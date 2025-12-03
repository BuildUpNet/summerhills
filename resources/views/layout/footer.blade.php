 <!-- Footer -->
    <footer class="app-footer mt-5">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-3 col-md-6"  data-anim="fade-right">
            <h5 class="fw-bold text-white mb-3"><span
            style="
              font-size: 1.5rem;
              font-weight: bold;
              color: var(--dark-color)2
            "
            >Summer<span style="color: var(--primary-color)">Hill</span>&nbsp;
            Liquor</span
          ></h5>
            <p class="small">
              Providing the finest selection of spirits since 2013.
            </p>
            <p class="small mb-1">
              <i class="bi bi-telephone-fill me-2" style="color: var(--primary-color);"></i> 
              587-600-1325
            </p>
            <p class="small mb-0">
              <i class="bi bi-geo-alt-fill me-2" style="color: var(--primary-color);"></i> 
              2145 Summerfield blvd se , Unit #3, Airdrie, Alberta
T4B1X5, Canada
            </p>
          </div>

          <div class="col-lg-3 col-md-6"  data-anim="fade-right">
            <h5>Information</h5>
            <ul class="list-unstyled small">
                <li class="mb-2"><a href="{{ url('/') }}">Home</a></li>
              <li class="mb-2"><a href="{{ url('/about') }}">About</a></li>
               <li class="mb-2"><a href="{{ route('products.show') }}">Products</a></li>
              <li class="mb-2"><a href="#">Privacy Policy</a></li>
              <li class="mb-2"><a href="#">Terms & Conditions</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6"  data-anim="fade-left">
            <h5>Customer Service</h5>
            <ul class="list-unstyled small">
              <li class="mb-2"><a href="{{ url('/contact') }}">Contact Us</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6"  data-anim="fade-left">
            <h5>Connect</h5>
            <div class="social-icons mb-4">
              <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
              <a href="https://www.instagram.com/summerhill_liquor?igsh=cXBzNzl4c3VsaGE2" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>
      
      <div class="copyright-bar">
        <div class="container">
          <div class="row pt-3">
            <div class="col-md-6 text-center text-md-start">
              <p class="small mb-0">
                &copy; {{ date('Y') }}  <span
            style="
              
              font-weight: bold;
              color: var(--dark-color)2
            "
            >Summer<span style="color: var(--primary-color)">Hill</span>&nbsp;
            Liquor.</span
          >  All Rights Reserved.
              </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
              <p class="small mb-0">
                Developed and Designed by 
                <a href="https://buildupnet.com" target="_blank" rel="noopener noreferrer">Buildupnet</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    
     <!-- jQuery (Required First) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Bootstrap Bundle JS (includes Popper.js) -->
    <script 
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    AOS.init({
      duration: 1000,
      once: true,
      offset: 100,
    });
  });
</script>

    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <!-- Custom Main JS -->
    <!--<script src="{{ asset('assets/js/main.js') }}"></script>-->
    <script src="{{ asset('assets/js/main.js') }}?v=3.0"></script>
<!-- ScrollReveal CDN -->
<script src="https://unpkg.com/scrollreveal"></script>

<script>
  const sr = ScrollReveal({
    distance: '60px',
    duration: 1000,
    easing: 'ease-out',
    reset: true, // 👈 Repeats animation every time the element enters viewport
    viewFactor: 0.2 // optional: triggers when 20% of element is visible
  });

  sr.reveal('[data-anim="fade-right"]', { origin: 'right' });
  sr.reveal('[data-anim="fade-left"]', { origin: 'left' });
  sr.reveal('[data-anim="fade-up"]', { origin: 'bottom' });
  sr.reveal('[data-anim="fade-down"]', { origin: 'top' });
</script>
<script>
document.addEventListener('contextmenu', event => event.preventDefault());
</script>
<script>
    document.onkeydown = function(e) {
        // Disable F12
        if(e.keyCode == 123) {
            return false;
        }
     
        if(e.ctrlKey && e.shiftKey && (e.key === "I" || e.key === "C" || e.key === "J")) {
            return false;
        }
       
        if(e.ctrlKey && e.key === "u") {
            return false;
        }
       
        if(e.ctrlKey && (e.key === "c" || e.key === "x" || e.key === "s")) {
            return false;
        }
    };
</script>


<script>
document.addEventListener('copy', function(e){
    e.preventDefault();
});
</script>

  </body>
</html>