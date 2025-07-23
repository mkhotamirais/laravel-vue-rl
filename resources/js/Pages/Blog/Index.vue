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
  <section>blog</section>
</template>