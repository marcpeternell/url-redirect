<template>
  <tr>
    <table-head-item>
      <slot>Id</slot>
    </table-head-item>
    <table-head-item>
      <slot>Tag</slot>
    </table-head-item>
    <table-head-item>
      <slot>Destination</slot>
    </table-head-item>
    <table-head-item>
      <slot>Status</slot>
    </table-head-item>
    <table-head-item class="text-center">
      <slot>Visits</slot>
    </table-head-item>
    <table-head-item class="text-center">
      <slot>Actions</slot>
    </table-head-item>
  </tr>
</template>

<script>
import TableHeadItem from "./TableHeadItem";
export default {
name: "TableHead",
  components: {
    TableHeadItem
  }
}
</script>