<script setup lang="ts">
import { ref } from "vue";
import SvgTextHeading from "@/components/texts/SvgTextHeading.vue";
import DocumentSvg from "@/components/svgs/DocumentSvg.vue";
import BaseCard from "@/components/cards/BaseCard.vue";
import { Memo } from "@/features/memos/types/memoTypes";

const memos = ref<Memo[]>([
  {
    createdAt: "2024-07-30 10:30",
    description: "Vue.jsの基本構文を復習する",
  },
  {
    createdAt: "2024-07-30 11:15",
    description: "Reactiveの使い方を理解する",
  },
  {
    createdAt: "2024-07-30 14:20",
    description: "TypeScriptの型定義について学ぶ",
  },
]);
</script>

<template>
  <section class="space-y-4">
    <SvgTextHeading :icon="DocumentSvg" text="保存されたメモ" />
    <BaseCard v-for="(memo, index) in memos" :key="index" variant="subtle">
      <div class="flex-1">
        <p class="text-gray-800 leading-relaxed whitespace-pre-wrap">{{ memo.description }}</p>
        <p class="text-xs text-gray-400 mt-3">{{ memo.createdAt }}</p>
      </div>
    </BaseCard>
  </section>
</template>
