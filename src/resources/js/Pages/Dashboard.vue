<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <entry-form></entry-form>
      </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div
          class="bg-white overflow-hidden shadow-xl sm:rounded-lg bg-white overflow-hidden shadow-xl sm:rounded-lg sm:px-20 sm:py-10 bg-white border-b border-gray-200">
        <table-search-bar></table-search-bar>
        <entry-list :data="data.data"></entry-list>
        <pagination class="px-8 py-4 justify-center" :data="data"></pagination>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout";
import EntryForm from "../Components/EntryForm";
import EntryList from "../Components/EntryList";
import Pagination from "../Components/Pagination";
import TableSearchBar from "../Components/TableSearchBar";


export default {
  components: {
    AppLayout,
    EntryForm,
    EntryList,
    Pagination,
    TableSearchBar
  },
  props: ['data', 'errors'],
  data() {
    return {
      editMode: false,
      isOpen: false,
      form: {
        title: null,
        body: null,
      },
    }
  },
  methods: {
    openModal: function () {
      this.isOpen = true;
    },
    closeModal: function () {
      this.isOpen = false;
      this.reset();
      this.editMode = false;
    },
    reset: function () {
      this.form = {
        title: null,
        body: null,
      }
    },
    save: function (data) {
      console.log('saving')
      this.$inertia.post('/url', data)
      this.reset();
      this.closeModal();
      this.editMode = false;
    },
    edit: function (data) {
      this.form = Object.assign({}, data);
      this.editMode = true;
      this.openModal();
    },
    update: function (data) {
      data._method = 'PUT';
      this.$inertia.post('/url/' + data.id, data)
      this.reset();
      this.closeModal();
    },
    deleteRow: function (data) {
      if (!confirm('Are you sure want to remove?')) return;
      data._method = 'DELETE';
      this.$inertia.post('/posts/' + data.id, data)
      this.reset();
      this.closeModal();
    }
  }
}
</script>
