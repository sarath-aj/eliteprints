<template>
  <table class="table is-hoverable is-fullwidth">
    <tbody>
      <tr v-for="payment in paymentMethods" :key="payment.id">
        <td>
          <div class="address-item-selected">
            <div class="address-item is-default" data-id="5">
              <p
                class="address"
                title="my address, door no 1, my city, my state, Bahamas"
              >
                {{ payment.card_type }} ending {{ payment.last_four }}
              </p>
              <a
                href="#"
                class="default"
                @click.prevent="$emit('selected', payment)"
                >Pay with this</a
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
  props: {
    paymentMethods: {
      type: Array,
      required: true,
    },

    selectedPaymentMethod: {
      type: Object,
      required: true,
    },
  },
};
</script>
