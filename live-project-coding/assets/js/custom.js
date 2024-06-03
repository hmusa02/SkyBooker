$(function () {
  // Initialize the SPA application
  var app = $.spapp({
    defaultView: "home",
    templateDir: "pages/",
  });

  // Define routes for each view
  app.route({ view: "home", load: "home.html" });
  app.route({ view: "about-us", load: "about-us.html" });
  app.route({ view: "packages", load: "packages.html" });
  app.route({ view: "package-details", load: "package-details.html" });
  app.route({ view: "reservation", load: "reservation.html" });
  app.route({ view: "login", load: "login.html" });
  app.route({ view: "register", load: "register.html" });
  app.route({ view: "contact", load: "contact.html" });

  // Manage visibility of sections
  function manageVisibility() {
    $("main#spapp > section").hide();
    var id = location.hash.slice(1);
    $("#" + id).show();
  }

  // Start the SPA application
  app.run();

  // On hash change, manage the visibility of sections
  window.addEventListener("hashchange", function () {
    manageVisibility();
  });

  // On initial load, manage the visibility of sections
  if (!window.location.hash) {
    window.location.hash = app.config.defaultView;
  }
  manageVisibility();

  // Register form submit event
  $(document).on("submit", "#register-form", function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "backend/UserController.php", // Prilagodite putanju
      data: formData,
      success: function (response) {
        console.log("Registration Successful: " + response);
        alert("Registration Successful: " + response);
      },
      error: function (error) {
        console.error("Registration Failed: ", error);
        alert("Registration Failed: " + error.responseText);
      },
    });
  });
});
