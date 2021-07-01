<template>
  <div class="col-md-3 col-6">
    <div class="product">
      <div class="product_wrap">
        <div class="product_img">
          <img :src="backendURL + product.main_image" :alt="product.name" />
        </div>
        <div class="product_info">
          <h6 class="product_title">
            <nuxt-link :to="'products/' + product.slug">
              {{ product.name }}
            </nuxt-link>
          </h6>
          <div class="product_price">
            <vue-autonumeric
              v-model="product.price"
              class="price"
              :options="options"
              tag="span"
            />
            <!-- <span class="price">{{ product.price }}</span> -->
          </div>
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
  props: {
    // eslint-disable-next-line vue/require-default-prop
    product: {
      type: Object,
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
    backendURL() {
      return process.env.backendURL;
    },
  },
};
</script>
