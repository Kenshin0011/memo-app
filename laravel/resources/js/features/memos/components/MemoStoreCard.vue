<script setup lang="ts">
import { ref } from "vue";
import BaseCard from "../../../components/cards/BaseCard.vue";
import SvgTextHeading from "../../../components/texts/SvgTextHeading.vue";
import PlusSvg from "../../../components/svgs/PlusSvg.vue";
import TextareaForm from "../../../components/forms/TextareaForm.vue";
import SaveButton from "../../../components/buttons/SaveButton.vue";

const memo = ref("");

const handleSave = () => {
  console.log("保存ボタンがクリックされました");
  console.log("メモの内容:", memo.value);
  console.log("メモの文字数:", memo.value.length);
};
</script>

<template>
  <BaseCard>
    <SvgTextHeading :icon="PlusSvg" text="新しいメモ" class="mb-4" />
    <div class="space-y-4">
      <div>
        <TextareaForm
          id="memo-input"
          v-model="memo"
          aria-describedby="memo-input-description"
          aria-label="新しいメモの内容"
          :placeholder="`メモを入力してください...\n（Enterで保存、Shift+Enterで改行）`"
          :rows="4"
        />
        <div id="memo-input-description" class="sr-only">
          メモを入力してから保存ボタンを押してください。Enterキーで保存、Shift+Enterで改行できます。
        </div>
      </div>
      <SaveButton
        aria-describedby="memo-input-description"
        :aria-label="
          memo.length === 0 ? 'メモを保存できません（メモを入力してください）' : 'メモを保存'
        "
        :disabled="memo.length === 0"
        text="メモを保存"
        @click="handleSave"
      >
        <PlusSvg color="white" />
      </SaveButton>
    </div>
  </BaseCard>
</template>
