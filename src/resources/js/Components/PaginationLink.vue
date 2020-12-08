<template>
  <a :href="link"
     class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-700 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary">
    <slot></slot>
  </a>
</template>

<script>
export default {
name: "PaginationLink",
props: ['link']
}
</script>

<style scoped>

</style>