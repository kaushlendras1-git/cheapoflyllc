import axios from "axios";
import showToast from './toast.js';

/**
 * Admin Notification Manager for Agent Login Requests
 */
class AdminNotificationManager {
    constructor() {
        this.pollInterval = null;
        this.isPolling = false;
        this.init();
    }

    init() {
        // Only start polling if user is admin in sales department
        if (this.isAdminInSales()) {
            this.startPolling();
        }
    }

    isAdminInSales() {
        // Check if current user is admin in sales department
        // This should be set by the backend in a global variable
        return window.userRole === 'admin' && window.userDepartment === 'sales';
    }

    startPolling() {
        if (this.isPolling) return;
        
        this.isPolling = true;
        this.pollInterval = setInterval(() => {
            this.checkForNotifications();
        }, 3000); // Check every 3 seconds
    }

    stopPolling() {
        if (this.pollInterval) {
            clearInterval(this.pollInterval);
            this.pollInterval = null;
            this.isPolling = false;
        }
    }

    async checkForNotifications() {
        try {
            const response = await axios.get('/agent/admin-notifications');
            
            if (response.data && response.data.type === 'agent_login_request') {
                this.showAgentLoginNotification(response.data);
            }
        } catch (error) {
            console.error('Error checking notifications:', error);
        }
    }

    showAgentLoginNotification(notification) {
        // Show toast notification
        showToast(notification.message, 'info', 10000); // Show for 10 seconds
        
        // Play notification sound if available
        this.playNotificationSound();
        
        // Show browser notification if permission granted
        this.showBrowserNotification(notification);
    }

    playNotificationSound() {
        try {
            const audio = new Audio('/assets/audio/notification.mp3');
            audio.volume = 0.5;
            audio.play().catch(e => console.log('Could not play notification sound'));
        } catch (e) {
            console.log('Notification sound not available');
        }
    }

    showBrowserNotification(notification) {
        if ('Notification' in window && Notification.permission === 'granted') {
            new Notification('Agent Login Request', {
                body: notification.message,
                icon: '/favicon.ico',
                tag: 'agent-login-request'
            });
        } else if ('Notification' in window && Notification.permission !== 'denied') {
            Notification.requestPermission().then(permission => {
                if (permission === 'granted') {
                    new Notification('Agent Login Request', {
                        body: notification.message,
                        icon: '/favicon.ico',
                        tag: 'agent-login-request'
                    });
                }
            });
        }
    }

    destroy() {
        this.stopPolling();
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.adminNotificationManager = new AdminNotificationManager();
});

// Cleanup when page unloads
window.addEventListener('beforeunload', function() {
    if (window.adminNotificationManager) {
        window.adminNotificationManager.destroy();
    }
});

export default AdminNotificationManager;