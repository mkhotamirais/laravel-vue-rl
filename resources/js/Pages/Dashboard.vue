<script setup></script>

<template>
  <section class="bg-slate-100 py-12">
    <div class="container">
      <div class="max-w-md mx-auto p-8 bg-white rounded-lg">
        <h1 class="h1 mb-4">Hi, {{ $page.props.auth.user.name }}</h1>
        <p>
          {{ $t("dashboard_desc") }}
        </p>
      </div>
    </div>
  </section>
</template>