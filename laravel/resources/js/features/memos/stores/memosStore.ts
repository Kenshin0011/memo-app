import { defineStore } from "pinia";
import { Memo } from "@/features/memos/types/memoTypes.ts";

export const useMemosStore = defineStore("memos", {
  state: () => ({
    memos: [] as Memo[],
  }),
  getters: {
    count: (state): number => state.memos.length,
  },
  actions: {
    addMemo(memo: Memo) {
      this.memos.unshift(memo);
    },
    store(memos: Memo[]) {
      this.memos = memos;
    },
    reset() {
      this.$reset();
    },
  },
});
