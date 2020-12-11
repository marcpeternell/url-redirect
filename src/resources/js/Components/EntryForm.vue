<template>
  <div class="sm:px-20 bg-white border-b border-gray-200">
    <div class="mb-4 flex flex-col my-2">
      <div class="mt-4">
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="$page.flash.message">
          <div class="flex">
            <div>
              <p class="text-sm">{{ $page.flash.message }}</p>
            </div>
          </div>
        </div>

        <jet-form-section @submitted="save(form)">
          <template #title>
            Add new Entry
          </template>

          <template #form>
            <div class="col-span-1 mb-4 md:mb-0">
              <jet-label for="tag" value="Tag:"/>
              <jet-input id="tag" type="text" class="mt-1 block w-full" v-model="form.tag" ref="tag"/>
              <jet-input-error :message="$page.errors.tag ? $page.errors.tag[0]: null"></jet-input-error>
            </div>

            <div class="col-span-1">
              <jet-label for="redirect_url" value="Redirect To:"/>
              <jet-input id="redirect_url" type="text" class="mt-1 block w-full" v-model="form.redirect_url"
                         ref="redirect_url"/>
              <jet-input-error :message="$page.errors.redirect_url ? $page.errors.redirect_url[0]: null"></jet-input-error>
            </div>
          </template>

          <template #actions>
            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
              <i v-if="form.processing" class="fas fa-spinner fa-spin"></i>
              <i v-else class="fas fa-plus mr-1"></i> Add
            </jet-button>
          </template>
        </jet-form-section>
      </div>
    </div>
  </div>
</template>

<script>
import JetLabel from "../Jetstream/Label";
import JetInput from "../Jetstream/Input";
import JetButton from "../Jetstream/Button";
import JetInputError from "../Jetstream/InputError";
import JetFormSection from "../Jetstream/FormSection";
import JetActionMessage from "../Jetstream/ActionMessage"

export default {
  name: "EntryForm",
  components: {
    JetButton,
    JetInput,
    JetLabel,
    JetInputError,
    JetFormSection,
    JetActionMessage
  },
  props: {
    errors: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        tag: '',
        redirect_url: '',
      })
    }
  },
  methods: {
    reset: function () {
      this.form = {
        tag: null,
        redirect_url: null,
      }
    },
    save: function (data) {
      this.form.post('/url', data).then(()=>{
        this.reset();
      })
    },
  },
}
</script>
