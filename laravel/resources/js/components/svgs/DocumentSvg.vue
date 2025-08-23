<script setup lang="ts">
import { computed } from "vue";
import { ICON_SIZES, IconSize } from "@/constants/iconSizes.ts";

const { color = "primary", size = "sm" } = defineProps<{
  color?: "primary";
  size?: IconSize;
}>();

const colorClass = computed(() => {
  switch (color) {
    default:
      return "text-primary-500";
  }
});
const sizeClass = computed<string>(() => ICON_SIZES[size]);
</script>

<template>
  <svg
    xmlns="http://www.w3.org/2000/svg"
    :class="[colorClass, sizeClass]"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round"
    class="lucide lucide-sticky-note"
  >
    <path d="M16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8Z"></path>
    <path d="M15 3v4a2 2 0 0 0 2 2h4"></path>
  </svg>
</template>
