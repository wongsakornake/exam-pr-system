<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
import { email } from '@/routes/password';

defineProps<{
    status?: string;
}>();
</script>

<!-- <template>
    <AuthLayout
        title="Forgot password"
        description="Enter your email to receive a password reset link"
    >
        <Head title="Forgot password" />

        <div
            v-if="status"
            class="mb-4 text-center text-sm font-medium text-green-600"
        >
            {{ status }}
        </div>

        <div class="space-y-6">
            <Form v-bind="email.form()" v-slot="{ errors, processing }">
                <div class="grid gap-2">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        autocomplete="off"
                        autofocus
                        placeholder="email@example.com"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="my-6 flex items-center justify-start">
                    <Button
                        class="w-full"
                        :disabled="processing"
                        data-test="email-password-reset-link-button"
                    >
                        <Spinner v-if="processing" />
                        Email password reset link
                    </Button>
                </div>
            </Form>

            <div class="space-x-1 text-center text-sm text-muted-foreground">
                <span>Or, return to</span>
                <TextLink :href="login()">log in</TextLink>
            </div>
        </div>
    </AuthLayout>
</template> -->

<template>
    <AuthLayout>
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-black text-slate-800 dark:text-slate-100 tracking-tight">
                Forgot Password?
            </h1>
            <p class="text-sm text-slate-500 mt-2 font-medium">
                No worries, enter your email to receive a 
                <span class="text-indigo-600 font-bold">reset link</span>
            </p>
        </div>

        <Head title="Forgot password" />

        <div
            v-if="status"
            class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 rounded-xl text-center text-sm font-bold text-green-600"
        >
            {{ status }}
        </div>

        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-none p-8 transition-all">
            <Form v-bind="email.form()" v-slot="{ errors, processing }" class="space-y-6">
                <div class="space-y-2">
                    <Label for="email" class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Email Address</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        autocomplete="off"
                        autofocus
                        placeholder="email@example.com"
                        class="w-full px-4 py-3.5 rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="pt-2">
                    <Button
                        class="w-full py-6 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-xl shadow-lg shadow-indigo-200 dark:shadow-none transition-all active:scale-[0.98]"
                        :disabled="processing"
                        data-test="email-password-reset-link-button"
                    >
                        <Spinner v-if="processing" class="mr-2" />
                        Send Reset Link
                    </Button>
                </div>
            </Form>

            <div class="mt-8 pt-6 border-t border-slate-50 dark:border-slate-800 text-center text-sm font-medium text-slate-500">
                Or, return to 
                <TextLink 
                    :href="login()" 
                    class="text-indigo-600 font-bold hover:underline underline-offset-4 ml-1"
                >
                    Log in
                </TextLink>
            </div>
        </div>
    </AuthLayout>
</template>
