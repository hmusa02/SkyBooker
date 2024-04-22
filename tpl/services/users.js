var UserService = {
  reload_users_datatable: function () {
    Utils.get_datatable(
      "tbl_users",
      Constants.API_BASE_URL + "get_users.php", // get_patients.php
      [{ data: "email" }, { data: "password_hash" }]
    );
  },
};
