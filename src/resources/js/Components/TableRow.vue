<template>
  <tr>
    <table-cell>#{{ entry.id }}</table-cell>
    <table-cell>
      <div>
        {{ entry.tag }}
      </div>
    </table-cell>
    <table-cell>
      <div v-if="!this.showEditForm" class="table--url">
        <a class="underline" :href="entry.destination" target="_blank">
          {{ limitStr(entry.destination, 40) }} <i class="ml-1 fas fa-external-link-alt"></i>
        </a>
      </div>
      <div v-else class="redirect-url">
        <jet-input id="destination" type="text" class="mt-1 block w-full" v-model="form.destination" ref="tag"/>
        <jet-input-error :message="form.error('destination')" class="mt-2"/>
      </div>
    </table-cell>
    <table-cell>
      <div v-if="!this.showEditForm">
        <tag-status :status="entry.active"></tag-status>
      </div>
      <div v-else class="flex justify-center align-center">
        <input-toggle v-model="form.active"></input-toggle>
        <jet-input-error :message="form.error('active')" class="mt-2"/>
      </div>
    </table-cell>
    <table-cell>
      <div class="text-center">
        {{ entry.visits }}
      </div>
    </table-cell>
    <table-cell class="text-center">
      <a class="mx-1 py-4 bg-teal-500 hover:bg-teal-600 focus:border-teal-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-teal-900 focus:shadow-outline-teal transition ease-in-out duration-150"
         :href="entry.qr_code" download>
        <i class="fas fa-download"></i>
      </a>
      <jet-button v-if="!this.showEditForm"
                  class="mx-1 py-4 border-yellow-500 bg-yellow-500 hover:bg-yellow-600 focus:border-yellow-500"
                  @click.native="editElement()"><i class="far fa-edit"></i>
      </jet-button>
      <jet-button v-else
                  class="mx-1 py-4 border-red-500 bg-red-500 hover:bg-red-600 focus:border-red-500"
                  @click.native="cancelElement"><i class="fas fa-times"></i>
      </jet-button>
      <jet-button v-if="this.showEditForm" class="mx-1 py-4 border-green-500 bg-green-500 hover:bg-green-600 focus:border-green-500"
                  @click.native="updateElement(form)"><i class="far fa-save"></i>
      </jet-button>
      <jet-button v-else class="mx-1 py-4 border-red-500 bg-red-500 hover:bg-red-600 focus:border-red-500"
                  @click.native="confirmEntryDeletion"><i class="far fa-trash-alt"></i>
      </jet-button>
    </table-cell>
    <jet-dialog-modal :show="confirmingEntryDeletion" @close="confirmingEntryDeletion = false">
      <template #title>
        Delete Entry
      </template>

      <template #content>
        Are you sure you want to delete this entry? Once it is deleted, all of its resources and data will be deleted.
      </template>

      <template #footer>
        <jet-secondary-button @click.native="confirmingEntryDeletion = false">
          Nevermind
        </jet-secondary-button>

        <jet-danger-button class="ml-2" @click.native="deleteElement(entry)" :class="{ 'opacity-25': form.processing }"
                           :disabled="form.processing">
          Delete Entry
        </jet-danger-button>
      </template>
    </jet-dialog-modal>
  </tr>
</template>
<script>

import TableCell from "./TableCell";
import TagStatus from "./TagStatus";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import InputToggle from "@/Components/InputToggle"
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetDialogModal from '@/Jetstream/DialogModal'

export default {
  name: "TableRow",
  props: ['entry'],
  components: {
    TableCell,
    TagStatus,
    JetButton,
    JetInput,
    JetInputError,
    InputToggle,
    JetSecondaryButton,
    JetDangerButton,
    JetDialogModal
  },
  data() {
    return {
      showEditForm: false,
      form: this.$inertia.form({
        id: this.entry.id,
        destination: '',
        active: ''
      }),
      confirmingEntryDeletion: false,
    }
  },
  methods: {
    updateElement: function (data) {
      this.form.put('/url/' + data.id, data, {
        preserveScroll: true,
      }).then(() => {
        if (!this.form.error('active') && !this.form.error('destination')) {
          this.showEditForm = false;
        }
      })
    },
    deleteElement: function (data) {
      data._method = 'DELETE';
      this.$inertia.post('/url/' + data.id, data)
    },

    confirmEntryDeletion() {
      this.confirmingEntryDeletion = true;

      setTimeout(() => {
        this.$refs.password.focus()
      }, 250)
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
      this.form.destination = this.entry.destination;
      this.form.active = this.entry.active;
    },
    limitStr: function (string, limit) {
      let str = string;

      if (typeof str === 'string' && str.length > limit) {
        str = str.slice(0, limit) + '...'
      }

      return str;
    }
  },
  computed: {}
}
</script>

<style scoped>
.redirect-url {
  min-width: 250px;
}

</style>