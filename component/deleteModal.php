<div class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center">
  <div class="bg-[#1c1c1e] border border-zinc-200/10 rounded-2xl p-6 w-full max-w-sm mx-4">
    <div class="flex flex-col items-center gap-4 text-center">
      <!-- Icon -->
      <div class="w-12 h-12 rounded-full bg-red-500/10 flex items-center justify-center">
        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
      </div>
      <!-- Text -->
      <div>
        <h2 class="text-white font-semibold text-base">Delete Record</h2>
        <p class="text-slate-400 text-sm mt-1">Are you sure you want to delete record <span
            class="text-white font-medium" id="deleteRecordId"></span>? This action cannot be undone.</p>
      </div>
      <!-- Buttons -->
      <div class="flex gap-3 w-full mt-2">
        <button
          class="flex-1 py-2 rounded-lg border border-zinc-200/10 text-sm text-slate-400 hover:text-white hover:border-zinc-200/20 transition">
          Cancel
        </button>
        <button class="flex-1 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-sm text-white font-medium transition">
          Delete
        </button>
      </div>
    </div>
  </div>
</div>

<!-- <script> -->
<!--   function openDeleteModal(id) { -->
<!--     document.getElementById('deleteRecordId').textContent = '#' + id; -->
<!--     document.getElementById('deleteModal').style.display = 'flex'; -->
<!--   } -->
<!---->
<!--   function closeDeleteModal() { -->
<!--     document.getElementById('deleteModal').style.display = 'none'; -->
<!--   } -->
<!---->
<!--   function confirmDelete() { -->
<!--     // handle delete here -->
<!--   } -->
<!-- </script> -->
