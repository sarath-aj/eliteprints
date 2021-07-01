<template>
  <div id="app">
    <Breadcrumb />
    <div class="section">
      <div class="container">
        <div class="section pb-0">
          <div class="row">
            <div class="col-xl-4 col-md-6">
              <div class="contact_style3">
                <div class="contact_icon">
                  <i class="linearicons-map2" />
                </div>
                <div class="contact_text">
                  <span>Address</span>
                  <p>123 Street, Old Trafford, NewYork, USA</p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6">
              <div class="contact_style3">
                <div class="contact_icon">
                  <i class="linearicons-envelope-open" />
                </div>
                <div class="contact_text">
                  <span>Email Address</span>
                  <a href="mailto:admin@eliteprints.herokuapp.com"
                    >admin@eliteprints.herokuapp.com</a
                  >
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6">
              <div class="contact_style3">
                <div class="contact_icon">
                  <i class="linearicons-tablet2" />
                </div>
                <div class="contact_text">
                  <span>Phone</span>
                  <p>123-456-7890</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="section">
          <div class="row">
            <div class="col-12">
              <div class="heading_s1">
                <h2>Get In touch</h2>
              </div>
              <p class="leads">
                If you have any queries you can get in touch with us by filling
                this form. We will respond in 24 hours.
              </p>
              <div class="field_form">
                <form
                  class="form--contact contact-form"
                  @submit.prevent="submitForm"
                >
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="contact_name" class="control-label required"
                          >Name</label
                        >
                        <input
                          id="contact_name"
                          v-model="form.name"
                          type="text"
                          placeholder="Name"
                          class="form-control"
                          @keydown="form.errors.clear('name')"
                        />
                        <span
                          v-if="!$v.form.name.required && $v.form.name.$dirty"
                          class="text-danger"
                          >The name field is required</span
                        >
                        <span
                          v-if="form.errors.has('name')"
                          class="text-danger"
                          v-text="form.errors.get('name')"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label
                          for="contact_email"
                          class="control-label required"
                          >Email</label
                        >
                        <input
                          id="contact_email"
                          v-model="form.email"
                          type="email"
                          placeholder="Email"
                          class="form-control"
                          @keydown="form.errors.clear('email')"
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
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="contact_subject" class="control-label"
                          >Subject</label
                        >
                        <input
                          id="contact_subject"
                          v-model="form.subject"
                          type="text"
                          placeholder="Subject"
                          class="form-control"
                          @keydown="form.errors.clear('subject')"
                        />
                        <span
                          v-if="
                            !$v.form.subject.required && $v.form.subject.$dirty
                          "
                          class="text-danger"
                          >The subject field is required</span
                        >
                        <span
                          v-if="form.errors.has('subject')"
                          class="text-danger"
                          v-text="form.errors.get('subject')"
                        />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label
                          for="contact_content"
                          class="control-label required"
                          >Message</label
                        >
                        <textarea
                          id="contact_content"
                          v-model="form.message"
                          rows="5"
                          placeholder="Message"
                          class="form-control"
                          @keydown="form.errors.clear('message')"
                        />
                        <span
                          v-if="
                            !$v.form.message.required && $v.form.message.$dirty
                          "
                          class="text-danger"
                          >The message field is required</span
                        >
                        <span
                          v-if="form.errors.has('message')"
                          class="text-danger"
                          v-text="form.errors.get('message')"
                        />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <button type="submit" class="btn btn-fill-out">
                          Send Message
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
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
import Breadcrumb from '@/layouts/partials/Breadcrumb.vue';

export default {
  components: {
    Breadcrumb,
  },
  data() {
    return {
      title: 'Contact Us',
      form: new Form({
        name: null,
        email: null,
        subject: null,
        message: null,
      }),
    };
  },
  validations: {
    form: {
      name: {
        required,
      },
      email: {
        required,
        email,
      },
      subject: {
        required,
      },
      message: {
        required,
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
          //   const response = await this.$axios.$post('contact-us', this.form);
          //   if (response.message === 'success') {
          //     toastr.options = {
          //       positionClass: 'toast-top-right',
          //     };
          //     toastr.success('Thank you for contacting us!');
          //     this.$v.$reset();
          //     this.form.reset();
          //   }

          // MOCK
          toastr.options = {
            positionClass: 'toast-top-right',
          };
          await toastr.success('Thank you for contacting us!');
          this.$v.$reset();
          this.form.reset();
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
