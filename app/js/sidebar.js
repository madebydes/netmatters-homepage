$(document).ready(function () {
  // --- BANNER SLIDER SCRIPT ---

  // --- SIDEBAR SCRIPT ---
  $(".site-nav-toggle").on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();

    $(this).toggleClass("is-active");
    $("body").toggleClass("menu-is-active");
  });

  $("#container").on("click", function () {
    if ($("body").hasClass("menu-is-active")) {
      $("body").removeClass("menu-is-active");
      $(".site-nav-toggle").removeClass("is-active");
    }
  });

  // --- SIDEBAR SUB-MENU SCRIPT (NEW) ---
  $(".sidebar > ul > li > a").on("click", function (e) {
    // Check if this menu item has a sub-menu
    if ($(this).siblings(".sub-menu-banner").length > 0) {
      e.preventDefault(); // Prevent link from navigating
      $(this).parent().toggleClass("is-open");
    }
  });
});
