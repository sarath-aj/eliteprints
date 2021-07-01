<template>
  <div class="login_register_wrap section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-6 col-md-10">
          <div class="login_wrap">
            <div class="padding_eight_all bg-white">
              <div class="heading_s1">
                <h3>Register</h3>
              </div>
              <form @submit.prevent="submitForm">
                <div class="form-group">
                  <input
                    v-model="form.name"
                    class="form-control"
                    type="text"
                    placeholder="Your Name"
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
                  <input
                    v-model="form.email"
                    class="form-control"
                    type="email"
                    placeholder="Your Email"
                    @keydown="form.errors.clear('email')"
                  />
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
                    v-else-if="!$v.form.email.maxLength && $v.form.email.$dirty"
                    class="text-danger"
                    >The email must not be more than 60 characters.</span
                  >
                  <span
                    v-else-if="!$v.form.email.minLength && $v.form.email.$dirty"
                    class="text-danger"
                    >The email must be at least 6 characters.</span
                  >
                  <span
                    v-if="form.errors.has('email')"
                    class="text-danger"
                    v-text="form.errors.get('email')"
                  />
                </div>

                <div class="form-group">
                  <input
                    v-model="form.password"
                    class="form-control"
                    type="password"
                    placeholder="Password"
                    @keydown="clearPassword()"
                  />
                  <span
                    v-if="!$v.form.password.required && $v.form.password.$dirty"
                    class="text-danger"
                    >The password field is required</span
                  >
                  <span
                    v-else-if="
                      !$v.form.password.minLength && $v.form.password.$dirty
                    "
                    class="text-danger"
                    >The password length should be atleast 6 characters</span
                  >
                  <span
                    v-if="form.errors.has('password')"
                    class="text-danger"
                    v-text="form.errors.get('password')"
                  />
                </div>

                <div class="form-group">
                  <input
                    v-model="form.password_confirmation"
                    class="form-control"
                    type="password"
                    placeholder="Confirm Password"
                    @keydown="form.errors.clear('password_confirmation')"
                  />
                  <span
                    v-if="
                      !$v.form.password_confirmation.required &&
                      $v.form.password_confirmation.$dirty
                    "
                    class="text-danger"
                    >The password confirmation field is required.</span
                  >
                  <span
                    v-else-if="
                      !$v.form.password_confirmation.sameAsPassword &&
                      $v.form.password_confirmation.$dirty
                    "
                    class="text-danger"
                    >The password should match</span
                  >
                  <span
                    v-if="form.errors.has('password_confirmation')"
                    class="text-danger"
                    v-text="form.errors.get('password_confirmation')"
                  />
                </div>
                <div class="login_footer form-group">
                  <div class="chek-form">
                    <div class="custome-checkbox">
                      <input
                        id="terms-policy"
                        v-model="form.terms"
                        class="form-check-input"
                        type="checkbox"
                        @change="termsChanged()"
                      />
                      <label class="form-check-label" for="terms-policy"
                        ><span>I agree to terms &amp; Policy.</span></label
                      >
                      <br />
                      <span
                        v-if="!$v.form.terms.required && $v.form.terms.$error"
                        class="text-danger"
                        >You must agree to our terms & Policy.</span
                      >
                      <span
                        v-if="form.errors.has('terms')"
                        class="text-danger"
                        v-text="form.errors.get('terms')"
                      />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-fill-out btn-block">
                    Sign up
                  </button>
                </div>
              </form>

              <div class="text-center" />

              <div class="form-note text-center">
                Already have an account?
                <nuxt-link to="/login"> Sign in </nuxt-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {
  required,
  email,
  minLength,
  maxLength,
  sameAs,
} from 'vuelidate/lib/validators';
import Form from '@/static/js/Form.js';

export default {
  middleware: ['guest'],
  data() {
    return {
      title: 'Register',
      form: new Form({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
        terms: false,
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
      email: {
        required,
        email,
        maxLength: maxLength(60),
        minLength: minLength(6),
      },
      password: {
        required,
        minLength: minLength(6),
      },
      password_confirmation: {
        required,
        sameAsPassword: sameAs('password'),
      },
      terms: {
        required(val) {
          return val;
        },
      },
    },
  },

  head() {
    return {
      title: this.title,
    };
  },

  methods: {
    clearPassword() {
      this.form.errors.clear('password');
      this.form.errors.clear('password_confirmation');
    },
    async submitForm() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
        try {
          const response = await this.$axios.$post('register', this.form);
          if (response.data.message === 'success') {
            const response = await this.$auth.loginWith('user', {
              data: this.form,
            });

            if (response.status === 200) {
              this.$router.push({
                path: this.$route.query.redirect || '/',
              });
            }
          }
        } catch (error) {
          if (error.response.status === 422) {
            this.form.errors.record(error.response.data);
          }
        }
      }
    },
    termsChanged() {
      this.$v.form.terms.$touch();
      this.form.errors.clear('terms');
    },
  },
};
</script>
