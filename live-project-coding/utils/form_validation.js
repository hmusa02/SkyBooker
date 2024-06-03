var FormValidation = {
  // Funkcija za serijalizaciju forme u objekat
  serialize_form: function (form) {
    var result = {}; // Inicijalizacija praznog objekta za rezultate
    $.each($(form).serializeArray(), function () {
      // Iteracija kroz serijalizovani niz forme
      result[this.name] = this.value; // Dodavanje svakog elementa u objekat rezultata
    });
    return result; // Povratak serijalizovanog objekta
  },

  // Funkcija za validaciju forme
  validate: function (form_selector, form_rules, form_submit_handler_callback) {
    var form_object = $(form_selector); // Selektor jQuery za formu
    var error = $(".alert-danger", form_object); // Element za prikaz grešaka
    var success = $(".alert-success", form_object); // Element za prikaz uspeha

    $(form_object).validate({
      rules: form_rules, // Pravila za validaciju forme
      submitHandler: function (form, event) {
        event.preventDefault(); // Sprječavanje standardnog slanja forme
        success.show(); // Prikaz uspešne poruke
        error.hide(); // Sakrivanje poruke o grešci

        if (form_submit_handler_callback) {
          // Provjera postojanja callback funkcije
          form_submit_handler_callback(
            FormValidation.serialize_form(form_object)
          ); // Pozivanje callback-a sa serijalizovanim podacima forme
        }
      },
    });
  },
};
