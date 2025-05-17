<script setup>
import { formatRupiah, smartTrim, diffForHumans } from "@/functions";
import { capitalize } from "vue";

defineProps({ rental: Object, otherRentals: Object, latestBlogs: Object });
</script>

<template>
  <Head :title="`Sewa Mobil ${smartTrim(capitalize(rental.name))}`" />
  <section class="bg-slate-100 min-h-72">
    <div class="container">
      <div class="flex flex-col md:flex-row gap-0 md:gap-4 place-items-start">
        <article
          class="bg-white p-4 md:p-6 lg:p-8 my-4 lg:my-6 rounded-lg w-full space-y-4"
        >
          <div class="space-y-2">
            <h1 class="h1">{{ rental.name }}</h1>
            <p class="border-l-2 border-primary pl-2 capitalize text-gray-600">
              {{ rental.category.replace("_", " ") }}
            </p>
            <p class="text-2xl text-primary font-semibold">
              {{ formatRupiah(rental.price) }}
            </p>

            <a href="#detailRental" class="btn w-fit">Lihat Detail</a>
          </div>
          <img
            :src="`/storage/${rental.banner}`"
            alt=""
            class="rounded-md w-full"
            width="500"
            height="500"
          />
          <div id="detailRental" class="scroll-mt-20">
            <div>
              <h2 class="text-lg font-semibold">{{ $t("rental.term") }}</h2>
              <p v-html="rental.policy" class="text-content"></p>
            </div>
            <div>
              <h2 class="text-lg font-semibold">{{ $t("rental.info") }}</h2>
              <p v-html="rental.information" class="text-content"></p>
            </div>
            <a href="#" class="btn w-fit mt-6 !py-4 !px-6 !rounded-full">
              <i class="fa-brands fa-whatsapp text-xl mr-2"></i>
              {{ $t("rental.order_now") }}</a
            >
          </div>
        </article>
        <div class="w-full md:w-120 sticky top-20 my-6">
          <div class="bg-white p-4 rounded-lg mb-4">
            <h2 class="h2 mb-4">{{ $t("rental.other_rentals") }}</h2>
            <template v-for="(or, i) in otherRentals" :key="i">
              <Link
                :href="route('sewa-mobil.show', or)"
                class="group shadow hover:shadow-md flex rounded gap-2 overflow-hidden mb-2"
              >
                <img
                  :src="`/storage/${or.banner}`"
                  alt=""
                  width="100"
                  height="100"
                  class="h-full w-28 object-cover object-center"
                />
                <div class="col-span-1 md:col-span-2 space-y-2 md:space-y-1">
                  <h3
                    class="group-hover:underline text-base font-medium capitalize"
                  >
                    {{ or.name }}
                  </h3>
                  <p class="badge">{{ or.category.replace("_", " ") }}</p>
                  <p class="text-lg font-medium">
                    {{ formatRupiah(or.price) }}
                  </p>
                </div>
              </Link>
            </template>
          </div>
          <div class="bg-white p-4 rounded-lg">
            <h2 class="h2 mb-4">{{ $t("blog.latest_blogs") }}</h2>
            <template v-for="(b, i) in latestBlogs" :key="i">
              <Link
                :href="route('blog.show', b)"
                class="group shadow hover:shadow-md flex rounded gap-2 overflow-hidden mb-2"
              >
                <img
                  :src="`/storage/${b.banner}`"
                  alt=""
                  width="100"
                  height="100"
                  class="h-22 w-24 object-cover object-center"
                />
                <div class="space-y-2">
                  <h3
                    class="group-hover:underline text-sm font-medium first-letter:capitalize"
                  >
                    {{ smartTrim(b.title, 40) }}
                  </h3>
                  <p class="text-xs mt-auto">
                    {{ diffForHumans(b.created_at) }}
                  </p>
                </div>
              </Link>
            </template>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>