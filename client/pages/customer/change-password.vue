<template>
  <div class="card">
    <div class="card-header">
      <h3>Change password</h3>
    </div>
    <div class="card-body">
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label for="old_password">Current password:</label>
          <input
            id="old_password"
            v-model="form.password"
            type="password"
            class="form-control"
            placeholder="Current Password"
            @keydown="form.errors.clear('password')"
          />
          <span
            v-if="!$v.form.password.required && $v.form.password.$dirty"
            class="text-danger"
            >The password field is required.</span
          >
          <span
            v-if="form.errors.has('password')"
            class="text-danger"
            v-text="form.errors.get('password')"
          />
        </div>
        <div class="form-group">
          <label for="new_password">New password:</label>
          <input
            id="new_password"
            v-model="form.new_password"
            type="password"
            class="form-control"
            placeholder="New Password"
            @keydown="form.errors.clear('new_password')"
          />
          <span
            v-if="!$v.form.new_password.required && $v.form.new_password.$dirty"
            class="text-danger"
            >The new password field is required.</span
          >
          <span
            v-else-if="
              !$v.form.new_password.minLength && $v.form.new_password.$dirty
            "
            class="text-danger"
            >The password length should be atleast 6 characters.</span
          >
          <span
            v-if="form.errors.has('new_password')"
            class="text-danger"
            v-text="form.errors.get('new_password')"
          />
        </div>
        <div class="form-group">
          <label for="new_password_confirmation">Password confirmation:</label>
          <input
            id="new_password_confirmation"
            v-model="form.new_password_confirmation"
            type="password"
            class="form-control"
            placeholder="Password Confirmation"
            @keydown="form.errors.clear('new_password_confirmation')"
          />
          <span
            v-if="
              !$v.form.new_password_confirmation.required &&
              $v.form.new_password_confirmation.$dirty
            "
            class="text-danger"
            >The new password confirmation field is required.</span
          >

          <span
            v-else-if="
              !$v.form.new_password_confirmation.sameAsPassword &&
              $v.form.new_password_confirmation.$dirty
            "
            class="text-danger"
            >The password should match.</span
          >
          <span
            v-if="form.errors.has('new_password_confirmation')"
            class="text-danger"
            v-text="form.errors.get('new_password_confirmation')"
          />
        </div>
        <div class="form-group text-center">
          <button type="submit" class="btn btn-fill-out btn-sm">
            Change password
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { required, minLength, sameAs } from 'vuelidate/lib/validators';
import Form from '@/static/js/Form.js';

export default {
  layout: 'customer',
  middleware: 'auth',
  data() {
    return {
      title: 'Change Password',
      form: new Form({
        password: '',
        new_password: '',
        new_password_confirmation: '',
      }),
    };
  },

  validations: {
    form: {
      password: {
        required,
      },
      new_password: {
        required,
        minLength: minLength(6),
      },
      new_password_confirmation: {
        required,
        sameAsPassword: sameAs('new_password'),
      },
    },
  },

  methods: {
    async submitForm() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
        try {
          const response = await this.$axios.$post(
            'customer/change-password',
            this.form
          );
          if (response.data.message === 'success') {
            toastr.options = {
              positionClass: 'toast-top-right',
            };
            toastr.success('Password Changed Successfully');
          }
          this.$v.$reset();
          this.form.reset();
        } catch (error) {
          if (error.response.status === 422) {
            this.form.errors.record(error.response.data);
          }
        }
      }
    },
    head() {
      return {
        title: this.title,
        meta: [
          {
            hid: 'robots',
            name: 'robots',
            content: 'noindex,nofollow',
          },
        ],
      };
    },
  },
};
</script>
