<script setup>
import { smartTrim, diffForHumans } from "@/functions";
defineProps({
  blog: Object,
  latestBlogs: Object,
});
</script>

<template>
  <section class="bg-slate-100 min-h-72">
    <div class="container">
      <div class="flex flex-col md:flex-row gap-0 md:gap-4 place-items-start">
        <article
          class="bg-white p-4 md:p-6 lg:p-8 my-4 lg:my-6 rounded-lg w-full space-y-4"
        >
          <h1 class="h1 !mb-2">{{ blog.title }}</h1>
          <p class="text-sm text-gray-500">
            <span class="capitalize">
              {{ blog.blogcat.name }}
            </span>
            |
            <span>
              {{ diffForHumans(blog.created_at) }}
            </span>
          </p>
          <img
            :src="`/storage/${blog.banner}`"
            alt=""
            width="500"
            height="500"
            class="rounded-md w-full"
          />
          <p v-html="blog.content" class="text-content"></p>
        </article>
        <div class="w-full md:w-120 sticky top-20 my-6 bg-white p-4 rounded-lg">
          <h2 class="h2 mb-4">Blog Terbaru</h2>
          <div>
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