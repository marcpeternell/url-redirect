<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tag: {{ url.tag }}
      </h2>
    </template>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-12">
      <div
          class="bg-white overflow-x-auto shadow-xl sm:rounded-lg bg-white shadow-xl sm:rounded-lg sm:px-20 sm:py-10 bg-white border-b border-gray-200">
          <entry-list :url="url"></entry-list>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout";
import EntryList from "../Components/Shared/EntryList";


export default {
  name: "SharedDashboard",
  components: {
    EntryList,
    AppLayout,
  },
  props: {
    url: Object
  },
}
</script>