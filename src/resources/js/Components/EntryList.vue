<template>
  <div class="overflow-x-auto">
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
      <pagination></pagination>
    </div>
  </div>
</template>

<script>
import TableRow from "./TableRow";
import TableHead from "./TableHead";
import TagStatus from "./TagStatus";
import Pagination from "./Pagination";
import TableSearchBar from "./TableSearchBar";
import ModalDeleteEntry from "./ModalDeleteEntry";

export default {
  name: "EntryList",
  components: {
    TableRow,
    TagStatus,
    TableHead,
    Pagination,
    TableSearchBar,
    ModalDeleteEntry
  },
  props: {
    data: Array
  },
}
</script>