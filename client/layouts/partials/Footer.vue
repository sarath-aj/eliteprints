<template>
  <footer class="footer_dark" role="contentinfo">
    <div class="footer_top">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="widget">
              <nuxt-link to="/" class="widget_title footer_logo">
                ELITE PRINTS
              </nuxt-link>
              <p class="widget_description">
                {{ contactInfo.description }}
              </p>
            </div>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="widget">
              <h6 class="widget_title">Useful Links</h6>
              <ul class="widget_links">
                <li>
                  <nuxt-link to="/contact-us">
                    <span>Contact Us</span>
                  </nuxt-link>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="widget">
              <h6 class="widget_title">Categories</h6>
              <ul class="widget_links">
                <li>
                  <nuxt-link to="/men-t-shirts">
                    <span>Men T-shirts</span>
                  </nuxt-link>
                </li>
                <li>
                  <nuxt-link to="/women-t-shirts">
                    <span>Women T-shirts</span>
                  </nuxt-link>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="widget">
              <h6 class="widget_title">My Account</h6>
              <ul class="widget_links">
                <li>
                  <nuxt-link to="/customer/overview">
                    <span>My Profile</span>
                  </nuxt-link>
                </li>
                <li>
                  <nuxt-link to="/tracking">
                    <span>Order Tracking</span>
                  </nuxt-link>
                </li>
                <li>
                  <nuxt-link to="/customer/orders">
                    <span>Orders</span>
                  </nuxt-link>
                </li>
              </ul>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="widget">
              <h6 class="widget_title">Contact Info</h6>
              <ul class="contact_info contact_info_light">
                <li>
                  <i class="ti-location-pin" />
                  <p>{{ contactInfo.address }}</p>
                </li>
                <li>
                  <i class="ti-email" />
                  <a :href="mailto()">{{ contactInfo.email }}</a>
                </li>
                <li>
                  <i class="ti-mobile" />
                  <p>{{ contactInfo.phone }}</p>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="bottom_footer border-top-tran">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <p class="mb-md-0 text-center text-md-left">
              © {{ currentYear }} All Rights Reserved by Elite Prints.
            </p>
          </div>
          <div class="col-md-6">
            <ul class="footer_payment text-center text-lg-right">
              <li>
                <img src="/storage/general/visa.png" alt="payment method" />
              </li>
              <li>
                <img
                  src="/storage/general/master-card.png"
                  alt="payment method"
                />
              </li>
              <li>
                <img src="/storage/general/discover.png" alt="payment method" />
              </li>
              <li>
                <img
                  src="/storage/general/american-express.png"
                  alt="payment method"
                />
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
  data() {
    return {
      currentYear: new Date().getFullYear(),
    };
  },
  computed: {
    ...mapGetters({
      contactInfo: 'contact-info/contactInfo',
    }),
  },
  methods: {
    mailto() {
      return `mailto:${this.contactInfo.email}`;
    },
  },
};
</script>

<style>
.footer_logo {
  font-size: 26px;
  line-height: 40px;
  font-weight: 800;
  font-style: normal;
}

.widget_description {
  margin-top: 16px;
}
</style>
