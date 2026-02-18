<template>
  <div class="flex h-screen bg-gray-50 font-sans text-slate-900 dark:text-slate-100">
    
    <Sidebar />

    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
      
      <Navbar />

      <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 sm:p-6 lg:p-8">
        <div class="container mx-auto">
          <slot />
        </div>
      </main>
      
    </div>
  </div>
</template>

<script setup>
import Sidebar from '@/components/Sidebar.vue';
import Navbar from '@/components/Navbar.vue';
</script>