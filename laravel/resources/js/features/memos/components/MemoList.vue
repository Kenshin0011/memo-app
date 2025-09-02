<script setup lang="ts">
import { onMounted } from "vue";
import SvgTextHeading from "@/components/texts/SvgTextHeading.vue";
import DocumentSvg from "@/components/svgs/DocumentSvg.vue";
import BaseCard from "@/components/cards/BaseCard.vue";
import CountChip from "@/components/chips/CountChip.vue";
import DeleteButton from "@/components/buttons/DeleteButton.vue";
import { deleteMemo, fetchMemos } from "@/features/memos/apis/MemoRepository";
import { useFormatter } from "@/utils/formatter.ts";
import { useMemosStore } from "@/features/memos/stores/memosStore.ts";

const memosStore = useMemosStore();
const { formatDateTime } = useFormatter();

/**
 * メモの読み込み
 */
const loadMemos = async () => {
  await fetchMemos();
};

/**
 * メモの削除
 * @param memoId メモID
 */
const handleDelete = async (memoId: number) => {
  await deleteMemo(memoId);
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
    <BaseCard v-for="memo in memosStore.memos" :key="memo.id" variant="subtle" class="group">
      <div class="flex justify-between items-start gap-4">
        <div class="flex-1">
          <p class="text-gray-800 leading-relaxed whitespace-pre-wrap">{{ memo.description }}</p>
          <p class="text-xs text-gray-400 mt-3">{{ formatDateTime(memo.createdAt) }}</p>
        </div>
        <DeleteButton
          class="opacity-0 group-hover:opacity-100"
          :aria-label="`メモ「${memo.description.slice(0, 20)}...」を削除`"
          @click="handleDelete(memo.id)"
        />
      </div>
    </BaseCard>
  </section>
</template>
