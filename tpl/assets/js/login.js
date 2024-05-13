document.addEventListener("DOMContentLoaded", function () {
  const reservationButton = document.getElementById("confirmReservationButton");
  if (reservationButton) {
    reservationButton.addEventListener("click", submitReservation);
  }
});

function submitReservation() {
  const firstName = document.getElementById("first-name").value;
  const lastName = document.getElementById("last-name").value;
  const username = document.getElementById("username").value;
  const email = document.getElementById("email").value;
  const destination = document.getElementById("destination").value;
  const date = document.getElementById("date").value;

  // Konstruisanje tijela zahtjeva
  const requestData = `first_name=${encodeURIComponent(
    firstName
  )}&last_name=${encodeURIComponent(lastName)}&username=${encodeURIComponent(
    username
  )}&email=${encodeURIComponent(email)}&destination=${encodeURIComponent(
    destination
  )}&date=${encodeURIComponent(date)}`;

  // AJAX poziv koristeći Fetch API
  fetch("tpl/assets/api/reservation.php", {
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
      alert("Reservation failed, please try again later.");
    });
}
