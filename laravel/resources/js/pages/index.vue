<script setup lang="ts">
import SimpleLayout from "../layouts/SimpleLayout.vue";
import MemoStoreCard from "../features/memos/components/MemoStoreCard.vue";
import MemoList from "../features/memos/components/MemoList.vue";
</script>

<template>
  <SimpleLayout>
    <MemoStoreCard />
    <MemoList />
  </SimpleLayout>
</template>
