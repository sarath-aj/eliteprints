<template>
  <div class="card">
    <div class="card-header">
      <h3>Account information</h3>
    </div>
    <div class="card-body">
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label for="name">Full Name:</label>
          <input
            id="name"
            v-model="form.name"
            type="text"
            class="form-control"
            @keydown="form.errors.clear('name')"
          />
          <span
            v-if="!$v.form.name.required && $v.form.name.$dirty"
            class="text-danger"
            >The name field is required</span
          >
          <span
            v-else-if="!$v.form.name.maxLength && $v.form.name.$dirty"
            class="text-danger"
            >The name must not be more than 60 characters.</span
          >
          <span
            v-else-if="!$v.form.name.minLength && $v.form.name.$dirty"
            class="text-danger"
            >The name must be at least 2 characters.</span
          >

          <span
            v-if="form.errors.has('name')"
            class="text-danger"
            v-text="form.errors.get('name')"
          />
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input
            id="email"
            type="text"
            class="form-control"
            disabled="disabled"
            :value="form.email"
          />
        </div>

        <div class="form-group">
          <label for="mobile">Mobile</label>
          <input
            id="mobile"
            v-model="form.mobile"
            type="number"
            class="form-control"
            placeholder="123456789"
            @keydown="form.errors.clear('mobile')"
          />
          <span
            v-if="!$v.form.mobile.required && $v.form.mobile.$dirty"
            class="text-danger"
            >The mobile number field is required</span
          >
          <span
            v-else-if="!$v.form.mobile.maxLength && $v.form.mobile.$dirty"
            class="text-danger"
            >The mobile number must not be more than 20 digits.</span
          >
          <span
            v-else-if="!$v.form.mobile.minLength && $v.form.mobile.$dirty"
            class="text-danger"
            >The mobile number must be at least 10 digits.</span
          >
          <span
            v-else-if="
              !$v.form.mobile.validatePostalCode && $v.form.mobile.$dirty
            "
            class="text-danger"
            >The mobile number cannot contain alphabets</span
          >
          <span
            v-if="form.errors.has('mobile')"
            class="text-danger"
            v-text="form.errors.get('mobile')"
          />
        </div>

        <div class="form-group text-center">
          <button type="submit" class="btn btn-fill-out btn-sm">Update</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { required, maxLength, minLength } from 'vuelidate/lib/validators';
import Form from '@/static/js/Form.js';
function validatePostalCode(value) {
  // eslint-disable-next-line no-useless-escape
  return /^([0-9\s\-\+\(\)]*)$/.test(value);
}
export default {
  layout: 'customer',
  middleware: 'auth',
  data() {
    return {
      title: 'Edit Account',
      form: new Form({
        name: this.$auth.user.name,
        email: this.$auth.user.email,
        mobile: this.$auth.user.mobile,
      }),
    };
  },

  validations: {
    form: {
      name: {
        required,
        maxLength: maxLength(60),
        minLength: minLength(2),
      },
      mobile: {
        required,
        maxLength: maxLength(20),
        minLength: minLength(10),
        validatePostalCode,
      },
    },
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
  methods: {
    async submitForm() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
        try {
          const self = this;
          await this.$axios
            .post('customer/edit-account', this.form)
            .then(function (response) {
              if (response.data.data.message === 'success') {
                toastr.options = {
                  positionClass: 'toast-top-right',
                };
                toastr.success('Account Updated Successfully');
                self.$v.$reset();
              }
            });
        } catch (error) {
          if (error.response.status === 422) {
            this.form.errors.record(error.response.data);
          }
        }
      }
    },
  },
};
</script>
