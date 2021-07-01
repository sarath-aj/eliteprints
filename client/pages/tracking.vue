<template>
  <div class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8 col-12">
          <form class="tracking-form" @submit.prevent="submitForm">
            <div class="text-center">
              <h3>Order tracking</h3>
              <p>Track your order status</p>
            </div>
            <div class="form__content">
              <div class="form-group">
                <label for="txt-order-id">Order ID<sup>*</sup></label>
                <input
                  v-model="form.orderId"
                  class="form-control"
                  type="text"
                  placeholder="Order ID"
                />
              </div>
              <span
                v-if="!$v.form.orderId.required && $v.form.orderId.$dirty"
                class="text-danger"
                >The Order ID field is required</span
              >
              <span
                v-else-if="!$v.form.orderId.numeric && $v.form.orderId.$dirty"
                class="text-danger"
                >The Order ID must be numeric</span
              >
              <span
                v-if="form.errors.has('orderId')"
                class="text-danger"
                v-text="form.errors.get('orderId')"
              />
              <div class="form-group">
                <label for="txt-email">Email Address<sup>*</sup></label>
                <input
                  v-model="form.email"
                  class="form-control"
                  type="text"
                  placeholder="Your Email"
                />
              </div>
              <span
                v-if="!$v.form.email.required && $v.form.email.$dirty"
                class="text-danger"
                >The email field is required</span
              >
              <span
                v-else-if="!$v.form.email.email && $v.form.email.$dirty"
                class="text-danger"
                >You should enter a valid email</span
              >
              <span
                v-if="form.errors.has('email')"
                class="text-danger"
                v-text="form.errors.get('email')"
              />
              <div class="form__actions">
                <button type="submit" class="btn btn-fill-out btn-block">
                  Find
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <p class="mt-4 text-center text-info">
      {{ message }}
    </p>
  </div>
</template>

<script>
import { required, numeric, email } from 'vuelidate/lib/validators';
import Form from '@/static/js/Form.js';

export default {
  data() {
    return {
      title: 'Track Your Order Status',
      message: '',
      form: new Form({
        orderId: null,
        email: null,
      }),
    };
  },
  validations: {
    form: {
      orderId: {
        required,
        numeric,
      },
      email: {
        required,
        email,
      },
    },
  },
  head() {
    return {
      title: this.title,
    };
  },

  methods: {
    async submitForm() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
        try {
          const self = this;
          await this.$axios
            .post('track-order', this.form)
            .then(function (response) {
              if (response.status === 200) {
                self.message = response.data.data.status;
                self.$v.$reset();
                self.form.reset();
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

<style>
.tracking-form {
  padding: 30px;
  background-color: #f7f7f7;
  max-width: 500px;
  margin: 15px auto 50px;
}
</style>
