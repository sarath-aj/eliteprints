<template>
  <div class="login_register_wrap section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-6 col-md-10">
          <div class="login_wrap">
            <div class="padding_eight_all bg-white">
              <div class="heading_s1">
                <h3>Login</h3>
              </div>
              <form @submit.prevent="submitForm">
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
                    @keydown="form.errors.clear('password')"
                  />
                  <span
                    v-if="!$v.form.password.required && $v.form.password.$dirty"
                    class="text-danger"
                    >The password field is required</span
                  >
                  <span
                    v-if="form.errors.has('password')"
                    class="text-danger"
                    v-text="form.errors.get('password')"
                  />
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-fill-out btn-block">
                    Log in
                  </button>
                </div>
              </form>

              <div class="text-center" />

              <div class="form-note text-center">
                Don't Have an Account?<nuxt-link :to="getRegisterLink()">
                  Sign Up
                </nuxt-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required, email } from 'vuelidate/lib/validators';
import Form from '@/static/js/Form.js';

export default {
  middleware: 'guest',
  data() {
    return {
      title: 'Login',
      form: new Form({
        email: 'johndoe@example.com',
        password: 'secret',
      }),
    };
  },

  validations: {
    form: {
      email: {
        required,
        email,
      },
      password: {
        required,
      },
    },
  },

  head() {
    return {
      title: this.title,
    };
  },
  created() {
    if (process.client) {
      alert('Username and Password Pre-Populated. Just Hit Sign In Button');
    }
  },
  methods: {
    getRegisterLink() {
      if (this.$route.query.redirect) {
        return '/register?redirect=' + this.$route.query.redirect;
      }
      return '/register';
    },
    async submitForm() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
        try {
          const response = await this.$auth.loginWith('user', {
            data: this.form,
          });

          if (response.status === 200) {
            this.$router.push({
              path: this.$route.query.redirect || '/',
            });
          }
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
