document.addEventListener("DOMContentLoaded", function () {
  const reservationButton = document.getElementById("confirmReservationButton");
  if (reservationButton) {
    reservationButton.addEventListener("click", function (event) {
      event.preventDefault(); // Prevent the form from submitting via the browser
      const formData = new URLSearchParams();
      for (const pair of new FormData(
        document.getElementById("reservationForm")
      )) {
        formData.append(pair[0], pair[1]);
      }

      fetch("tpl/assets/api/reservation.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: formData,
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.text();
        })
        .then((data) => {
          alert(data); // Prikaz odgovora od servera
        })
        .catch((error) => {
          console.error("Error:", error);
          alert("Reservation failed, please try again later.");
        });
    });
  }
});
