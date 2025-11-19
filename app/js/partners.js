$(document).ready(function () {
  /**
   * Initialize a continuous scroll carousel for a specific container
   * @param {string} containerSelector - The class of the flex container
   * @param {string} itemSelector - The class/tag of the items inside
   */
  function initCarousel(containerSelector, itemSelector) {
    const $container = $(containerSelector);

    // Safety check: if container doesn't exist, stop
    if ($container.length === 0) return;

    const $items = $container.find(itemSelector);
    if ($items.length === 0) return;

    let currentIndex = 0;
    let autoScrollInterval;
    const scrollSpeed = 3000;

    // Clone items for infinite scroll illusion
    $container.append($items.clone());

    function autoScroll() {
      // Calculate width of one item
      const itemWidth = $items.first().outerWidth(true);

      // Calculate the flex-gap (essential for correct spacing)
      const gap = parseFloat($container.css("gap")) || 0;

      // Total move distance per item
      const moveAmount = itemWidth + gap;

      currentIndex++;

      if (currentIndex > $items.length) {
        // Reset without animation to create loop illusion
        currentIndex = 0;
        $container.css("transition", "none");
        $container.css("transform", "translateX(0)");

        // Force reflow
        void $container[0].offsetWidth;

        // Start next animation immediately
        setTimeout(() => {
          currentIndex = 1;
          $container.css("transition", "transform 0.5s ease");
          const offset = -(currentIndex * moveAmount);
          $container.css("transform", `translateX(${offset}px)`);
        }, 50);
      } else {
        const offset = -(currentIndex * moveAmount);
        $container.css("transition", "transform 0.5s ease");
        $container.css("transform", `translateX(${offset}px)`);
      }
    }

    function startAutoScroll() {
      // Clear any existing interval to prevent duplicates
      if (autoScrollInterval) clearInterval(autoScrollInterval);
      autoScrollInterval = setInterval(autoScroll, scrollSpeed);
    }

    function stopAutoScroll() {
      clearInterval(autoScrollInterval);
    }

    // Initialize
    startAutoScroll();

    // Pause on hover
    $container.on("mouseenter", stopAutoScroll);
    $container.on("mouseleave", startAutoScroll);
  }

  // --- Initialize Partners Reel ---
  // Items are direct <img> tags
  initCarousel(".associates-logo-layout-container", "img");

  // --- Initialize Clients Reel ---
  // Items are <div> wrappers containing popups and images
  initCarousel(
    ".clients-logo-layout-container",
    ".clients__section-for-each-client"
  );
});
