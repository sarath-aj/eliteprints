<template>
  <main id="main-container">
    <div class="content">
      <!-- Your Block -->
      <form @submit.prevent="submitForm">
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Site Settings</h3>
          </div>
          <div class="block-content">
            <div class="col-lg-8 col-xl-5">
              <div class="form-group">
                <label for="shopname-text-input">Shop Name</label>
                <input
                  id="shopname-text-input"
                  v-model="settings.shop_name"
                  type="text"
                  class="form-control"
                  placeholder="shop name"
                />
                <span
                  v-if="
                    !$v.settings.shop_name.required &&
                    $v.settings.shop_name.$dirty
                  "
                  class="text-danger"
                  >The shop name field is required</span
                >
                <span
                  v-else-if="
                    !$v.settings.shop_name.maxLength &&
                    $v.settings.shop_name.$dirty
                  "
                  class="text-danger"
                  >The shop name must not be more than 60 characters.</span
                >
                <span
                  v-else-if="
                    !$v.settings.shop_name.minLength &&
                    $v.settings.shop_name.$dirty
                  "
                  class="text-danger"
                  >The shop name must be at least 2 characters.</span
                >
                <span
                  v-if="settings.errors.has('shop_name')"
                  class="text-danger"
                  v-text="settings.errors.get('shop_name')"
                />
              </div>
              <div class="form-group">
                <label for="shopdesc-text-input">Shop Description</label>
                <textarea
                  id="shopdesc-text-input"
                  v-model="settings.description"
                  type="text"
                  class="form-control"
                  placeholder="shop description"
                />
                <span
                  v-if="
                    !$v.settings.description.required &&
                    $v.settings.description.$dirty
                  "
                  class="text-danger"
                  >The shop description field is required</span
                >
                <span
                  v-else-if="
                    !$v.settings.description.maxLength &&
                    $v.settings.description.$dirty
                  "
                  class="text-danger"
                  >The shop description must not be more than 200
                  characters.</span
                >
                <span
                  v-else-if="
                    !$v.settings.description.minLength &&
                    $v.settings.description.$dirty
                  "
                  class="text-danger"
                  >The shop name must be at least 100 characters.</span
                >
                <span
                  v-if="settings.errors.has('description')"
                  class="text-danger"
                  v-text="settings.errors.get('description')"
                />
              </div>
              <div class="form-group">
                <label for="phone-input">Phone</label>
                <input
                  id="phone-input"
                  v-model="settings.phone"
                  type="text"
                  class="form-control"
                  placeholder="phone"
                />
                <span
                  v-if="!$v.settings.phone.required && $v.settings.phone.$dirty"
                  class="text-danger"
                  >The phone field is required</span
                >
                <span
                  v-if="settings.errors.has('phone')"
                  class="text-danger"
                  v-text="settings.errors.get('phone')"
                />
              </div>
              <div class="form-group">
                <label for="email-input">Email</label>
                <input
                  id="email-input"
                  v-model="settings.email"
                  type="email"
                  class="form-control"
                  placeholder="email"
                />
                <span
                  v-if="!$v.settings.email.required && $v.settings.email.$dirty"
                  class="text-danger"
                  >The email field is required</span
                >
                <span
                  v-else-if="
                    !$v.settings.email.email && $v.settings.email.$dirty
                  "
                  class="text-danger"
                  >You should enter a valid email</span
                >
                <span
                  v-if="settings.errors.has('email')"
                  class="text-danger"
                  v-text="settings.errors.get('email')"
                />
              </div>
              <div class="form-group">
                <label for="address-input">Address</label>
                <input
                  id="address-input"
                  v-model="settings.address"
                  type="text"
                  class="form-control"
                  placeholder="address"
                />
                <span
                  v-if="
                    !$v.settings.address.required && $v.settings.address.$dirty
                  "
                  class="text-danger"
                  >The address field is required</span
                >
                <span
                  v-else-if="
                    !$v.settings.address.maxLength && $v.settings.address.$dirty
                  "
                  class="text-danger"
                  >The address must not be more than 120 characters.</span
                >
                <span
                  v-if="settings.errors.has('address')"
                  class="text-danger"
                  v-text="settings.errors.get('address')"
                />
              </div>
              <div class="form-group">
                <label for="state-input">State</label>
                <input
                  id="state-input"
                  v-model="settings.state"
                  type="text"
                  class="form-control"
                  placeholder="state"
                />
                <span
                  v-if="!$v.settings.state.required && $v.settings.state.$dirty"
                  class="text-danger"
                  >The state field is required</span
                >
                <span
                  v-else-if="
                    !$v.settings.state.maxLength && $v.settings.state.$dirty
                  "
                  class="text-danger"
                  >The state must not be more than 120 characters.</span
                >
                <span
                  v-if="settings.errors.has('state')"
                  class="text-danger"
                  v-text="settings.errors.get('state')"
                />
              </div>
              <div class="form-group">
                <label for="city-input">City</label>
                <input
                  id="city-input"
                  v-model="settings.city"
                  type="text"
                  class="form-control"
                  placeholder="city"
                />
                <span
                  v-if="!$v.settings.city.required && $v.settings.city.$dirty"
                  class="text-danger"
                  >The city field is required</span
                >
                <span
                  v-else-if="
                    !$v.settings.city.maxLength && $v.settings.city.$dirty
                  "
                  class="text-danger"
                  >The city must not be more than 120 characters.</span
                >
                <span
                  v-if="settings.errors.has('city')"
                  class="text-danger"
                  v-text="settings.errors.get('city')"
                />
              </div>
              <div class="form-group">
                <label for="postalcode-input">Postal Code</label>
                <input
                  id="postalcode-input"
                  v-model="settings.postal_code"
                  type="number"
                  class="form-control"
                  placeholder="postal code"
                />
                <span
                  v-if="
                    !$v.settings.postal_code.required &&
                    $v.settings.postal_code.$dirty
                  "
                  class="text-danger"
                  >The postal code is required.</span
                >
                <span
                  v-if="
                    !$v.settings.postal_code.required &&
                    $v.settings.postal_code.$dirty
                  "
                  class="text-danger"
                  >The postal code field is required</span
                >
                <span
                  v-else-if="
                    !$v.settings.postal_code.maxLength &&
                    $v.settings.postal_code.$dirty
                  "
                  class="text-danger"
                  >The postal code must not be more than 10 numbers.</span
                >
                <span
                  v-if="settings.errors.has('postal_code')"
                  class="text-danger"
                  v-text="settings.errors.get('postal_code')"
                />
              </div>
              <div class="form-group">
                <label for="country-select">Country</label>
                <!-- eslint-disable-->
                <CountryDropdown
                  v-model="settings.country_id"
                  :countryId="settings.country_id"
                />
                <!-- eslint-enable-->
                <span
                  v-if="
                    !$v.settings.country_id.required &&
                    $v.settings.country_id.$dirty
                  "
                  class="text-danger"
                  >Please select country</span
                >
                <span
                  v-if="settings.errors.has('country_id')"
                  class="text-danger"
                  v-text="settings.errors.get('country_id')"
                />
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-alt-success">
                  Update
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- END Your Block -->
    </div>
  </main>
