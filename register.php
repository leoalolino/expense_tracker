<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <?php
  require "db.php";
  $msg = null;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    foreach ([$name, $password, $confirm_password] as $fields) {
      if (empty($fields)) {
        $msg = "fields shouldn't be empty.";
        goto end;
      }
    }

    $stmt  = $pdo->prepare('SELECT * FROM users WHERE name = ?');
    $stmt->execute([$name]);
    $check = $stmt->fetch();

    if ($check) {
      $msg = "Username already exists!";
    } elseif ($password !== $confirm_password) {
      $msg = "Passwords do not match!";
    } else {
      $hashed = password_hash($password, PASSWORD_DEFAULT);
      $stmt   = $pdo->prepare('INSERT INTO users (name, password) VALUES (?, ?)');
      $stmt->execute([$name, $hashed]);
      header('Location: index.php');
      exit;
    }
  }
  end:
  ?>
  <?= $msg ?>
  <form method="POST">
    <input type="text" name="name" placeholder="enter prefered username">
    <input type="password" name="password" placeholder="enter password">
    <input type="password" name="confirm_password" placeholder="re-enter password">
    <button type="submit">Register</button>
  </form>
  <span>Already have an account? <a class="text" href="index.php" style="color:blue">Login!</a></span>
</body>

</html>
