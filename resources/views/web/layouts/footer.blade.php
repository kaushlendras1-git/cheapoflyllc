            <!-- <div class="content-backdrop fade"></div> -->
          </div>
          <!--/ Content wrapper -->
        </div>
        <!--/ Layout container -->
      </div>
    </div>
    </div>
   </div>
    <div class="crm-copyright text-center">
      <p class="mb-0">© {{date('Y')}}. Copyright Cheapoflyllc. All rights are reserved</p>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('assets/js/addMore.js') }}"></script>
    @vite('resources/js/agent-login.js')
    @vite('resources/js/booking/edit.js')
    @vite('resources/js/auth/sendAuth.js')
    @vite('resources/js/booking/pricing.js')
    @vite('resources/js/booking/cruise.js')
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('load', function() {
                document.getElementById('loader-overlay').style.display = 'none';
            });
        });
    </script>
  </body>
</html>
