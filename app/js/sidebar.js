$(document).ready(function () {
  // --- BANNER SLIDER SCRIPT ---

  // --- SIDEBAR SCRIPT ---
  $(".site-nav-toggle").on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();

    $(this).toggleClass("is-active");
    $("body").toggleClass("menu-is-active");
    $("body").trigger("classChange");
  });

  $("#container").on("click", function () {
    if ($("body").hasClass("menu-is-active")) {
      $("body").removeClass("menu-is-active");
      $(".site-nav-toggle").removeClass("is-active");
      $("body").trigger("classChange");
    }
  });

  // --- SIDEBAR SUB-MENU SCRIPT (NEW) ---
  // Select both the main list AND the mobile-only .main grid list
  $(".sidebar > ul > li > a, .sidebar .main > ul > li > a").on(
    "click",
    function (e) {
      // Check if this menu item has a sub-menu
      if ($(this).siblings(".sub-menu-banner").length > 0) {
        e.preventDefault(); // Prevent link from navigating
        $(this).parent().toggleClass("is-open");
      }
    }
  );
});
