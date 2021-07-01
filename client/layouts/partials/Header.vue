<template>
  <header class="header_wrap" role="banner">
    <div class="top-header d-none d-md-block">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div
              class="
                d-flex
                align-items-center
                justify-content-center justify-content-md-end
              "
            >
              <ul class="header_list">
                <li v-if="!authenticated">
                  <nuxt-link to="/login">
                    <i class="ti-user" /><span>Login</span>
                  </nuxt-link>
                </li>
                <template v-else>
                  <li>
                    <nuxt-link to="/customer/overview">
                      <i class="ti-user" /><span>{{ user.name }}</span>
                    </nuxt-link>
                  </li>
                  <li>
                    <a href="#" @click.prevent="logout()">
                      <i class="ti-lock" /><span>Logout</span>
                    </a>
                  </li>
                </template>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="middle-header">
      <div class="container">
        <div class="nav_block">
          <nuxt-link class="navbar-brand" to="/"> ELITE PRINTS </nuxt-link>
          <div class="contact_phone order-md-last">
            <i class="linearicons-phone-wave" />
            <span>{{ contactInfo.phone }}</span>
          </div>
          <div
            class="product_search_form"
            :class="{ show: showSearchBar }"
            role="search"
          >
            <form>
              <div class="input-group">
                <input
                  v-model="search"
                  class="form-control"
                  placeholder="Search Product..."
                  type="search"
                  @keyup.enter="showSearchBar = false"
                />
                <nuxt-link
                  class="search_btn"
                  tag="button"
                  :to="{ name: 'search', query: { s: search } }"
                >
                  <i
                    class="linearicons-magnifier"
                    @click="showSearchBar = false"
                  />
                </nuxt-link>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="light_skin main_menu_uppercase bg_dark">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav class="navbar navbar-expand-lg" role="navigation">
              <button
                class="navbar-toggler side_navbar_toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSidetoggle"
              >
                <span class="ion-android-menu" />
              </button>
              <div
                id="navbarSidetoggle"
                class="collapse navbar-collapse mobile_side_menu"
              >
                <ul class="navbar-nav">
                  <li class="active">
                    <nuxt-link class="nav-link nav_item" to="/">
                      Home
                    </nuxt-link>
                  </li>
                  <li class="">
                    <nuxt-link class="nav-link nav_item" to="/products">
                      All Products
                    </nuxt-link>
                  </li>
                  <li class="">
                    <nuxt-link class="nav-link nav_item" to="/men-t-shirts">
                      Men T-Shirts
                    </nuxt-link>
                  </li>
                  <li class="">
                    <nuxt-link class="nav-link nav_item" to="/women-t-shirts">
                      Women T-Shirts
                    </nuxt-link>
                  </li>
                  <li class="">
                    <nuxt-link class="nav-link nav_item" to="/contact-us">
                      Contact us
                    </nuxt-link>
                  </li>
                </ul>
              </div>
              <ul class="navbar-nav attr-nav align-items-center">
                <li class="dropdown cart_dropdown">
                  <nuxt-link
                    class="nav-link cart_trigger btn-shopping-cart"
                    to="/cart"
                    data-toggle="dropdown"
                  >
                    <i class="linearicons-cart" />
                    <span class="cart_count">{{ cartCount }}</span>
                  </nuxt-link>
                  <div class="cart_box dropdown-menu dropdown-menu-right">
                    <ul class="cart_list">
                      <li v-for="product in products" :key="product.id">
                        <a
                          href="#"
                          class="item_remove remove-cart-button"
                          @click.prevent="attemptDestroy(product.id)"
                          ><i class="ion-close"
                        /></a>
                        <nuxt-link :to="'/products/' + product.product.slug">
                          <img
                            style="max-width: 80px; max-height: 100px"
                            :src="backendURL + product.product.main_image"
                            :alt="product.product.name"
                          />
                          {{ product.product.name }}
                        </nuxt-link>
                        <span class="cart_quantity">
                          {{ product.quantity }} x
                          <vue-autonumeric
                            v-model="product.price"
                            class="cart_amount"
                            :options="options"
                            tag="span"
                          />
                        </span>
                      </li>
                    </ul>
                    <div v-if="!empty" class="cart_footer">
                      <p class="cart_total">
                        <strong>Sub Total:</strong>
                      </p>
                      <!-- eslint-disable -->
                      <p
                        v-model="subtotal"
                        class="cart_price"
                        :options="options"
                        tag="span"
                      />

                      <!-- eslint-enable -->
                      <p class="cart_buttons">
                        <nuxt-link
                          to="/cart"
                          class="btn btn-fill-line view-cart"
                        >
                          View Cart
                        </nuxt-link>
                        <nuxt-link
                          class="btn btn-fill-out checkout"
                          to="/checkout"
                        >
                          Checkout
                        </nuxt-link>
                      </p>
                    </div>
                  </div>

                  <div
                    v-if="empty"
                    class="cart_box dropdown-menu dropdown-menu-right"
                  >
                    <p class="text-center">Your cart is empty!</p>
                  </div>
                </li>
              </ul>
              <div class="pr_search_icon">
                <a
                  href="#"
                  class="nav-link pr_search_trigger"
                  :class="{ show: showSearchBar }"
                  @click="showsearchForm()"
                  ><i class="linearicons-magnifier"
                /></a>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import VueAutonumeric from '@/node_modules/vue-autonumeric/src/components/VueAutonumeric.vue';
import { mapActions, mapGetters } from 'vuex';

export default {
  components: {
    VueAutonumeric,
  },
  data() {
    return {
      options: {
        alwaysAllowDecimalCharacter: true,
        caretPositionOnFocus: 'start',
        currencySymbol: '$',
        readOnly: true,
      },
      search: this.$route.query.s,
      show: false,
      showSearchBar: false,
    };
  },
  computed: {
    ...mapGetters({
      contactInfo: 'contact-info/contactInfo',
      cartCount: 'cart/count',
      empty: 'cart/empty',
      products: 'cart/products',
      subtotal: 'cart/subtotal',
    }),
    backendURL() {
      return process.env.backendURL;
    },
  },
  mounted() {
    $(document).ready(function () {
      $(document).click(function (event) {
        const click = $(event.target);
        const _open = $('.navbar-collapse').hasClass('show');
        if (_open === true && !click.hasClass('navbar-toggler')) {
          $('.navbar-toggler').click();
        }
      });
    });
  },
  methods: {
    showsearchForm() {
      this.showSearchBar = !this.showSearchBar;
    },
    logout() {
      this.$auth.logout();
    },
    ...mapActions({
      destroy: 'cart/destroy',
      update: 'cart/update',
    }),

    attemptDestroy(id) {
      if (confirm('Are you sure?')) {
        this.destroy(id);
      }
    },
  },
};
</script>

<style>
.navbar-brand {
  font-size: 36px;
  text-align: center;
  line-height: 60px;
  font-weight: 800;
  font-style: normal;
  color: #111;
}
</style>
