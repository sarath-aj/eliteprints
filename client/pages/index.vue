<template>
  <div class="container">
    <div class="heading_s2 mb-3 mt-3">
      <h4>Featured Products</h4>
    </div>
    <div class="row">
      <div
        v-for="(product, index) in featuredProducts"
        :key="index"
        class="col-md-3 col-6"
      >
        <div class="item">
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
              </div>
            </div>
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
  async asyncData({ $axios }) {
    const response = await $axios.$get('featured');

    return {
      featuredProducts: response.data.featured_products,
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
      featuredProducts: null,
    };
  },
  computed: {
    backendURL() {
      return process.env.backendURL;
    },
  },
};
</script>
