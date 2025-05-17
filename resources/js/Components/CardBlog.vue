<script setup>
import { smartTrim, diffForHumans } from "@/functions";
defineProps({
  b: Object,
});
</script>

<template>
  <Link :href="route('blog.show', b)" class="group rounded-lg overflow-hidden">
    <img
      :src="`/storage/${b.banner}`"
      alt=""
      width="250"
      height="250"
      class="w-full h-48 object-cover object-center"
    />
    <div class="flex flex-col mt-2 transition-all">
      <h3 class="group-hover:underline text-base font-medium text-base mb-2">
        {{ smartTrim(b.title, 42) }}
      </h3>
      <p class="text-xs mt-auto text-gray-500">
        {{ diffForHumans(b.created_at) }}
      </p>
    </div>
  </Link>
</template>