</template>

<script>
import {
  required,
  email,
  maxLength,
  minLength,
} from 'vuelidate/lib/validators';
import Form from '@/static/js/Form.js';
import CountryDropdown from '@/components/form/CountryDropdown';

export default {
  components: {
    CountryDropdown,
  },
  layout: 'admin',
  middleware: 'auth-admin',
  async asyncData({ $axios, params, app }) {
    const settings = await $axios.$get('admin/settings');
    return {
      settings: settings.data,
    };
  },
  data() {
    return {
      title: 'Site settings',
      settings: {
        shop_name: null,
        shop_description: null,
        email: null,
        phone: null,
        address: null,
        state: null,
        city: null,
        postal_code: null,
        country_id: null,
      },
    };
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
  created() {
    this.settings = new Form(this.settings);
  },
  validations: {
    settings: {
      shop_name: {
        required,
        maxLength: maxLength(60),
        minLength: minLength(2),
      },
      description: {
        required,
        maxLength: maxLength(200),
        minLength: minLength(100),
      },
      email: {
        required,
        email,
      },
      phone: {
        required,
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
  methods: {
    async submitForm() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
        try {
          await this.$axios
            .post('admin/settings', this.settings)
            .then(function (response) {
              if (response.status === 200) {
                toastr.options = {
                  positionClass: 'toast-bottom-right',
                };
                toastr.success('Settings Updated Successfully');
              }
            });
        } catch (error) {
          if (error.response.status === 422) {
            this.settings.errors.record(error.response.data);
          }
        }
      }
    },
  },
};
</script>
