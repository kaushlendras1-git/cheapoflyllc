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
    padding: 1.2rem 0;
    margin-top: 2rem;
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
    font-size: 0.95rem;
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
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/popular.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('assets/css/country-phone.css') }}" rel="stylesheet" />
<script src="{{ asset('assets/js/country-phone.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('assets/js/addMore.js') }}"></script>
@vite('resources/js/agent-login.js')
@vite('resources/js/booking/edit.js')
@vite('resources/js/booking/otherMain.js')
@vite('resources/js/country-phone.js')
@vite('resources/js/auth/sendAuth.js')
@vite('resources/js/booking/pricing.js')
@vite('resources/js/booking/cruise.js')

<script>
  document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function () {
      document.getElementById('loader-overlay').style.display = 'none';
    });
  });
</script>


<script>
  (function () {
    var rcs = document.createElement("script");
    rcs.src = "https://apps.ringcentral.com/integration/ringcentral-embeddable/latest/adapter.js";
    var rcs0 = document.getElementsByTagName("script")[0];
    rcs0.parentNode.insertBefore(rcs, rcs0);
  })();
</script>


</body>

</html>