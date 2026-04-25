<div class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center" id="modal" style="display:none">
  <div class="bg-[#1c1c1e] border border-zinc-200/10 rounded-2xl p-6 w-full max-w-md mx-4">
    <form action="crud/logic.php" method="POST">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-base font-semibold text-white">Add Expense</h2>
        <button type="button" onclick="closeModal()" class="text-slate-500 hover:text-white transition">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <div class="flex flex-col gap-4">
        <div>
          <label class="text-xs text-slate-400 mb-1 block">Title</label>
          <input type="text" placeholder="e.g. Business Wifi" name="title" required
            class="w-full bg-[#2c2c2e] border border-zinc-200/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-blue-500" />
        </div>

        <div>
          <label class="text-xs text-slate-400 mb-1 block">Amount (₱)</label>
          <input type="number" placeholder="0.00" name="amount" required
            class="w-full bg-[#2c2c2e] border border-zinc-200/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-blue-500" />
        </div>

        <div>
          <label class="text-xs text-slate-400 mb-1 block">Category</label>
          <select name="category"
            class="w-full bg-[#2c2c2e] border border-zinc-200/10 rounded-lg px-3 py-2 text-sm text-slate-300 focus:outline-none focus:border-blue-500">
            <option value="Utilities">Utilities</option>
            <option value="Food">Food</option>
            <option value="Transport">Transport</option>
            <option value="Health">Health</option>
            <option value="Other">Other</option>
          </select>
        </div>

        <div>
          <label class="text-xs text-slate-400 mb-1 block">Date</label>
          <input type="date" name="expense_date" required
            class="w-full bg-[#2c2c2e] border border-zinc-200/10 rounded-lg px-3 py-2 text-sm text-slate-300 focus:outline-none focus:border-blue-500" />
        </div>

        <div>
          <label class="text-xs text-slate-400 mb-1 block">Description <span
              class="text-slate-600">(optional)</span></label>
          <input type="text" placeholder="Add a note..." name="description"
            class="w-full bg-[#2c2c2e] border border-zinc-200/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-blue-500" />
        </div>
      </div>

      <div class="flex gap-3 mt-6">
        <button type="button" onclick="closeModal()"
          class="flex-1 py-2 rounded-lg border border-zinc-200/10 text-sm text-slate-400 hover:text-white transition">
          Cancel
        </button>
        <button type="submit"
          class="flex-1 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-sm text-white font-medium transition">
          Save
        </button>
      </div>
    </form>
  </div>
</div>
