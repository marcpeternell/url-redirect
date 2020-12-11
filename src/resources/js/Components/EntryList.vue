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
          <table-row v-for="item in data" :key="item.id" :item="item" :id="item.id" :tag="item.tag"
                     :redirect_url="item.redirect_url" :status="item.active"></table-row>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</template>

<script>
import TableRow from "./TableRow";
import TableHead from "./TableHead";
import TagStatus from "./TagStatus";
import TableSearchBar from "./TableSearchBar";
import ModalDeleteEntry from "./ModalDeleteEntry";
import JetDialogModal from '@/Jetstream/DialogModal';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';
import JetButton from '@/Jetstream/Button';

export default {
  name: "EntryList",
  components: {
    TableRow,
    TagStatus,
    TableHead,
    TableSearchBar,
    ModalDeleteEntry,
  },
  props: {
    data: Array
  },
  data() {
    return {}
  },
  methods: {
  }
}
</script>