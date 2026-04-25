<?php
require '../db.php';
session_start();

// 1. SECURITY CHECK (Prevents the "Invalid integer" error for parameter $6)
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
  http_response_code(401);
  die("Error: Unauthorized. Please log in.");
}

$userId = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    // Handle JSON input (used for Delete via JavaScript fetch)
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // --- DELETE ACTION ---
    if (isset($data['action']) && $data['action'] === 'delete') {
      $id = $data['id'];
      $stmt = $pdo->prepare("DELETE FROM bills WHERE id = ? AND user_id = ?");
      $stmt->execute([$id, $userId]);
      echo json_encode(['status' => 'success']);
      exit;
    }

    // --- UPDATE ACTION ---
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
      $id          = $_POST['id'];
      $title       = $_POST['title'];
      $amount      = $_POST['amount'];
      $category    = $_POST['category'];
      $description = $_POST['description'] ?? '';
      $date        = $_POST['expense_date'];

      $stmt = $pdo->prepare("UPDATE bills SET title=?, amount=?, category=?, description=?, expense_date=? WHERE id=? AND user_id=?");
      $stmt->execute([$title, $amount, $category, $description, $date, $id, $userId]);

      header('Location: ../dashboard.php'); // Redirect back to your main page
      exit;
    }

    // --- ADD ACTION (Create) ---
    // If no specific action is set, we assume it's a new entry
    $title       = $_POST['title'];
    $amount      = $_POST['amount'];
    $category    = $_POST['category'];
    $description = $_POST['description'] ?? '';
    $date        = $_POST['expense_date'];

    if (!empty($title) && !empty($amount)) {
      $sql = 'INSERT INTO bills (title, amount, category, description, expense_date, user_id) VALUES (?, ?, ?, ?, ?, ?)';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$title, $amount, $category, $description, $date, $userId]);
    }

    header('Location: ../dashboard.php');
    exit;
  } catch (Exception $e) {
    die("System Error: " . $e->getMessage());
  }
}
