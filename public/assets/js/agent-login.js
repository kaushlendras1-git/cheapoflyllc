/**
 * Agent Login Request Functionality
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

    async handleSubmit(e) {
        e.preventDefault();
        
        const email = document.getElementById('agentEmail').value;
        
        try {
            const requestResponse = await fetch('/agent/request-login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': this.getCsrfToken()
                },
                body: JSON.stringify({ email })
            });
            
            if (!requestResponse.ok) {
                const errorText = await requestResponse.text();
                console.error('Server response:', errorText);
                this.showError(`Server error: ${requestResponse.status}`);
                return;
            }
            
            const result = await requestResponse.json();
            console.log('Server response:', result);
            
            if (result.success) {
                this.currentRequestId = result.request_id;
                this.currentEmail = email;
                this.showStatusView(result.expires_at);
                this.startPolling();
            } else {
                this.showError(result.error || 'Failed to submit request');
            }
        } catch (error) {
            this.showError('Error: ' + error.message);
        }
    }

    showStatusView(expiresAt) {
        document.getElementById('agentLoginForm').style.display = 'none';
        document.getElementById('agentLoginStatus').style.display = 'block';
        this.startCountdown(expiresAt);
    }

    startCountdown(expiresAt) {
        const expiry = new Date(expiresAt);
        
        this.countdownInterval = setInterval(() => {
            const now = new Date();
            const timeLeft = expiry - now;
            
            if (timeLeft <= 0) {
                clearInterval(this.countdownInterval);
                document.getElementById('countdown').textContent = 'Expired';
                this.cancelRequest();
                return;
            }
            
            const minutes = Math.floor(timeLeft / 60000);
            const seconds = Math.floor((timeLeft % 60000) / 1000);
            document.getElementById('countdown').textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
        }, 1000);
    }

    startPolling() {
        this.requestInterval = setInterval(async () => {
            try {
                const response = await fetch(`/agent/check-request-status/${this.currentEmail}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                
                const result = await response.json();
                
                if (result.status === 'approved') {
                    this.cleanup();
                    window.location.href = `/agent/auto-login/${this.currentRequestId}`;
                } else if (result.status === 'rejected' || result.status === 'expired') {
                    this.cleanup();
                    this.showError('Request ' + result.status);
                    this.resetModal();
                }
            } catch (error) {
                console.error('Polling error:', error);
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
        document.getElementById('agentLoginForm').style.display = 'block';
        document.getElementById('agentLoginStatus').style.display = 'none';
        document.getElementById('agentRequestForm').reset();
        this.currentRequestId = null;
        this.currentEmail = null;
    }

    showError(message) {
        alert(message); // You can replace this with a better notification system
    }

    getCsrfToken() {
        const token = document.querySelector('meta[name="csrf-token"]');
        return token ? token.getAttribute('content') : '';
    }
}

// Global function for cancel button
window.cancelRequest = function() {
    if (window.agentLoginManager) {
        window.agentLoginManager.cancelRequest();
    }
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.agentLoginManager = new AgentLoginManager();
});