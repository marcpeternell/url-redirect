<template>
  <tr>
    <table-cell>#{{ item.id }}</table-cell>
    <table-cell>
      <div>
        {{ item.tag }}
      </div>
    </table-cell>
    <table-cell>
      <div v-if="!this.showEditForm">
        <a class="underline" :href="item.redirect_url" target="_blank">{{ item.redirect_url }} <i class="ml-1 fas fa-external-link-alt"></i></a>
      </div>
      <div v-else class="redirect-url">
        <jet-input id="redirect_url" type="text" class="mt-1 block w-full" v-model="form.redirect_url" ref="tag"/>
        <jet-input-error :message="form.error('redirect_url')" class="mt-2"/>
      </div>
    </table-cell>
    <table-cell>
      <div v-if="!this.showEditForm">
        <tag-status :status="item.active"></tag-status>
      </div>
      <div v-else class="flex justify-center align-center">
        <input-toggle v-model="form.active"></input-toggle>
        <jet-input-error :message="form.error('active')" class="mt-2"/>
      </div>
    </table-cell>
    <table-cell class="text-center">
      <a class="bg-teal-500 hover:bg-teal-600 focus:border-teal-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-teal-900 focus:shadow-outline-teal transition ease-in-out duration-150"
         :href="item.qr_code" download>
        <i class="fas fa-download"></i>
      </a>
      <jet-button v-if="!this.showEditForm"
                  class="border-yellow-500 bg-yellow-500 hover:bg-yellow-600 focus:border-yellow-500"
                  @click.native="editElement()"><i class="far fa-edit"></i>
      </jet-button>
      <jet-button v-else class="border-green-500 bg-green-500 hover:bg-green-600 focus:border-green-500"
                  @click.native="updateElement(form)"><i class="far fa-save"></i>
      </jet-button>
      <jet-button v-if="this.showEditForm"
                  class="border-red-500 bg-red-500 hover:bg-red-600 focus:border-red-500"
                  @click.native="cancelElement"><i class="fas fa-times"></i>
      </jet-button>
      <jet-button v-else class="border-red-500 bg-red-500 hover:bg-red-600 focus:border-red-500"
                  @click.native="deleteElement(item)"><i class="far fa-trash-alt"></i>
      </jet-button>
    </table-cell>
  </tr>
</template>
<script>

import TableCell from "./TableCell";
import TagStatus from "./TagStatus";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import InputToggle from "@/Components/InputToggle"

export default {
  name: "TableRow",
  props: ['item'],
  components: {
    TableCell,
    TagStatus,
    JetButton,
    JetInput,
    JetInputError,
    InputToggle
  },
  data() {
    return {
      showEditForm: false,
      form: this.$inertia.form({
        id: this.item.id,
        redirect_url: '',
        active: ''
      })
    }
  },
  methods: {
    updateElement: function (data) {
      this.form.put('/url/' + data.id, data, {
        preserveScroll: true,
      }).then(() => {
        if (!this.form.error('active') && !this.form.error('redirect_url')) {
          this.showEditForm = false;
        }
      })
    },
    deleteElement: function (data) {
      data._method = 'DELETE';
      this.$inertia.post('/url/' + data.id, data)
    },
    editElement: function () {
      this.setForm();
      this.showEditForm = true;
    },
    cancelElement: function () {
      this.showEditForm = false;
      this.setForm();
    },
    setForm: function () {
      this.form.redirect_url = this.item.redirect_url;
      this.form.active = this.item.active;
    }
  }
}
</script>

<style scoped>
.redirect-url {
  min-width: 250px;
}

</style>