<template>
  <tr>
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
      <jet-button v-if="this.showEditForm"
                  class="mx-1 py-4 border-green-500 bg-green-500 hover:bg-green-600 focus:border-green-500"
                  @click.native="updateElement(form)"><i class="far fa-save"></i>
      </jet-button>
      <jet-button v-else class="mx-1 py-4 border-red-500 bg-red-500 hover:bg-red-600 focus:border-red-500"
                  @click.native="confirmEntryDeletion(form)"><i class="far fa-trash-alt"></i>
      </jet-button>
      <jet-button class="mx-1 py-4 border-green-500 bg-green-500 hover:bg-green-600 focus:border-green-500"
                  @click.native="shareEntry(entry.id)"><i class="far fa-share-square"></i>
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
  props: ['entry'],
  components: {
    TableCell,
    TagStatus,
    JetButton,
    JetInput,
    JetInputError,
    InputToggle,

  },
  data() {
    return {
      showEditForm: false,
      form: this.$inertia.form({
        id: this.entry.id,
        destination: '',
        active: ''
      }),
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
    },
    confirmEntryDeletion() {
      this.$emit('confirmEntryDeletion', this.form);
    },
    shareEntry(entryId) {
      const sharedUrl = location.protocol + '//' + location.hostname + (location.port ? ':' + location.port : '') + '/shared/' + entryId
      this.copyTextToClipboard(sharedUrl);
    },

    fallbackCopyTextToClipboard(text) {
      let textArea = document.createElement("textarea");
      textArea.value = text;

      // Avoid scrolling to bottom
      textArea.style.top = "0";
      textArea.style.left = "0";
      textArea.style.position = "fixed";

      document.body.appendChild(textArea);
      textArea.focus();
      textArea.select();

      try {
        let successful = document.execCommand('copy');
        let msg = successful ? 'erfolgreich' : 'nicht erfolgreich';
        this.$swal({
          icon: 'success',
          title: 'Link wurde ' + msg + ' Zwischenablage hinzugefügt',
          text: 'Link: ' + text,
        })
      } catch (err) {
        this.$swal({
          icon: 'success',
          title: 'Link wurde ' + msg + ' Zwischenablage hinzugefügt',
          text: err,
        })
      }

      document.body.removeChild(textArea);
    },

    copyTextToClipboard(text) {
      if (!navigator.clipboard) {
        this.fallbackCopyTextToClipboard(text);
        return;
      }
      navigator.clipboard.writeText(text).then(() => {
        this.$swal({
          icon: 'success',
          title: 'Link zur Zwischenablage hinzugefügt',
          text: 'Link: ' + text,
        })
      }, (err) => {
        this.$swal({
          icon: 'success',
          title: 'Leider ist ein Fehler aufgetreten',
          text: err,
        })
      });
    },



  },
  computed: {}
}
</script>

<style scoped>
.redirect-url {
  min-width: 250px;
}

</style>