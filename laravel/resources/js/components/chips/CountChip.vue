<script setup lang="ts">
type Props = {
  count: number;
};

defineProps<Props>();
</script>

<template>
  <span class="text-sm text-gray-500 bg-orange-100 px-3 py-1 rounded-full"> {{ count }}件 </span>
</template>
