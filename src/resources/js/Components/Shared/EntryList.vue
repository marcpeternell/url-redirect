<template>
  <table class="w-full">
    <table-head></table-head>
    <tr>
      <table-cell>
        <div>
          {{ url.tag }}
        </div>
      </table-cell>
      <table-cell>
        <div v-if="!this.showEditForm" class="table--url">
          <a class="underline" :href="url.destination" target="_blank">
            {{ limitStr(url.destination, 40) }} <i class="ml-1 fas fa-external-link-alt"></i>
          </a>
        </div>
        <div v-else class="redirect-url">
          <jet-input id="destination" type="text" class="mt-1 block w-full" v-model="form.destination" ref="tag"/>
          <jet-input-error :message="form.error('destination')" class="mt-2"/>
        </div>
      </table-cell>
      <table-cell>
        <div v-if="!this.showEditForm">
          <tag-status :status="url.active"></tag-status>
        </div>
        <div v-else class="flex justify-center align-center">
          <input-toggle v-model="form.active"></input-toggle>
          <jet-input-error :message="form.error('active')" class="mt-2"/>
        </div>
      </table-cell>
      <table-cell>
        <div class="text-center">
          {{ url.visits }}
        </div>
      </table-cell>
      <table-cell class="text-center">
        <a class="mx-1 py-4 bg-teal-500 hover:bg-teal-600 focus:border-teal-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-teal-900 focus:shadow-outline-teal transition ease-in-out duration-150"
           :href="url.qr_code" download>
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
      </table-cell>
    </tr>
  </table>
</template>

<script>
import TableHead from "../../Components/TableHead";
import TableRow from "../../Components/TableRow";
import TableCell from "../../Components/TableCell";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import InputToggle from "@/Components/InputToggle"
import JetButton from "@/Jetstream/Button";
import TagStatus from "../../Components/TagStatus";

export default {
  name: "EntryList",
  components: {
    TagStatus,
    TableCell,
    TableRow,
    TableHead,
    JetButton,
    JetInput,
    JetInputError,
    InputToggle,
  },

  props: {
    url: Object
  },

  data() {
    return {
      showEditForm: false,
      form: this.$inertia.form({
        id: this.url.id,
        destination: '',
        active: ''
      }),
    }
  },

  methods: {
    limitStr: function (string, limit) {
      let str = string;

      if (typeof str === 'string' && str.length > limit) {
        str = str.slice(0, limit) + '...'
      }

      return str;
    },
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
      this.form.destination = this.url.destination;
      this.form.active = this.url.active;
    },
  }
}
</script>

<style scoped>

</style>