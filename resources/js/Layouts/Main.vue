<script setup>
import Logo from "@/Components/Logo.vue";
import SetLocale from "./SetLocale.vue";
import NavDesktop from "./NavDesktop.vue";
import NavMobile from "./NavMobile.vue";
import NavUser from "./NavUser.vue";
import Search from "./Search.vue";
import Footer from "./Footer.vue";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({
  blogResults: Object,
  rentalResults: Object,
});

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
  <Head>
    <meta
      head-key="description"
      name="description"
      :content="$t('home.subtitle')"
    />
  </Head>
  <div class="flex flex-col min-h-screen">
    <!-- header -->
    <header class="h-16 sticky top-0 bg-white shadow z-50">
      <div class="container flex items-center justify-between">
        <div class="flex items-center gap-1">
          <NavMobile />
          <Logo />
        </div>
        <nav class="flex items-center gap-1">
          <NavDesktop />
          <NavUser :user="user" />
          <Search :blogResults="blogResults" :rentalResults="rentalResults" />
          <SetLocale />
        </nav>
      </div>
    </header>

    <!-- main -->
    <main class="flex-1">
      <slot></slot>
    </main>

    <Footer :user="user" />
  </div>
</template>