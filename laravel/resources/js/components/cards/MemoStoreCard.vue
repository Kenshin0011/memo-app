<script setup lang="ts">
import BaseCard from "./BaseCard.vue";
import SvgTextHeading from "../texts/SvgTextHeading.vue";
import PlusSvg from "../svgs/PlusSvg.vue";
</script>

<template>
  <BaseCard>
    <SvgTextHeading :icon="PlusSvg" text="新しいメモ" class="mb-4" />
  </BaseCard>
</template>
