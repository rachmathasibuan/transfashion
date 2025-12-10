<?php

// Database config
$servername = "localhost";
$username   = "root";        // ganti
$password   = "password_db"; // ganti
$dbname     = "sensor";      // ganti

// Ambil parameter GET
$temperature = isset($_GET['temperature']) ? $_GET['temperature'] : null;
$humidity    = isset($_GET['humidity']) ? $_GET['humidity'] : null;
$heat_index  = isset($_GET['heat_index']) ? $_GET['heat_index'] : null;

// Cek data
if ($temperature === null || $humidity === null || $heat_index === null) {
    echo "ERROR: Missing parameters";
    exit;
}

// Koneksi DB
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert (prepared statement)
$stmt = $conn->prepare("INSERT INTO sensor_data (temperature, humidity, heat_index) VALUES (?, ?, ?)");
$stmt->bind_param("ddd", $temperature, $humidity, $heat_index);

if ($stmt->execute()) {
    echo "OK";
} else {
    echo "ERROR: Failed to insert";
}

$stmt->close();
$conn->close();
?>
