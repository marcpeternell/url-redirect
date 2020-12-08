<template>
  <jet-confirmation-modal :show="confirmingUserDeletion" @close="confirmingUserDeletion = false">
    <template #title>
      Delete Account
    </template>

    <template #content>
      Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be
      permanently deleted.
    </template>

    <template #footer>
      <jet-secondary-button @click.native="confirmingUserDeletion = false">
        Nevermind
      </jet-secondary-button>

      <jet-danger-button class="ml-2" @click.native="deleteEntry" :class="{ 'opacity-25': form.processing }"
                         :disabled="form.processing">
        Delete Account
      </jet-danger-button>
    </template>
  </jet-confirmation-modal>
</template>

<script>
import JetConfirmationModal from '@/Jetstream/ConfirmationModal';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';
import JetDangerButton from '@/Jetstream/DangerButton';

export default {
  name: "ModelDeleteEntry",
  components: {
    JetConfirmationModal,
    JetSecondaryButton,
    JetDangerButton
  },

  props: ['id'],

  data() {
    return {
      form: this.$inertia.form({
        name: this.name,
        email: this.email,
      }, {
        bag: 'updateProfileInformation',
        resetOnSuccess: true,
      }),
    }
  },
  methods: {
    deleteEntry() {

    }
  }
}
</script>