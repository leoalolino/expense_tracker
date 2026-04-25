<?php
require_once 'db.php';
session_start();
$userId = $_SESSION['user'];

$stmt = $pdo->prepare("SELECT * FROM bills where user_id = ?");
$stmt->execute([$userId]);
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

<body class="text-white font-sans min-h-screen flex justify-between">
  <?php include("sidebar.php") ?>

  <main class="ml-56 flex-1 p-8 max-w-4xl">
    <div class="flex items-center justify-between mb-8">
      <h1 class="text-xl font-semibold text-white">Your Expenses</h1>
      <div class="flex items-center gap-3">
        <!-- btn -->
        <button onclick="openModal()"
          class="flex items-center gap-2 bg-zinc-950 hover:bg-zinc-950/20 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
          Add Expense
        </button>
        <button onclick="window.location.href='logout.php'"
          class="flex items-center gap-2 bg-red-600 hover:bg-red-600/70 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
          Logout
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

      <select name="category"
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
      <?php foreach ($expenses as $e): ?>
        <div id="card-<?= $e['id'] ?>"
          onclick="details(<?= $e['id'] ?>, '<?= $e['title'] ?>', '<?= $e['amount'] ?>', '<?= $e['category'] ?>', '<?= $e['description'] ?>', '<?= $e['expense_date'] ?>' )"
          class="expense-card bg-[#1c1c1e] border border-zinc-200/10 rounded-xl px-5 py-4 cursor-pointer">
          <div class="flex items-start justify-between gap-4">
            <div class="flex flex-col gap-1.5 min-w-0">
              <span class="text-white font-medium text-sm">
                <?= $e['title'] ?>
              </span>
              <span class="text-xs px-2 py-0.5 rounded-md font-medium w-fit bg-blue-500/20 text-blue-300">
                <?= $e['category'] ?>
              </span>
            </div>
            <div class="flex flex-col items-end gap-1 shrink-0">
              <span class="text-white font-semibold text-sm">
                <?= $e['amount'] ?>
              </span>
              <span class="text-slate-500 text-xs">
                <?= $e['expense_date'] ?>
              </span>
              <!-- <div class="flex gap-3 mt-2"> -->
              <!--   <button class="text-slate-500 hover:text-blue-400 transition"> -->
              <!--     <?php include("svg/edit.php") ?> -->
              <!--   </button> -->
              <!--   <button class="text-slate-500 hover:text-red-400 transition"> -->
              <!--     <?php include("svg/delete.php") ?> -->
              <!--   </button> -->
              <!-- </div> -->
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </main>
  <?php include("layout/expenseDetails.php") ?>
  <?php include("modal.php") ?>
  <?php include("component/deleteModal.php") ?>
  <?php include("component/editModal.php") ?>

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

    let selectedId = null;
    let selectedTitle = null;
    let selectedAmount = null;
    let selectedCategory = null;
    let selectedDate = null;
    let selectedDescription = null;

    function crudDelete() {
      fetch('crud/logic.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          id: selectedId,
          action: 'delete'
        })
      }).then(() => window.location.reload());
    }

    function details(id, title, amount, category, description, expense_date) {
      document.querySelectorAll('.expense-card').forEach(card => {
        card.classList.remove('border-white');
      });
      selectedId = id;
      selectedTitle = title;
      selectedAmount = amount;
      selectedCategory = category;
      selectedDate = expense_date;
      selectedDescription = description;

      document.getElementById("record_id").innerHTML = id;
      document.getElementById('title').innerHTML = title;
      document.getElementById('amount').innerHTML = `₱ ${amount}`;
      document.getElementById('amountDetail').innerHTML = `₱ ${amount}`;
      document.getElementById('category').innerHTML = category;
      document.getElementById('categoryDetail').innerHTML = category;
      document.getElementById('date').innerHTML = expense_date;
      document.getElementById('description').innerHTML = description || "No description";

      const el = document.getElementById('card-' + id);
      el.classList.add('border-white');
    }

    // ... keep your existing details() function ...

    function openEdit() {
      document.getElementById('editId').value = selectedId;
      document.getElementById('editTitle').value = selectedTitle;
      document.getElementById('editAmount').value = selectedAmount;
      document.getElementById('editCategory').value = selectedCategory;
      document.getElementById('editDate').value = selectedDate;
      document.getElementById('editDescription').value = selectedDescription;

      document.getElementById('editModal').classList.remove('hidden');
    }

    function crudDelete() {
      if (!selectedId) return;

      fetch('crud/logic.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            id: selectedId,
            action: 'delete'
          })
        })
        .then(res => {
          if (res.ok) {
            window.location.reload();
          } else {
            alert("Check if you are logged in.");
          }
        });
    }
  </script>
</body>

</html>
