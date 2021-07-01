<template>
  <div>
    <Breadcrumb />
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-md-5 mb-4 mb-md-0">
            <div class="product-image">
              <lingallery
                :iid.sync="currentId"
                :width="width"
                :height="height"
                :items="items"
              />
            </div>
            <!--                 <div class="product-image">
                    <div class="product_img_box">
                        <img style="max-width: 100%; max-width:100%;" id="product_img" :src="backendURL + product.main_image" alt="Samsung Smart Phone">
                    </div>
                    <div id="pr_item_gallery" class="product_gallery_item">
                            <a href="#" class="product_gallery_item  active ">
                                    <img :src="backendURL + 'storage/products/8-p-150x150.jpg'" alt="Samsung Smart Phone">
                                </a>
                              <a href="#" class="product_gallery_item  active ">
                                    <img src="http://localhost:8001/storage/products/8-p-150x150.jpg" alt="Samsung Smart Phone">
                                </a>
                    </div>
                </div> -->
          </div>

          <div class="col-lg-7 col-md-7">
            <div class="pr_detail">
              <div class="product_description">
                <h4 class="product_title">
                  <nuxt-link :to="product.slug">
                    {{ product.name }}
                  </nuxt-link>
                </h4>
                <div class="product_price">
                  <vue-autonumeric
                    v-model="product.price"
                    class="price"
                    :options="options"
                    tag="span"
                  />
                </div>
                <div class="clearfix" />
                <div class="pr_desc">
                  <p />
                  <p>{{ product.description }}</p>
                  <p />
                </div>
                <div class="clearfix" />
                <div
                  v-if="!product.in_stock"
                  class="error-message text-danger text-center pr_desc"
                >
                  Product is out of stock!
                </div>

                <div class="pr_switch_wrap">
                  <form @submit.prevent="add">
                    <ProductVariationType
                      v-for="(variations, type) in product.variations"
                      :key="type"
                      v-model="form.variation"
                      :type="type"
                      :variations="variations"
                    />

                    <div v-if="form.variation">
                      <div class="row">
                        <div class="col-3">
                          <div class="form-group">
                            <select
                              id=""
                              v-model="form.quantity"
                              class="form-control form-control-sm"
                              name=""
                            >
                              <option
                                v-for="x in parseInt(
                                  form.variation.stock_count
                                )"
                                :key="x"
                                :value="x"
                              >
                                {{ x }}
                              </option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <button
                        v-if="authenticated"
                        class="btn btn-fill-out btn-addtocart"
                      >
                        Add to cart
                      </button>
                      <div v-else>
                        Please
                        <nuxt-link :to="link()"> Sign in </nuxt-link>
                        to buy this product
                      </div>
                    </div>
                  </form>
                </div>
                <hr />

                <ul class="product-meta">
                  <li>Product Code: {{ product.product_code }}</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-12">
            <p>
              {{ product.description }}
            </p>
            <p>- Colour: {{ product.color }}</p>
            <p>- Sleeve Type: {{ product.sleeve }}</p>
            <p>- Neck Style: {{ product.neck }}</p>
            <p>- Fit Type: {{ product.fit }} Fit</p>
            <br />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import ProductVariationType from '@/components/products/ProductVariationType.vue';
import Breadcrumb from '@/layouts/partials/Breadcrumb.vue';
import VueAutonumeric from '@/node_modules/vue-autonumeric/src/components/VueAutonumeric.vue';

export default {
  components: {
    ProductVariationType,
    Breadcrumb,
    VueAutonumeric,
  },
  validate({ params }) {
    return /^[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*$/.test(params.slug);
  },
  async asyncData({ $axios, params, app }) {
    const response = await $axios.$get(`products/${params.slug}`);
    const structuredData = {
      '@context': 'https://schema.org',
      '@type': 'Product',
      name: response.data.name,
      image: process.env.backendURL + response.data.main_image,
      sku: response.data.product_code,
      mpn: response.data.product_code,
      description: response.data.description,
      offers: {
        '@type': 'Offer',
        priceCurrency: 'USD',
        availability: response.data.in_stock ? 'InStock' : 'OutOfStock',
        price: response.data.price,
        url: process.env.backendURL + 'products/' + response.data.slug,
      },
      brand: {
        '@type': 'Thing',
        name: response.data.name,
      },
    };
    if (response.data.image_gallery) {
      const imageGallery = response.data.image_gallery;

      const items = imageGallery.map((k) => ({
        src: process.env.backendURL + k,
        thumbnail: process.env.backendURL + k,
      }));
      items.unshift({
        src: process.env.backendURL + response.data.main_image,
        thumbnail: process.env.backendURL + response.data.main_image,
      });
      return {
        structuredData,
        product: response.data,
        items,
      };
    } else {
      return {
        structuredData,
        product: response.data,
        items: [
          {
            src: process.env.backendURL + response.data.main_image,
            thumbnail: process.env.backendURL + response.data.main_image,
          },
        ],
      };
    }
  },

  data() {
    return {
      structuredData: {},
      options: {
        alwaysAllowDecimalCharacter: true,
        caretPositionOnFocus: 'start',
        currencySymbol: '$',
        readOnly: true,
      },
      product: null,
      form: {
        variation: null,
        quantity: 1,
      },
      width: 750,
      height: 550,
      startImage: 0,
      items: [],
      currentId: null,
    };
  },
  head() {
    return {
      title: this.product.name,
      meta: [
        {
          hid: 'description',
          name: 'description',
          content: this.product.description,
        },
        {
          hid: 'twitter:title',
          name: 'twitter:title',
          content: 'Buy' + this.product.name + ' | ElitePrints',
        },
        {
          hid: 'twitter:description',
          name: 'twitter:description',
          content: this.product.description,
        },
        {
          hid: 'twitter:image',
          name: 'twitter:image',
          content: process.env.backendURL + this.product.main_image,
        },
        {
          hid: 'twitter:site',
          name: 'twitter:site',
          content: '@ElitePrints',
        },
        {
          hid: 'og:title',
          property: 'og:title',
          content: 'Buy' + this.product.name + ' | ElitePrints',
        },
        {
          hid: 'og:type',
          property: 'og:type',
          content: 'website',
        },
        {
          hid: 'og:url',
          property: 'og:url',
          content: process.env.HOSTNAME + this.$route.fullPath,
        },
        {
          hid: 'og:site_name',
          property: 'og:site_name',
          content: 'ElitePrints',
        },
        {
          hid: 'og:description',
          property: 'og:description',
          content: this.product.description,
        },
        {
          hid: 'og:image',
          property: 'og:image',
          content: process.env.backendURL + this.product.main_image,
        },
      ],
      script: [{ type: 'application/ld+json', json: this.structuredData }],
    };
  },
  computed: {
    backendURL() {
      return process.env.backendURL;
    },
  },
  watch: {
    'form.variation'() {
      this.form.quantity = 1;
    },
  },
  methods: {
    ...mapActions({
      store: 'cart/store',
    }),

    add() {
      this.store([
        {
          id: this.form.variation.id,
          quantity: this.form.quantity,
        },
      ]);

      this.form = {
        variation: null,
        quantity: 1,
      };
      toastr.options = {
        positionClass: 'toast-top-right',
      };
      toastr.success('Added to cart');
    },
    link() {
      return `/login?redirect=products/${this.product.slug}`;
    },
  },
};
</script>

<style>
.product_img_box {
  height: 430px;
  width: 430px;
}
</style>
