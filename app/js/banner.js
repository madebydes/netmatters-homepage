$(document).ready(function () {
  console.log("=== BANNER INIT START ===");

  const $wrapper = $(".banner__hero-items-wrapper");
  const $navButtons = $(".banner__hero-nav button");
  const $slides = $(".banner__hero-item");

  console.log("Slide count:", $slides.length);

  let currentIndex = 0;
  let autoTimer = null;

  function moveToIndex(index) {
    console.log("Moving to index:", index);

    const slideWidth = $slides.first().outerWidth(true);
    const offset = -index * slideWidth;

    $wrapper.css("transform", `translateX(${offset}px)`);
    currentIndex = index;

    $navButtons.removeClass("banner__hero-nav-button--active");
    $navButtons.eq(currentIndex).addClass("banner__hero-nav-button--active");
  }

  function startAutoSlider() {
    console.log("=== START auto-slider ===");
    stopAutoSlider();

    autoTimer = setInterval(() => {
      let nextIndex = currentIndex + 1;
      if (nextIndex >= $slides.length) {
        nextIndex = 0;
      }
      moveToIndex(nextIndex);
    }, 5000);
  }

  function stopAutoSlider() {
    console.log("=== STOP auto-slider ===");
    if (autoTimer) {
      clearInterval(autoTimer);
      autoTimer = null;
    }
  }

  // Add this one function to handle the loop transition smoothly
  function moveToIndex(index) {
    console.log("Moving to index:", index);

    const slideWidth = $slides.first().outerWidth(true);
    const offset = -index * slideWidth;

    // Add transition for normal moves, remove for loop jumps
    if (
      Math.abs(currentIndex - index) === 1 ||
      (currentIndex === 0 && index === $slides.length - 1) ||
      (currentIndex === $slides.length - 1 && index === 0)
    ) {
      $wrapper.addClass("banner__hero-items-wrapper--transition");
    } else {
      // For loop jumps (like 7→0), do it instantly
      $wrapper.removeClass("banner__hero-items-wrapper--transition");
    }

    $wrapper.css("transform", `translateX(${offset}px)`);
    currentIndex = index;

    $navButtons.removeClass("banner__hero-nav-button--active");
    $navButtons.eq(currentIndex).addClass("banner__hero-nav-button--active");
  }

  // Simple drag - just stop auto-slider when user starts dragging
  $wrapper.on("mousedown touchstart", function (e) {
    console.log("=== USER DRAG START ===");
    stopAutoSlider();
  });

  // Navigation buttons
  $navButtons.on("click", function () {
    const clickedSlide = $(this).data("banner-id");
    console.log("=== NAV BUTTON CLICKED ===");

    stopAutoSlider();
    moveToIndex(clickedSlide);

    // Restart auto-slider after delay
    setTimeout(startAutoSlider, 3000);
  });

  // Initialize
  moveToIndex(0);
  startAutoSlider();

  console.log("=== BANNER INIT COMPLETE ===");
});
