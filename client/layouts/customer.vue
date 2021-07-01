<template>
  <div>
    <Header />
    <Breadcrumb />
    <div class="main_content">
      <!-- START SECTION SHOP -->
      <div class="section">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-4">
              <div class="dashboard_menu">
                <ul class="nav nav-tabs flex-column" role="tablist">
                  <li class="nav-item">
                    <nuxt-link
                      to="/customer/overview"
                      :class="[
                        currentPage.includes('overview') ? activeClass : '',
                        'nav-link',
                      ]"
                    >
                      <i class="ti-layout-grid2" />Overview
                    </nuxt-link>
                  </li>
                  <li class="nav-item">
                    <nuxt-link
                      to="/customer/orders"
                      :class="[
                        currentPage.includes('orders') ? activeClass : '',
                        'nav-link',
                      ]"
                    >
                      <i class="ti-shopping-cart-full" />Orders
                    </nuxt-link>
                  </li>
                  <li class="nav-item">
                    <nuxt-link
                      to="/customer/address"
                      :class="[
                        currentPage.includes('address') ? activeClass : '',
                        'nav-link',
                      ]"
                    >
                      <i class="ti-location-pin" />Address
                    </nuxt-link>
                  </li>
                  <li class="nav-item">
                    <nuxt-link
                      to="/customer/edit-account"
                      :class="[
                        currentPage.includes('edit-account') ? activeClass : '',
                        'nav-link',
                      ]"
                    >
                      <i class="ti-id-badge" />Account details
                    </nuxt-link>
                  </li>
                  <li class="nav-item">
                    <nuxt-link
                      to="/customer/change-password"
                      :class="[
                        currentPage.includes('change-password')
                          ? activeClass
                          : '',
                        'nav-link',
                      ]"
                    >
                      <i class="ti-id-badge" />Change password
                    </nuxt-link>
                  </li>
                  <li class="nav-item">
                    <nuxt-link to="/customer/logout" class="nav-link">
                      <i class="ti-lock" />Logout
                    </nuxt-link>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-9 col-md-8">
              <div class="dashboard_content">
                <nuxt />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END SECTION SHOP -->
    </div>
    <Footer />
  </div>
</template>

<script>
import Header from './partials/Header.vue';
import Footer from './partials/Footer.vue';
import Breadcrumb from './partials/Breadcrumb.vue';

export default {
  components: {
    Header,
    Footer,
    Breadcrumb,
  },
  data() {
    return {
      activeClass: 'active',
    };
  },
  head() {
    return {
      link: [
        {
          rel: 'stylesheet',
          href: 'https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap',
        },
        { rel: 'stylesheet', href: '/bootstrap/css/bootstrap.min.css' },
        { rel: 'stylesheet', href: '/css/styles.css' },
        { rel: 'stylesheet', href: '/css/ionicons.min.css' },
        { rel: 'stylesheet', href: '/css/themify-icons.css' },
        { rel: 'stylesheet', href: '/css/linearicons.css' },
        { rel: 'stylesheet', href: '/css/flaticon.css' },
        { rel: 'stylesheet', href: '/css/simple-line-icons.css' },
      ],
      script: [
        {
          src: '/js/jquery-3.5.1.min.js',
        },
        {
          src: '/js/popper.min.js',
          body: true,
        },
        {
          src: '/bootstrap/js/bootstrap.min.js',
          body: true,
        },
        { src: 'https://js.stripe.com/v3/' },
      ],
    };
  },
  computed: {
    currentPage() {
      return this.$route.path;
    },
  },
};
</script>
