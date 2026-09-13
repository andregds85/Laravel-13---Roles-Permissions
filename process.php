<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'] ?? null;
    $whatsapp = $_POST['whatsapp'] ?? null;

    $stmt = $pdo->prepare("INSERT INTO contacts (name, email, whatsapp) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $whatsapp]);

    header('Location: list.php');
    exit;
}