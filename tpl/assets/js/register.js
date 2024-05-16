document.addEventListener("DOMContentLoaded", function () {
  const registerButton = document.getElementById("registerButton");
  if (registerButton) {
    registerButton.addEventListener("click", submitRegistration);
  }
});

function submitRegistration() {
  const firstName = document.getElementById("first-name").value;
  const lastName = document.getElementById("last-name").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirm-password").value;

  // Konstruisanje tijela zahtjeva
  const requestData = `first_name=${encodeURIComponent(
    firstName
  )}&last_name=${encodeURIComponent(lastName)}&email=${encodeURIComponent(
    email
  )}&password=${encodeURIComponent(
    password
  )}&confirm_password=${encodeURIComponent(confirmPassword)}`;

  // AJAX poziv koristeći Fetch API
  fetch("tpl/assets/api/register.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: requestData,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.text();
    })
    .then((data) => {
      alert(data); // Prikažite odgovor od servera
    })
    .catch((error) => {
      console.error("Error during the fetch operation:", error);
      alert("Registration failed, please try again later.");
    });
}
