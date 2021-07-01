<template>
  <div>
    <Breadcrumb />
    <div class="section">
      <div class="container">
        <form class="form--shopping-cart">
          <div class="row">
            <div class="col-12">
              <div v-if="products.length" class="table-responsive">
                <CartOverview />
              </div>
              <p v-else class="text-center">Your cart is empty!</p>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <nuxt-link
                v-if="products.length"
                :to="{ name: 'checkout' }"
                class="btn btn-block btn-fill-out"
              >
                Checkout
              </nuxt-link>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import CartOverview from '@/components/cart/CartOverview.vue';
import Breadcrumb from '@/layouts/partials/Breadcrumb.vue';

export default {
  components: {
    CartOverview,
    Breadcrumb,
  },
  data() {
    return {
      title: 'Your Cart',
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
  computed: {
    ...mapGetters({
      empty: 'cart/empty',
      products: 'cart/products',
      changed: 'cart/changed',
    }),
  },
};
</script>
