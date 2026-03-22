<?php
$host = '127.0.0.1';
$port = '5432';
$db   = 'extracker';
$user = 'leo';
$pass = 'secret';

try {
  $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
  $pdo->exec("SET search_path TO expenses"); // to avoid doing query expenses.users 

} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}
