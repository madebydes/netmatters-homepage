// COOKIE CONSENT SCRIPT //
$(document).ready(function () {
  // (Your other scripts for banner, sidebar, header...)
  // ...

  // --- COOKIE CONSENT LOGIC ---

  // --- SELECTORS ---
  const cookieConsent = $(".cookie-consent"); // The initial pop-up banner
  const cookieSettings = $(".cookie-settings"); // The settings panel

  const acceptButton = $(".btn--accept"); // Button: "Accept Cookies" (on banner)
  const settingsButton = $(".btn--settings"); // Button: "Change Settings" (on banner)
  const saveSettingsButton = $(".btn--save-settings"); // Button: "Save Settings" (on panel)

  // Toggle Checkboxes
  const functionalToggle = $("#cookie-functional-toggle");
  const performanceToggle = $("#cookie-performance-toggle");

  // The key we use in localStorage
  const storageKey = "cookieSettings";

  // --- FUNCTIONS ---

  /**
   * Saves the user's choices to localStorage
   * @param {object} settings - The cookie settings object
   */
  function saveCookieSettings(settings) {
    localStorage.setItem(storageKey, JSON.stringify(settings));
  }

  /**
   * Loads the user's settings from localStorage
   * @returns {object | null} The settings object or null if not found
   */
  function loadCookieSettings() {
    const settings = localStorage.getItem(storageKey);
    return settings ? JSON.parse(settings) : null;
  }

  /**
   * Updates the toggle checkboxes based on a settings object
   * @param {object} settings - The cookie settings object
   */
  function updateToggles(settings) {
    if (settings) {
      functionalToggle.prop("checked", settings.functional);
      performanceToggle.prop("checked", settings.performance);
    }
  }
  /**
   * Hides the banner and settings panel
   */
  function hideModals() {
    cookieConsent.fadeOut(300, function () {
      $(this).addClass("hidden").removeAttr("style");
    });
    cookieSettings.fadeOut(300, function () {
      $(this).addClass("hidden").removeAttr("style");
    });
  }

  // --- SCRIPT LOGIC ---

  // 1. Check if settings are already saved
  const existingSettings = loadCookieSettings();

  if (existingSettings) {
    updateToggles(existingSettings);
  } else {
    cookieConsent.removeClass("hidden");
  }

  // 2. Handle "Accept Cookies" button click
  acceptButton.on("click", function () {
    const defaultSettings = {
      necessary: true,
      functional: true,
      performance: true,
    };
    saveCookieSettings(defaultSettings);
    hideModals();
  });

  // 3. Handle "Change Settings" button click
  settingsButton.on("click", function () {
    // Hide the banner and show the settings panel
    cookieConsent.fadeOut(300, function () {
      $(this).addClass("hidden").removeAttr("style");
      cookieSettings.removeClass("hidden").fadeIn(300);

      // Load current settings into toggles
      const settings = loadCookieSettings() || {
        functional: true,
        performance: true,
      };
      updateToggles(settings);
    });
  });

  // 4. Handle "Save Settings" button click
  saveSettingsButton.on("click", function () {
    // Get the current state of the toggles
    const newSettings = {
      necessary: true, // Always true
      functional: functionalToggle.is(":checked"),
      performance: performanceToggle.is(":checked"),
    };

    saveCookieSettings(newSettings);
    hideModals();
  });
});
