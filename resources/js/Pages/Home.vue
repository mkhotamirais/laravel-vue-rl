<script setup>
import Bg from "@/Components/Bg.vue";
import Line from "@/Components/Line.vue";
import CardRental from "@/Components/CardRental.vue";
import CardBlog from "@/Components/CardBlog.vue";
import { formatRupiah, smartTrim, diffForHumans } from "@/functions";
import c from "@/content.json";

defineProps({
  rentals: Object,
  blogs: Object,
  popularDestinations: Object,
});
</script>

<template>
  <div>
    <!-- Hero -->
    <section class="py-12 relative overflow-hidden">
      <Bg position="top-left" />
      <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 place-items-center">
          <article class="space-y-6">
            <h1 class="text-4xl lg:text-5xl font-semibold">
              {{ $t("home.title") }}
            </h1>
            <p class="text-gray-500">{{ $t("home.subtitle") }}</p>
            <a
              :href="c.links.wa.url"
              class="inline-block bg-primary hover:bg-primary-dark transition-all py-2 text-white px-6 rounded-full text-center"
            >
              <span class="block mb-1 text-sm">
                {{ $t("common.contact-us") }}
              </span>
              <span class="block text-sm">
                {{ c.links.wa.label }}
              </span>
            </a>
          </article>
          <div
            class="h-56 md:h-80 flex w-full mx-auto rounded-lg overflow-x-scroll"
          >
            <template v-for="(h, i) in popularDestinations" :key="i">
              <Link
                :href="route('blog.show', h)"
                class="min-w-full h-full inline-block"
              >
                <img
                  :src="`/storage/${h.banner}`"
                  alt=""
                  width="500"
                  height="500"
                  class="w-full h-full object-cover object-center"
                />
              </Link>
            </template>
          </div>
        </div>
      </div>
    </section>
    <!-- Rentals -->
    <section class="bg-slate-100 py-12 relative overflow-hidden">
      <div class="container">
        <div class="mb-4 space-y-2">
          <h2 class="h2">{{ $t("rental.title") }}</h2>
          <p class="text-gray-500">{{ $t("rental.subtitle") }}</p>
          <Line class="py-2" />
        </div>
        <div
          class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 gap-y-4"
        >
          <template v-for="(r, i) in rentals" :key="i">
            <CardRental :r="r" />
          </template>
        </div>
        <Link
          :href="route('sewa-mobil.index')"
          class="btn !py-3 !px-5 w-fit mt-4"
          >{{ $t("home.all-rentals") }}</Link
        >
      </div>
    </section>
    <!-- Blogs -->
    <div class="py-12">
      <div class="container">
        <div class="mb-4 space-y-2">
          <h2 class="h2">{{ $t("blog.title") }}</h2>
          <p class="text-gray-500">{{ $t("blog.subtitle") }}</p>
          <Line class="py-2" />
        </div>
        <div
          class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2 gap-y-4"
        >
          <template v-for="(b, i) in blogs" :key="i">
            <CardBlog :b="b" />
          </template>
        </div>
        <Link :href="route('blog.index')" class="btn !py-3 !px-5 w-fit mt-4">{{
          $t("home.all-blogs")
        }}</Link>
      </div>
    </div>
  </div>
</template>