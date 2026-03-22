<?php
require 'db.php';
session_start();
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name     = $_POST['name'];
  $password = $_POST['password'];
  $stmt = $pdo->prepare('SELECT * FROM users WHERE name = ?');
  $stmt->execute([$name]);
  $user = $stmt->fetch();
  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user['id'];
    header('Location: dashboard.php');
    exit;
  } else {
    $error = 'Invalid username or password';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — Expenses</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #111110;
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center font-sans text-white">
  <div class="w-full max-w-sm px-4">
    <div class="mb-8 text-center">
      <div
        class="w-10 h-10 rounded-xl bg-[#1c1c1e] border border-zinc-200/10 flex items-center justify-center mx-auto mb-4">
        <span class="text-white font-bold text-sm">V</span>
      </div>
      <h1 class="text-xl font-semibold">Welcome back</h1>
      <p class="text-slate-400 text-sm mt-1">Sign in to your expenses account</p>
    </div>

    <?php if ($error): ?>
      <div class="mb-4 px-4 py-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="flex flex-col gap-4">
      <div>
        <label class="text-xs text-slate-400 mb-1 block">Username</label>
        <input type="text" name="name" placeholder="Enter your username" required
          class="w-full bg-[#1c1c1e] border border-zinc-200/10 rounded-lg px-3 py-2 text-sm text-white placeholder-slate-600 focus:outline-none focus:border-blue-500" />
      </div>
      <div>
        <label class="text-xs text-slate-400 mb-1 block">Password</label>
        <input type="password" name="password" placeholder="Enter your password" required
          class="w-full bg-[#1c1c1e] border border-zinc-200/10 rounded-lg px-3 py-2 text-sm text-white placeholder-slate-600 focus:outline-none focus:border-blue-500" />
      </div>
      <button type="submit"
        class="w-full py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-sm text-white font-medium transition mt-2">
        Sign In
      </button>
    </form>

    <p class="text-center text-slate-400 text-sm mt-6">
      Don't have an account?
      <a href="register.php" class="text-blue-400 hover:text-blue-300 transition">Sign up</a>
    </p>
  </div>
</body>

</html>
