<script setup>
import Input from "@/Components/Input.vue";
import TextareaCke from "@/Components/TextareaCke.vue";
import ImageUpload from "@/Components/ImageUpload.vue";
import Select from "@/Components/Select.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  rental: Object,
});

const image = (e) => (form.banner = e);

const form = useForm({
  name: props.rental.name,
  price: props.rental.price,
  policy: props.rental.policy,
  information: props.rental.information,
  banner: null,
  category: props.rental.category,
  _method: "PATCH",
});
</script>

<template>
  <Head title="Update Rental" />
  <section class="bg-slate-100 py-4">
    <div class="container">
      <div class="bg-white p-6 rounded-lg shadow-lg max-w-2xl">
        <h1 class="h1">Update</h1>
        <form @submit.prevent="form.post(route('sewa-mobil.update', rental))">
          <ImageUpload @image="(e) => image(e)" :oldBanner="rental.banner" />
          <Input
            label="Name"
            id="name"
            icon="heading"
            placeholder="Brand name"
            v-model="form.name"
            :error="form.errors.name"
          />
          <Input
            label="Price"
            type="number"
            id="price"
            icon="dollar-sign"
            placeholder="Price"
            v-model="form.price"
            :error="form.errors.price"
          />
          <TextareaCke
            label="Policy"
            id="policy"
            v-model="form.policy"
            :error="form.errors.policy"
          />
          <TextareaCke
            label="Information"
            id="information"
            v-model="form.information"
            :error="form.errors.information"
          />
          <Select
            label="Category"
            id="category"
            icon="tag"
            v-model="form.category"
            :error="form.errors.category"
          >
            <option :value="null">--Select Category</option>
            <option value="lepas_kunci">Lepas Kunci</option>
            <option value="include_driver">Include Driver</option>
          </Select>
          <div class="flex items-center gap-1">
            <button type="submit" class="btn" :disabled="form.processing">
              Save
            </button>
            <Link
              :href="route('sewa-mobil.index')"
              type="button"
              class="btn !bg-gray-500"
              >Back</Link
            >
          </div>
        </form>
      </div>
    </div>
  </section>
</template>