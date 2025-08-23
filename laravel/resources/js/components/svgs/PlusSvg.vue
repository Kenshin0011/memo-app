<script setup lang="ts">
import { computed } from "vue";
import { ICON_SIZES, IconSize } from "@/constants/iconSizes.ts";

const { color = "primary", size = "sm" } = defineProps<{
  color?: "primary" | "white";
  size?: IconSize;
}>();

const colorClass = computed(() => {
  switch (color) {
    case "white":
      return "text-white";
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
    class="lucide lucide-plus"
  >
    <path d="M5 12h14"></path>
    <path d="M12 5v14"></path>
  </svg>
</template>
