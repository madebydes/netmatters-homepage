$(function () {
  "use strict";
  const $win = $(window);
  const $body = $("body");
  const $container = $("#container");
  const $header = $(".main-header");

  if (!$header.length) return;

  const headerEl = $header[0];
  const originalParent = headerEl.parentNode;

  // Create a placeholder div that will take the header's space when it becomes sticky
  const placeholder = $("<div>")
    .addClass("header-placeholder")
    .hide()
    .insertBefore($header);

  let lastY = window.pageYOffset;
  let ticking = false;
  let isSticky = false;

  function updateHeaderHeightAndPlaceholder() {
    const h = $header.outerHeight();
    placeholder.height(h);
    return h;
  }

  function recomputeStickyPosition() {
    if (!isSticky) return;
    // Align the sticky header's left and width to match the #container's visual position.
    // This works perfectly even when #container is transformed by the sidebar.
    const containerRect = $container[0].getBoundingClientRect();
    $header.css({
      left: containerRect.left + "px",
      width: containerRect.width + "px",
    });
  }

  function enableSticky() {
    if (isSticky) return;

    const h = updateHeaderHeightAndPlaceholder();
    placeholder.show(); // Show placeholder to prevent content jump

    // Move the header to the body to escape the transform on #container
    $header.detach().appendTo($body);
    $header.addClass("header-is-sticky");

    recomputeStickyPosition(); // Set initial position
    isSticky = true;
  }

  function disableSticky() {
    if (!isSticky) return;

    // Move the header back to its original position (after the placeholder)
    $header.detach().insertAfter(placeholder);
    $header.removeClass("header-is-sticky");

    placeholder.hide(); // Hide the placeholder
    isSticky = false;
  }

  function onScroll() {
    const currentY = window.pageYOffset;
    const headerHeightThreshold = placeholder.height() || $header.outerHeight();

    // SCROLLING UP & past the original header's position
    if (currentY < lastY && currentY > headerHeightThreshold) {
      enableSticky();
      $header.removeClass("main-header--hidden");
    }
    // SCROLLING DOWN
    else if (currentY > lastY) {
      if (isSticky) {
        // Only hide if it's currently sticky
        $header.addClass("main-header--hidden");
      }
    }

    // AT THE TOP: When scrolling back into the header's original area
    if (currentY <= headerHeightThreshold) {
      disableSticky();
      $header.removeClass("main-header--hidden");
    }

    lastY = currentY <= 0 ? 0 : currentY;
    ticking = false;
  }

  // Use requestAnimationFrame for smooth performance
  $win.on("scroll", function () {
    if (!ticking) {
      ticking = true;
      window.requestAnimationFrame(onScroll);
    }
  });

  // Re-calculate positions on sidebar toggle and window resize
  new MutationObserver(recomputeStickyPosition).observe($body[0], {
    attributes: true,
    attributeFilter: ["class"],
  });
  $win.on("resize", recomputeStickyPosition);
});
