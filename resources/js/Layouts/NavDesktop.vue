<script setup>
import { computed } from "vue";
import { useI18n } from "vue-i18n";

const { t, locale, messages } = useI18n();

const mainMenu = computed(() => messages.value[locale.value].main_menu);
</script>

<template>
  <div class="hidden md:flex mr-2">
    <Link
      v-for="(menu, i) in mainMenu"
      :key="i"
      :href="route(menu.name)"
      class="btn-link"
      :class="menu.url === $page.url ? 'bg-primary/10' : ''"
      >{{ menu.label }}</Link
    >
  </div>
</template>