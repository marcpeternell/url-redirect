<template>
  <div>
    <span v-if="status === 1"
          class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
        <span class="relative text-xs">active</span>
    </span>
    <span v-if="status === 0" class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
        <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
        <span class="relative text-xs">inactive</span>
    </span>
  </div>
</template>

<script>
export default {
  name: "TagStatus",
  props: ['status']
}
</script>