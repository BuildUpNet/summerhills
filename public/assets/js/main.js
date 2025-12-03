/**
 * SummerHill Liquor - Main JavaScript
 * Production Ready Version
 */


(function ($) {
  "use strict";

  // ============================================
  // PARALLAX SETUP
  // ============================================
  if ($.fn.stellar) {
    $(window).stellar({
      responsive: true,
      parallaxBackgrounds: true,
      parallaxElements: true,
      horizontalScrolling: false,
      hideDistantElements: false,
      scrollProperty: "scroll",
    });
  }

  // ============================================
  // FULL HEIGHT SECTION
  // ============================================
  var fullHeight = function () {
    $(".js-fullheight").css("height", $(window).height());
    $(window).resize(function () {
      $(".js-fullheight").css("height", $(window).height());
    });
  };
  fullHeight();

  // ============================================
  // LOADER
  // ============================================
  var loader = function () {
    setTimeout(function () {
      if ($("#ftco-loader").length > 0) {
        $("#ftco-loader").removeClass("show");
      }
    }, 1);
  };
  loader();

  // ============================================
  // TESTIMONIAL CAROUSEL
  // ============================================
  if ($.fn.owlCarousel) {
    $(".carousel-testimony").owlCarousel({
      center: true,
      loop: true,
      autoplay: true,
      autoplaySpeed: 2000,
      items: 1,
      margin: 30,
      stagePadding: 0,
      nav: false,
      navText: [
        '<span class="ion-ios-arrow-back">',
        '<span class="ion-ios-arrow-forward">',
      ],
      responsive: {
        0: { items: 1 },
        600: { items: 2 },
        1000: { items: 3 },
      },
    });
  }

  // ============================================
  // NAVBAR DROPDOWN HOVER
  // ============================================
  $("nav .dropdown").hover(
    function () {
      var $this = $(this);
      $this.addClass("show");
      $this.find("> a").attr("aria-expanded", true);
      $this.find(".dropdown-menu").addClass("show");
    },
    function () {
      var $this = $(this);
      $this.removeClass("show");
      $this.find("> a").attr("aria-expanded", false);
      $this.find(".dropdown-menu").removeClass("show");
    }
  );

  // ============================================
  // COUNTER ANIMATION
  // ============================================
  if ($.fn.waypoint && $.animateNumber) {
    $("#section-counter, .wrap-about, .ftco-counter").waypoint(
      function (direction) {
        if (
          direction === "down" &&
          !$(this.element).hasClass("ftco-animated")
        ) {
          var comma_separator_number_step =
            $.animateNumber.numberStepFactories.separator(",");
          $(".number").each(function () {
            var $this = $(this),
              num = $this.data("number");
            $this.animateNumber(
              {
                number: num,
                numberStep: comma_separator_number_step,
              },
              7000
            );
          });
        }
      },
      { offset: "95%" }
    );
  }

  // ============================================
  // SCROLL ANIMATION
  // ============================================
  if ($.fn.waypoint) {
    var i = 0;
    $(".ftco-animate").waypoint(
      function (direction) {
        if (
          direction === "down" &&
          !$(this.element).hasClass("ftco-animated")
        ) {
          i++;
          $(this.element).addClass("item-animate");
          setTimeout(function () {
            $("body .ftco-animate.item-animate").each(function (k) {
              var el = $(this);
              setTimeout(
                function () {
                  var effect = el.data("animate-effect");
                  if (effect === "fadeIn") {
                    el.addClass("fadeIn ftco-animated");
                  } else if (effect === "fadeInLeft") {
                    el.addClass("fadeInLeft ftco-animated");
                  } else if (effect === "fadeInRight") {
                    el.addClass("fadeInRight ftco-animated");
                  } else {
                    el.addClass("fadeInUp ftco-animated");
                  }
                  el.removeClass("item-animate");
                },
                k * 50,
                "easeInOutExpo"
              );
            });
          }, 100);
        }
      },
      { offset: "95%" }
    );
  }

  // ============================================
  // MAGNIFIC POPUP
  // ============================================
  if ($.fn.magnificPopup) {
    $(".image-popup").magnificPopup({
      type: "image",
      closeOnContentClick: true,
      closeBtnInside: false,
      fixedContentPos: true,
      mainClass: "mfp-no-margins mfp-with-zoom",
      gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [0, 1],
      },
      image: {
        verticalFit: true,
      },
      zoom: {
        enabled: true,
        duration: 300,
      },
    });

    $(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({
      disableOn: 700,
      type: "iframe",
      mainClass: "mfp-fade",
      removalDelay: 160,
      preloader: false,
      fixedContentPos: false,
    });
  }

  // ============================================
  // BOOTSTRAP 5 TOOLTIPS & POPOVERS
  // ============================================
  if (typeof bootstrap !== 'undefined') {
    try {
      const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
      const popoverList = Array.from(popoverTriggerList).map(
        popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl)
      );

      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
      const tooltipList = Array.from(tooltipTriggerList).map(
        tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl)
      );
    } catch (error) {
      console.error("Bootstrap components error:", error);
    }
  }

})(jQuery);

