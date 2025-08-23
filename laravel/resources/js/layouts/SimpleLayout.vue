<script setup lang="ts">
import Header from "@/components/Header.vue";
</script>

<template>
  <div class="min-h-full w-full">
    <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-primary-50 to-red-50">
      <Header />
      <div class="max-w-2xl mx-auto px-6 py-8">
        <slot />
      </div>
    </div>
  </div>
</template>
