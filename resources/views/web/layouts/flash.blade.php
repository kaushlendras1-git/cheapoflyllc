<style>
.alert__notification {
    opacity: 1;
    visibility: visible;
    transition: opacity 0.4s ease, visibility 0.4s ease, transform 0.4s ease;
}

.alert__notification.hide {
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
}
</style>

<!-- Success Notification -->
@if(session('success'))
<div class="alert__notification alert__notification--success show" role="alert" id="alertSuccess">
    <div class="alert__icon">
        <span class="iconify" data-icon="mdi:check-circle-outline" style="font-size: 1.4rem;"></span>
    </div>
    <div class="alert__content">
        <strong>Success!</strong> {{ session('success') }}
    </div>
    <button type="button" class="alert__close" id="alertCloseSuccess" aria-label="Close">
        <span class="iconify" data-icon="mdi:close"></span>
    </button>
</div>
@endif

<!--Validation Errors -->
@if ($errors->any())
<div class="alert__notification alert__notification--error show" role="alert" id="alertError">
    <div class="alert__icon">
        <span class="iconify" data-icon="mdi:alert-circle-outline" style="font-size: 1.4rem;"></span>
    </div>
    <div class="alert__content">
        <strong>Error!</strong>
        <ul class="mb-0 mt-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <button type="button" class="alert__close" id="alertCloseError" aria-label="Close">
        <span class="iconify" data-icon="mdi:close"></span>
    </button>
</div>
@endif


<script>
document.addEventListener('DOMContentLoaded', function() {
    function closeAlert(alertId) {
        const alert = document.getElementById(alertId);
        if (alert) {
            alert.classList.add('hide');
            setTimeout(() => alert.remove(), 400);
        }
    }

    // Close on click (Success)
    const closeSuccess = document.getElementById('alertCloseSuccess');
    if (closeSuccess) {
        closeSuccess.addEventListener('click', function() {
            closeAlert('alertSuccess');
        });
    }

    // Close on click (Error)
    const closeError = document.getElementById('alertCloseError');
    if (closeError) {
        closeError.addEventListener('click', function() {
            closeAlert('alertError');
        });
    }

    // Auto-close after 5 seconds
    setTimeout(() => {
        closeAlert('alertSuccess');
        closeAlert('alertError');
    }, 5000);
});
</script>