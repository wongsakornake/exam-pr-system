<template>
    <footer class="mt-auto border-t border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm">
        <div class="max-w-full mx-auto px-4 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-1.5 font-bold text-slate-800 dark:text-slate-200">
                        <span class="p-1 bg-indigo-600 text-white rounded text-[10px] uppercase tracking-tighter">PR</span>
                        <span class="text-sm">System</span>
                    </div>
                    <span class="text-slate-300 dark:text-slate-700 hidden sm:block">|</span>
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">
                        © {{ new Date().getFullYear() }} Piatec. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
/**
 * Footer Component
 * ดีไซน์ให้มีความโปร่งแสง (Backdrop blur) และใช้โทนสีเดียวกับ Navbar/Sidebar
 */
</script>