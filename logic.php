<?php
require 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $title  = $_POST['title'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    foreach ([$title, $amount, $category, $description, $date] as $field) {
      if (empty($field)) return;
    }

    $sql = 'INSERT INTO expenses (title, amount, category, description, date) VALUES (?, ?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([$title, $amount, $category, $description, $date]);

    $msg = $success ? "successfully added new record!" : "failed to add new record!";
  } catch (Exception $e) {
    die($e->getMessage());
  }
}
