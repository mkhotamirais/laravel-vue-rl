<script setup>
defineProps({
  position: {
    type: String,
    default: "top-right",
    validator: (value) => {
      return ["top-right", "top-left", "bottom-right", "bottom-left"].includes(
        value
      );
    },
  },
});
</script>

<template>
  <div
    class="absolute h-full bg-primary/5 w-full rounded-full"
    :class="{
      'top-0 right-0 translate-x-1/2 -translate-y-1/2':
        position === 'top-right',
      'left-0 top-0 -translate-x-1/2 -translate-y-1/2': position === 'top-left',
      'bottom-0 right-0 translate-y-1/2 translate-x-1/2':
        position === 'bottom-right',
      'bottom-0 left-0 translate-y-1/2 -translate-x-1/2':
        position === 'bottom-left',
    }"
  ></div>
</template>