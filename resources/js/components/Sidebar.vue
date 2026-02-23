<template>
    <div v-if="isOpen" @click="isOpen = false" 
         class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden transition-opacity"></div>

    <aside :class="[
        'fixed lg:static inset-y-0 left-0 z-50 flex flex-col transition-all duration-300 ease-in-out border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900',
        isOpen ? 'w-64' : 'w-20 -translate-x-full lg:translate-x-0'
    ]">
        <div class="h-16 flex items-center justify-between px-4 border-b border-slate-200 dark:border-slate-800">
            <div v-if="isOpen" class="flex items-center gap-2 font-bold text-xl text-indigo-600 dark:text-indigo-400 overflow-hidden whitespace-nowrap">
                <span class="p-1.5 bg-indigo-600 text-white rounded-lg text-xs">PR</span>
                <span>System</span>
            </div>
            <button @click="isOpen = !isOpen" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 mx-auto">
                <svg v-if="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <nav class="flex-1 p-3 space-y-1 overflow-y-auto overflow-x-hidden">
            <Link v-for="item in menuItems" :key="item.href" :href="item.href"
                :class="[
                    'flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group',
                    isUrl(item.href) 
                    ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400' 
                    : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50'
                ]">
                <component :is="item.icon" class="w-6 h-6 shrink-0" />
                <span v-if="isOpen" class="font-medium whitespace-nowrap">{{ item.label }}</span>
                
                <div v-if="!isOpen" class="absolute left-16 scale-0 group-hover:scale-100 transition-all bg-slate-800 text-white text-xs p-2 rounded-md z-50">
                    {{ item.label }}
                </div>
            </Link>
        </nav>

        <!-- <div class="p-3 border-t border-slate-200 dark:border-slate-800 space-y-1">
            <button class="w-full flex items-center gap-3 px-3 py-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                <span v-if="isOpen" class="text-sm font-medium">アカウント</span>
            </button>
        </div> -->
    </aside>

    <!-- <button @click="isOpen = true" v-if="!isOpen" 
            class="lg:hidden fixed bottom-4 right-4 z-50 p-4 bg-indigo-600 text-white rounded-full shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M4 6h16M4 12h16M4 18h16" /></svg>
    </button> -->
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

// State สำหรับเปิด-ปิด
const isOpen = ref(true);
const page = usePage();

// จัดการหน้าจอเริ่มต้น (ถ้าจอมือถือให้ปิดไว้ก่อน)
onMounted(() => {
    if (window.innerWidth < 1024) {
        isOpen.ref = false;
    }
});

const isUrl = (url) => page.url.startsWith(url);

// ข้อมูลเมนู (เก็บเป็น Array จะได้จัดการง่ายขึ้น)
const menuItems = [
    { 
        label: 'PRレビュー', 
        href: '/admin/public-relations/review', 
        icon: () => h('svg', { xmlns: 'http://www.w3.org/2000/svg', fill: 'none', viewBox: '0 0 24 24', stroke: 'currentColor', class: 'w-6 h-6' }, [h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4' })])
    },
    { 
        label: 'PR 新規作成', 
        href: '/customer/public-relations/create', 
        icon: () => h('svg', { xmlns: 'http://www.w3.org/2000/svg', fill: 'none', viewBox: '0 0 24 24', stroke: 'currentColor', class: 'w-6 h-6' }, [h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M12 4v16m8-8H4' })])
    },
    { 
        label: 'PR 一覧', 
        href: '/customer/public-relations/list', 
        icon: () => h('svg', { xmlns: 'http://www.w3.org/2000/svg', fill: 'none', viewBox: '0 0 24 24', stroke: 'currentColor', class: 'w-6 h-6' }, [h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M4 6h16M4 10h16M4 14h16M4 18h16' })])
    },
];
import { h } from 'vue'; // สำหรับสร้าง Icon แบบ inline
</script>

<style scoped>
/* เพิ่มความสวยงามของการเลื่อน */
nav::-webkit-scrollbar {
    width: 4px;
}
nav::-webkit-scrollbar-thumb {
    background: #e2e8f0;
    border-radius: 10px;
}
.dark nav::-webkit-scrollbar-thumb {
    background: #1e293b;
}
</style>