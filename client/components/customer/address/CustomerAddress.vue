<template>
  <tbody>
    <tr v-for="address in addresses" :key="address.id">
      <td style="white-space: inherit">
        <p>
          {{ address.name }}, {{ address.address }}, {{ address.state }},
          {{ address.city }}, {{ address.postal_code }},
          {{ address.country.name }}
        </p>
      </td>
      <td style="width: 120px">
        {{ address.is_default == 1 ? 'Yes' : 'No' }}
      </td>
      <td style="width: 100px">
        <nuxt-link
          class="btn btn-fill-out btn-sm"
          :to="{ name: 'customer-address-edit-id', params: { id: address.id } }"
        >
          Edit
        </nuxt-link>
        <a
          class="btn btn-fill-out btn-sm"
          href="#"
          @click.prevent="attemptDestroy(address.id)"
          >Remove</a
        >
      </td>
    </tr>

    <tr>
      <td v-if="!addresses.length" colspan="5" class="text-center">
        No address!
      </td>
    </tr>
  </tbody>
</template>

<script>
export default {
  props: {
    addresses: {
      type: Array,
      required: true,
    },
  },
  methods: {
    async attemptDestroy(addressid) {
      if (confirm('Are you sure?')) {
        await this.$axios.$delete(`addresses/${addressid}`);
        this.$router.go();
      }
    },
  },
};
</script>
