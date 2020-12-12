<template>
  <div class="flex items-center justify-center mt-4 work-sans">
    <div>
      <div class="relative z-0 inline-flex shadow-sm">
        <inertia-link
            class="link--pagination first:bg-red -ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-700 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary"
            v-for="(item, index) in pagination" :key="index" :href="item.url ? item.url : '#'" v-html="item.label">
        </inertia-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Pagination",
  components: {},
  props: ['pagination'],
  data() {
    return {}
  }
}
</script>

<style scoped lang="scss">
.link--pagination {
  &:first-child {
    border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
  }

  &:last-child {
    border-bottom-right-radius: 5px;
    border-top-right-radius: 5px;
  }
}

</style>