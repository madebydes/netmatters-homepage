$(document).ready(function () {
  const slideWrapper = $(".banner__hero-items-wrapper");
  const slides = $(".banner__hero-item");
  const navButtons = $(".banner__hero-nav button");
  const slideCount = slides.length;
  let currentIndex = 0;
  let slideInterval;

  function goToSlide(index) {
    currentIndex = index;
    const offset = -index * 100;
    slideWrapper.css("transform", `translateX(${offset}vw)`);

    navButtons.removeClass("banner__hero-nav-button--active");
    navButtons.eq(index).addClass("banner__hero-nav-button--active");
  }

  function startSlider() {
    slideInterval = setInterval(function () {
      let nextIndex = (currentIndex + 1) % slideCount;
      goToSlide(nextIndex);
    }, 5000); // 5 seconds
  }

  function stopSlider() {
    clearInterval(slideInterval);
  }

  navButtons.on("click", function () {
    stopSlider();
    const index = $(this).data("banner-id");
    goToSlide(index);
    startSlider(); // Restart the timer
  });

  // Start the slider on page load
  startSlider();
});
