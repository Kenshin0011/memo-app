<script setup lang="ts">
import { ref } from "vue";
import BaseCard from "../../../components/cards/BaseCard.vue";
import SvgTextHeading from "../../../components/texts/SvgTextHeading.vue";
import PlusSvg from "../../../components/svgs/PlusSvg.vue";
import TextareaForm from "../../../components/forms/TextareaForm.vue";

const memo = ref("");
</script>

<template>
  <BaseCard>
    <SvgTextHeading :icon="PlusSvg" text="新しいメモ" class="mb-4" />
    <TextareaForm
      v-model="memo"
      :placeholder="`メモを入力してください...\n（Enterで保存、Shift+Enterで改行）`"
      :rows="4"
    />
  </BaseCard>
</template>
