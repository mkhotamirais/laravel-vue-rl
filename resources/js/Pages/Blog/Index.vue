<script setup>
import SessMsg from "@/Components/SessMsg.vue";
import { smartTrim, diffForHumans } from "@/functions";
import { router, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const params = route().params;

defineProps({
  blogs: Object,
  blogcats: Object,
  msg: String,
});

const page = usePage();
const user = computed(() => page.props.auth.user);

const deleteBlog = (b) => {
  if (confirm("Apakah anda yakin?")) {
    router.delete(route("blog.destroy", b));
  }
};

const filterCategory = (c) => {
  router.get(route("blog.index"), { blogcat: c });
};
</script>

<template>
  <Head>
    <title>{{ $t("blog.title") }}</title>
    <meta
      head-key="description"
      name="description"
      :content="$t('blog.subtitle')"
    />
  </Head>
  <section class="bg-slate-100">
    <div class="text-center bg-white py-8 px-0 lg:px-24 shadow">
      <div class="container">
        <h1 class="h1 mb-4">{{ $t("blog.title") }}</h1>
        <p class="text-gray-500">{{ $t("blog.subtitle") }}</p>
      </div>
    </div>
    <div class="container py-6">
      <div v-show="user && user.role === 'admin'" class="my-4">
        <Link :href="route('blog.create')" class="btn w-fit">Tambah Blog</Link>
        <SessMsg :msg="msg" />
      </div>
      <div class="flex flex-col md:flex-row gap-4 items-start">
        <!-- Cards -->
        <div v-if="blogs.data.length" class="w-full">
          <template v-for="(b, i) in blogs.data" :key="i">
            <div
              class="shadow w-full mb-4 grid grid-cols-1 md:grid-cols-3 bg-white rounded-lg overflow-hidden"
            >
              <Link :href="route('blog.show', b)" class="block w-full h-full">
                <img
                  :src="`/storage/${b.banner}`"
                  alt=""
                  width="200"
                  height="200"
                  class="col-span-1 w-full h-56 md:h-full lg:h-56 object-cover object-center"
                />
              </Link>
              <div class="col-span-2 p-4 flex flex-col">
                <Link :href="route('blog.show', b)" class="hover:underline">
                  <h3 class="h3 mb-2">{{ smartTrim(b.title, 40) }}</h3>
                </Link>
                <div class="flex gap-2 items-center capitalize">
                  <!-- <span class="badge">{{ b.blogcat.name }}</span> -->
                  <span>·</span>
                  <span
                    v-for="(tag, index) in b.tags
                      ?.split(',')
                      .map((t) => t.trim())"
                    :key="index"
                    class="badge bg-primary/10"
                  >
                    {{ tag }}
                  </span>
                </div>
                <p
                  v-html="smartTrim(b.content, 160)"
                  class="text-content text-sm"
                ></p>
                <p class="text-xs mt-4 md:mt-auto text-gray-500">
                  {{ diffForHumans(b.created_at) }}
                </p>
              </div>
              <div v-show="user && user.role === 'admin'" class="p-2">
                <Link :href="route('blog.edit', b)" class="link mr-4"
                  >edit</Link
                >
                <button
                  type="button"
                  @click="deleteBlog(b)"
                  class="link !text-danger"
                >
                  delete
                </button>
              </div>
            </div>
          </template>
        </div>
        <div v-else class="w-full bg-white p-4 rounded-lg shadow-md">
          <p>Data tidak ditemukan</p>
        </div>
        <!-- Asides -->
        <div
          class="sticky top-20 w-full bg-white p-4 rounded-lg mb-4 shadow md:w-80"
        >
          <h2 class="h2 mb-4">Category</h2>
          <template v-for="(h, i) in blogcats" :key="i">
            <button
              type="button"
              @click="filterCategory(h.slug)"
              class="block w-full text-left text-sm py-2 px-3 bg-primary/5 mb-1 rounded-lg hover:bg-primary/10 capitalize"
              :class="h.slug === params.blogcat ? '!bg-primary/20' : ''"
            >
              {{ h.name }}
            </button>
          </template>
        </div>
      </div>
    </div>
  </section>
</template>