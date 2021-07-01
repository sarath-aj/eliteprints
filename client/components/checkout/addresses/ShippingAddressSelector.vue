<template>
  <table class="table is-hoverable is-fullwidth mt-4">
    <tbody>
      <tr v-for="address in addresses" :key="address.id">
        <td>
          <p
            :class="{
              'has-text-weight-bold': address.id === selectedAddress.id,
            }"
          />

          <div class="address-item-selected">
            <div class="address-item is-default" data-id="5">
              <p class="name">
                {{ address.name }}
              </p>
              <p class="address">
                {{ address.address }} , {{ address.city }} ,
              </p>
              <p class="phone">Phone: {{ user.mobile || 'N/A' }}</p>
              <p class="phone">Email: {{ user.email }}</p>
              <a
                href="#"
                class="default"
                @click.prevent="$emit('selected', address)"
                >Ship here</a
              >
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  mixins: ['user'],
  props: {
    addresses: {
      type: Array,
      required: true,
    },

    selectedAddress: {
      type: Object,
      required: true,
    },
  },
};
</script>
