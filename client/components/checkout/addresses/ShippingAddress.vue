<template>
  <article class="message">
    <div class="message-body">
      <h5 class="title is-5">Ship to</h5>

      <template v-if="selecting">
        <ShippingAddressSelector
          :addresses="addresses"
          :selected-address="selectedAddress"
          @selected="select"
        />
      </template>
      <template v-else-if="creating">
        <ShippingAddressCreator
          :local-addresses="localAddresses"
          @cancel="creating = false"
          @created="create"
        />
      </template>
      <template v-else>
        <template v-if="selectedAddress">
          <div class="address-item-selected">
            <div class="address-item is-default" data-id="5">
              <p class="name">{{ selectedAddress.name }}</p>
              <p class="address">
                {{ selectedAddress.address }} , {{ selectedAddress.city }} ,
                {{ selectedAddress.postal_code }},{{
                  selectedAddress.country.name
                }}
              </p>
              <p class="phone">Phone: {{ user.mobile || 'N/A' }}</p>
              <p class="phone">Email: {{ user.email }}</p>
              <span class="default">Default</span>
            </div>
          </div>

          <br />
        </template>

        <div class="field is-grouped">
          <div class="control">
            <a
              v-if="selectedAddress"
              href=""
              class="btn btn-fill-out btn-sm"
              @click.prevent="selecting = true"
              >Change shipping address</a
            >
            <a
              href=""
              class="btn btn-fill-out btn-sm"
              @click.prevent="creating = true"
              >Add an address</a
            >
          </div>
          <div class="control"></div>
        </div>
      </template>
    </div>
  </article>
</template>

<script>
import ShippingAddressSelector from './ShippingAddressSelector.vue';
import ShippingAddressCreator from './ShippingAddressCreator.vue';

export default {
  components: {
    ShippingAddressSelector,
    ShippingAddressCreator,
  },
  mixins: ['user'],

  props: {
    addresses: {
      type: Array,
      required: true,
    },
  },

  data() {
    return {
      selecting: false,
      creating: false,
      localAddresses: this.addresses,
      selectedAddress: null,
    };
  },

  computed: {
    defaultAddress() {
      return this.localAddresses.find((address) => address.is_default === 1);
    },
  },

  watch: {
    selectedAddress(address) {
      this.$emit('input', address.id);
    },
  },

  created() {
    if (this.addresses.length) {
      this.switchAddress(this.defaultAddress);
    }
  },

  methods: {
    switchAddress(address) {
      this.selectedAddress = address;
    },

    select(address) {
      this.switchAddress(address);
      this.selecting = false;
    },

    create(address) {
      this.localAddresses.push(address);
      this.creating = false;

      this.switchAddress(address);
    },
  },
};
</script>
