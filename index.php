<?php
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM expenses ORDER BY created_at DESC");
$expenses = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Expenses</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            navy: {
              900: '#0d1b2e',
              800: '#112240',
              700: '#1a2f50',
              600: '#1e3a5f',
            }
          },
          fontFamily: {
            sans: ['DM Sans', 'sans-serif'],
          }
        }
      }
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <style>
    body {
      background-color: #111110;
    }
  </style>
</head>

<body class="text-white font-sans min-h-screen flex">
  <main class="ml-56 flex-1 p-8 max-w-4xl">
    <?php include("sidebar.php") ?>
    <div class="flex items-center justify-between mb-8">
      <h1 class="text-xl font-semibold text-white">Your Expenses</h1>
      <div class="flex items-center gap-3">
        <!-- btn -->
        <button onclick="openModal()"
          class="flex items-center gap-2 bg-zinc-950 hover:bg-zinc-950/20 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
          Add Expense
        </button>
      </div>
    </div>
    <div class="flex items-center gap-3 mb-6">
      <div class="relative flex-1 max-w-sm">
        <input type="text" placeholder="Search expenses..."
          class="w-full bg-[#1c1c1e] border border-zinc-700 rounded-lg pl-9 pr-4 py-2 text-sm text-white placeholder-slate-500 focus:border-blue-500" />
      </div>
      <?php
      $categories = ["food", "transport", "medical", "utilities"];
      ?>

      <select
        class="bg-[#1c1c1e] border border-zinc-700 rounded-lg px-3 py-2 text-sm text-slate-300 focus:border-blue-500 focus:outline-none">
        <option value="">All categories</option>
        <?php foreach ($categories as $c): ?>
          <option value="<?= $c ?>">
            <?= ucfirst($c) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="flex flex-col gap-3">
      <div class="expense-card bg-[#1c1c1e] border border-zinc-200/10 rounded-xl px-5 py-4">
        <div class="flex items-start justify-between gap-4">
          <div class="flex flex-col gap-1.5 min-w-0">
            <span class="text-white font-medium text-sm">Business Wifi</span>
            <span class="text-xs px-2 py-0.5 rounded-md font-medium w-fit bg-blue-500/20 text-blue-300">Utilities</span>
          </div>
          <div class="flex flex-col items-end gap-1 shrink-0">
            <span class="text-white font-semibold text-sm">₱10,000.00</span>
            <span class="text-slate-500 text-xs">10/13/2026</span>
            <div class="flex gap-3 mt-2">
              <button class="text-slate-500 hover:text-blue-400 transition">
                <?php include("svg/edit.php") ?>
              </button>
              <button class="text-slate-500 hover:text-red-400 transition">
                <?php include("svg/delete.php") ?>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include("modal.php") ?>

  <script>
    let state = {
      modalOpen: false,
      expenses: []
    }

    function setState(newState) {
      state = {
        ...state,
        ...newState
      }
      document.getElementById('modal').style.display = state.modalOpen ? 'flex' : 'none'
    }

    const openModal = () => {
      setState({
        modalOpen: true
      })
    }

    const closeModal = () => {
      setState({
        modalOpen: false
      })
    }
  </script>
</body>

</html>
