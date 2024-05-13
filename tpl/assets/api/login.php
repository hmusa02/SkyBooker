<?php
$username = $_POST['username'];
$password = $_POST['password'];

// Ovdje dodajte provjeru korisničkih podataka
if ($username == 'admin' && $password == 'admin123') {
    echo "Login successful";
} else {
    echo "Login failed, please try again later.";
}
?>
