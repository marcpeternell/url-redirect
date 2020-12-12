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
          <table-row v-for="entry in entries" :key="entry.id" :entry="entry"
                     @confirmEntryDeletion="confirmEntryDeletion"></table-row>
          </tbody>
        </table>

        <jet-dialog-modal :show="confirmingEntryDeletion" @close="confirmingEntryDeletion = false">
          <template #title>
            Delete Entry
          </template>

          <template #content>
            Are you sure you want to delete this entry? Once it is deleted, all of its resources and data will be
            deleted.
          </template>

          <template #footer>
            <jet-secondary-button @click.native="confirmingEntryDeletion = false">
              Nevermind
            </jet-secondary-button>

            <jet-danger-button class="ml-2" @click.native="deleteElement(form)"
                               :class="{ 'opacity-25': form.processing }"
                               :disabled="submitForm">
              Delete Entry
            </jet-danger-button>
          </template>
        </jet-dialog-modal>
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
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetDialogModal from '@/Jetstream/DialogModal'

export default {
  name: "EntryList",
  components: {
    TableRow,
    TagStatus,
    TableHead,
    ModalDeleteEntry,
    NothingHere,
    JetSecondaryButton,
    JetDangerButton,
    JetDialogModal
  },
  props: {
    entries: Array
  },
  data() {
    return {
      confirmingEntryDeletion: false,
      form: {},
      submitForm: false
    }
  },
  methods: {
    deleteElement: function (data) {
      this.submitForm = true;
      data._method = 'DELETE';
      this.$inertia.post('/url/' + data.id, data, {
        onSuccess: () => {
          this.submitForm = false;
          this.confirmingEntryDeletion = false;
        },
      })
    },
    confirmEntryDeletion(form) {
      this.form = form
      this.confirmingEntryDeletion = true;
    },
  }
}
</script>