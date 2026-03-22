<?php
require '../db.php';
session_start();

$userId = $_SESSION['user'];

// ADD NEW ITEM
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $data = json_decode(file_get_contents('php://input'), true);
    // DELETE
    if (isset($data['action']) && $data['action'] === 'delete') {
      $id = $data['id'];
      $stmt = $pdo->prepare("DELETE FROM bills WHERE id = ? AND user_id = ?");
      $stmt->execute([$id, $userId]);
      exit;
    }

    if (isset($_POST['action']) && $_POST['action'] === 'update') {
      $id          = $_POST['id'];
      $title       = $_POST['title'];
      $amount      = $_POST['amount'];
      $category    = $_POST['category'];
      $description = $_POST['description'];
      $date        = $_POST['expense_date'];

      $stmt = $pdo->prepare("UPDATE bills SET title=?, amount=?, category=?, description=?, expense_date=? WHERE id=? AND user_id=?");
      $stmt->execute([$title, $amount, $category, $description, $date, $id, $userId]);
      header('Location: ../dashboard.php');
      exit;
    }

    // update
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
      $id          = $_POST['id'];
      $title       = $_POST['title'];
      $amount      = $_POST['amount'];
      $category    = $_POST['category'];
      $description = $_POST['description'];
      $date        = $_POST['expense_date'];

      $stmt = $pdo->prepare("UPDATE bills SET title=?, amount=?, category=?, description=?, expense_date=? WHERE id=? AND user_id=?");
      $stmt->execute([$title, $amount, $category, $description, $date, $id, $userId]);
      header('Location: ../dashboard.php');
      exit;
    }

    // add
    $title  = $_POST['title'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $date = $_POST['expense_date'];

    foreach ([$title, $amount, $category, $date] as $field) {
      if (empty($field)) return;
    }

    $sql = 'INSERT INTO bills (title, amount, category, description, expense_date, user_id) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([$title, $amount, $category, $description, $date, $userId]);

    header('Location: ../dashboard.php');
    exit;
  } catch (Exception $e) {
    die($e->getMessage());
  }
}
