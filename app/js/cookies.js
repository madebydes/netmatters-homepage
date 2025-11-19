$(document).ready(function () {
  // Selectors
  const cookieConsent = $(".cookie-consent");
  const cookieSettings = $(".cookie-settings");
  const acceptButton = $(".btn--accept");
  const settingsButton = $(".btn--settings");
  const saveSettingsButton = $(".btn--save-settings");
  const functionalToggle = $("#cookie-functional-toggle");
  const performanceToggle = $("#cookie-performance-toggle");
  const storageKey = "cookieSettings";

  // Helper Functions
  function saveCookieSettings(settings) {
    localStorage.setItem(storageKey, JSON.stringify(settings));
  }

  function loadCookieSettings() {
    const settings = localStorage.getItem(storageKey);
    return settings ? JSON.parse(settings) : null;
  }

  function updateToggles(settings) {
    if (settings) {
      functionalToggle.prop("checked", settings.functional);
      performanceToggle.prop("checked", settings.performance);
    }
  }

  function hideModals() {
    cookieConsent.fadeOut(300, function () {
      $(this).addClass("hidden").removeAttr("style");
    });
    cookieSettings.fadeOut(300, function () {
      $(this).addClass("hidden").removeAttr("style");
    });
  }

  // Init Check
  const existingSettings = loadCookieSettings();
  if (existingSettings) {
    updateToggles(existingSettings);
  } else {
    cookieConsent.removeClass("hidden");
  }

  // Event Handlers
  acceptButton.on("click", function () {
    const defaultSettings = {
      necessary: true,
      functional: true,
      performance: true,
    };
    saveCookieSettings(defaultSettings);
    hideModals();
  });

  settingsButton.on("click", function () {
    cookieConsent.fadeOut(300, function () {
      $(this).addClass("hidden").removeAttr("style");
      cookieSettings.removeClass("hidden").fadeIn(300);

      const settings = loadCookieSettings() || {
        functional: true,
        performance: true,
      };
      updateToggles(settings);
    });
  });

  saveSettingsButton.on("click", function () {
    const newSettings = {
      necessary: true,
      functional: functionalToggle.is(":checked"),
      performance: performanceToggle.is(":checked"),
    };
    saveCookieSettings(newSettings);
    hideModals();
  });
});
