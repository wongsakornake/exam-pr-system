<template>
    <Teleport to="body">
        <Transition name="fade">
            <div v-if="show" class="fixed inset-0 z-[100] flex items-center justify-center p-4">

                <div class="absolute inset-0 bg-slate-900/60" @click="$emit('close')"></div>

                <div :class="[
                    'relative bg-white dark:bg-slate-900 w-full rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden transition-all flex flex-col',
                    maxWidthClass,
                    'max-h-[90vh]'
                ]">
                    <div
                        class="shrink-0 px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">
                            PR詳細レビュー
                        </h3>
                        <button @click="$emit('close')"
                            class="p-2 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full transition-colors group">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="p-6 overflow-y-auto flex-1 custom-scrollbar">
                        <div v-if="data" class="space-y-5">
                            <div>
                                <label
                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">PRタイトル</label>
                                <p
                                    class="text-sm text-slate-800 dark:text-slate-200 mt-1 font-semibold leading-relaxed">
                                    {{ data.subject }}
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Owner</label>
                                    <p class="text-sm text-slate-800 dark:text-slate-200 mt-1">user test</p>
                                </div>
                                <div>
                                    <label
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Created
                                        at</label>
                                    <p class="text-sm text-slate-800 dark:text-slate-200 mt-1">{{
                                        formatDate(data.created_at) }}</p>
                                </div>
                                <div>
                                    <label
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Status</label>
                                    <p class="text-sm text-slate-800 dark:text-slate-200 mt-1">{{ data.status }}</p>
                                </div>
                                <div>
                                    <label
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Updated
                                        at</label>
                                    <p class="text-sm text-slate-800 dark:text-slate-200 mt-1">{{
                                        formatDate(data.updated_at) }}</p>
                                </div>
                                <div>
                                   
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sent
                                        at</label>
                                    <p class="text-sm text-slate-800 dark:text-slate-200 mt-1">After Approve</p>
                                </div>
                            </div>

                            <div>
                                <label
                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Content</label>
                                <div
                                    class="mt-2 p-4 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-sm text-slate-600 dark:text-slate-400 border border-slate-100 dark:border-slate-700/50 leading-relaxed whitespace-pre-wrap">
                                    {{ data.content }}
                                </div>
                            </div>

                            <!-- <div>
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">File Attachments</label>
                                <div class="mt-2 p-4 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-sm text-slate-600 dark:text-slate-400 border border-slate-100 dark:border-slate-700/50">
                                    files : {{ data.file_attachments[0].file_name }}
                                </div>
                            </div> -->
                            <div>
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                    File Attachments
                                </label>
                                <div class="mt-2 space-y-2">
                                    <div v-if="data.file_attachments && data.file_attachments.length > 0"
                                        v-for="(file, index) in data.file_attachments" :key="index"
                                        class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-100 dark:border-slate-700/50 group hover:border-indigo-500/50 transition-all">

                                        <div class="flex items-center gap-3 overflow-hidden">
                                            <!-- <div
                                                class="w-10 h-10 rounded-lg bg-white dark:bg-slate-800 flex items-center justify-center shadow-sm border border-slate-100 dark:border-slate-700">
                                                <span v-if="file.file_name.endsWith('.pdf')"
                                                    class="material-icons text-rose-500 text-xl">picture_as_pdf</span>
                                                <span v-else-if="file.file_name.match(/\.(jpg|jpeg|png|gif)$/i)"
                                                    class="material-icons text-emerald-500 text-xl">image</span>
                                                <span v-else
                                                    class="material-icons text-slate-400 text-xl">insert_drive_file</span>
                                            </div> -->

                                            <div class="flex flex-col overflow-hidden">
                                                <span
                                                    class="text-xs font-bold text-slate-700 dark:text-slate-200 truncate">
                                                    {{ file.file_name }}
                                                </span>
                                                <span class="text-[10px] text-slate-400 font-medium uppercase">
                                                    {{ file.file_name.split('.').pop() }} File
                                                </span>
                                            </div>
                                        </div>

                                        <!-- <a :href="'../../' + file.file_path" target="_blank"
                                            class="p-2 bg-white dark:bg-slate-700 text-slate-500 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-400 rounded-lg shadow-sm border border-slate-100 dark:border-slate-600 transition-all active:scale-90">
                                            <svg width="16px" height="16px" viewBox="0 0 16 16"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="bi bi-eye">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                            </svg>
                                        </a> -->
                                        <a :href="file.file_path" :download="file.file_name" target="_blank"
                                            class="p-2 bg-white dark:bg-slate-700 text-slate-500 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-400 rounded-lg shadow-sm border border-slate-100 dark:border-slate-600 transition-all active:scale-90">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </a>
                                    </div>

                                    <div v-else
                                        class="p-4 bg-slate-50 dark:bg-slate-800/30 rounded-lg border border-dashed border-slate-200 dark:border-slate-800 text-center text-xs text-slate-400 font-medium">
                                        添付ファイルはありません
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Noted</label>
                                <div
                                    class="mt-2 p-4 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-sm text-slate-600 dark:text-slate-400 border border-slate-100 dark:border-slate-700/50">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="shrink-0 px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row justify-end gap-3">
                        <button @click="$emit('close')"
                            class="order-3 sm:order-1 px-5 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-md transition-colors">
                            キャンセル
                        </button>
                        <button @click="$emit('close')"
                            class="order-2 px-5 py-2 text-sm font-medium bg-rose-600 hover:bg-rose-700 text-white rounded-md transition-all shadow-sm">
                            却下する
                        </button>
                        <button @click="$emit('close')"
                            class="order-1 sm:order-3 px-5 py-2 text-sm font-medium bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition-all shadow-sm">
                            承認する
                        </button>
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>



<script setup>
import { computed } from 'vue';

const props = defineProps({
    show: Boolean,
    data: Object, // เพิ่มการรับข้อมูลจากหน้าหลัก
    maxWidth: {
        type: String,
        default: '2xl'
    }
});

defineEmits(['close']);

const maxWidthClass = computed(() => {
    return {
        'sm': 'max-w-sm',
        'md': 'max-w-md',
        'lg': 'max-w-lg',
        'xl': 'max-w-xl',
        '2xl': 'max-w-2xl',
    }[props.maxWidth];
});

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

</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>

<style scoped>
/* ทำให้ Modal ดูดีขึ้นเมื่อ Scroll */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #e2e8f0;
    border-radius: 10px;
}

.dark .custom-scrollbar::-webkit-scrollbar-thumb {
    background: #1e293b;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>