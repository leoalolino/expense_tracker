<aside>
  <div id="detailPanel" class="w-80 bg-[#1c1c1e] border-l border-zinc-200/10 min-h-screen p-6 flex flex-col gap-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
      <h2 class="text-white font-semibold text-sm">Expense Details</h2>
      <button onclick="closePanel()" class="text-slate-500 hover:text-white transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    <?php $arr = ["title", "amount", "date", "category", "description", "record_id"] ?>

    <!-- Amount -->
    <div class="bg-[#2c2c2e] rounded-xl p-4 text-center">
      <p class="text-slate-400 text-xs mb-1">Total Amount</p>
      <p id="amountDetail" class="text-white text-3xl font-semibold"></p>
      <span id="categoryDetail"
        class="inline-block mt-2 px-2 py-0.5 rounded-md bg-blue-500/20 text-blue-300 text-xs font-medium"></span>
    </div>
    <?php $selectedId = null ?>
    <!-- Details -->
    <?php foreach ($arr as $a): ?>
      <div class="flex flex-col gap-3">
        <div class="flex flex-col gap-1">
          <p class="text-slate-500 text-xs first-letter:uppercase">
            <?= $a ?>
          </p>
          <p id="<?= $a ?>" class="text-white text-sm font-medium"></p>
        </div>
        <div class="h-px bg-zinc-200/5"></div>
      </div>
    <?php endforeach; ?>

    <!-- Actions -->
    <div class="flex gap-2 mt-auto">
      <button onclick="openEdit()"
        class="flex-1 py-2 rounded-lg border border-zinc-200/10 text-sm text-slate-400 hover:text-white hover:border-zinc-200/20 transition flex items-center justify-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
        Edit
      </button>
      <button onclick="openDelete()"
        class="flex-1 py-2 rounded-lg bg-red-600/10 border border-red-500/20 text-sm text-red-400 hover:bg-red-600 hover:text-white transition flex items-center justify-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
        Delete
      </button>
    </div>


  </div>
</aside>

<script>
  function openDelete() {
    document.getElementById('deleteModal').classList.remove('hidden');

  }
</script>
