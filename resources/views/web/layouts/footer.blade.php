<!-- <div class="content-backdrop fade"></div> -->
</div>
<!--/ Content wrapper -->
</div>
<!--/ Layout container -->
</div>
</div>
</div>
</div>
<div class="crm-footer">
  <div class="container-fluid text-center">
    <p class="footer-text mb-0">
      © {{ date('Y') }} <span class="brand">Cheapofly LLC</span>. All rights reserved.
    </p>
  </div>
</div>
<style>
  .crm-footer {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: #fff;
    padding: .2rem 0;
    margin-top: .8rem;
    text-align: center;
    position: relative;
    z-index: 10;
    border-top: 1px solid rgba(255, 255, 255, 0.15);
    box-shadow: 0 -4px 20px rgba(28, 49, 109, 0.15);
    transition: all 0.3s ease;
  }

  .crm-footer:hover {
    background: linear-gradient(135deg, var(--primary-light), var(--primary));
  }

  .crm-footer .footer-text {
    font-size: 0.7rem;
    letter-spacing: 0.3px;
    font-weight: 500;
    color: #e5e9f2;
    margin: 0;
  }

  .crm-footer .footer-text .brand {
    font-weight: 700;
    color: #ffffff;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* ✨ Optional Glow Effect */
  .crm-footer::before {
    content: '';
    position: absolute;
    top: -2px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: var(--warning);
    border-radius: 2px;
  }

  /* 📱 Responsive Footer */
  @media (max-width: 768px) {
    .crm-footer {
      padding: 1rem;
    }

    .crm-footer .footer-text {
      font-size: 0.9rem;
    }
  }
</style>
<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
<div class="drag-target"></div>

<!-- Core Scripts (Critical) -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page-specific Scripts (Conditional Loading) -->
@if(request()->routeIs('booking.*'))
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="{{ asset('assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.js"></script>
    @vite('resources/js/booking/edit.js')
    @vite('resources/js/booking/pricing.js')
    @vite('resources/js/booking/cruise.js')
     @vite('resources/js/auth/sendAuth.js')
@endif

@if(request()->routeIs('*.index') || request()->routeIs('dashboard'))
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}" defer></script>
@endif

@if(request()->routeIs('call-logs.*') || request()->routeIs('booking.*'))
    <script src="{{ asset('assets/js/country-phone.js') }}" defer></script>
    @vite('resources/js/country-phone.js')
@endif



@if(request()->routeIs('agent.*'))
    @vite('resources/js/agent-login.js')
@endif

<!-- Non-critical Scripts (Async) -->
<script src="https://code.iconify.design/3/3.1.0/iconify.min.js" async></script>
<script src="{{ asset('assets/js/addMore.js') }}" defer></script>
@vite('resources/js/booking/otherMain.js')

<script>
  // Optimized loader hide
  window.addEventListener('load', () => {
    const loader = document.getElementById('loader-overlay');
    if (loader) loader.style.display = 'none';
  });
</script>

<style>
/* CSS */
.readonly-select {
  position: relative;
  display: inline-block; /* or block; match your layout */
  width: 100%;           /* if you want full width */
}

/* make select normal-looking */
.readonly-select select {
  width: 100%;
  box-sizing: border-box;
  appearance: none;      /* optional: hides native arrow in some browsers */
  -webkit-appearance: none;
  -moz-appearance: none;
}

/* overlay that blocks mouse/touch */
.readonly-select .select-block {
  position: absolute;
  inset: 0;              /* top:0; right:0; bottom:0; left:0; */
  cursor: default;       /* shows non-interactive cursor */
  background: transparent;
  z-index: 2;
}

/* Optional: visually indicate readonly */
.readonly-select select {
  background-color: #f5f5f5;
  color: #444;
}
</style>


</body>

</html>