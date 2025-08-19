<script setup lang="ts">
import type { Component } from "vue";

defineProps<{
  icon: Component;
  text?: string;
}>();
</script>

<template>
  <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
    <component :is="icon" />
    <span>{{ text }}</span>
  </h2>
</template>
