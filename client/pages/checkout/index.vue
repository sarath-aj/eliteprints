<template>
  <div>
    <section class="section">
      <template v-if="!empty">
        <div class="container is-fluid">
          <div>
            <ShippingAddress v-model="form.address_id" :addresses="addresses" />
            <hr />
            <PaymentMethods
              v-model="form.payment_method_id"
              :payment-methods="paymentMethods"
            />
            <hr />
            <article v-if="shippingMethodId" class="message">
              <h5 class="title is-5">Shipping Method</h5>
              <select
                v-model="shippingMethodId"
                class="form-control form-control-sm col-lg-3"
              >
                <option
                  v-for="shipping in shippingMethods"
                  :key="shipping.id"
                  :value="shipping.id"
                >
                  {{ shipping.name }}
                  (<vue-autonumeric
                    v-model="shipping.price"
                    :options="options"
                    tag="span"
                  />)
                </option>
              </select>
            </article>
            <hr />
            <article v-if="products.length" class="message">
              <div class="message-body">
                <h5 class="title is-5">Cart summary</h5>

                <CartOverview>
                  <template v-if="shippingMethodId" slot="rows">
                    <tr>
                      <td />
                      <td />
                      <td class="has-text-weight-bold">Shipping</td>

                      <vue-autonumeric
                        v-model="shipping.price"
                        :options="options"
                        tag="td"
                      />
                      <td />
                    </tr>

                    <tr>
                      <td />
                      <td />
                      <td class="has-text-weight-bold">Total</td>
                      <vue-autonumeric
                        v-model="total"
                        :options="options"
                        tag="td"
                      />
                      <td />
                    </tr>
                  </template>
                </CartOverview>
              </div>
            </article>

            <article class="message">
              <div class="message-body">
                <button
                  class="btn btn-fill-out btn-block"
                  :disabled="disabled"
                  @click="order"
                >
                  Place order
                </button>
              </div>
            </article>
          </div>
        </div>
      </template>
      <template v-if="empty">
        <div class="container">
          <div class="alert alert-warning" style="margin: 50px auto">
            <span
              >No products in cart.
              <nuxt-link to="/">Back to shopping</nuxt-link>!</span
            >
          </div>
        </div>
      </template>
    </section>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import CartOverview from '@/components/cart/CartOverview';
import ShippingAddress from '@/components/checkout/addresses/ShippingAddress';
import PaymentMethods from '@/components/checkout/paymentMethods/PaymentMethods';
import VueAutonumeric from '@/node_modules/vue-autonumeric/src/components/VueAutonumeric.vue';

export default {
  components: {
    CartOverview,
    ShippingAddress,
    PaymentMethods,
    VueAutonumeric,
  },
  layout: 'checkout',
  middleware: ['auth'],
  async asyncData({ $axios }) {
    const addresses = await $axios.$get('addresses');
    const paymentMethods = await $axios.$get('payment-methods');
    return {
      addresses: addresses.data,
      paymentMethods: paymentMethods.data,
    };
  },
  data() {
    return {
      options: {
        alwaysAllowDecimalCharacter: true,
        caretPositionOnFocus: 'start',
        currencySymbol: '$',
        readOnly: true,
      },
      title: 'Checkout',
      submitting: false,
      addresses: [],
      shippingMethods: [],
      paymentMethods: [],

      form: {
        address_id: null,
        payment_method_id: null,
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
  computed: {
    ...mapGetters({
      total: 'cart/total',
      products: 'cart/products',
      empty: 'cart/empty',
      shipping: 'cart/shipping',
    }),

    disabled() {
      return this.empty || this.submitting;
    },

    shippingMethodId: {
      get() {
        return this.shipping ? this.shipping.id : '';
      },
      set(shippingMethodId) {
        this.setShipping(
          this.shippingMethods.find((s) => s.id === shippingMethodId)
        );
      },
    },
  },

  watch: {
    'form.address_id'(addressId) {
      this.getShippingMethods(addressId).then(() => {
        this.setShipping(this.shippingMethods[0]);
      });
    },

    shippingMethodId() {
      this.getCart();
    },
  },

  methods: {
    ...mapActions({
      setShipping: 'cart/setShipping',
      getCart: 'cart/getCart',
    }),

    async order() {
      this.submitting = true;
      try {
        await this.$axios.$post('orders', {
          ...this.form,
          shipping_method_id: this.shippingMethodId,
        });

        await this.getCart();
        toastr.options = {
          positionClass: 'toast-top-right',
        };

        this.$cookies.set('show-order-completed-page', 'true', {
          path: '/',
          maxAge: 60 * 5,
        });

        this.$router.push({ name: 'order-completed' });
      } catch (error) {
        toastr.options = {
          positionClass: 'toast-bottom-right',
        };
        toastr.error(error.response.data.message);

        this.getCart();
      }

      this.submitting = false;
    },

    async getShippingMethods(addressId) {
      const response = await this.$axios.$get(
        `addresses/${addressId}/shipping`
      );

      this.shippingMethods = response.data;

      return response;
    },
  },
};
</script>
