<script setup lang="ts">
import { onMounted } from "vue";
import SvgTextHeading from "@/components/texts/SvgTextHeading.vue";
import DocumentSvg from "@/components/svgs/DocumentSvg.vue";
import BaseCard from "@/components/cards/BaseCard.vue";
import CountChip from "@/components/chips/CountChip.vue";
import { fetchMemos } from "@/features/memos/apis/MemoRepository";
import { useFormatter } from "@/utils/formatter.ts";
import { useMemosStore } from "@/features/memos/stores/memosStore.ts";

const memosStore = useMemosStore();
const { formatDateTime } = useFormatter();

const loadMemos = async () => {
  await fetchMemos();
};

onMounted(() => {
  loadMemos();
});
</script>

<template>
  <section class="space-y-4">
    <div class="flex items-center justify-between">
      <SvgTextHeading :icon="DocumentSvg" text="保存されたメモ" />
      <CountChip :count="memosStore.count" />
    </div>
    <BaseCard v-for="(memo, index) in memosStore.memos" :key="index" variant="subtle">
      <div class="flex-1">
        <p class="text-gray-800 leading-relaxed whitespace-pre-wrap">{{ memo.description }}</p>
        <p class="text-xs text-gray-400 mt-3">{{ formatDateTime(memo.createdAt) }}</p>
      </div>
    </BaseCard>
  </section>
</template>
