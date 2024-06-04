var Utils = {
  init_spapp: function () {
    var app = $.spapp({
      templateDir: "./pages/",
    });
    app.run();
  },
  block_ui: function (element) {
    $(element).block({
      message:
        '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>',
      css: {
        backgroundColor: "transparent",
        border: "0",
      },
      overlayCSS: {
        backgroundColor: "#000",
        opacity: 0.5,
      },
    });
  },
  unblock_ui: function (element) {
    $(element).unblock();
  },
};
