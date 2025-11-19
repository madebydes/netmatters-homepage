/**
 * Sticky Header - Scroll Up Reveal
 * 
 * Behavior from Netmatters:
 * - Header is absolute by default (scrolls with page)
 * - When scrolling UP (past threshold): becomes fixed + slides in
 * - When scrolling DOWN: removes fixed (header scrolls away naturally)
 * - At top of page: always absolute (natural position)
 */
(function ($) {
  "use strict";

  $(document).ready(function () {
    var $header = $(".main-header");
    var $body = $("body");
    var $window = $(window);

    // Bail if no header found
    if (!$header.length) {
      console.warn("Sticky Header: .main-header not found");
      return;
    }

    console.log("Sticky Header: Initialized on element:", $header[0]);

    // Config - adjust these values as needed
    var THRESHOLD = 150; // Pixels scrolled before sticky can activate
    var DELTA = 5; // Minimum scroll amount to trigger direction change

    // State
    var lastScrollY = $window.scrollTop();
    var isSticky = false;
    var ticking = false;
    var headerHeight = $header.outerHeight();

    console.log("Sticky Header: Header height =", headerHeight, "Threshold =", THRESHOLD);

    /**
     * Add sticky state - header becomes fixed and animates in
     */
    function addSticky() {
      if (isSticky) return;
      
      isSticky = true;
      // Remove first to reset animation, then add
      $header.removeClass("slideInDown");
      // Force reflow to restart animation
      void $header[0].offsetWidth;
      $header.addClass("sticky animated slideInDown");
      console.log("Sticky Header: ACTIVATED - classes:", $header.attr("class"));
    }

    /**
     * Remove sticky state - header returns to absolute
     */
    function removeSticky() {
      if (!isSticky) return;
      
      isSticky = false;
      $header.removeClass("sticky animated slideInDown");
      console.log("Sticky Header: DEACTIVATED");
    }

    /**
     * Main update logic - called on every scroll
     */
    function update() {
      var currentScrollY = $window.scrollTop();
      var scrollDelta = currentScrollY - lastScrollY;

      // Debug every scroll event (comment out in production)
      // console.log("Scroll:", currentScrollY, "Delta:", scrollDelta, "Sticky:", isSticky);

      // At top of page - always remove sticky
      if (currentScrollY <= THRESHOLD) {
        if (isSticky) {
          removeSticky();
        }
        lastScrollY = currentScrollY;
        ticking = false;
        return;
      }

      // Not enough movement to matter
      if (Math.abs(scrollDelta) < DELTA) {
        ticking = false;
        return;
      }

      // Scrolling DOWN - remove sticky (let header scroll away)
      if (scrollDelta > 0) {
        removeSticky();
      }
      // Scrolling UP - add sticky (header slides in from top)
      else if (scrollDelta < 0) {
        addSticky();
      }

      lastScrollY = currentScrollY;
      ticking = false;
    }

    /**
     * Scroll handler with requestAnimationFrame throttle
     */
    function onScroll() {
      if (!ticking) {
        window.requestAnimationFrame(update);
        ticking = true;
      }
    }

    /**
     * When sidebar menu opens, disable sticky to prevent layout issues
     */
    function onMenuChange() {
      if ($body.hasClass("menu-is-active")) {
        removeSticky();
        console.log("Sticky Header: Disabled (sidebar menu open)");
      }
    }

    // Bind scroll event
    $window.on("scroll.stickyHeader", onScroll);
    
    // Bind sidebar menu event
    $body.on("classChange.stickyHeader", onMenuChange);

    // Handle window resize - recalculate header height
    $window.on("resize.stickyHeader", function() {
      headerHeight = $header.outerHeight();
    });

    // Initial check in case page loads scrolled
    update();

    // Expose for debugging in console
    window.stickyHeaderDebug = {
      addSticky: addSticky,
      removeSticky: removeSticky,
      getState: function() {
        return {
          isSticky: isSticky,
          lastScrollY: lastScrollY,
          currentScroll: $window.scrollTop(),
          threshold: THRESHOLD,
          headerClasses: $header.attr("class")
        };
      }
    };

    console.log("Sticky Header: Ready. Debug with window.stickyHeaderDebug.getState()");
  });
})(jQuery);
