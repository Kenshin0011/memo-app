<script setup lang="ts">
import BaseCard from "./BaseCard.vue";
import SvgTextHeading from "../texts/SvgTextHeading.vue";
import PlusSvg from "../svgs/PlusSvg.vue";
</script>

<template>
  <BaseCard>
    <SvgTextHeading :icon="PlusSvg" class="mb-4">新しいメモ</SvgTextHeading>
  </BaseCard>
</template>
