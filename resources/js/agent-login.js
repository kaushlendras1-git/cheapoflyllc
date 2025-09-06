/**
 * Agent Login Request System
 */

// Toast notification function
function showToast(message, type = 'info') {
    const toastContainer = document.getElementById('toast-container') || createToastContainer();
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'primary'} border-0`;
    toast.setAttribute('role', 'alert');
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">${message}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    toastContainer.appendChild(toast);
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    setTimeout(() => toast.remove(), 5000);
}

function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'toast-container position-fixed top-0 end-0 p-3';
    container.style.zIndex = '9999';
    document.body.appendChild(container);
    return container;
}

/**
 * Agent Login Request Management
 */
class AgentLoginManager {
    constructor() {
        this.requestInterval = null;
        this.countdownInterval = null;
        this.currentRequestId = null;
        this.currentEmail = null;
        this.init();
    }

    init() {
        this.bindEvents();
        this.checkExistingRequest();
    }

    bindEvents() {
        const form = document.getElementById('agentRequestForm');
        if (form) {
            form.addEventListener('submit', (e) => this.handleSubmit(e));
        }

        const modal = document.getElementById('agentLoginModal');
        if (modal) {
            modal.addEventListener('hidden.bs.modal', () => this.resetModal());
        }
    }

    async checkExistingRequest() {
        // Skip for now - will be handled by form submission
    }

    async handleSubmit(e) {
        e.preventDefault();
        
        const email = document.getElementById('agentEmail').value;
        if (!email) {
            showToast('Please enter your email', 'error');
            return;
        }

        try {
            const response = await fetch('/agent/request-login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ email })
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.currentRequestId = data.request_id;
                this.currentEmail = email;
                this.showStatusView(data.expires_at);
                showToast('Request submitted successfully', 'success');
            } else {
                showToast(data.error || 'Failed to submit request', 'error');
            }
        } catch (error) {
            showToast('Failed to submit request', 'error');
        }
    }

    showStatusView(expiresAt) {
        document.getElementById('agentLoginForm').style.display = 'none';
        document.getElementById('agentLoginStatus').style.display = 'block';
        
        this.startCountdown(expiresAt);
        this.startPolling();
    }

    startCountdown(expiresAt) {
        const updateCountdown = () => {
            const now = new Date().getTime();
            const expiry = new Date(expiresAt).getTime();
            const timeLeft = Math.max(0, expiry - now);
            
            if (timeLeft <= 0) {
                this.cleanup();
                showToast('Request expired', 'error');
                this.resetModal();
                return;
            }
            
            const minutes = Math.floor(timeLeft / 60000);
            const seconds = Math.floor((timeLeft % 60000) / 1000);
            
            const countdownElement = document.getElementById('countdown');
            if (countdownElement) {
                countdownElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            }
        };
        
        updateCountdown();
        this.countdownInterval = setInterval(updateCountdown, 1000);
    }

    startPolling() {
        let retryCount = 0;
        const maxRetries = 3;
        
        this.requestInterval = setInterval(async () => {
            try {
                const response = await fetch(`/agent/check-request-status/${this.currentEmail}`);
                const data = await response.json();
                retryCount = 0;
                
                if (data.status === 'approved') {
                    this.cleanup();
                    showToast('Request approved! Redirecting...', 'success');
                    setTimeout(() => {
                        window.location.href = `/agent/auto-login/${this.currentRequestId}`;
                    }, 1500);
                } else if (data.status === 'rejected') {
                    this.cleanup();
                    showToast('Request rejected by admin', 'error');
                    this.resetModal();
                } else if (data.status === 'expired') {
                    this.cleanup();
                    showToast('Request expired', 'error');
                    this.resetModal();
                } else if (data.status === 'none') {
                    this.cleanup();
                    showToast('Request not found', 'error');
                    this.resetModal();
                }
            } catch (error) {
                console.error('Polling error:', error);
                retryCount++;
                
                if (retryCount >= maxRetries) {
                    this.cleanup();
                    showToast('Connection error. Please try again.', 'error');
                    this.resetModal();
                }
            }
        }, 2000);
    }

    cancelRequest() {
        this.cleanup();
        this.resetModal();
    }

    cleanup() {
        if (this.requestInterval) {
            clearInterval(this.requestInterval);
            this.requestInterval = null;
        }
        if (this.countdownInterval) {
            clearInterval(this.countdownInterval);
            this.countdownInterval = null;
        }
    }

    resetModal() {
        this.cleanup();
        document.getElementById('agentLoginForm').style.display = 'block';
        document.getElementById('agentLoginStatus').style.display = 'none';
        document.getElementById('agentRequestForm').reset();
        this.currentRequestId = null;
        this.currentEmail = null;
        
        const countdownElement = document.getElementById('countdown');
        if (countdownElement) {
            countdownElement.textContent = '';
        }
    }
}

/**
 * Admin Login Request Management
 */
class AdminLoginManager {
    constructor() {
        this.notificationInterval = null;
        this.timerInterval = null;
        this.lastNotificationCheck = 0;
        this.lastPendingCount = 0;
        this.init();
    }

    init() {
        this.updatePendingCount();
        this.startPolling();
        this.bindAdminEvents();
    }

    bindAdminEvents() {
        const modal = document.getElementById('loginRequestsModal');
        if (modal) {
            modal.addEventListener('show.bs.modal', () => this.loadPendingRequests());
            modal.addEventListener('hidden.bs.modal', () => this.stopTimers());
        }
    }

    startPolling() {
        this.notificationInterval = setInterval(async () => {
            await this.updatePendingCount();
        }, 3000);
    }

    async updatePendingCount() {
        try {
            const response = await fetch('/agent/pending-requests');
            const data = await response.json();
            const countElement = document.getElementById('pendingCount');
            if (countElement) {
                const count = data.length;
                
                if (count > this.lastPendingCount) {
                    showToast(`New login request received! (${count} pending)`, 'warning');
                }
                
                this.lastPendingCount = count;
                countElement.textContent = count;
            }
        } catch (error) {
            console.error('Error updating count:', error);
        }
    }

    startModalTimers() {
        this.stopTimers();
        const timers = document.querySelectorAll('.timer');
        
        const updateTimers = () => {
            timers.forEach(timer => {
                const expiresAt = new Date(timer.dataset.expires);
                const now = new Date();
                const timeLeft = Math.max(0, Math.floor((expiresAt - now) / 1000));
                
                if (timeLeft <= 0) {
                    timer.textContent = 'Expired';
                    timer.className = 'text-danger';
                } else {
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;
                    timer.textContent = `Expires in: ${minutes}:${seconds.toString().padStart(2, '0')}`;
                }
            });
        };
        
        updateTimers();
        this.timerInterval = setInterval(updateTimers, 1000);
    }

    stopTimers() {
        if (this.timerInterval) {
            clearInterval(this.timerInterval);
            this.timerInterval = null;
        }
    }

    async loadPendingRequests() {
        try {
            const response = await fetch('/agent/pending-requests');
            const data = await response.json();
            const listContainer = document.getElementById('loginRequestsList');
            
            if (data.length === 0) {
                listContainer.innerHTML = '<div class="text-center text-muted">No pending requests</div>';
                this.stopTimers();
                return;
            }
            
            let html = '<div class="list-group">';
            data.forEach(request => {
                html += `
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>${request.user.name}</strong> (${request.user.email})<br>
                            <small class="text-muted">Requested: ${new Date(request.requested_at).toLocaleString()}</small><br>
                            <small class="text-warning timer" data-expires="${request.expired_at}">Calculating...</small>
                        </div>
                        <div>
                            <button class="btn btn-success btn-sm me-1" onclick="window.adminLoginManager.approveRequest(${request.id}, 'approve')">
                                Approve
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="window.adminLoginManager.approveRequest(${request.id}, 'reject')">
                                Reject
                            </button>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
            listContainer.innerHTML = html;
            this.startModalTimers();
        } catch (error) {
            console.error('Error loading requests:', error);
        }
    }

    async approveRequest(requestId, action) {
        try {
            const response = await fetch(`/agent/login-approval/${requestId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ action })
            });
            const data = await response.json();
            if (data.success) {
                this.loadPendingRequests();
                showToast(`Request ${action}d successfully`, 'success');
            } else {
                showToast('Error: ' + data.error, 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('An error occurred', 'error');
        }
    }
}

// Global functions
window.cancelRequest = function() {
    if (window.agentLoginManager) {
        window.agentLoginManager.cancelRequest();
    }
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.agentLoginManager = new AgentLoginManager();
    
    // Initialize admin manager if on admin page
    if (document.getElementById('loginRequestsModal')) {
        window.adminLoginManager = new AdminLoginManager();
    }
});