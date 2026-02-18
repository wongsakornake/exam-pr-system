<template>
    <MainLayout>
        <main class="flex-1 flex flex-col min-w-0 bg-slate-50/50 dark:bg-slate-950/50">
            <div class="p-4 sm:p-6 md:p-8 max-w-7xl mx-auto w-full">

                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                    <div
                        class="flex items-center gap-1 sm:gap-2 bg-slate-100/70 dark:bg-slate-900/70 p-1.5 rounded-xl border border-slate-200/80 dark:border-slate-800 overflow-x-auto hide-scrollbar">
                        <button
                            class="whitespace-nowrap px-4 py-2 rounded-lg bg-white dark:bg-slate-800 font-semibold text-slate-800 dark:text-slate-100 shadow-sm ring-1 ring-slate-200/50 dark:ring-slate-700 transition-all">
                            すべて
                        </button>
                        <button
                            class="whitespace-nowrap px-4 py-2 rounded-lg text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 hover:bg-white/60 dark:hover:bg-slate-800/50 font-medium transition-all">
                            配信前
                        </button>
                        <button
                            class="whitespace-nowrap px-4 py-2 rounded-lg text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 hover:bg-white/60 dark:hover:bg-slate-800/50 font-medium transition-all">
                            配信完了
                        </button>
                    </div>

                </div>

                <div
                    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[800px]">
                            <thead>
                                <tr
                                    class="bg-slate-50/80 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                                    <th
                                        class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-400 text-sm whitespace-nowrap">
                                        ID</th>
                                    <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-400 text-sm">タイトル
                                    </th>
                                    <th
                                        class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-400 text-sm whitespace-nowrap">
                                        予約/配信日時</th>
                                    <th
                                        class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-400 text-sm whitespace-nowrap">
                                        ステータス</th>
                                    <th
                                        class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-400 text-sm text-right whitespace-nowrap">
                                        アクション</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/80">

                                <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                    <td class="px-6 py-4 text-sm font-mono text-slate-500 whitespace-nowrap">10-1100
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-slate-800 dark:text-slate-200">
                                        新サービスリリースのご案内</td>
                                    <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400 whitespace-nowrap">
                                        2026/02/15 17:00</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 ring-1 ring-amber-600/20 dark:bg-amber-500/10 dark:text-amber-400 dark:ring-amber-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            承認待ち
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        <button
                                            class="p-2 text-slate-400 hover:text-primary hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full transition-colors">
                                            <span class="material-icons-round text-xl block">more_horiz</span>
                                        </button>
                                    </td>
                                </tr>

                                <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                    <td class="px-6 py-4 text-sm font-mono text-slate-500 whitespace-nowrap">10-1101
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-slate-800 dark:text-slate-200">
                                        冬季限定キャンペーンのお知らせ</td>
                                    <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400 whitespace-nowrap">
                                        2026/02/15 17:00</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 ring-1 ring-blue-600/20 dark:bg-blue-500/10 dark:text-blue-400 dark:ring-blue-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                            配信前
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        <button
                                            class="p-2 text-slate-400 hover:text-primary hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full transition-colors">
                                            <span class="material-icons-round text-xl block">more_horiz</span>
                                        </button>
                                    </td>
                                </tr>

                                <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                    <td class="px-6 py-4 text-sm font-mono text-slate-500 whitespace-nowrap">10-1099
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-slate-800 dark:text-slate-200">
                                        コーポレートサイトリニューアルのお知らせ</td>
                                    <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400 whitespace-nowrap">
                                        2026/01/20 10:00</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20 dark:bg-emerald-500/10 dark:text-emerald-400 dark:ring-emerald-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            配信完了
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        <button
                                            class="p-2 text-slate-400 hover:text-primary hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full transition-colors">
                                            <span class="material-icons-round text-xl block">more_horiz</span>
                                        </button>
                                    </td>
                                </tr>

                                <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                    <td class="px-6 py-4 text-sm font-mono text-slate-500 whitespace-nowrap">10-1098
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-slate-800 dark:text-slate-200">
                                        第3四半期決算発表に関するお知らせ</td>
                                    <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400 whitespace-nowrap">
                                        2026/01/15 15:00</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20 dark:bg-emerald-500/10 dark:text-emerald-400 dark:ring-emerald-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            配信完了
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        <button
                                            class="p-2 text-slate-400 hover:text-primary hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full transition-colors">
                                            <span class="material-icons-round text-xl block">more_horiz</span>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <!-- <div
                        class="px-6 py-4 border-t border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 bg-slate-50/50 dark:bg-slate-900/50">
                        <span class="text-sm text-slate-500 font-medium">全 48 件中 1-4 件を表示</span>
                        <div class="flex gap-2">
                            <button
                                class="p-2 text-slate-500 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors shadow-sm"
                                disabled>
                                <span class="material-icons-round text-sm block">chevron_left</span>
                            </button>
                            <button
                                class="p-2 text-slate-500 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors shadow-sm">
                                <span class="material-icons-round text-sm block">chevron_right</span>
                            </button>
                        </div>
                    </div> -->
                </div>

            </div>
        </main>
    </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import MainLayout from '@/layouts/MainLayout.vue';
</script>

<style scoped>
/* ซ่อน Scrollbar แต่ยังเลื่อนได้ */
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}

.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>