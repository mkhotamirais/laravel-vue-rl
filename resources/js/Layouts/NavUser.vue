<script setup>
import { ref } from "vue";
import { computed } from "vue";
import { useI18n } from "vue-i18n";

defineProps({ user: Object });

const { t, locale, messages } = useI18n();

const userMenu = computed(() => messages.value[locale.value].user_menu);

const open = ref(false);
const closeMenu = () => {
  open.value = false;
};
const openMenu = () => {
  open.value = true;
};
</script>

<template>
  <div v-if="user">
    <button @click="openMenu" type="button" title="menuUser" class="btn-icon">
      <i class="fa-solid fa-user"></i>
    </button>
    <div
      @click="closeMenu"
      class="fixed inset-0 bg-black/20 z-50 transition-all"
      :class="open ? 'visible opacity-100' : 'invisible opacity-0'"
    >
      <div
        @click="(e) => e.stopPropagation()"
        class="absolute w-72 bg-white h-full right-0 transition-all"
        :class="open ? 'translate-x-0' : 'translate-x-full'"
      >
        <div class="p-3">
          <div class="flex items-center justify-between">
            <p>Hi, {{ user.name }}</p>
            <button
              @click="closeMenu"
              class="btn-icon"
              type="button"
              title="closeMenuUser"
            >
              <i class="fa-solid fa-times"></i>
            </button>
          </div>
          <nav>
            <Link
              @click="closeMenu"
              v-for="(m, i) in userMenu"
              :key="i"
              :href="route(m.name)"
              class="btn-link block w-full text-left"
              >{{ m.label }}</Link
            >

            <Link
              @click="closeMenu"
              :href="route('logout')"
              method="post"
              as="button"
              class="btn-link block w-full text-left"
            >
              Logout
            </Link>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>