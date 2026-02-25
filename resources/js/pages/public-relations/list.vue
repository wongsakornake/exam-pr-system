<template>
    <MainLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-slate-800 dark:text-white">PRリスト</h1>
            </div>

            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                <div
                    class="flex items-center gap-1 sm:gap-2 bg-slate-100/70 dark:bg-slate-900/70 p-1.5 rounded-xl border border-slate-200/80 dark:border-slate-800 overflow-x-auto hide-scrollbar">
                    <button v-for="tab in tabs" :key="tab.value" @click="activeTab = tab.value" :class="[
                        'whitespace-nowrap px-4 py-2 rounded-lg font-medium transition-all',
                        activeTab === tab.value
                            ? 'bg-white dark:bg-slate-800 font-semibold text-slate-800 dark:text-slate-100 shadow-sm ring-1 ring-slate-200/50 dark:ring-slate-700'
                            : 'text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 hover:bg-white/60 dark:hover:bg-slate-800/50'
                    ]">
                        {{ tab.label }}
                    </button>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                                <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300"></th>
                                <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300">件名</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300">作成日</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300">更新日</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300">配布スケジュール</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300">状態</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300 text-right">アクション</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                             <!-- <tr v-if="publicRelations.data.length === 0">
                                <td colspan="4" class="px-6 py-10 text-center text-slate-400 text-sm">データがありません</td>
                            </tr> -->
                            <tr v-for="(item, index) in publicRelations.data" :key="item.id" class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4 text-sm font-mono text-slate-500 whitespace-nowrap">
                                    {{ (publicRelations.current_page - 1) * publicRelations.per_page + index + 1 }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-slate-800 dark:text-slate-200">{{ item.subject }}</div>
                                    <!-- <div class="text-xs text-slate-400 mt-1">{{ item.content }}</div> -->
                                </td>
                                 <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    {{ formatDate(item.created_at) }}
                                </td>
                                 <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    {{ formatDate(item.updated_at) }}
                                </td>
                                 <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    {{ formatDate(item.sent_at) }}
                                </td>
                                <td class="px-6 py-4">
                                    <span :class="statusClass(item.status)">{{ item.status }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button @click="goToEdit(item)"
                                        :disabled="item.status !== 'pending' && item.status !== 'reject'" :class="[
                                            'inline-flex items-center px-4 py-2 text-xs font-medium rounded transition-colors',
                                            (item.status === 'pending' || item.status === 'reject')
                                                ? 'bg-orange-600 hover:bg-orange-500 text-white cursor-pointer'
                                                : 'bg-slate-200 text-slate-500 cursor-not-allowed opacity-60'
                                        ]">
                                        編集
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div v-if="filteredList.length === 0" class="p-12 text-center text-slate-500">
                    情報はありません。
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import MainLayout from '@/layouts/MainLayout.vue';

const props = defineProps({
    publicRelations: Object,
});
const publicRelations = props.publicRelations ?? [];


// Filter Tabs
const tabs = [
    { label: 'すべて', value: 'all' },
    { label: '配信前', value: 'pending' },
    { label: '配信完了', value: 'sent' },
];
const activeTab = ref('all');

const filteredList = computed(() => {
    if (activeTab.value === 'all') return publicRelations;
    return publicRelations.data.filter(item => item.status === activeTab.value);
});

// Format Date
const formatDate = (dateStr) => {
    if (!dateStr) return '-';
    const d = new Date(dateStr);
    return d.toLocaleString('ja-JP', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
    });
};

// Status Styling Function
const statusClass = (status) => {
    const base = 'px-2.5 py-1 rounded text-[11px] font-bold ';
    if (status === 'pending') return base + 'bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300';
    if (status === 'approved') return base + 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300';
    return base + 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-400';
};

const goToEdit = (item) => {
    router.get(`/customer/public-relations/edit`);
};

// Status Style — ปรับ value ให้ตรงกับ DB ของคุณ
const statusStyle = (status) => {
    const map = {
        pending: {
            label: '承認待ち',
            badge: 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 ring-1 ring-amber-600/20 dark:bg-amber-500/10 dark:text-amber-400 dark:ring-amber-500/20',
            dot: 'w-1.5 h-1.5 rounded-full bg-amber-500',
        },
        scheduled: {
            label: '配信前',
            badge: 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 ring-1 ring-blue-600/20 dark:bg-blue-500/10 dark:text-blue-400 dark:ring-blue-500/20',
            dot: 'w-1.5 h-1.5 rounded-full bg-blue-500',
        },
        sent: {
            label: '配信完了',
            badge: 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20 dark:bg-emerald-500/10 dark:text-emerald-400 dark:ring-emerald-500/20',
            dot: 'w-1.5 h-1.5 rounded-full bg-emerald-500',
        },
    };
    return map[status] ?? {
        label: status,
        badge: 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600 ring-1 ring-slate-200',
        dot: 'w-1.5 h-1.5 rounded-full bg-slate-400',
    };
};
</script>

<style scoped>
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}

.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>