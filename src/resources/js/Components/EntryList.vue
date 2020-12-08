<template>
  <div>
    <div class="overflow-x-auto" v-if="data.length > 0">
      <table-search-bar></table-search-bar>
      <div class="align-middle inline-block min-w-full overflow-hidden bg-white px-8 pt-3 rounded-bl-lg rounded-br-lg">
        <table class="min-w-full">
          <thead>
          <table-head></table-head>
          </thead>
          <tbody class="bg-white">
          <table-row v-for="item in data" :key="item.id" :id="item.id" :tag="item.tag"
                     :redirect_url="item.redirect_url" :status="item.active"></table-row>
          </tbody>
        </table>
      </div>
    </div>
    <nothing-here></nothing-here>
  </div>

</template>

<script>
import TableRow from "./TableRow";
import TableHead from "./TableHead";
import TagStatus from "./TagStatus";
import TableSearchBar from "./TableSearchBar";
import ModalDeleteEntry from "./ModalDeleteEntry";
import NothingHere from "./NothingHere";

export default {
  name: "EntryList",
  components: {
    TableRow,
    TagStatus,
    TableHead,
    TableSearchBar,
    ModalDeleteEntry,
    NothingHere
  },
  props: {
    data: Array
  },
}
</script>