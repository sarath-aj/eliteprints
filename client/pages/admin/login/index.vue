<template>
  <!-- Main Container -->
  <main id="main-container">
    <!-- Page Content -->
    <div class="hero-static d-flex align-items-center">
      <div class="w-100">
        <!-- Sign In Section -->
        <div class="bg-white">
          <div class="content content-full">
            <div class="row justify-content-center">
              <div class="col-md-8 col-lg-6 col-xl-4 py-4">
                <!-- Header -->
                <div class="text-center">
                  <p class="mb-2">
                    <i class="fa fa-2x fa-circle-notch text-primary" />
                  </p>
                  <h1 class="h4 mb-1">Sign In</h1>
                </div>
                <!-- END Header -->

                <form class="js-validation-signin" @submit.prevent="submitForm">
                  <div class="py-3">
                    <div class="form-group">
                      <input
                        v-model.trim="form.email"
                        type="text"
                        :class="{
                          'is-invalid':
                            $v.form.email.$anyError || form.errors.has('email'),
                        }"
                        class="form-control form-control-lg form-control-alt"
                        placeholder="Email"
                        @keydown="form.errors.clear('email')"
                      />

                      <div
                        v-if="!$v.form.email.required && $v.form.email.$invalid"
                        class="invalid-feedback animated fadeIn"
                      >
                        The email field is required
                      </div>

                      <div
                        v-else-if="
                          !$v.form.email.email && $v.form.email.$invalid
                        "
                        class="invalid-feedback animated fadeIn"
                      >
                        You should enter a valid email
                      </div>

                      <div
                        v-if="form.errors.has('email')"
                        class="invalid-feedback animated fadeIn"
                        v-text="form.errors.get('email')"
                      />
                    </div>
                    <div class="form-group">
                      <input
                        v-model.trim="form.password"
                        type="password"
                        :class="{
                          'is-invalid':
                            $v.form.password.$anyError ||
                            form.errors.has('password'),
                        }"
                        class="form-control form-control-lg form-control-alt"
                        placeholder="Password"
                        @keydown="form.errors.clear('password')"
                      />

                      <div
                        v-if="
                          !$v.form.password.required &&
                          $v.form.password.$invalid
                        "
                        class="invalid-feedback animated fadeIn"
                      >
                        The password field is required
                      </div>

                      <div
                        v-if="form.errors.has('password')"
                        class="invalid-feedback animated fadeIn"
                        v-text="form.errors.get('password')"
                      />
                    </div>
                  </div>
                  <div class="form-group row justify-content-center mb-0">
                    <div class="col-md-6 col-xl-5">
                      <button type="submit" class="btn btn-block btn-primary">
                        <i class="fa fa-fw fa-sign-in-alt mr-1" /> Sign In
                      </button>
                    </div>
                  </div>
                </form>
                <!-- END Sign In Form -->
              </div>
            </div>
          </div>
        </div>
        <!-- END Sign In Section -->

        <!-- Footer -->
        <div class="font-size-sm text-center text-muted py-3">
          <strong>Elite Prints</strong> &copy; <span>{{ currentYear }}</span>
        </div>
        <!-- END Footer -->
      </div>
    </div>
    <!-- END Page Content -->
  </main>
  <!-- END Main Container -->
</template>

<script>
import { required, email } from 'vuelidate/lib/validators';
import Form from '@/static/js/Form.js';

export default {
  layout: 'admin-login',
  middleware: 'admin',
  data() {
    return {
      title: 'Admin Login',
      currentYear: new Date().getFullYear(),
      form: new Form({
        email: 'admin@example.com',
        password: 'admin',
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
    if (process.client) {
      alert('Username and Password Pre-Populated. Just Hit Sign In Button');
    }
  },
  methods: {
    async submitForm() {
      this.$v.$touch();
      if (!this.$v.$invalid) {
        try {
          const response = await this.$auth.loginWith('admin', {
            data: this.form,
          });

          if (response.status === 200) {
            this.$router.push({
              path: this.$route.query.redirect || '/admin',
            });
          }
        } catch (error) {
          this.form.errors.record(error.response.data);
        }
      }
    },
  },
};
</script>
