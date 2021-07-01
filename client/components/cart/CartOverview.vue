<template>
  <table class="table">
    <thead>
      <tr>
        <th class="product-thumbnail">Image</th>
        <th class="product-name">Product</th>
        <th class="product-quantity">Quantity</th>
        <th class="product-price">Price</th>
        <th class="product-remove">Remove</th>
      </tr>
    </thead>
    <tbody>
      <CartOverviewProduct
        v-for="product in products"
        :key="product.id"
        :product="product"
      />
      <tr>
        <td />
        <td />
        <td class="heading_s1">
          <h6>Subtotal</h6>
        </td>
        <td>
          <vue-autonumeric v-model="subtotal" :options="options" tag="strong" />
        </td>
        <td />
      </tr>
      <slot name="rows" />
    </tbody>
  </table>
</template>

<script>
import { mapGetters } from 'vuex';
import VueAutonumeric from '@/node_modules/vue-autonumeric/src/components/VueAutonumeric.vue';
import CartOverviewProduct from './CartOverviewProduct.vue';

export default {
  components: {
    CartOverviewProduct,
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
    };
  },
  computed: {
    ...mapGetters({
      empty: 'cart/empty',
      products: 'cart/products',
      subtotal: 'cart/subtotal',
    }),
  },
};
</script>
