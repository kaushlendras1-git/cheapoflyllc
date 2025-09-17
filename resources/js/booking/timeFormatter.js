document.addEventListener('DOMContentLoaded', function() {
    // Add CSS for time format indicator
    const style = document.createElement('style');
    style.textContent = `
        .time-format-indicator {
            position: absolute;
            top: 2px;
            right: 2px;
            background: #055bdb;
            color: white;
            font-size: 7px;
            padding: 1px 2px;
            border-radius: 8px;
            pointer-events: none;
            z-index: 10;
            min-width: 20px;
            text-align: center;
        }
    `;
    document.head.appendChild(style);

    // Function to convert 24-hour to 12-hour format
    function convertTo12Hour(time24) {
        const [hours, minutes] = time24.split(':');
        const hour = parseInt(hours);
        const min = minutes || '00';
        
        if (hour === 0) return `12:${min} AM`;
        if (hour < 12) return `${hour}:${min} AM`;
        if (hour === 12) return `12:${min} PM`;
        return `${hour - 12}:${min} PM`;
    }

    // Function to format incomplete time input
    function formatTimeInput(value) {
        const parts = value.split(':');
        if (parts.length === 2) {
            const hours = parts[0].padStart(2, '0');
            const minutes = parts[1].padStart(2, '0');
            return `${hours}:${minutes}`;
        }
        return value;
    }

    // Function to update tooltip and indicator with converted time
    function updateTimeTooltip(input, autoFormat = false) {
        let value = input.value.trim();
        const indicator = input.parentElement.querySelector('.time-format-indicator');
        
        if (!value) {
            input.title = "Enter time in 12-hour (3:30 PM) or 24-hour (15:30) format";
            if (indicator) indicator.style.display = 'none';
            return;
        }

        // Auto-format incomplete time input only on blur
        if (autoFormat && value.includes(':') && value.length >= 3) {
            const formatted = formatTimeInput(value);
            if (formatted !== value) {
                input.value = formatted;
                value = formatted;
            }
        }

        // Check if it's 24-hour format (HH:MM)
        const time24Pattern = /^([01]?\d|2[0-3]):([0-5]\d)$/;
        const time12Pattern = /^(1[0-2]|0?[1-9]):([0-5]\d)\s?(AM|PM)$/i;

        if (time24Pattern.test(value) && !time12Pattern.test(value)) {
            const convertedTime = convertTo12Hour(value);
            input.title = `Converts to: ${convertedTime}`;
            if (indicator) {
                indicator.textContent = convertedTime;
                indicator.style.display = 'block';
            }
        } else {
            input.title = "Enter time in 12-hour (3:30 PM) or 24-hour (15:30) format";
            if (indicator) indicator.style.display = 'none';
        }
    }

    // Attach event listeners to all time-12hr inputs
    function attachTimeFormatters() {
        document.querySelectorAll('.time-12hr').forEach(input => {
            if (input.dataset.timeFormatterAttached) return;
            
            input.addEventListener('input', function() {
                updateTimeTooltip(this, false);
            });
            
            input.addEventListener('blur', function() {
                updateTimeTooltip(this, true);
            });
            
            // Check initial value on page load
            updateTimeTooltip(input);
            
            input.dataset.timeFormatterAttached = 'true';
        });
    }

    // Initial setup
    attachTimeFormatters();

    // Observer for dynamically added elements
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1) {
                        const timeInputs = node.querySelectorAll('.time-12hr');
                        timeInputs.forEach(input => {
                            if (!input.dataset.timeFormatterAttached) {
                                input.addEventListener('input', function() {
                                    updateTimeTooltip(this, false);
                                });
                                
                                input.addEventListener('blur', function() {
                                    updateTimeTooltip(this, true);
                                });
                                
                                // Check initial value for dynamically added inputs
                                updateTimeTooltip(input);
                                
                                input.dataset.timeFormatterAttached = 'true';
                            }
                        });
                    }
                });
            }
        });
    });

    // Start observing
    const containers = ['flightForms', 'carForms', 'trainForms'];
    containers.forEach(containerId => {
        const container = document.getElementById(containerId);
        if (container) {
            observer.observe(container, { childList: true, subtree: true });
        }
    });
});