// ============================================
// VANILLA JAVASCRIPT FEATURES
// ============================================
document.addEventListener("DOMContentLoaded", function () {

  // ============================================
  // MENU TOGGLE
  // ============================================
  const menuBtn = document.querySelector(".menu-toggle-new");
  const closeBtn = document.querySelector(".menu-close-new");
  const menuOverlay = document.querySelector(".menu-overlay-new");

  if (menuBtn && closeBtn && menuOverlay) {
    menuBtn.addEventListener("click", () => {
      menuOverlay.classList.add("active");
      document.body.classList.add("menu-open");
    });

    closeBtn.addEventListener("click", () => {
      menuOverlay.classList.remove("active");
      document.body.classList.remove("menu-open");
    });
  }

  // ============================================
  // CATEGORY SWIPER SLIDER
  // ============================================
  if (typeof Swiper !== "undefined") {
    const swiperElement = document.querySelector(".category-swiper");
    
    if (swiperElement) {
      const categorySwiper = new Swiper(".category-swiper", {
        // Basic Settings
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 30,
        centeredSlides: false,
        
        // Loop
        loop: true,
        loopAdditionalSlides: 0,
        loopFillGroupWithBlank: false,
        watchOverflow: true,
        
        // Autoplay
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
          pauseOnMouseEnter: true,
        },
        
        // Speed
        speed: 800,
        
        // Grab cursor
        grabCursor: true,
        
        // Keyboard control
        keyboard: {
          enabled: true,
        },
        
        // Navigation arrows
        navigation: {
          nextEl: ".category-swiper .swiper-button-next",
          prevEl: ".category-swiper .swiper-button-prev",
        },
        
        // Pagination
     
         pagination: false,
        
        // NO SCROLLBAR
        scrollbar: false,
        
        // Responsive breakpoints
        breakpoints: {
          0: {
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 15,
          },
          768: {
            slidesPerView: 2,
            slidesPerGroup: 1,
            spaceBetween: 20,
          },
          992: {
            slidesPerView: 3,
            slidesPerGroup: 1,
            spaceBetween: 30,
          }
        },
        
        // Touch settings
        touchRatio: 1,
        touchAngle: 45,
        simulateTouch: true,
        
        // Observer
        observer: true,
        observeParents: true,
        
        // Prevent overflow
        preventInteractionOnTransition: true,
        
        // Callbacks
        on: {
          touchEnd: function () {
            setTimeout(() => {
              this.autoplay.start();
            }, 2000);
          },
        }
      });

      // Hover pause
      const swiperContainer = document.querySelector(".category-swiper");
      if (swiperContainer) {
        swiperContainer.addEventListener("mouseenter", () => {
          categorySwiper.autoplay.stop();
        });

        swiperContainer.addEventListener("mouseleave", () => {
          categorySwiper.autoplay.start();
        });
      }
    }
  }

  // ============================================
  // SMOOTH SCROLL
  // ============================================
  const anchorLinks = document.querySelectorAll('a[href^="#"]');
  
  if (anchorLinks.length > 0) {
    anchorLinks.forEach(link => {
      link.addEventListener("click", function (e) {
        const targetId = this.getAttribute("href");
        if (targetId === "#") return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
          e.preventDefault();
          targetElement.scrollIntoView({
            behavior: "smooth",
            block: "start"
          });
        }
      });
    });
  }

  // ============================================
  // BACK TO TOP BUTTON
  // ============================================
  const backToTopBtn = document.querySelector(".back-to-top");
  
  if (backToTopBtn) {
    window.addEventListener("scroll", () => {
      if (window.pageYOffset > 300) {
        backToTopBtn.classList.add("show");
      } else {
        backToTopBtn.classList.remove("show");
      }
    });

    backToTopBtn.addEventListener("click", (e) => {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    });
  }

});
