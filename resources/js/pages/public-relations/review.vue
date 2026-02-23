<template>
    <MainLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-slate-800 dark:text-white">PRレビュー</h1>
            </div>

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                                <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300">Subject</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300">Owner</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300">Created At</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300">Updated At</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300">Send At</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300">Status</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                             <!-- <tr v-if="publicRelations.data.length === 0">
                                <td colspan="4" class="px-6 py-10 text-center text-slate-400 text-sm">データがありません</td>
                            </tr> -->
                            <tr v-for="(item, index) in publicRelations.data" :key="item.id" class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-slate-800 dark:text-slate-200">{{ item.subject }}</div>
                                    <div class="text-xs text-slate-400 mt-1">Tokyo, Japan — [2026-02-22] — We are proud to announce the launch of "EcoStream," a revolutionary home water purification system designed to reduce plastic waste by 70%. Developed with advanced filtration technology from Japan, EcoStream offers pure, mineral-rich water while maintaining a sleek, minimalist design suitable for modern homes. Our mission is to provide clean water access while protecting our planet's oceans from single-use plastics. EcoStream will be available nationwide starting next month.</div>
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    user test
                                </td>
                                 <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    23/02/2026
                                </td>
                                 <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    23/02/2026
                                </td>
                                 <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    23/02/2026
                                </td>
                                <td class="px-6 py-4">
                                    <span :class="statusClass(item.status)">{{ item.statusText }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button @click="openReviewModal(item)" 
                                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded transition-colors">
                                       レビュー
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div v-if="mockPRs.length === 0" class="p-12 text-center text-slate-500">
                    情報はありません。
                </div>
            </div>
        </div>

        <Modal :show="isModalOpen" :data="selectedPR" @close="isModalOpen = false" />
    </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import MainLayout from '@/layouts/MainLayout.vue';
import Modal from '@/components/ReviewPrModal.vue';

// Props
const props = defineProps({
    publicRelations: Object,
});
const publicRelations = props.publicRelations ?? [];

// Modal State
const isModalOpen = ref(false);
const selectedPR = ref(null);

// Mock Data (Japanese Content)
const mockPRs = ref([
    { 
        id: 1, 
        title: '2026年度 新製品発表プレスリリース', 
        author: 'マーケティング部', 
        status: 'pending', 
        statusText: '保留中',
        date: '2026-02-18' 
    },
    { 
        id: 2, 
        title: '第3四半期 決算報告書の公開', 
        author: '財務局', 
        status: 'approved', 
        statusText: '承認済み',
        date: '2026-02-17' 
    },
    { 
        id: 3, 
        title: '社内ボランティアプログラムのお知らせ', 
        author: '人事部', 
        status: 'pending', 
        statusText: '保留中',
        date: '2026-02-16' 
    },
]);

// Open Modal Function
const openReviewModal = (item) => {
    selectedPR.value = item;
    isModalOpen.value = true;
};

// Status Styling Function
const statusClass = (status) => {
    const base = 'px-2.5 py-1 rounded text-[11px] font-bold ';
    if (status === 'pending') return base + 'bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300';
    if (status === 'approved') return base + 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300';
    return base + 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-400';
};
</script>