<script setup lang="ts">
import { ref } from "vue";
import TrashSvg from "@/components/svgs/TrashSvg.vue";

type Props = {
  ariaLabel?: string;
  disabled?: boolean;
};

type Emits = {
  click: [];
};

defineProps<Props>();
defineEmits<Emits>();

const isHovered = ref(false);
</script>

<template>
  <button
    type="button"
    :disabled="disabled"
    :aria-label="ariaLabel || '削除'"
    :class="[
      'p-2 rounded-lg transition-colors',
      disabled ? 'cursor-not-allowed opacity-50' : 'hover:bg-red-50 cursor-pointer',
    ]"
    @click="$emit('click')"
    @mouseenter="!disabled && (isHovered = true)"
    @mouseleave="isHovered = false"
  >
    <TrashSvg size="xs" :color="isHovered ? 'danger' : 'gray'" />
  </button>
</template>
