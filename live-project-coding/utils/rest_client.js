var RestClient = {
  // Izvršavanje GET zahtjeva
  get: function (url, callback, error_callback) {
    $.ajax({
      url: url,
      type: "GET",
      success: function (response) {
        if (callback) callback(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (error_callback) error_callback(jqXHR);
      },
    });
  },

  // Izvršavanje POST zahtjeva
  post: function (url, data, callback, error_callback) {
    $.ajax({
      url: url,
      type: "POST",
      data: JSON.stringify(data),
      contentType: "application/json",
      success: function (response) {
        if (callback) callback(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (error_callback) error_callback(jqXHR);
      },
    });
  },

  // Izvršavanje PUT zahtjeva
  put: function (url, data, callback, error_callback) {
    $.ajax({
      url: url,
      type: "PUT",
      data: JSON.stringify(data),
      contentType: "application/json",
      success: function (response) {
        if (callback) callback(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (error_callback) error_callback(jqXHR);
      },
    });
  },

  // Izvršavanje DELETE zahtjeva
  delete: function (url, data, callback, error_callback) {
    $.ajax({
      url: url,
      type: "DELETE",
      data: JSON.stringify(data),
      contentType: "application/json",
      success: function (response) {
        if (callback) callback(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (error_callback) error_callback(jqXHR);
      },
    });
  },
};
