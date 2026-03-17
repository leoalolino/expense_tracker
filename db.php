<?php
$host = '127.0.0.1';
$port = '5432';
$db   = 'expenses';
$user = 'leo';
$pass = 'secret';

try {
  $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);

  echo "Connected successfully";
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}
