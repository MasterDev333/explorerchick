/* eslint-disable no-undef */
/* eslint-disable func-names */
// eslint-disable-next-line func-names
(function($) {
  const helper = {
    // custom helper function for debounce - how to work see https://codepen.io/Hyubert/pen/abZmXjm
    /**
     * Debounce
     * need for once call function
     *
     * @param { function } - callback function
     * @param { number } - timeout time (ms)
     * @return { function }
     */
    debounce(func, timeout) {
      let timeoutID;
      // eslint-disable-next-line no-param-reassign
      timeout = timeout || 200;
      return function() {
        const scope = this;
        // eslint-disable-next-line prefer-rest-params
        const args = arguments;
        clearTimeout(timeoutID);
        timeoutID = setTimeout(function() {
          func.apply(scope, Array.prototype.slice.call(args));
        }, timeout);
      };
    },
    /**
     * Helper if element exist then call function
     */
    isElementExist(_el, _cb, _argCb) {
      const elem = document.querySelector(_el);
      if (document.body.contains(elem)) {
        try {
          if (arguments.length <= 2) {
            _cb();
          } else {
            _cb(..._argCb);
          }
        } catch (e) {
          // eslint-disable-next-line no-console
          console.log(e);
        }
      }
    },

    /**
     *  viewportCheckerAnimate function
     *
     * @param whatElement - element name
     * @param whatClassAdded - class name if element is in viewport
     * @param classAfterAnimate - class name after element animates
     */
    viewportCheckerAnimate(whatElement, whatClassAdded, classAfterAnimate) {
      jQuery(whatElement)
        .addClass("a-hidden")
        .viewportChecker({
          classToRemove: "a-hidden",
          classToAdd: `animated ${whatClassAdded}`,
          offset: 10,
          callbackFunction(elem) {
            if (classAfterAnimate) {
              elem.on("animationend", () => {
                elem.addClass("animation-end");
              });
            }
          }
        });
    },
    // helpler windowResize
    windowResize(functName) {
      const self = this;
      $(window).on("resize orientationchange", self.debounce(functName, 200));
    }
  };

  const theme = {
    /**
     * Main init function
     */
    init() {
      this.plugins(); // Init all plugins
      this.bindEvents(); // Bind all events
      this.initAnimations(); // Init all animations
    },

    /**
     * Init External Plugins
     */
    plugins() {
      // eslint-disable-next-line no-undef
      $("img[data-src]").lazyload(); // Init Lazyload from https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js

      $("select").each(function() {
        let placeholder = $(this).attr("placeholder");
        if (!placeholder) placeholder = "Select";
        $(this).select2({
          placeholder: {
            id: "-1", // the value of the option
            text: placeholder
          }
        });
      });
    },

    /**
     * Bind all events here
     *
     */
    bindEvents() {
      const self = this;
      /** * Run on Document Ready ** */
      $(document).ready(function() {
        self.smoothScrollLinks();
        self.initHeader();
        helper.isElementExist(".header-top__slider", self.initHeaderTop);
        helper.isElementExist(
          ".content-slider .swiper",
          self.initContentSlider
        );
        helper.isElementExist(".cpt-slider .swiper", self.initCPTSlider);
        helper.isElementExist(".featured-blog__slider", self.initFeaturedBlog);
        helper.isElementExist(".banner--slider", self.initBannerSlider);
        helper.isElementExist(
          ".card-box:not(.card-box--static)",
          self.initCardbox
        );
        helper.isElementExist(".accordion", self.initAccordion);
        helper.isElementExist(".sidebar", self.initSidebar);
        // Copy url to clipboard when click link on social share
        $(".social-share__copy").on("click", function() {
          const href = $(this).attr("data-url");
          $(this).append('<span class="copied">Copied</span>');
          setTimeout(() => {
            $(".copied").remove();
          }, 1000);
          navigator.clipboard.writeText(href);
          return false;
        });
      });
      /** * Run on Window Load ** */
      $(window).on("scroll", function() {
        if ($(window).scrollTop() >= 50)
          $(".header").addClass("header--sticky");
        else $(".header").removeClass("header--sticky");
      });
    },

    /**
     * init scroll revealing animations function
     */
    initAnimations() {
      helper.viewportCheckerAnimate(".a-up", "fadeInUp", true);
      helper.viewportCheckerAnimate(".a-down", "fadeInDown");
      helper.viewportCheckerAnimate(".a-left", "fadeInLeft");
      helper.viewportCheckerAnimate(".a-right", "fadeInRight");
      helper.viewportCheckerAnimate(".a-op", "fade");
    },

    /**
     * Smooth Scroll link
     */
    smoothScrollLinks() {
      $('a[href^="#"').on("click touchstart", function() {
        const target = $(this).attr("href");
        if (target !== "#" && $(target).length > 0) {
          const offset = $(target).offset().top - $("header").outerHeight();
          $("html, body").animate(
            {
              scrollTop: offset
            },
            500
          );
        }
        return false;
      });
    },
    /**
     * Init Header Top
     */
    initHeaderTop() {
      if ($(".header-top__slider .swiper-slide").length > 1) {
        new Swiper(".header-top__slider", {
          slidesPerView: 1,
          autoplay: {
            delay: 3000
          }
        });
      }
    },
    /**
     * Init Header
     */
    initHeader() {
      const $header = $(".header");
      // Init Smartmenus
      $(".header-menu").smartmenus({
        collapsibleBehavior: "accordion",
        subIndicatorsText: ""
      });
      // Hamburger
      $(".hamburger").on("click", function() {
        $header.toggleClass("is-opened");
        $(".header-menu").slideToggle();
      });
    },
    /**
     * Init Content Slider
     */
    initContentSlider() {
      if ($(".content-slider .swiper-slide").length > 1) {
        new Swiper(".content-slider .swiper", {
          slidesPerView: 1,
          breakpoints: {
            576: {
              slidesPerView: 2,
              spaceBetween: 20
            },
            768: {
              slidesPerView: 3,
              spaceBetween: 20
            },
            1024: {
              slidesPerView: 3,
              spaceBetween: 50
            }
          },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
          }
        });
      }
    },

    /**
     * Init CPT Slider
     */
    initCPTSlider() {
      if ($(".cpt-slider .swiper-slide").length > 1) {
        new Swiper(".cpt-slider .swiper", {
          slidesPerView: 1,
          breakpoints: {
            576: {
              slidesPerView: 2,
              spaceBetween: 20
            },
            768: {
              slidesPerView: 3,
              spaceBetween: 20
            },
            1024: {
              slidesPerView: 3,
              spaceBetween: 50
            }
          },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
          }
        });
      }
    },
    /**
     * Init Featured Blog
     */
    initFeaturedBlog() {
      if ($(".featured-blog__slider .swiper-slide").length > 1) {
        new Swiper(".featured-blog__slider", {
          slidesPerView: 1,
          loop: true,
          navigation: {
            nextEl: ".swiper-button-next"
          }
        });
      }
    },
    /**
     * Init Card Box
     */
    initCardbox() {
      const height = `${$(".card-box__header").outerHeight() * -1}px`;
      const $parent = $(".card-box__header").closest("section");
      $parent.css({
        position: "relative",
        "margin-top": `${height}`,
        "z-index": 2
      });
    },
    /**
     * Init Banner Slider
     */
    initBannerSlider() {
      new Swiper(".banner--slider .swiper", {
        slidesPerView: 1,
        loop: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev"
        }
      });
    },
    /**
     * Init Accordion
     */
    initAccordion() {
      // Show accordion on click
      $(".accordion-header").on("click", function() {
        const $parent = $(this).closest(".accordion");
        $(this).toggleClass("active");
        $(".accordion-content", $parent).slideToggle();
      });
      // expand all
      $(".btn-expand-all").on("click", function() {
        $(this).toggleClass("collapse");
        if ($(this).hasClass("collapse")) {
          $(this).text("Collapse All Days");
          $(".accordion-header").addClass("active");
          $(".accordion-content").slideDown();
        } else {
          $(this).text("Expand All Days");
          $(".accordion-header").removeClass("active");
          $(".accordion-content").slideUp();
        }
      });
    },
    /**
     * Init Sidebar
     */
    initSidebar() {
      // Active anchor links on scroll
      window.onscroll = () => {
        let current = "";
        const sections = document.querySelectorAll(".content-block");
        const navLinks = document.querySelectorAll(".sidebar-menu a");
        sections.forEach(section => {
          const sectionTop = section.offsetTop - 50;
          if (pageYOffset >= sectionTop) {
            current = section.getAttribute("id");
          }
        });
        navLinks.forEach(link => {
          link.classList.remove("active");
          if (link.getAttribute("href") === `#${current}`) {
            link.classList.add("active");
          }
        });
      };
      // add bold on click sidebar menu link
      $(".sidebar-menu a").on("click", function() {
        if ($(this).hasClass("active")) return;
        $(".sidebar-menu a.active").removeClass("active");
        $(this).addClass("active");
      });
    }
  };

  // Initialize Theme
  theme.init();
})(jQuery);
