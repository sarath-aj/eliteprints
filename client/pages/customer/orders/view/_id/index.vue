<template>
  <div class="card">
    <div class="card-header">
      <h3>Order information</h3>
    </div>
    <div class="card-body">
      <div class="customer-order-detail">
        <div class="row">
          <div class="col-md-6">
            <div class="order-slogan">ELITE PRINTS</div>
          </div>
          <div class="col-md-6">
            <div class="order-meta">
              <p>
                <span>Order number:</span>
                <span class="order-detail-value">{{ order.id }}</span>
              </p>
              <span>Time:</span>
              <span class="order-detail-value">{{ order.order_date }}</span>
            </div>
          </div>
        </div>

        <h6>Order information</h6>
        <div class="col-12">
          <span>Order status:</span>
          <span class="order-detail-value"
            ><span class="status-label" :class="getClass(order.status)">{{
              order.status
            }}</span></span
          >
        </div>

        <div class="col-12">
          <span>Payment method:</span>
          <span class="order-detail-value"
            >{{ order.payment_method.provider_id }}
          </span>
        </div>

        <div class="col-12">
          <span>Total Amount:</span>
          <vue-autonumeric
            v-model="order.total"
            class="order-detail-value"
            :options="options"
            tag="span"
          />
        </div>
        <div class="col-12">
          <span>Shipping method:</span>
          <span class="order-detail-value">
            {{ order.shippingMethod.name }}
          </span>
        </div>
        <div class="col-12">
          <span>Shipping fee:</span>
          <vue-autonumeric
            v-model="order.shippingMethod.price"
            class="order-detail-value"
            :options="options"
            tag="span"
          />
        </div>
        <br />
        <h6>Shipping Address</h6>

        <div class="col-12">
          <span>Full Name:</span>
          <span class="order-detail-value"
            >{{ order.shipping_address.name }}
          </span>
        </div>

        <div class="col-12">
          <span>Phone:</span>
          <span class="order-detail-value">{{ order.customer_mobile }} </span>
        </div>

        <div class="col-12">
          <span>Address:</span>
          <span class="order-detail-value">{{
            order.shipping_address.address
          }}</span>
        </div>
        <div class="col-12">
          <span>State:</span>
          <span class="order-detail-value">{{
            order.shipping_address.state
          }}</span>
        </div>
        <div class="col-12">
          <span>City:</span>
          <span class="order-detail-value"
            >{{ order.shipping_address.city }}
          </span>
        </div>
        <div class="col-12">
          <span>Postal Code:</span>
          <span class="order-detail-value"
            >{{ order.shipping_address.postal_code }}
          </span>
        </div>
        <div class="col-12">
          <span>Country:</span>
          <span class="order-detail-value">
            {{ order.shipping_address.country.name }}
          </span>
        </div>

        <br />
        <h6>Order detail</h6>
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Image</th>
                  <th>Product</th>
                  <th style="width: 70px">Quantity</th>
                  <th>Unit Cost</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(product, key) in order.products" :key="product.id">
                  <td class="text-center">
                    {{ key + 1 }}
                  </td>
                  <td class="text-center">
                    <img
                      style="max-width: 80px; max-height: 100px"
                      :src="backendURL + product.product.main_image"
                      width="50"
                      :alt="product.name"
                    />
                  </td>
                  <td>
                    {{ product.product.name }}
                    <small>({{ product.type }} : {{ product.name }})</small>
                  </td>
                  <td class="text-center">
                    {{ product.quantity }}
                  </td>
                  <vue-autonumeric
                    v-model="product.price"
                    :options="options"
                    tag="td"
                  />
                  <vue-autonumeric
                    v-model="product.total"
                    :options="options"
                    tag="td"
                  />
                </tr>
                <tr>
                  <td />
                  <td />
                  <td />
                  <td />
                  <td class="heading_s1">
                    <h6>Subtotal</h6>
                  </td>
                  <td>
                    <vue-autonumeric
                      v-model="order.subtotal"
                      :options="options"
                      tag="strong"
                    />
                  </td>
                </tr>

                <tr>
                  <td />
                  <td />
                  <td />
                  <td />
                  <td class="heading_s1">
                    <h6>Shipping</h6>
                  </td>
                  <td>
                    <vue-autonumeric
                      v-model="order.shippingMethod.price"
                      :options="options"
                      tag="strong"
                    />
                  </td>
                </tr>
                <tr class="table-success">
                  <td />
                  <td />
                  <td />
                  <td />
                  <td class="heading_s1">
                    <h6>TOTAL</h6>
                  </td>
                  <td>
                    <vue-autonumeric
                      v-model="order.total"
                      :options="options"
                      tag="strong"
                    />
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <br />
        <div>
          <a
            v-if="!(order.status === 'cancelled')"
            href="#"
            class="btn btn-dark btn-sm"
            @click.prevent="cancelOrder()"
            >Cancel order</a
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueAutonumeric from '@/node_modules/vue-autonumeric/src/components/VueAutonumeric.vue';
export default {
  components: {
    VueAutonumeric,
  },
  layout: 'customer',
  middleware: 'auth',
  async asyncData({ $axios, params, app }) {
    const order = await $axios.$get(`customer/orders/${params.id}`);
    return {
      order: order.data,
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
      cancelled: 'label-danger',
      pending: 'label-warning',
      processing: 'label-info',
      shipped: 'label-info',
      delivered: 'label-info',
      order: {},
    };
  },
  head() {
    return {
      title: `Order detail ${this.order.id}`,
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
    backendURL() {
      return process.env.backendURL;
    },
  },
  methods: {
    getClass(status) {
      return this[status];
    },
    async cancelOrder() {
      try {
        const self = this;
        await this.$axios
          .$put(`customer/orders/${this.order.id}`, {
            status: 'cancelled',
          })
          .then(function (response) {
            if (response.data.message === 'success') {
              toastr.options = {
                positionClass: 'toast-top-right',
              };
              toastr.warning('Order Cancelled');
              self.$router.replace('/customer/orders');
            }
          });
      } catch (error) {}
    },
  },
};
</script>

<style>
.order-slogan {
  font-size: 26px;
  line-height: 60px;
  font-weight: 800;
  font-style: normal;
  color: #111;
}
</style>
