<script setup lang="ts">
import DocumentSvg from "./svgs/DocumentSvg.vue";
</script>

<template>
  <header class="bg-white shadow-sm border-b border-primary-100">
    <div class="max-w-2xl mx-auto px-6 py-6">
      <div class="text-center">
        <h1
          class="text-3xl font-bold bg-gradient-to-r from-primary-500 to-red-500 bg-clip-text text-transparent flex items-center justify-center gap-3"
        >
          <DocumentSvg size="xl" />
          かんたんメモ
        </h1>
        <p class="text-gray-600 mt-2 text-sm">思いついたことをサッと記録しよう</p>
      </div>
    </div>
  </header>
</template>
