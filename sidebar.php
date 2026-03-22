<aside class="w-56 bg-[#1c1c1e] min-h-screen flex flex-col py-6 px-4 fixed top-0 left-0 z-10">
  <div class="flex items-center gap-2 mb-10 px-2">
    <div class="w-7 h-7 bg-zinc-950 rounded flex items-center justify-center text-xs font-semibold">V</div>
    <span class="text-white font-medium text-sm tracking-wide">expenses</span>
  </div>
  <nav class="flex flex-col gap-1 flex-1">
    <a href="#"
      class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-white hover:bg-[#2c2c2e] text-sm transition">
      Dashboard
    </a>
    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-[#2c2c2e] text-white text-sm font-medium">
      Expenses
    </a>
    <a href="#"
      class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-white hover:bg-[#2c2c2e] text-sm transition">
      <?php include("svg/savings.php") ?>
      Savings
    </a>
    <a href="#"
      class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-white hover:bg-[#2c2c2e] text-sm transition">
      <?php include("svg/recordHistory.php") ?>
      Record History
    </a>
  </nav>
</aside>
