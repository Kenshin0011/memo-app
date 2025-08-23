<script setup lang="ts">
import { ICON_SIZES, IconSize } from "@/constants/iconSizes.ts";
import { computed } from "vue";

const { color = "primary", size = "sm" } = defineProps<{
  color?: "gray" | "danger";
  size?: IconSize;
}>();

const colorClass = computed(() => {
  switch (color) {
    case "danger":
      return "text-red-500";
    default:
      return "text-gray-400";
  }
});
const sizeClass = computed<string>(() => ICON_SIZES[size]);
</script>

<template>
  <svg
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round"
    class="lucide lucide-trash2"
    :class="[colorClass, sizeClass]"
  >
    <path d="M3 6h18"></path>
    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
    <line x1="10" x2="10" y1="11" y2="17"></line>
    <line x1="14" x2="14" y1="11" y2="17"></line>
  </svg>
</template>
