<script setup lang="ts">
import { computed } from "vue";

const { variant = "prominent" } = defineProps<{
  variant?: "prominent" | "subtle";
}>();

const baseClass = computed(() => {
  switch (variant) {
    case "subtle":
      return "bg-white rounded-lg shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all duration-200 group";
    default:
      return "bg-white rounded-xl shadow-lg border border-primary-100 p-6 mb-8";
  }
});
</script>

<template>
  <div :class="baseClass">
    <slot />
  </div>
</template>
