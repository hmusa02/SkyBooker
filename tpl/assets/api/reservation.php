<?php
$firstName = $_POST['first_name'] ?? '';
$lastName = $_POST['last_name'] ?? '';
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$destination = $_POST['destination'] ?? '';
$date = $_POST['date'] ?? '';

if (empty($firstName) || empty($lastName) || empty($username) || empty($email) || empty($destination) || empty($date)) {
    echo "All fields are required.";
} else {
    // Ovdje biste dodali logiku za spremanje rezervacije u bazu podataka
    echo "Reservation confirmed for $destination on $date.";
}
?>
