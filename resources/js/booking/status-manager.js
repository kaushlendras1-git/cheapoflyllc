import axios from 'axios';

class StatusManager {
    constructor() {
        this.bookingStatusSelect = null;
        this.paymentStatusSelect = null;
        this.userDepartment = null;
        this.userRole = null;
        this.init();
    }

    init() {
        document.addEventListener('DOMContentLoaded', () => {
            this.bookingStatusSelect = document.querySelector('select[name="booking_status_id"]');
            this.paymentStatusSelect = document.querySelector('select[name="payment_status_id"]');
            
            if (this.bookingStatusSelect && this.paymentStatusSelect) {
                this.getUserInfo();
                this.bindEvents();
                // Load initial payment statuses for current booking status
                const currentBookingStatus = this.bookingStatusSelect.value;
                if (currentBookingStatus) {
                    this.updatePaymentStatuses(currentBookingStatus);
                }
            }
        });
    }

    getUserInfo() {
        // Get user info from meta tags or data attributes
        const userDeptMeta = document.querySelector('meta[name="user-department"]');
        const userRoleMeta = document.querySelector('meta[name="user-role"]');
        
        this.userDepartment = userDeptMeta ? userDeptMeta.getAttribute('content') : null;
        this.userRole = userRoleMeta ? userRoleMeta.getAttribute('content') : null;
    }

    bindEvents() {
        this.bookingStatusSelect.addEventListener('change', (e) => {
            this.updatePaymentStatuses(e.target.value);
        });
    }

    async updatePaymentStatuses(bookingStatusId) {
        // console.log('Updating payment statuses for:', {
        //     bookingStatusId,
        //     department: this.userDepartment,
        //     role: this.userRole
        // });

        if (!bookingStatusId || !this.userDepartment || !this.userRole) {
            // console.log('Missing required data');
            return;
        }

        try {
            const response = await axios.get('/api/payment-statuses-by-booking', {
                params: {
                    booking_status_id: bookingStatusId,
                    department: this.userDepartment,
                    role: this.userRole
                },
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            });

            // console.log('API Response:', response.data);
            this.populatePaymentStatuses(response.data.payment_statuses);
        } catch (error) {
            console.error('Error fetching payment statuses:', error);
        }
    }

    populatePaymentStatuses(paymentStatuses) {
        // console.log('Populating payment statuses:', paymentStatuses);
        
        // Keep current selection if exists
        const currentValue = this.paymentStatusSelect.value;
        
        // Clear existing options except the first (current) one
        const firstOption = this.paymentStatusSelect.querySelector('option[selected]');
        this.paymentStatusSelect.innerHTML = '';
        
        if (firstOption) {
            this.paymentStatusSelect.appendChild(firstOption);
        }

        // Add new options
        paymentStatuses.forEach(status => {
            if (status.id != currentValue) {
                const option = document.createElement('option');
                option.value = status.id;
                option.textContent = `${status.name} - ${status.id}`;
                this.paymentStatusSelect.appendChild(option);
            }
        });
        
        // console.log('Payment status options updated');
    }
}

// Initialize the status manager
new StatusManager();

export default StatusManager;