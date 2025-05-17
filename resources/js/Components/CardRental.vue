<script setup>
import { formatRupiah } from "@/functions";
import c from "@/content.json";

defineProps({ r: Object });
</script>

<template>
  <div class="relative rounded-lg overflow-hidden shadow-md bg-white">
    <div
      class="z-10 absolute -bottom-40 -right-10 -left-10 h-80 rounded-full bg-primary/5"
    ></div>

    <Link :href="route('sewa-mobil.show', r)">
      <img
        :src="`storage/${r.banner}`"
        alt="image"
        width="300"
        height="300"
        class="w-full"
      />
    </Link>
    <div class="relative z-20 p-4 flex space-y-2 flex-col items-center">
      <Link :href="route('sewa-mobil.show', r)" class="hover:underline">
        <h3 class="h3">{{ r.name }}</h3>
      </Link>
      <p class="badge capitalize">{{ r.category.replace("_", " ") }}</p>
      <p class="text-xl font-medium text-primary">
        {{ formatRupiah(r.price) }}
      </p>
      <div class="flex justify-center flex-col items-center">
        <a :href="c.links.wa.url" class="btn">
          <i class="fa-brands fa-whatsapp mr-2 text-lg"></i>
          {{ $t("rental.order_now") }}
        </a>
        <Link :href="route('sewa-mobil.show', r)" class="link py-3"
          >Detail</Link
        >
      </div>
    </div>

    <slot></slot>
  </div>
</template>