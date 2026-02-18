<template>
    <Teleport to="body">
        <Transition name="fade">
            <div v-if="show" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
                
                <div class="absolute inset-0 bg-slate-900/60" @click="$emit('close')"></div>

                <div :class="[
                    'relative bg-white dark:bg-slate-900 w-full rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden transition-all',
                    maxWidthClass
                ]">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">
                            PR詳細レビュー
                        </h3>
                        <button @click="$emit('close')"
                            class="p-2 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full transition-colors group">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="p-6">
                        <div v-if="data" class="space-y-5">
                            <div>
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">PRタイトル</label>
                                <p class="text-sm text-slate-800 dark:text-slate-200 mt-1 font-semibold leading-relaxed">
                                    {{ data.title }}
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">申請者</label>
                                    <p class="text-sm text-slate-800 dark:text-slate-200 mt-1">{{ data.author }}</p>
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">申請日</label>
                                    <p class="text-sm text-slate-800 dark:text-slate-200 mt-1">{{ data.date }}</p>
                                </div>
                            </div>

                            <div>
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">内容本文</label>
                                <div class="mt-2 p-4 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-sm text-slate-600 dark:text-slate-400 h-40 overflow-y-auto border border-slate-100 dark:border-slate-700/50 leading-relaxed">
                                    こちらは「{{ data.title }}」のプレスリリース詳細内容です。サンプルのテキストがここに入ります。
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 flex flex-col sm:flex-row justify-end gap-3">
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