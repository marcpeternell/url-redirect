<template>
  <div>
    <div class="overflow-x-auto">

      <div v-if="typeof data !== 'undefined' && data.length > 0"
           class="align-middle inline-block min-w-full overflow-hidden bg-white px-8 pt-3 rounded-bl-lg rounded-br-lg">
        <table class="min-w-full">
          <thead>
          <table-head></table-head>
          </thead>
          <tbody class="bg-white">
          <table-row v-for="item in data" :key="item.id" :item="item" :id="item.id" :tag="item.tag"
                     :destination="item.destination" :status="item.active"></table-row>
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
    data: Array
  },
  data() {
    return {}
  },
  methods: {}
}
</script>