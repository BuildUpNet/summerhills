<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SummerHill Liquor | Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
      <!-- Font Awesome - FIXED VERSION WITHOUT INTEGRITY -->
    <link 
      rel="stylesheet" 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      crossorigin="anonymous" 
      referrerpolicy="no-referrer" 
    />
    
    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v=23.1">
    
    <style>
        :root {
            --primary-color: #f76b00;
            --primary-hover: #e06000;
            --primary-active: #d05500;
            --dark-color: #333;
            --light-text-color: #f0f0f0;
            --font-family: "Roboto Slab", serif;
            --transition-speed: 0.3s;
            --border-radius: 8px;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 15px rgba(0, 0, 0, 0.15);
            --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.25);
        }

        body {
            color: var(--dark-color);
            font-family: var(--font-family);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Form Container with Glassmorphism */
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 50px 40px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            max-width: 480px;
            width: 100%;
            margin: 0 auto;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .form-container h3 {
            font-size: 24px;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 30px;
            text-align: center;
        }

        .form-control {
            padding: 12px 12px 12px 45px;
            border-radius: var(--border-radius);
            border: 1px solid #ddd;
            font-size: 14px;
            transition: all var(--transition-speed);
            background-color: #fff;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(247, 107, 0, 0.2);
            outline: none;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 18px;
            z-index: 3;
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            font-size: 18px;
            z-index: 3;
            transition: color var(--transition-speed);
        }

        .toggle-password:hover {
            color: var(--primary-color);
        }

        .btn-custom {
            background-color: var(--primary-color);
            color: #fff;
            font-weight: 600;
            border-radius: var(--border-radius);
            padding: 12px 24px;
            font-size: 14px;
            border: none;
            transition: all var(--transition-speed);
            width: 100%;
        }

        .btn-custom:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(247, 107, 0, 0.4);
        }

        .btn-custom:active {
            background-color: var(--primary-active);
            transform: translateY(0);
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #6c757d;
        }

        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color var(--transition-speed);
        }

        .register-link a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .forgot-password-link {
            color: #6c757d;
            font-size: 12px;
            text-decoration: none;
            transition: color var(--transition-speed);
        }

        .forgot-password-link:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }

        /* Logo in form */
        .form-logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-logo-text {
            font-size: 20px;
            font-weight: 600;
            color: var(--dark-color);
        }

        .form-logo-text span {
            color: var(--primary-color);
        }

        /* Mobile responsive */
        @media (max-width: 576px) {
            .form-container {
                padding: 35px 25px;
            }

            .form-container h3 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
   <nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm py-3">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          <span
            style="
              font-size: 1.5rem;
              font-weight: bold;
              color: var(--dark-color); 
            "
            >Summer<span style="color: var(--primary-color)">Hill</span>&nbsp;
            Liquor</span
          >
        </a>
        
        <div class="collapse navbar-collapse justify-content-center d-none d-lg-flex" id="navbarNavDesktop">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item me-3">
              <a class="nav-link fw-bold active" aria-current="page" href="{{ url('/') }}">HOME</a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link fw-bold" href="{{ url('/about') }}">ABOUT</a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link fw-bold" href="{{ route('products.show') }}">PRODUCTS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold" href="{{ url('/contact') }}">CONTACT US</a>
            </li>
          </ul>
        </div>
        
        <div class="d-flex align-items-center">
            
          <div class="d-none d-lg-block"> 
            @auth
              <div class="dropdown me-3">
                  <a href="#" class="text-dark" title="My Account" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle h5"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                      @if(auth()->user()->role === 'user')
                          <li><a class="dropdown-item" href="{{ url('/account') }}">My Account</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li>
                              <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-new').submit();">Logout</a>
                          </li>
                      @endif
                  </ul>
              </div>
            @else
              <a href="{{ route('login') }}" class="text-dark me-3" title="Login/Register"><i class="bi bi-person-circle h5"></i></a>
            @endauth
          </div>

          <a href="#" class="text-dark me-3" title="Wishlist"><i class="bi bi-heart h5"></i></a>
          
          <button
            class="navbar-toggler" 
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        
      </div>
    </nav>
    
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                 <a class="navbar-brand" href="{{ url('/') }}">
                    <span style="font-size: 1.5rem; font-weight: bold; color: var(--dark-color)">Summer<span style="color: var(--primary-color)">Hill</span>&nbsp;
                        Liquor</span>
                 </a>
            </h5>
            <button type="button" class="btn-close"   aria-label="Close"></button>
        </div>
        
        <div class="offcanvas-body d-flex flex-column">
            <ul class="navbar-nav flex-grow-1 pe-3">
                <li class="nav-item">
                    <a class="nav-link fw-bold active" aria-current="page" href="{{ url('/') }}" >HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold"  href="{{ url('/about') }}" >ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="{{ route('products.show') }}" >PRODUCTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="{{ url('/contact') }}" >CONTACT US</a>
                </li>
                 <li class="nav-item mt-3 pt-3 border-top">
                    @auth
                        @if(auth()->user()->role === 'user')
                           <a href="{{ url('/account') }}" class="nav-link fw-bold text-primary" >MY ACCOUNT</a>
                           <a href="{{ route('logout') }}" class="nav-link fw-bold" onclick="event.preventDefault(); document.getElementById('logout-form-new-mobile').submit();" >LOGOUT</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="nav-link fw-bold" >LOGIN / REGISTER</a>
                    @endauth
                </li>
            </ul>
            
            <div class="mt-auto pt-4 border-top">
                
                <h6 class="fw-bold mb-2 small-text">Connect with Us</h6>
                <div class="d-flex justify-content-start mb-4 social-icons-mobile">
                    <a href="#" class="text-dark me-3"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="https://www.instagram.com/summerhill_liquor?igsh=cXBzNzl4c3VsaGE2" class="text-dark me-3"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
                
                <h6 class="fw-bold mb-2 small-text">Contact Info</h6>
                <div class="contact-details-mobile">
                    <p class="mb-1 text-dark"><i class="bi bi-telephone-fill me-2" style="color: var(--primary-color);"></i> 587-600-1325</p>
                    <p class="mb-1 text-dark"><i class="bi bi-envelope-fill me-2" style="color: var(--primary-color);"></i> info@summerhill.com</p>
                    <p class="mb-0 text-dark"><i class="bi bi-geo-alt-fill me-2" style="color: var(--primary-color);"></i> 2145 Summerfield blvd se , Unit #3, Airdrie, Alberta
T4B1X5, Canada</p>
                </div>
            </div>
        </div>
    </div>
    
    <form id="logout-form-new" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <form id="logout-form-new-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Login Form Section with Local Background Image -->
    <div class="d-flex align-items-center justify-content-center" 
         style="min-height: 100vh; 
                background-image: url('{{ asset('assets/images/img-1.jpg') }}'); 
                background-size: cover; 
                background-position: center; 
                background-attachment: fixed; 
                position: relative; 
                padding: 80px 20px 0 20px;
                margin: 0;">
        
        <!-- Dark overlay with primary color tint -->
        <div style="content: ''; 
                    position: absolute; 
                    top: 0; 
                    left: 0; 
                    width: 100%; 
                    height: 100%; 
                    background: linear-gradient(135deg, rgba(51, 51, 51, 0.85), rgba(247, 107, 0, 0.3)); 
                    z-index: 1;">
        </div>

        <!-- Form Container -->
        <div class="form-container" data-aos="zoom-in" data-aos-duration="800" style="position: relative; z-index: 2;">
            <!-- Logo -->
            <div class="form-logo">
                <span class="form-logo-text">Summer<span>Hill</span> Liquor</span>
            </div>

            <h3>Welcome Back</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group-custom">
                    <i class="bi bi-envelope input-icon"></i>
                    <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="input-group-custom password-wrapper">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password" id="password" required>
                    <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
                </div>

                <div class="text-end mb-3">
                    <a href="#" class="forgot-password-link">Forgot Password?</a>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-custom">Login</button>
                </div>

                <div class="register-link">
                    Don't have an account? <a href="{{ route('register') }}">Register here</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="app-footer mt-5">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-3 col-md-6" data-aos="fade-right">
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

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <h5>Information</h5>
            <ul class="list-unstyled small">
                <li class="mb-2"><a href="{{ url('/') }}">Home</a></li>
              <li class="mb-2"><a href="{{ url('/about') }}">About</a></li>
               <li class="mb-2"><a href="{{ route('products.show') }}">Products</a></li>
              <li class="mb-2"><a href="#">Privacy Policy</a></li>
              <li class="mb-2"><a href="#">Terms & Conditions</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <h5>Customer Service</h5>
            <ul class="list-unstyled small">
              <li class="mb-2"><a href="{{ url('/contact') }}">Contact Us</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-left" data-aos-delay="300">
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

    <!-- Scripts -->
      <script 
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
        });
    </script>

    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonColor: '#f76b00'
                });
            });
        </script>
    @endif

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
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
