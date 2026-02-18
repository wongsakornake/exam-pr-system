<template>
    <MainLayout>
        <div class="w-full max-w-full lg:max-w-5xl xl:max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-12">
            
            <div class="flex items-center gap-0 w-full mb-8 shadow-sm rounded-lg overflow-hidden border border-slate-200 dark:border-slate-800">
                <div v-for="(step, index) in steps" :key="index" :class="[
                    'flex-1 flex items-center justify-center py-4 transition-all duration-300 relative',
                    currentStep >= index + 1
                        ? 'bg-indigo-600 text-white'
                        : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400',
                    index !== steps.length - 1 ? 'border-r border-white/10 dark:border-slate-700' : ''
                ]">
                    <span class="font-bold mr-2 text-sm" :class="currentStep >= index + 1 ? 'opacity-100' : 'opacity-60'">
                        {{ index + 1 }}.
                    </span>
                    <span class="font-medium text-xs sm:text-sm md:text-base">{{ step.title }}</span>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-md overflow-hidden transition-all">
                
                <div v-if="currentStep === 1" class="p-4 sm:p-8">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 lg:col-span-4 space-y-4">
                            <div class="bg-slate-50 dark:bg-slate-800/40 p-5 rounded-xl border border-slate-100 dark:border-slate-800">
                                <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">エリア選択</h2>
                                <div class="grid grid-cols-2 lg:grid-cols-1 gap-1">
                                    <label v-for="area in ['北海道', '東北', '関東', '中部', '近畿', '中国・四国', '九州']" :key="area"
                                        class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-white dark:hover:bg-slate-700 cursor-pointer transition-all group">
                                        <input class="w-4 h-4 rounded text-indigo-600 focus:ring-indigo-500 dark:bg-slate-800 border-slate-300 dark:border-slate-700" type="checkbox" />
                                        <span class="group-hover:text-indigo-600 text-sm font-medium">{{ area }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-12 lg:col-span-8 border border-slate-100 dark:border-slate-800 rounded-xl flex flex-col overflow-hidden">
                            <div class="p-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/20">
                                <div class="flex items-center gap-2">
                                    <h2 class="font-bold text-base md:text-lg">配信対象</h2>
                                    <span class="px-2.5 py-0.5 bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 rounded-full text-[10px] font-black uppercase">14件</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-slate-500">
                                    <span class="hidden sm:inline">全選択</span>
                                    <input checked class="w-5 h-5 rounded text-indigo-600 focus:ring-indigo-500 cursor-pointer" type="checkbox" />
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm">
                                    <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 border-b border-slate-100 dark:border-slate-800">
                                        <tr>
                                            <th class="px-6 py-4 font-bold uppercase text-[10px] tracking-wider">エリア</th>
                                            <th class="px-6 py-4 font-bold uppercase text-[10px] tracking-wider">メディア名</th>
                                            <th class="px-6 py-4 text-right font-bold uppercase text-[10px] tracking-wider">選択</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                        <tr v-for="i in 5" :key="i" class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400 font-medium">東海</td>
                                            <td class="px-6 py-4 font-bold text-slate-800 dark:text-slate-200">名古屋テレビ (営業部)</td>
                                            <td class="px-6 py-4 text-right">
                                                <input checked class="w-4 h-4 rounded text-indigo-600 focus:ring-indigo-500" type="checkbox" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="currentStep === 2" class="p-6 sm:p-10 max-w-4xl mx-auto">
                    <div class="mb-10 text-center">
                        <h2 class="text-2xl font-black text-slate-800 dark:text-slate-100">PR内容の入力</h2>
                        <p class="text-sm text-slate-500 mt-2">配信するリリースの詳細を入力してください。</p>
                    </div>
                    <form class="space-y-8">
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                タイトル <span class="bg-rose-500 text-white text-[9px] px-1.5 py-0.5 rounded font-bold">必須</span>
                            </label>
                            <input class="w-full px-4 py-3.5 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-800 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all shadow-sm"
                                type="text" placeholder="プレスリリースのタイトルを入力してください" />
                        </div>
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                概要・本文 <span class="bg-rose-500 text-white text-[9px] px-1.5 py-0.5 rounded font-bold">必須</span>
                            </label>
                            <textarea class="w-full px-4 py-3.5 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-800 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all shadow-sm"
                                rows="10" placeholder="配信内容の詳細を入力してください..."></textarea>
                        </div>
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest">PDFファイル</label>
                            <div class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-2xl p-8 flex flex-col items-center justify-center gap-3 bg-slate-50/50 dark:bg-slate-800/30 hover:border-indigo-500 hover:bg-indigo-50/10 transition-all cursor-pointer group">
                                <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center group-hover:bg-indigo-100 transition-colors">
                                    <span class="material-icons text-slate-400 group-hover:text-indigo-600 transition-colors">upload_file</span>
                                </div>
                                <p class="text-sm font-bold text-slate-600 dark:text-slate-300">クリックまたはドラッグ＆ドロップでアップロード</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase">PDF形式のみ、最大10MBまで</p>
                            </div>
                        </div>
                    </form>
                </div>

                <div v-if="currentStep === 3" class="p-6 sm:p-10">
                    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-8 text-left">
                        <div class="md:col-span-5 space-y-6">
                            <h2 class="text-lg font-bold flex items-center gap-2">配信日時</h2>
                            <div class="p-6 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-slate-800">
                                <input type="time" value="17:00" class="w-full mt-4 p-3 rounded-lg border-slate-200 dark:border-slate-700 dark:bg-slate-900" />
                            </div>
                        </div>
                        <div class="md:col-span-7">
                            <div class="bg-indigo-50/30 dark:bg-slate-800/40 border border-indigo-100 dark:border-slate-800 rounded-2xl p-6 sm:p-8">
                                <h2 class="text-lg font-bold mb-6">各種同意チェック</h2>
                                <div class="space-y-6">
                                    <label v-for="i in 3" :key="i" class="flex gap-4 cursor-pointer group">
                                        <input type="checkbox" class="w-6 h-6 rounded border-slate-300 text-indigo-600 mt-1" />
                                        <div class="flex-1">
                                            <p class="font-bold text-sm group-hover:text-indigo-600">配信条件、公序良俗など</p>
                                            <!-- <p class="text-xs text-slate-500 mt-1">รายละเอียดข้อตกลงการใช้งานและการกดยืนยันเพื่อดำเนินการต่อ</p> -->
                                        </div>
                                    </label>
                                </div>
                                <div class="mt-10 flex flex-col items-end gap-3">
                                    <p class="text-2xl font-black text-indigo-600">2026年 2月 15日 17:00</p>
                                    <!-- <button class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-4 rounded-xl font-black text-lg shadow-xl shadow-indigo-200 dark:shadow-none transition-all active:scale-95">
                                        配信予約ボタン
                                    </button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-5 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center">
                    <button @click="prevStep" :disabled="currentStep === 1"
                        class="px-6 py-2.5 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 font-bold hover:bg-white dark:hover:bg-slate-800 disabled:opacity-30 disabled:cursor-not-allowed transition-all">
                        回顧
                    </button>

                    <button @click="nextStep"
                        class="px-10 py-2.5 bg-indigo-600 text-white font-black rounded-lg shadow-lg shadow-indigo-200 dark:shadow-none hover:opacity-90 active:scale-95 transition-all">
                        {{ currentStep === 3 ? '配信予約ボタン' : '次' }}
                    </button>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import MainLayout from '@/layouts/MainLayout.vue';

const steps = [
    { title: '配信先' },
    { title: '配信内容' },
    { title: '配信予約' }
];

const currentStep = ref(1);

const nextStep = () => {
    if (currentStep.value < 3) {
        currentStep.value++;
    } else {
        alert('Save success!');
    }
};

const prevStep = () => {
    if (currentStep.value > 1) {
        currentStep.value--;
    }
};
</script>