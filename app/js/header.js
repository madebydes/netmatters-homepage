$(document).ready(function () {
  const slideWrapper = $(".banner__hero-items-wrapper");
  const navButtons = $(".banner__hero-nav button");

  // Get original slides
  const originalSlides = $(".banner__hero-item");
  const slideCount = originalSlides.length;

  // Clone slides for seamless looping
  const firstClone = originalSlides.first().clone();
  const lastClone = originalSlides.last().clone();

  // Add clones to DOM
  slideWrapper.append(firstClone);
  slideWrapper.prepend(lastClone);

  // Now we have 9 slides total
  const allSlides = $(".banner__hero-item");
  const totalSlideCount = slideCount + 2;

  let currentIndex = 1; // Start at first real slide (index 1)
  let slideInterval;

  // Drag/Swipe variables
  let isDragging = false;
  let startPos = 0;
  let currentTranslate = 0;
  let prevTranslate = 0;
  let animationID;
  let sliderWidth = 0;

  /**
   * Update slider dimensions
   */
  function updateSliderDimensions() {
    sliderWidth = $(window).width();
    allSlides.css("width", sliderWidth + "px");
    slideWrapper.css("width", sliderWidth * totalSlideCount + "px");
    return sliderWidth;
  }

  /**
   * Navigate to specific slide
   * @param {number} targetIndex - Target index in the extended array
   * @param {boolean} animate - Whether to use transition
   */
  function goToSlide(targetIndex, animate = true) {
    if (targetIndex < 0 || targetIndex >= totalSlideCount) return;

    if (animate) {
      slideWrapper.addClass("banner__hero-items-wrapper--transition");
    } else {
      slideWrapper.removeClass("banner__hero-items-wrapper--transition");
    }

    const offset = -targetIndex * sliderWidth;
    slideWrapper.css("transform", `translateX(${offset}px)`);

    currentTranslate = offset;
    prevTranslate = offset;

    // Update real current index (0-6)
    if (targetIndex === 0) {
      currentIndex = slideCount - 1; // On clone of last slide
    } else if (targetIndex === totalSlideCount - 1) {
      currentIndex = 0; // On clone of first slide
    } else {
      currentIndex = targetIndex - 1; // Normal slides
    }

    // Update navigation dots
    navButtons.removeClass("banner__hero-nav-button--active");
    navButtons.eq(currentIndex).addClass("banner__hero-nav-button--active");

    // If on clone, jump to real slide after animation
    if (targetIndex === 0 || targetIndex === totalSlideCount - 1) {
      setTimeout(() => {
        if (targetIndex === 0) {
          // Jump to real last slide
          goToSlide(slideCount, false);
        } else if (targetIndex === totalSlideCount - 1) {
          // Jump to real first slide
          goToSlide(1, false);
        }
      }, 400);
    }
  }

  /**
   * Start automatic slide advancement
   */
  function startSlider() {
    stopSlider();
    slideInterval = setInterval(function () {
      let nextIndex = currentIndex + 2; // +2 because we have a clone at start

      if (nextIndex >= totalSlideCount) {
        nextIndex = 1; // Loop to first real slide
      }

      goToSlide(nextIndex);
    }, 5000);
  }

  function stopSlider() {
    if (slideInterval) {
      clearInterval(slideInterval);
      slideInterval = null;
    }
  }

  /**
   * Handle navigation button clicks
   */
  navButtons.on("click", function (e) {
    e.stopPropagation();
    if (isDragging) return;

    stopSlider();
    const index = $(this).data("banner-id");
    goToSlide(index + 1); // +1 to account for clone
    startSlider();
  });

  /**
   * Get X position from event
   */
  function getPositionX(event) {
    return event.type.includes("mouse")
      ? event.pageX
      : event.touches[0].clientX;
  }

  /**
   * Handle start of drag/swipe
   */
  function touchStart(event) {
    event.preventDefault();

    if (animationID) {
      cancelAnimationFrame(animationID);
    }

    isDragging = true;
    startPos = getPositionX(event);

    slideWrapper.removeClass("banner__hero-items-wrapper--transition");
    slideWrapper.css("cursor", "grabbing");

    stopSlider();

    if (event.type === "mousedown") {
      $(document).on("mousemove", touchMove);
    }

    animationID = requestAnimationFrame(animation);
  }

  /**
   * Handle drag/swipe movement
   */
  function touchMove(event) {
    if (!isDragging) return;

    const currentPosition = getPositionX(event);
    const diff = currentPosition - startPos;
    currentTranslate = prevTranslate + diff;

    setSliderPosition();
  }

  /**
   * Handle end of drag/swipe - WITH LOOPING
   */
  function touchEnd(event) {
    if (!isDragging) return;

    isDragging = false;
    slideWrapper.css("cursor", "grab");
    $(document).off("mousemove", touchMove);

    const movedBy = currentTranslate - prevTranslate;
    const threshold = 20; // Ultra-light 20px threshold

    let newIndex;

    // Determine target index based on current slide position (accounting for clones)
    const currentVisualIndex = Math.round(-currentTranslate / sliderWidth);

    if (movedBy < -threshold) {
      // Drag left - next slide
      newIndex = currentVisualIndex + 1;
    } else if (movedBy > threshold) {
      // Drag right - previous slide
      newIndex = currentVisualIndex - 1;
    } else {
      // Snap back to current
      newIndex = currentVisualIndex;
    }

    goToSlide(newIndex);
    startSlider();
  }

  function animation() {
    setSliderPosition();
    if (isDragging) {
      animationID = requestAnimationFrame(animation);
    }
  }

  function setSliderPosition() {
    slideWrapper.css("transform", `translateX(${currentTranslate}px)`);
  }

  // Prevent context menu
  slideWrapper.on("contextmenu", function (e) {
    e.preventDefault();
    return false;
  });

  // Handle window resize
  $(window).on("resize", function () {
    updateSliderDimensions();
    goToSlide(currentIndex + 1, false); // Reposition without animation
  });

  // Event listeners
  slideWrapper.on("touchstart", touchStart);
  slideWrapper.on("touchmove", touchMove);
  slideWrapper.on("touchend", touchEnd);
  slideWrapper.on("mousedown", touchStart);
  $(document).on("mouseup", touchEnd);

  // Set initial cursor
  slideWrapper.css("cursor", "grab");

  // Initialize
  updateSliderDimensions();
  goToSlide(1, false); // Start at first real slide
  startSlider();
});
