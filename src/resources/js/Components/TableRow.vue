<template>
  <tr>
    <table-cell>#{{ id }}</table-cell>
    <table-cell>
      <div v-if="!this.showEditForm">
        {{ form.tag }}
      </div>
      <div v-else>
        <jet-input id="tag" type="text" class="mt-1 block w-full" v-model="form.tag" ref="tag"/>
        <jet-input-error :message="$page.errors.tag ? $page.errors.tag[0]: null"></jet-input-error>
      </div>
    </table-cell>
    <table-cell>
      <div v-if="!this.showEditForm">
        {{ form.redirect_url }}
      </div>
      <div v-else>
        <jet-input id="redirect_url" type="text" class="mt-1 block w-full" v-model="form.redirect_url" ref="tag"/>
        <jet-input-error :message="$page.errors.redirect_url ? $page.errors.redirect_url[0]: null"></jet-input-error>
      </div>
    </table-cell>
    <table-cell>
      <div v-if="!this.showEditForm">
        <tag-status :status="status"></tag-status>
      </div>
      <div v-else>

      </div>
    </table-cell>
    <table-cell class="text-center">
      <jet-button class="border-teal-500 bg-teal-500 hover:bg-teal-600 focus:border-teal-500">QR Code</jet-button>
      <jet-button v-if="!this.showEditForm" class="border-yellow-500 bg-yellow-500 hover:bg-yellow-600 focus:border-yellow-500" @click.native="editElement(id)">Edit</jet-button>
      <jet-button v-else class="border-green-500 bg-green-500 hover:bg-green-600 focus:border-green-500" @click.native="updateElement(form)">Update</jet-button>
      <jet-button class="border-red-500 bg-red-500 hover:bg-red-600 focus:border-red-500" @click.native="deleteElement(id)">Delete</jet-button>
    </table-cell>
  </tr>
</template>
<script>

import TableCell from "./TableCell";
import TagStatus from "./TagStatus";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";

export default {
  name: "TableRow",
  props: ['id', 'tag', 'redirect_url', 'status'],
  components: {
    TableCell,
    TagStatus,
    JetButton,
    JetInput,
    JetInputError
  },
  data(){
    return {
      showEditForm: false,
      form: this.$inertia.form({
        tag: this.tag,
        redirect_url: this.redirect_url,
      })
    }
  },
  methods: {
    updateElement: function (data) {
      this.form.put('/redirect/' + data.id, data, {
        preserveScroll: true,
        onSuccess: () => {
          this.showEditForm = false;
        },
      })
    },
    deleteElement: function (data) {
    },
    editElement: function (data) {
      this.showEditForm = true;
    },
  }
}
</script>