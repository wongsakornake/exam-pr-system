<template>
    <header class="h-16 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 sticky top-0 z-30">
        <div class="h-full px-4 lg:px-8 flex items-center justify-between">
            
            <div class="flex items-center gap-4">
                <button @click="$emit('toggle-sidebar')" 
                        class="p-2 rounded-lg lg:hidden hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <h2 class="hidden sm:block text-sm lg:text-base font-semibold text-slate-700 dark:text-slate-200 uppercase tracking-wider">
                    {{ pageTitle }}
                </h2>
            </div>

            <div class="flex items-center gap-2 lg:gap-4">
                <div class="h-8 w-px bg-slate-200 dark:bg-slate-800 mx-1"></div>

                <div class="flex items-center gap-3 pl-2 group cursor-pointer">
                    <div class="text-right hidden lg:block">
                        <p class="text-xs font-bold text-slate-700 dark:text-slate-200">{{ mockUser.name }}</p>
                        <p class="text-[10px] text-indigo-500 font-medium uppercase">{{ mockUser.role }}</p>
                    </div>
                    
                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold shadow-sm ring-2 ring-white dark:ring-slate-800">
                        {{ mockUser.name.charAt(0) }}
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed, reactive } from 'vue';

const page = usePage();
defineEmits(['toggle-sidebar']);

/**
 * 1. ข้อมูล User จำลอง (Mock Data)
 * คุณสามารถเปลี่ยนค่าตรงนี้เพื่อดูการแสดงผลได้เลยครับ
 */
const mockUser = reactive({
    name: 'Piatec Developer',
    role: 'Administrator', // หรือ 'Customer'
    email: 'piatec@example.com'
});

/**
 * 2. Dynamic Page Title
 */
const pageTitle = computed(() => {
    const url = page.url;
    if (url.includes('review')) return 'PRレビュー (Review)';
    if (url.includes('create')) return 'PR 新規作成 (Create)';
    if (url.includes('list')) return 'PR 一覧 (List)';
    return 'Dashboard';
});
</script>