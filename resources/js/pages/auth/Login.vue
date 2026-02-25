<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<!-- <template>
    <AuthBase
        title="Log in to your account"
        description="Enter your email and password below to log in"
    >
        <Head title="Log in" />

        <div
            v-if="status"
            class="mb-4 text-center text-sm font-medium text-green-600"
        >
            {{ status }}
        </div>

        <Form
            v-bind="store.form()"
            :reset-on-success="['password']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        placeholder="email@example.com"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password">Password</Label>
                        <TextLink
                            v-if="canResetPassword"
                            :href="request()"
                            class="text-sm"
                            :tabindex="5"
                        >
                            Forgot password?
                        </TextLink>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        placeholder="Password"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" name="remember" :tabindex="3" />
                        <span>Remember me</span>
                    </Label>
                </div>

                <Button
                    type="submit"
                    class="mt-4 w-full"
                    :tabindex="4"
                    :disabled="processing"
                    data-test="login-button"
                >
                    <Spinner v-if="processing" />
                    Log in
                </Button>
            </div>

            <div
                class="text-center text-sm text-muted-foreground"
                v-if="canRegister"
            >
                Don't have an account?
                <TextLink :href="register()" :tabindex="5">Sign up</TextLink>
            </div>
        </Form>
    </AuthBase>
</template> -->
<template>
    <AuthBase>
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-black text-slate-800 dark:text-slate-100 tracking-tight">
                Welcome Back
            </h1>
            <p class="text-sm text-slate-500 mt-2 font-medium">
                Please enter your details to login to the <span class="text-indigo-600 font-bold">PR System</span>
            </p>
        </div>

        <Head title="Log in" />

        <div
            v-if="status"
            class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 rounded-xl text-center text-sm font-bold text-green-600"
        >
            {{ status }}
        </div>

        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-none p-8 transition-all">
            <Form
                v-bind="store.form()"
                :reset-on-success="['password']"
                v-slot="{ errors, processing }"
                class="space-y-6"
            >
                <div class="space-y-5">
                    <div class="space-y-2">
                        <Label for="email" class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Email Address</Label>
                        <Input
                            id="email"
                            type="email"
                            name="email"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="email"
                            placeholder="email@example.com"
                            class="w-full px-4 py-3.5 rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all"
                        />
                        <InputError :message="errors.email" />
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between ml-1">
                            <Label for="password" class="text-xs font-black text-slate-400 uppercase tracking-widest">Password</Label>
                            <TextLink
                                v-if="canResetPassword"
                                :href="request()"
                                class="text-xs font-bold text-indigo-600 hover:text-indigo-700"
                                :tabindex="5"
                            >
                                Forgot?
                            </TextLink>
                        </div>
                        <Input
                            id="password"
                            type="password"
                            name="password"
                            required
                            :tabindex="2"
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full px-4 py-3.5 rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all"
                        />
                        <InputError :message="errors.password" />
                    </div>

                    <div class="flex items-center justify-between py-1 ml-1">
                        <Label for="remember" class="flex items-center gap-3 cursor-pointer group">
                            <Checkbox id="remember" name="remember" :tabindex="3" class="w-5 h-5 rounded border-slate-300 text-indigo-600 mt-0" />
                            <span class="text-sm font-bold text-slate-600 group-hover:text-indigo-600 transition-colors">Remember me</span>
                        </Label>
                    </div>

                    <Button
                        type="submit"
                        class="w-full py-6 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-xl shadow-lg shadow-indigo-200 dark:shadow-none transition-all active:scale-[0.98]"
                        :tabindex="4"
                        :disabled="processing"
                    >
                        <Spinner v-if="processing" class="mr-2" />
                        Log in
                    </Button>
                </div>

                <div
                    class="pt-6 border-t border-slate-50 dark:border-slate-800 text-center text-sm font-medium text-slate-500"
                    v-if="canRegister"
                >
                    Don't have an account?
                    <TextLink 
                        :href="register()" 
                        class="text-indigo-600 font-bold hover:underline underline-offset-4 ml-1" 
                        :tabindex="6"
                    >
                        Sign up
                    </TextLink>
                </div>
            </Form>
        </div>
    </AuthBase>
</template>
