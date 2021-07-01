<template>
  <form @submit.prevent="submitForm">
    <h3 class="mb-3">Add a new address</h3>
    <div class="customer-address-payment-form">
      <div class="address-form-wrapper">
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <input
                v-model="form.name"
                type="text"
                placeholder="Full Name"
                class="form-control address-control-item checkout-input"
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
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <input
                v-model="form.address"
                type="text"
                placeholder="Enter your address"
                class="form-control address-control-item checkout-input"
                @keydown="form.errors.clear('address')"
              />
              <span
                v-if="!$v.form.address.required && $v.form.address.$dirty"
                class="text-danger"
                >The address field is required</span
              >
              <span
                v-else-if="!$v.form.address.maxLength && $v.form.address.$dirty"
                class="text-danger"
                >The address must not be more than 120 characters.</span
              >
              <span
                v-if="form.errors.has('address')"
                class="text-danger"
                v-text="form.errors.get('address')"
              />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 col-12">
            <div class="form-group">
              <input
                v-model="form.state"
                type="text"
                placeholder="State"
                class="form-control address-control-item checkout-input"
                @keydown="form.errors.clear('state')"
              />
              <span
                v-if="!$v.form.state.required && $v.form.state.$dirty"
                class="text-danger"
                >The state field is required</span
              >
              <span
                v-else-if="!$v.form.state.maxLength && $v.form.state.$dirty"
                class="text-danger"
                >The state must not be more than 120 characters.</span
              >
              <span
                v-if="form.errors.has('state')"
                class="text-danger"
                v-text="form.errors.get('state')"
              />
            </div>
          </div>
          <div class="col-lg-4 col-12">
            <div class="form-group">
              <input
                v-model="form.city"
                type="text"
                placeholder="City"
                class="form-control address-control-item checkout-input"
                @keydown="form.errors.clear('city')"
              />
              <span
                v-if="!$v.form.city.required && $v.form.city.$dirty"
                class="text-danger"
                >The city field is required</span
              >
              <span
                v-else-if="!$v.form.city.maxLength && $v.form.city.$dirty"
                class="text-danger"
                >The city must not be more than 120 characters.</span
              >
              <span
                v-if="form.errors.has('city')"
                class="text-danger"
                v-text="form.errors.get('city')"
              />
            </div>
          </div>
          <div class="col-lg-4 col-12">
            <div class="form-group">
              <input
                v-model="form.postal_code"
                type="number"
                placeholder="Postal Code"
                class="form-control address-control-item checkout-input"
                @keydown="form.errors.clear('postal_code')"
              />
              <span
                v-if="
                  !$v.form.postal_code.required && $v.form.postal_code.$dirty
                "
                class="text-danger"
                >The postal code field is required</span
              >
              <span
                v-else-if="
                  !$v.form.postal_code.maxLength && $v.form.postal_code.$dirty
                "
                class="text-danger"
                >The postal code must not be more than 10 numbers.</span
              >
              <span
                v-if="form.errors.has('postal_code')"
                class="text-danger"
                v-text="form.errors.get('postal_code')"
              />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <CountryDropdown v-model="form.country_id" />
              <span
                v-if="!$v.form.country_id.required && $v.form.country_id.$dirty"
                class="text-danger"
                >Please select country</span
              >
              <span
                v-if="form.errors.has('country_id')"
                class="text-danger"
                v-text="form.errors.get('country_id')"
              />
            </div>
          </div>
        </div>

        <div v-if="localAddresses.length" class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="is_default">
                <input
                  id="is_default"
                  v-model="form.is_default"
                  class="customer-checkbox"
                  type="checkbox"
                />
                Use this address as default.
              </label>
              <span
                v-if="form.errors.has('is_default')"
                class="text-danger"
                v-text="form.errors.get('is_default')"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="field">
      <p class="control">
        <button class="btn btn-fill-out btn-sm">Add a new address</button>
        <button class="btn btn-dark btn-sm" @click.prevent="$emit('cancel')">
          Cancel
        </button>
      </p>
    </div>
  </form>
</template>

<script>
import { required, minLength, maxLength } from 'vuelidate/lib/validators';
import Form from '@/static/js/Form.js';
import CountryDropdown from '@/components/form/CountryDropdown.vue';

export default {
  components: {
    CountryDropdown,
  },
  layout: 'customer',
  middleware: 'auth',
  props: {
    localAddresses: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      title: 'Create New Address',
      form: new Form({
        name: null,
        address: null,
        city: null,
        state: null,
        postal_code: null,
        country_id: null,
        is_default: 0,
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
      address: {
        required,
        maxLength: maxLength(120),
      },
      state: {
        required,
        maxLength: maxLength(120),
      },
      city: {
        required,
        maxLength: maxLength(120),
      },
      postal_code: {
        required,
        maxLength: maxLength(10),
      },
      country_id: {
        required,
      },
    },
  },
  head() {
    return {
      title: this.title,
    };
  },
  watch: {
    'form.is_default'(val) {
      this.form.is_default = val ? 1 : 0;
    },
    'form.country_id'(val) {
      this.$v.form.country_id.$touch();
      this.form.errors.clear('country_id');
    },
  },
  created() {
    if (!this.localAddresses.length) {
      this.form.is_default = 1;
    }
  },
  methods: {
    async submitForm() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
        try {
          const self = this;
          await this.$axios
            .post('addresses', this.form)
            .then(function (response) {
              if (response.status === 201) {
                toastr.options = {
                  positionClass: 'toast-top-right',
                };
                toastr.success('New Address Added Successfully');
                self.$emit('created', response.data.data);
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
