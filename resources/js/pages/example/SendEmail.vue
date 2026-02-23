<script setup>
import { ref } from 'vue';
import axios from 'axios';

const form = ref({
    email: '',
    subject: '',
    message: ''
});

const status = ref('');
const loading = ref(false);

const sendEmail = async () => {
    loading.value = true;
    try {
        const response = await axios.post('/send-email', form.value);
        status.value = response.data.message;
        form.value = { email: '', subject: '', message: '' }; // ล้างฟอร์ม
    } catch (error) {
        status.value = "เกิดข้อผิดพลาดในการส่ง";
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <div class="p-6 max-w-md mx-auto bg-white rounded-xl shadow-md">
        <h2 class="text-2xl font-bold mb-4">เมนู: Send Email</h2>
        
        <form @submit.prevent="sendEmail" class="space-y-4">
            <div>
                <label class="block">ถึง:</label>
                <input v-model="form.email" type="email" class="w-full border p-2 rounded" placeholder="user@example.com" required>
            </div>
            <div>
                <label class="block">หัวข้อ:</label>
                <input v-model="form.subject" type="text" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block">ข้อความ:</label>
                <textarea v-model="form.message" class="w-full border p-2 rounded" rows="4"></textarea>
            </div>
            
            <button :disabled="loading" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 disabled:bg-gray-400">
                {{ loading ? 'กำลังส่ง...' : 'กดเพื่อส่งเมล์' }}
            </button>
        </form>

        <p v-if="status" class="mt-4 text-green-600 font-semibold">{{ status }}</p>
    </div>
</template>