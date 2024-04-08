$(document).ready(function () {
  console.log("Document is ready");

  $(window).on("hashchange", function () {
    console.log("Hash changed to: ", window.location.hash);
  });

  var app = $.spapp({
    defaultView: "home",
    templateDir: "tpl/",
    pageNotFound: "error_404",
  }); // initialize

  // define routes
  app.route({
    view: "home",
    load: "home.html",
    onCreate: function () {
      console.log("Creating home");
    },
    onReady: function () {
      console.log("Home is ready");
    },
  });
  app.route({
    view: "about-us",
    load: "about-us.html",
    onCreate: function () {
      console.log("Creating about-us");
    },
    onReady: function () {
      console.log("Abouy Us is ready");
    },
  });
  app.route({
    view: "packages",
    load: "packages.html",
    onCreate: function () {
      console.log("Creating packages");
    },
    onReady: function () {
      console.log("Packages is ready");
    },
  });
  app.route({
    view: "package-details",
    load: "package-details.html",
    onCreate: function () {
      console.log("Creating package-details");
    },
    onReady: function () {
      console.log("Package-details is ready");
    },
  });
  app.route({
    view: "reservation",
    load: "reservation.html",
    onCreate: function () {
      console.log("Creating reservation");
    },
    onReady: function () {
      console.log("Reservation is ready");
    },
  });
  app.route({
    view: "login",
    load: "login.html",
    onCreate: function () {
      console.log("Creating login");
    },
    onReady: function () {
      console.log("Login is ready");
    },
  });
  app.route({
    view: "registration",
    load: "registration.html",
    onCreate: function () {
      console.log("Creating registration");
    },
    onReady: function () {
      console.log("Registration is ready");
    },
  });
  app.route({
    view: "contact",
    load: "contact.html",
    onCreate: function () {
      console.log("Creating contact");
    },
    onReady: function () {
      console.log("Contact is ready");
    },
  });

  // run app
  app.run();
  console.log($.spapp); // Trebalo bi da ispiše funkciju ili objekt
});
