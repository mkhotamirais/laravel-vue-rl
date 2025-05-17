<script setup>
import { ref, computed } from "vue";
import Logo from "@/Components/Logo.vue";
import { useI18n } from "vue-i18n";

const { t, locale, messages } = useI18n();

const mainMenu = computed(() => messages.value[locale.value].main_menu);

const open = ref(false);
const closeMenu = () => {
  open.value = false;
};
const openMenu = () => {
  open.value = true;
};
</script>

<template>
  <div class="flex md:hidden">
    <button
      @click="openMenu"
      type="button"
      title="openMenuMobile"
      class="btn-icon"
    >
      <i class="fa-solid fa-bars"></i>
    </button>
    <div
      @click="closeMenu"
      class="fixed inset-0 bg-black/20 z-50 transition-all"
      :class="open ? 'visible opacity-100' : 'invisible opacity-0'"
    >
      <div
        @click="(e) => e.stopPropagation()"
        class="absolute w-72 bg-white h-full left-0 transition-all"
        :class="open ? 'translate-x-0' : '-translate-x-full'"
      >
        <div class="p-3">
          <div class="flex items-center justify-between">
            <Logo />
            <button
              @click="closeMenu"
              type="button"
              title="closeMenuMobile"
              class="btn-icon"
            >
              <i class="fa-solid fa-times"></i>
            </button>
          </div>
          <div>
            <nav class="mt-6">
              <Link
                v-for="(m, i) in mainMenu"
                @click="closeMenu"
                :key="i"
                :href="route(m.name)"
                class="btn-link block w-full text-left"
                :class="m.url === $page.url ? 'bg-primary/10' : ''"
              >
                {{ m.label }}
              </Link>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>