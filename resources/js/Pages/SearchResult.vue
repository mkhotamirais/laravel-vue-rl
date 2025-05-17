<script setup>
import CardRental from "@/Components/CardRental.vue";
import CardBlog from "@/Components/CardBlog.vue";

const params = route().params;
defineProps({
  rentalResults: Object,
  blogResults: Object,
});
</script>

<template>
  <section class="py-12 bg-slate-100">
    <div class="container">
      <h1 class="h1">
        Result for <span class="text-primary">"{{ params.q }}"</span>
      </h1>
      <div>
        <h2 class="h2">Results from Rentals</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2">
          <template v-for="(r, i) in rentalResults" :key="i">
            <CardRental :r="r" />
          </template>
        </div>
      </div>
      <div>
        <h2 class="h2">Results from Blogs</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
          <template v-for="(b, i) in blogResults" :key="i">
            <CardBlog :b="b" />
          </template>
        </div>
      </div>
    </div>
  </section>
</template>