<?php
$firstName = $_POST['first_name'] ?? '';
$lastName = $_POST['last_name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

if (empty($email) || empty($password) || $password !== $confirmPassword) {
    echo "Please fill all fields correctly and make sure passwords match.";
} else {
    // Ovdje biste dodali logiku za spremanje podataka u bazu
    echo "Registration successful!";
}
?>
