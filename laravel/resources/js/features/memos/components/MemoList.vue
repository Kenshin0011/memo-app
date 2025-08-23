<script setup lang="ts">
import { ref, onMounted } from "vue";
import SvgTextHeading from "@/components/texts/SvgTextHeading.vue";
import DocumentSvg from "@/components/svgs/DocumentSvg.vue";
import BaseCard from "@/components/cards/BaseCard.vue";
import CountChip from "@/components/chips/CountChip.vue";
import { Memo } from "@/features/memos/types/memoTypes";
import { fetchMemos } from "@/features/memos/apis/MemoRepository";
import { useFormatter } from "@/utils/formatter.ts";

const { formatDateTime } = useFormatter();

const memos = ref<Memo[]>([]);

const loadMemos = async () => {
  const response = await fetchMemos();
  if (response.success && response.data) {
    memos.value = response.data;
  }
};

onMounted(() => {
  loadMemos();
});
</script>

<template>
  <section class="space-y-4">
    <div class="flex items-center justify-between">
      <SvgTextHeading :icon="DocumentSvg" text="保存されたメモ" />
      <CountChip :count="memos.length" />
    </div>
    <BaseCard v-for="(memo, index) in memos" :key="index" variant="subtle">
      <div class="flex-1">
        <p class="text-gray-800 leading-relaxed whitespace-pre-wrap">{{ memo.description }}</p>
        <p class="text-xs text-gray-400 mt-3">{{ formatDateTime(memo.createdAt) }}</p>
      </div>
    </BaseCard>
  </section>
</template>
