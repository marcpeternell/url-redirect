<template>
  <div>
    <div class="overflow-x-auto">
      <div v-if="typeof entries !== 'undefined' && entries.length > 0"
           class="align-middle inline-block min-w-full overflow-hidden bg-white px-8 pt-3 rounded-bl-lg rounded-br-lg">
        <table class="min-w-full">
          <thead>
          <table-head></table-head>
          </thead>
          <tbody class="bg-white">
          <table-row v-for="entry in entries" :key="entry.id" :entry="entry"></table-row>
          </tbody>
        </table>
      </div>
      <nothing-here v-else></nothing-here>
    </div>
  </div>
</template>

<script>
import TableRow from "./TableRow";
import TableHead from "./TableHead";
import TagStatus from "./TagStatus";
import ModalDeleteEntry from "./ModalDeleteEntry";
import NothingHere from "./NothingHere";

export default {
  name: "EntryList",
  components: {
    TableRow,
    TagStatus,
    TableHead,
    ModalDeleteEntry,
    NothingHere
  },
  props: {
    entries: Array
  },
  data() {
    return {}
  },
  methods: {}
}
</script>