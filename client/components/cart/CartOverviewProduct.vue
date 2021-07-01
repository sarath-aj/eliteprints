<template>
  <tr>
    <td class="product-thumbnail">
      <img
        style="max-width: 80px; max-height: 100px"
        :src="backendURL + product.product.main_image"
        :alt="product.product.name"
      />
    </td>
    <td class="product-name">
      <nuxt-link :to="'/products/' + product.product.slug">
        {{ product.product.name }}
      </nuxt-link>
      <small>({{ product.type }} : {{ product.name }})</small>
    </td>
    <td class="product-quantity">
      <div class="quantity">
        <select v-model="quantity">
          <option v-if="product.quantity === 0" value="0">0</option>
          <option
            v-for="x in product.stock_count"
            :key="x"
            :value="x"
            :selected="x === product.quantity"
          >
            {{ x }}
          </option>
        </select>
      </div>
    </td>

    <vue-autonumeric
      v-model="product.total"
      class="product-price"
      :options="options"
      tag="td"
    />
    <!--     <td class="product-price">
      {{ product.total }}

    </td> -->
    <td class="product-remove">
      <a
        href="#"
        class="remove-cart-button"
        @click.prevent="attemptDestroy(product.id)"
        ><i class="ti-close"
      /></a>
    </td>
  </tr>
</template>

<script>
/* eslint-disable vue/no-mutating-props */
import VueAutonumeric from '@/node_modules/vue-autonumeric/src/components/VueAutonumeric.vue';
import { mapActions, mapGetters } from 'vuex';

export default {
  components: {
    VueAutonumeric,
  },
  props: {
    product: {
      type: Object,
      required: true,
    },
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
      subtotal: 'cart/subtotal',
    }),
    backendURL() {
      return process.env.backendURL;
    },

    quantity: {
      get() {
        return this.product.quantity;
      },

      set(quantity) {
        this.update({
          productId: this.product.id,
          quantity,
        });
      },
    },
  },

  methods: {
    ...mapActions({
      destroy: 'cart/destroy',
      update: 'cart/update',
    }),

    attemptDestroy(id) {
      if (confirm('Are you sure?')) {
        this.destroy(id);
      }
    },
  },
};
</script>
