<?php require 'db.php'; ?>

<!DOCTYPE html>
<html>

<body>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = $_POST['name'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE name = ?');
    $stmt->execute([$name]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
      session_start();
      // $_SESSION['user'] = $user['id'];
      sleep(5);
      header('Location: dashboard.php');
      exit;
    } else {
      $error = 'Invalid username or password';
    }
  }
  ?>

  <form method="POST">
    <input type="text" name="name" placeholder="username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
  <span>Don't have an account yet? <a class="text" href="register.php" style="color:blue">Sign up!</a></span>

  <?php if (isset($error)) echo $error; ?>

</body>

</html>
