<script setup lang="ts">
const { placeholder, rows } = defineProps<{
  placeholder?: string;
  rows?: number;
}>();
const model = defineModel<string>();
const emit = defineEmits<{
  (e: "submit"): void;
}>();

const onEnter = () => {
  emit("submit");
};
</script>

<template>
  <textarea
    v-model="model"
    :placeholder="placeholder"
    :rows="rows"
    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none resize-none text-gray-700"
    @keydown.enter.exact.prevent="onEnter"
    @keydown.shift.enter.stop
  />
</template>
