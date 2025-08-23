<script setup lang="ts">
type Props = {
  ariaDescribedBy?: string;
  ariaLabel?: string;
  disabled?: boolean;
  text?: string;
  type?: "button" | "submit" | "reset";
};

const { disabled = false, text = "保存" } = defineProps<Props>();
</script>

<template>
  <button
    :class="[
      'w-full py-3 px-6 rounded-lg font-medium transition-all duration-200 flex items-center justify-center gap-2',
      'bg-gradient-to-r from-orange-500 to-red-500 text-white hover:from-orange-600 hover:to-red-600',
      disabled ? 'opacity-50 cursor-not-allowed' : '',
    ]"
    :disabled="disabled"
    :aria-label="ariaLabel || (disabled ? `${text}できません（入力が必要です）` : text)"
    :aria-describedby="ariaDescribedBy"
    :type="type"
    role="button"
  >
    <slot />
    {{ text }}
  </button>
</template>
