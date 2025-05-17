<script setup>
import { smartTrim } from "@/functions";
defineProps({
  title: String,
  results: Object,
});

const emit = defineEmits(["close"]);

function close() {
  emit("close");
}
</script>

<template>
  <p>Results From {{ title }}</p>
  <template v-for="(r, i) in results" :key="i">
    <Link
      @click="close"
      :href="route(title === 'Rentals' ? 'sewa-mobil.show' : 'blog.show', r)"
      class="flex items-center border border-primary/50 gap-2 mb-1 hover:bg-primary/10 transition-all rounded-lg overflow-hidden"
    >
      <img
        :src="`/storage/${r.banner}`"
        alt=""
        width="50"
        height="50"
        class="size-[50px] object-cover object-center"
      />
      <p class="text-sm">
        {{ smartTrim(title === "Rentals" ? r.name : r.title, 40) }}
      </p>
    </Link>
  </template>
</template>