<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SummerHill Liquor</title>

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    
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
    
    <!-- Swiper CSS -->
    <link 
      rel="stylesheet" 
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" 
    />
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&family=Mona+Sans:ital,wght@0,200..900;1,200..900&family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v=6.4">
  </head>
  <body>
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

          <a href="{{ route('wishlist.show') }}" class="text-dark me-3" title="Wishlist"><i class="bi bi-heart h5"></i></a>
          
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
            <button type="button" class="btn-close"  aria-label="Close"></button>
        </div>
        
        <div class="offcanvas-body d-flex flex-column">
            <ul class="navbar-nav flex-grow-1 pe-3">
                <li class="nav-item">
                    <a class="nav-link fw-bold active" aria-current="page" href="{{ url('/') }}" >HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="{{ url('/about') }}" >ABOUT</a>
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
                    <a href="#" class="text-dark me-3"><i class="fab fa-instagram fa-lg"></i></a>
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