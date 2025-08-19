<script setup lang="ts">
import type { Component } from "vue";

defineProps<{
  icon: Component;
}>();
</script>

<template>
  <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
    <component :is="icon" />
    <slot />
  </h2>
</template>
