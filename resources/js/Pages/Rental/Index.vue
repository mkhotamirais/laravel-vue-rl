<script setup>
import CardRental from "@/Components/CardRental.vue";
import SessMsg from "@/Components/SessMsg.vue";
import PaginationInput from "@/Components/PaginationInput.vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({ rentals: Object, msg: String });

const params = route().params;
const page = usePage();
const user = computed(() => page.props.auth.user);

const deleteRental = (id) => {
  if (confirm("Apakah anda yakin?")) {
    router.delete(route("sewa-mobil.destroy", id));
  }
};

const categories = [
  { name: "All", slug: "" },
  { name: "Lepas Kunci", slug: "lepas_kunci" },
  { name: "Include Driver", slug: "include_driver" },
];

const chooseCategory = (cat) => {
  router.get(route("sewa-mobil.index", { rentalcat: cat }));
};
</script>

<template>
  <Head title="Sewa Mobil Lombok" />
  <section class="bg-slate-100 flex-1">
    <div class="text-center bg-white py-8 px-3 shadow">
      <div class="container">
        <h1 class="h1 mb-4">{{ $t("rental.title") }}</h1>
        <p class="text-gray-500">{{ $t("rental.subtitle") }}</p>
        <div class="mt-4 flex gap-2 justify-center">
          <button
            v-for="(c, i) in categories"
            :key="i"
            @click="chooseCategory(c.slug)"
            class="py-2 text-sm px-3 rounded-lg bg-primary/5 hover:bg-primary/10 transition-all"
            :class="params.rentalcat === c.slug ? 'bg-primary/20' : ''"
          >
            {{ c.name }}
          </button>
        </div>
      </div>
    </div>
    <div class="container py-4">
      <div v-show="user && user.role === 'admin'" class="my-4">
        <Link :href="route('sewa-mobil.create')" class="btn w-fit"
          >Tambah Mobil</Link
        >
        <SessMsg :msg="msg" />
      </div>
      <div v-if="rentals.data.length">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
          <template v-for="(r, i) in rentals.data" :key="i">
            <CardRental :r="r" :user="user">
              <div
                v-show="user && user.role === 'admin'"
                class="relative z-20 px-4 pb-4 flex gap-4"
              >
                <Link :href="route('sewa-mobil.edit', r)" class="link"
                  >edit</Link
                >
                <button class="link !text-danger" @click="deleteRental(r)">
                  hapus
                </button>
              </div>
            </CardRental>
          </template>
        </div>
        <div>
          <PaginationInput :paginator="rentals" />
        </div>
      </div>
      <div v-else class="p-4 rounded-lg shado-md bg-white">
        <p>Data tidak ditemukan</p>
      </div>
    </div>
  </section>
</template>