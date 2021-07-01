<template>
  <div class="card">
    <div class="card-header">
      <h3>Orders</h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Order Date</th>
              <th>Total</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="order in orders" :key="order.id">
              <td>{{ order.id }}</td>
              <td>{{ order.created_at }}</td>
              <vue-autonumeric
                v-model="order.total"
                :options="options"
                tag="td"
              />
              <td>
                <span class="status-label" :class="getClass(order.status)">{{
                  order.status
                }}</span>
              </td>
              <td>
                <nuxt-link
                  class="btn btn-fill-out btn-sm"
                  :to="{
                    name: 'customer-orders-view-id',
                    params: { id: order.id },
                  }"
                >
                  View
                </nuxt-link>
              </td>
            </tr>
            <tr v-if="!orders.length">
              <td colspan="5" class="text-center">No orders!</td>
            </tr>
          </tbody>
        </table>
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
    const orders = await $axios.$get('customer/orders');
    return {
      orders: orders.data,
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
      title: 'Orders',
      canceled: 'label-danger',
      pending: 'label-warning',
      processing: 'label-info',
      delivered: 'label-info',
      orders: [],
    };
  },
  head() {
    return {
      meta: [
        {
          hid: 'robots',
          name: 'robots',
          content: 'noindex,nofollow',
        },
      ],
    };
  },
  methods: {
    getClass(status) {
      return this[status];
    },
  },
};
</script>
