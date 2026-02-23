<template>
    <MainLayout>
        <div class="space-y-6">
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
                        <div class="col-span-12 lg:col-span-4 space-y-4 h-[55vh] overflow-auto">
                            <div class="bg-slate-50 dark:bg-slate-800/40 p-5 rounded-xl border border-slate-100 dark:border-slate-800">
                                <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">エリア選択</h2>
                                <div class="grid grid-cols-2 lg:grid-cols-1 gap-1">
                                    <label v-for="area in props.areas" :key="area.id"
                                        class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-white dark:hover:bg-slate-700 cursor-pointer transition-all group">
                                        <input v-model="selectedAreaIds" :value="area.id"
                                            class="w-4 h-4 rounded text-indigo-600 focus:ring-indigo-500"
                                            type="checkbox" />
                                        <span class="group-hover:text-indigo-600 text-sm font-medium">{{ area.name_jp }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-12 lg:col-span-8 border border-slate-100 dark:border-slate-800 rounded-xl flex flex-col overflow-hidden">
                            <div class="p-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/20">
                                <div class="flex items-center gap-2">
                                    <h2 class="font-bold text-base md:text-lg">配信対象 (編集モード)</h2>
                                    <span class="px-2.5 py-0.5 bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 rounded-full text-[10px] font-black uppercase">
                                        {{ mediaReceivers.length }}件
                                    </span>
                                </div>
                            </div>
                            <div class="overflow-y-auto max-h-[300px] relative">
                                <table class="w-full text-sm">
                                    <thead class="sticky top-0 z-10 bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 border-b border-slate-100 dark:border-slate-800">
                                        <tr>
                                            <th class="px-6 py-4 font-bold uppercase text-[10px] tracking-wider text-left">エリア</th>
                                            <th class="px-6 py-4 font-bold uppercase text-[10px] tracking-wider text-left">メディア名</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 h-[55vh] overflow-auto">
                                        <tr v-for="media in mediaReceivers" :key="media.id">
                                            <td class="px-6 py-4 text-slate-600 font-medium">{{ media.target_area?.name_jp || '-' }}</td>
                                            <td class="px-6 py-4 font-bold text-slate-800 dark:text-slate-200">
                                                {{ media.organization_name }} ({{ media.department }})
                                            </td>
                                        </tr>
                                        <tr v-if="!isLoadingMedia && mediaReceivers.length === 0">
                                            <td colspan="2" class="px-6 py-10 text-center text-slate-400 font-medium">エリアを選択してください</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="currentStep === 2" class="p-6 sm:p-10 max-w-4xl mx-auto">
                    <div class="mb-10 text-center">
                        <h2 class="text-2xl font-black text-slate-800 dark:text-slate-100">PR内容の編集</h2>
                    </div>
                    <form class="space-y-8" @submit.prevent>
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                タイトル <span class="bg-rose-500 text-white text-[9px] px-1.5 py-0.5 rounded font-bold">必須</span>
                            </label>
                            <input v-model="form.subject" :class="{ 'border-rose-500': errors.subject }"
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-800 outline-none"
                                type="text" />
                            <p v-if="errors.subject" class="text-xs text-rose-500 font-bold">{{ errors.subject }}</p>
                        </div>

                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                概要・本文 <span class="bg-rose-500 text-white text-[9px] px-1.5 py-0.5 rounded font-bold">必須</span>
                            </label>
                            <textarea v-model="form.content" :class="{ 'border-rose-500': errors.content }"
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-800 outline-none"
                                rows="10"></textarea>
                            <p v-if="errors.content" class="text-xs text-rose-500 font-bold">{{ errors.content }}</p>
                        </div>

                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest">PDFファイル (変更する場合のみアップロード)</label>
                            <input type="file" id="pdf-upload" class="hidden" accept=".pdf" @change="handleFileUpload" />
                            <label for="pdf-upload" class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-2xl p-8 flex flex-col items-center justify-center gap-3 cursor-pointer group">
                                <span class="material-icons text-slate-400">{{ form.pdf_file ? 'check_circle' : 'upload_file' }}</span>
                                <p class="text-sm font-bold text-slate-600 dark:text-slate-300">
                                    {{ form.pdf_file ? (form.pdf_file.name || '既存ファイルあり') : 'クリックしてファイルを変更' }}
                                </p>
                            </label>
                        </div>
                    </form>
                </div>

                <div v-if="currentStep === 3" class="p-6 sm:p-10">
                    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-8">
                        <div class="md:col-span-5 space-y-6">
                            <h2 class="text-lg font-bold">配信日時</h2>
                            <div class="p-6 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-slate-800">
                                <input type="time" v-model="form.scheduled_time" class="w-full p-3 rounded-lg border-slate-200 dark:bg-slate-900" />
                            </div>
                        </div>
                        <div class="md:col-span-7">
                            <div class="bg-indigo-50/30 dark:bg-slate-800/40 border border-indigo-100 dark:border-slate-800 rounded-2xl p-8">
                                <h2 class="text-lg font-bold mb-6">更新の確認</h2>
                                <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">内容を確認の上、更新ボタンを押してください。</p>
                                <div class="mt-10 flex flex-col items-end gap-3">
                                    <p class="text-2xl font-black text-indigo-600">{{ form.scheduled_time }} に更新予定</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-5 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center">
                    <button @click="prevStep" :disabled="currentStep === 1"
                        class="px-6 py-2.5 rounded-lg border border-slate-200 text-slate-600 font-bold hover:bg-white disabled:opacity-30">
                        戻る
                    </button>

                    <button @click="nextStep"
                        class="px-10 py-2.5 bg-indigo-600 text-white font-black rounded-lg shadow-lg hover:opacity-90 transition-all">
                        {{ currentStep === 3 ? '更新する' : '次へ' }}
                    </button>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref, watch, reactive, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import MainLayout from '@/layouts/MainLayout.vue';

const props = defineProps({
    areas: Array,
    publicRelationsDetail: Object,
    targetMediaId: Array, // [{target_media_id: 1}, ...]
});

const form = reactive({
    id: null,
    subject: '',
    content: '',
    pdf_file: null,
    scheduled_time: '17:00',
    media_receiver_ids: []
});

const errors = reactive({
    subject: '',
    content: ''
});

const steps = [{ title: '配信先' }, { title: '配信内容' }, { title: '確認・更新' }];
const currentStep = ref(1);
const selectedAreaIds = ref([]);
const mediaReceivers = ref([]);
const isLoadingMedia = ref(false);

// 1. นำข้อมูลจาก Props มาใส่ใน Form เมื่อ Component ถูกโหลด
onMounted(() => {
    if (props.publicRelationsDetail) {
        const detail = props.publicRelationsDetail;
        form.id = detail.id;
        form.subject = detail.subject || '';
        form.content = detail.content || '';
        // หากมีไฟล์เก่า ไม่ต้องใส่ใน pdf_file (เก็บเป็น null ไว้ถ้าไม่เปลี่ยน)
        
        // ดึง IDs ของ Media ที่ถูกเลือกไว้ก่อนหน้า
        if (props.targetMediaId) {
            form.media_receiver_ids = props.targetMediaId.map(m => m.target_media_id);
            // เพื่อความสะดวกในหน้านี้ เราจะดึงข้อมูล Media มาแสดงโดยอ้างอิงจาก Area
            // หรือถ้าต้องการแม่นยำกว่านั้น ควรส่ง Area IDs ที่เคยเลือกไว้มาจาก Controller ด้วย
        }
    }
});

// Watcher สำหรับดึงข้อมูล Media ตาม Area
watch(selectedAreaIds, async (newIds) => {
    if (newIds.length === 0) {
        mediaReceivers.value = [];
        return;
    }
    isLoadingMedia.value = true;
    try {
        const response = await axios.get('/internal-api/target-media-receivers', {
            params: { area_ids: newIds }
        });
        mediaReceivers.value = response.data;
        form.media_receiver_ids = mediaReceivers.value.map(media => media.id);
    } catch (error) {
        console.error("Fetch error:", error);
    } finally {
        isLoadingMedia.value = false;
    }
}, { deep: true });

const validateStep2 = () => {
    errors.subject = form.subject.trim() ? '' : 'タイトルを入力してください';
    errors.content = form.content.trim() ? '' : '本文を入力してください';
    return !errors.subject && !errors.content;
};

const nextStep = () => {
    if (currentStep.value === 1) {
        if (selectedAreaIds.value.length === 0 && mediaReceivers.value.length === 0) {
            alert('配信先を選択してください');
            return;
        }
        currentStep.value++;
    } else if (currentStep.value === 2) {
        if (validateStep2()) currentStep.value++;
    } else {
        submitUpdate();
    }
};

const prevStep = () => { if (currentStep.value > 1) currentStep.value--; };

const submitUpdate = () => {
    if (mediaReceivers.value.length === 0) {
        alert('配信対象を選択してください');
        return;
    }

    // การทำ Update ที่มีไฟล์แนบใน Inertia/Laravel 
    // ต้องใช้ POST และส่ง _method: 'put' เพื่อให้รองรับ Multipart form data
    router.post(`/customer/public-relations/${form.id}`, {
        _method: 'put',
        subject: form.subject,
        content: form.content,
        pdf_file: form.pdf_file,
        scheduled_at: form.scheduled_time,
        media_ids: form.media_receiver_ids,
    }, {
        forceFormData: true,
        onSuccess: () => alert('更新が完了しました'),
        onError: (err) => console.error(err),
    });
};

const handleFileUpload = (event) => {
    const file = event.target.files[0];
    if (file && file.type === 'application/pdf') {
        form.pdf_file = file;
    } else {
        alert('PDF形式ของไฟล์เท่านั้น');
    }
};
</script>