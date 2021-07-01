<template>
  <div class="card">
    <div class="card-header">
      <div class="float-left">
        <h3>My Addresses</h3>
      </div>
      <div class="float-right">
        <nuxt-link
          to="address/create"
          class="add-address btn btn-fill-out btn-sm"
        >
          <span>Add a new address</span>
        </nuxt-link>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Address</th>
              <th>Is default?</th>
              <th>Actions</th>
            </tr>
          </thead>
          <CustomerAddress :addresses="addresses" />
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import CustomerAddress from '@/components/customer/address/CustomerAddress.vue';

export default {
  components: {
    CustomerAddress,
  },
  layout: 'customer',
  middleware: 'auth',

  async asyncData({ $axios, params, app }) {
    const addresses = await $axios.$get('customer/addresses');

    return {
      addresses: addresses.data,
    };
  },
  data() {
    return {
      title: 'Addresses',
      addresses: [],
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
};
</script>
