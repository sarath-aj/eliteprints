<template>
  <main id="main-container">
    <!-- Page Content -->
    <div class="content">
      <div class="row">
        <div class="col-xl-6">
          <div class="block block-rounded">
            <div class="block-content">
              <div class="table-responsive">
                <table class="table table-bordered table-vcenter font-size-sm">
                  <thead class="block-header-default">
                    <tr>
                      <th colspan="2">
                        <h3 class="block-title">Order Details</h3>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><strong>Order Date</strong></td>
                      <td class="text-center">
                        {{ order.order_date }}
                      </td>
                    </tr>
                    <tr>
                      <td><strong>Order Status</strong></td>
                      <td class="text-center">
                        {{ order.status }}
                      </td>
                    </tr>
                    <tr>
                      <td><strong>Order Total</strong></td>
                      <vue-autonumeric
                        v-model="order.total"
                        class="text-center"
                        :options="options"
                        tag="td"
                      />
                    </tr>
                    <tr>
                      <td><strong>Payment Method</strong></td>
                      <td class="text-center">
                        {{ order.payment_method.provider_id }}
                      </td>
                    </tr>
                    <tr>
                      <td><strong>Shipping Method</strong></td>
                      <td class="text-center">
                        {{ order.shippingMethod.name }}
                      </td>
                    </tr>
                    <tr>
                      <td><strong>Shipping Fee</strong></td>
                      <vue-autonumeric
                        v-model="order.shippingMethod.price"
                        class="text-center"
                        :options="options"
                        tag="td"
                      />
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="block block-rounded">
            <div class="block-content">
              <div class="table-responsive">
                <table class="table table-bordered table-vcenter font-size-sm">
                  <thead class="block-header-default">
                    <tr>
                      <th colspan="2">
                        <h3 class="block-title">Customer Details</h3>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><strong>Name</strong></td>
                      <td class="text-center">
                        {{ order.customer_name }}
                      </td>
                    </tr>
                    <tr>
                      <td><strong>Email</strong></td>
                      <td class="text-center">
                        {{ order.customer_email }}
                      </td>
                    </tr>
                    <tr>
                      <td><strong>Mobile</strong></td>
                      <td class="text-center">
                        {{ order.customer_mobile || 'N/A' }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END Products -->

      <!-- Customer -->
      <div class="row">
        <div class="col-sm-6">
          <!-- Shipping Address -->
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">Shipping Address</h3>
            </div>
            <div class="block-content">
              <div class="font-size-h4 mb-1">
                {{ order.shipping_address.name }}
              </div>
              <address class="font-size-sm">
                {{ order.shipping_address.address }}<br />
                {{ order.shipping_address.state }}<br />
                {{ order.shipping_address.city }}<br />
                {{ order.shipping_address.postal_code }}<br />
                {{ order.shipping_address.country.name }}<br />
              </address>
            </div>
          </div>
          <!-- END Shipping Address -->
        </div>

        <div class="col-sm-6">
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">Order Status</h3>
            </div>
            <div class="block-content">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <select v-model="order.status" class="form-control">
                      <option value="pending">Pending</option>
                      <option value="cancelled">Cancelled</option>
                      <option value="processing">Processing</option>
                      <option value="shipped">Shipped</option>
                      <option value="delivered">Delivered</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    @click="updateStatus()"
                  >
                    Update Status
                  </button>
                </div>
              </div>
              <!-- </div> -->
            </div>
          </div>
        </div>
      </div>
      <!-- END Customer -->
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">Ordered Products</h3>
        </div>
        <div class="block-content">
          <div class="table-responsive">
            <table
              class="
                table table-borderless table-striped table-vcenter
                font-size-sm
              "
            >
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Image</th>
                  <th>Product Code</th>
                  <th>Product(s)</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-right" style="width: 10%">UNIT COST</th>
                  <th class="text-right" style="width: 10%">PRICE</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(product, key) in order.products" :key="product.id">
                  <td class="text-center">
                    {{ key + 1 }}
                  </td>
                  <td class="text-center">
                    <img
                      :src="backendURL + product.product.main_image"
                      width="50"
                      alt="Samsung Smart Phone"
                    />
                  </td>
                  <td>
                    <strong>{{ product.product.product_code }}</strong>
                  </td>
                  <td>
                    <nuxt-link
                      :to="
                        '/admin/products/edit-product/' + product.product.slug
                      "
                    >
                      {{ product.product.name }}
                    </nuxt-link>
                    <small>({{ product.type }} : {{ product.name }})</small>
                  </td>
                  <td class="text-center">
                    <strong>{{ product.quantity }}</strong>
                  </td>
                  <vue-autonumeric
                    v-model="product.price"
                    class="text-right"
                    :options="options"
                    tag="td"
                  />
                  <vue-autonumeric
                    v-model="product.total"
                    class="text-right"
                    :options="options"
                    tag="td"
                  />
                </tr>

                <tr>
                  <td colspan="6" class="text-right">
                    <strong>Subtotal</strong>
                  </td>
                  <vue-autonumeric
                    v-model="order.subtotal"
                    class="text-right"
                    :options="options"
                    tag="td"
                  />
                </tr>
                <tr>
                  <td colspan="6" class="text-right">
                    <strong>Shipping</strong>
                  </td>
                  <vue-autonumeric
                    v-model="order.shippingMethod.price"
                    class="text-right"
                    :options="options"
                    tag="td"
                  />
                </tr>
                <tr class="table-success">
                  <td colspan="6" class="text-right text-uppercase">
                    <strong>Total</strong>
                  </td>
                  <td class="text-right">
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
      </div>
    </div>
    <!-- END Page Content -->
  </main>
</template>

<script>
import VueAutonumeric from '@/node_modules/vue-autonumeric/src/components/VueAutonumeric.vue';

export default {
  components: {
    VueAutonumeric,
  },
  layout: 'admin',
  middleware: 'auth-admin',
  validate({ params }) {
    // Must be a number
    return /^\d+$/.test(params.id);
  },
  async asyncData({ $axios, params, app }) {
    const response = await $axios.$get(`admin/order/${params.id}`);
    return {
      order: response.data,
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
      order: {},
    };
  },
  head() {
    return {
      title: `Edit Order #${this.order.id}`,
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
    async updateStatus() {
      try {
        await this.$axios
          .$put(`admin/datatable/orders/${this.order.id}`, {
            status: this.order.status,
          })
          .then(function (response) {
            toastr.options = {
              positionClass: 'toast-bottom-right',
            };
            toastr.success('Status Updated');
          });
      } catch (error) {}
    },
  },
};
</script>
