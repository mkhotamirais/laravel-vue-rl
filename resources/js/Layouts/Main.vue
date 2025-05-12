<script setup>
import Logo from "@/Components/Logo.vue";
import SetLocale from "./SetLocale.vue";
import NavDesktop from "./NavDesktop.vue";
import Footer from "./Footer.vue";
</script>

<template>
  <div class="flex flex-col min-h-screen">
    <!-- header -->
    <header class="h-16 sticky top-0 bg-white shadow">
      <div class="container flex items-center justify-between">
        <Logo />
        <nav class="flex items-center">
          <NavDesktop />
          <SetLocale />
        </nav>
      </div>
    </header>

    <!-- main -->
    <main class="flex-1">
      <slot></slot>
    </main>

    <Footer />
  </div>
</template>