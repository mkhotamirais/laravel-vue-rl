<script setup>
import Input from "@/Components/Input.vue";
import TextareaCke from "@/Components/TextareaCke.vue";
import Select from "@/Components/Select.vue";
import ImageUpload from "@/Components/ImageUpload.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({ blogcats: Object });

const form = useForm({
  title: null,
  blogcat_id: null,
  content: "",
  tags: null,
  banner: null,
});

const page = usePage();
const user = computed(() => page.props.auth.user);

const banner = (e) => (form.banner = e);

const submit = () => {
  form.post(route("blog.store"), {
    onSuccess: () => {
      form.reset();
    },
  });
};
</script>

<template>
  <section class="container py-4">
    <h1 class="h1">Tambah Blog</h1>

    <form @submit.prevent="submit" class="py-4 max-w-lg">
      <ImageUpload @image="(e) => banner(e)" />
      <Input
        label="Title"
        id="title"
        icon="heading"
        placeholder="Judul.."
        v-model="form.title"
        :error="form.errors.title"
      />
      <Select
        label="Information Category"
        id="information-category"
        icon="sitemap"
        v-model="form.blogcat_id"
        :error="form.errors.blogcat_id"
      >
        <option :value="null">Pilih Kategori</option>
        <template v-for="(bc, i) in blogcats" :key="i">
          <option :value="bc.id" class="capitalize">
            {{ bc.name }}
          </option>
        </template>
      </Select>
      <TextareaCke
        label="Content"
        id="info_content"
        v-model="form.content"
        :error="form.errors.content"
      />
      <Input
        label="Tags (pisah dengan koma)"
        id="tags"
        icon="tags"
        placeholder="tag1, tag2, tag3"
        v-model="form.tags"
        :error="form.errors.tags"
      />
      <div class="flex gap-2">
        <button type="submit" class="btn" :disabled="form.processing">
          Tambah
        </button>
        <Link
          :href="route('blog.index')"
          class="btn inline-block !bg-gray-500 hover:!bg-gray-600"
          >Kembali</Link
        >
      </div>
    </form>
  </section>
</template>