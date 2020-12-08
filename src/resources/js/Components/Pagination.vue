<template>
  <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between mt-4 work-sans">
    <div>
      <nav class="relative z-0 inline-flex shadow-sm">
        <pagination-prev></pagination-prev>
        <div>
          <pagination-link>1</pagination-link>
          <pagination-link>2</pagination-link>
          <pagination-link>3</pagination-link>
        </div>
        <pagination-next></pagination-next>
      </nav>
    </div>
  </div>
</template>

<script>
import PaginationLink from "./PaginationLink";
import PaginationPrev from "./PaginationPrev";
import PaginationNext from "./PaginationNext";
export default {
name: "Pagination",
  components: {
    PaginationLink,
    PaginationPrev,
    PaginationNext
  },
}
</script>

<style scoped>

</style>