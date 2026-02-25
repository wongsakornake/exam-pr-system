<template>
    <MainLayout>
        <div class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-black text-slate-800 dark:text-white">ユーザー管理</h1>
                </div>
                <!-- <button @click="createUser" 
                        class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 dark:shadow-none transition-all active:scale-95">
                    <span class="material-icons text-sm">add</span>
                    新規ユーザー招待
                </button> -->
            </div>

            <!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div v-for="stat in stats" :key="stat.label" class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ stat.label }}</p>
                    <p class="text-3xl font-black text-slate-800 dark:text-white mt-2">{{ stat.value }}</p>
                </div>
            </div> -->

            <div
                class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">

                        <thead>
                            <tr
                                class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                                <th class="px-6 py-4"></th>
                                <th class="px-6 py-4">ユーザー情報</th>
                                <th class="px-6 py-4">権限 (Role)</th>
                                <th class="px-6 py-4">ステータス</th>
                                <th class="px-6 py-4">登録日</th>
                                <th class="px-6 py-4 text-right">操作</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            <tr v-for="user in users.data" :key="user.id"
                                class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors group">
                                <td class="px-6 py-4 text-sm font-mono text-slate-500 whitespace-nowrap">
                                    {{ (user.current_page - 1) * user.per_page + index + 1 }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-xs">
                                            {{ user.name.charAt(0) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-800 dark:text-slate-200">{{ user.name
                                                }}</p>
                                            <p class="text-xs text-slate-400 font-medium">{{ user.email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span :class="[
                                        'px-2.5 py-1 rounded-md text-[10px] font-black uppercase tracking-tighter',
                                        user.role === 'admin' ? 'bg-amber-100 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400'
                                    ]">
                                        {{ user.role_name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2 text-xs font-bold"
                                        :class="user.email_verified_at ? 'text-emerald-500' : 'text-slate-400'">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                        {{ user.email_verified_at ? 'Verified' : 'Pending' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-500 font-medium">
                                    {{ new Date(user.created_at).toLocaleDateString('ja-JP') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div
                                        class="flex items-center justify-end gap-2">
                                        <button @click="editUser(user)"
                                            class="p-2  bg-green-800 text-white hover:bg-green-600 rounded-lg transition-all">
                                            <span class="material-icons text-sm">Enable</span>
                                        </button>
                                        <button @click="deleteUser(user)"
                                            class="p-2  bg-rose-800 text-white hover:bg-rose-600 rounded-lg transition-all">
                                            <span class="material-icons text-sm">Disable</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/layouts/MainLayout.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    users: Array,
    stats: Array // [{ label: 'Total Users', value: 120 }, ...]
});

const createUser = () => router.get('/admin/users/create');
const editUser = (user) => router.get(`/admin/users/${user.id}/edit`);
const deleteUser = (user) => {
    if (confirm('คุณแน่ใจหรือไม่ว่าต้องการลบผู้ใช้งานรายนี้?')) {
        router.delete(`/admin/users/${user.id}`);
    }
};
</script>