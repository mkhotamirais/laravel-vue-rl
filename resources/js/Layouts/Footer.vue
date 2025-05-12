<script setup>
import Logo from "@/Components/Logo.vue";
import { computed } from "vue";
import { useI18n } from "vue-i18n";
import c from "@/content.json";

const { t, locale, messages } = useI18n();

const mainMenu = computed(() => messages.value[locale.value].main_menu);
</script>

<template>
  <footer class="border-t border-slate-200">
    <div class="container py-12">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div>
          <Logo />
          <address class="mt-4 block text-gray-500">
            {{ $t("footer.address") }} :
            {{ c.address }}
          </address>
        </div>
        <div>
          <h3 class="footer-title">{{ $t("footer.links") }}</h3>
          <nav class="mt-2">
            <Link
              v-for="(m, i) in mainMenu"
              :key="i"
              :href="m.href"
              class="footer-link"
            >
              {{ m.label }}
            </Link>
          </nav>
        </div>
        <div>
          <h3 class="footer-title">{{ $t("footer.other_links") }}</h3>
          <nav class="mt-2">
            <Link :href="route('login')" class="footer-link">{{
              $t("auth.login")
            }}</Link>
            <Link :href="route('register')" class="footer-link">{{
              $t("auth.register")
            }}</Link>
            <a href="https://panoramaalam.id" class="footer-link"
              >panoramaalam</a
            >
          </nav>
        </div>
        <div>
          <h3 class="footer-title">{{ $t("common.contact") }}</h3>
          <nav class="mt-2">
            <a :href="c.links.wa.url" class="footer-link">
              <i class="fa-brands fa-whatsapp mr-1"></i>
              {{ c.links.wa.label }}</a
            >
            <a :href="c.links.ig.url" class="footer-link">
              <i class="fa-brands fa-instagram mr-1"></i>
              {{ c.links.ig.label }}</a
            >
          </nav>
        </div>
      </div>
    </div>
    <div class="py-4 bg-primary text-white text-center">
      <div class="container">
        <small>
          Copyright &copy; {{ new Date().getFullYear() }}
          <a
            href="https://panoramaalam.id"
            class="text-gray-200 hover:underline"
            >PT Panoramaalam Bahagia</a
          >
        </small>
      </div>
    </div>
  </footer>
</template>