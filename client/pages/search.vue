<template>
  <div>
    <div class="breadcrumb_section bg_gray page-title-mini">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="page-title">
              <h1>Search result for "{{ searchQuery }}"</h1>
            </div>
          </div>
          <div class="col-md-6">
            <ol
              class="breadcrumb justify-content-md-end"
              itemscope=""
              itemtype="http://schema.org/BreadcrumbList"
            >
              <li
                class="breadcrumb-item"
                itemprop="itemListElement"
                itemscope=""
                itemtype="http://schema.org/ListItem"
              >
                <meta itemprop="position" content="1" />
                <a href="/search" itemprop="item" title="Home">
                  Home
                  <meta itemprop="name" content="Home" />
                </a>
              </li>
              <li class="breadcrumb-item active">Search</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="row shop_container grid">
              <ShirtProduct
                v-for="product in products"
                :key="product.id"
                :product="product"
              />
              <div v-if="!products.length" class="col-12 text-center">
                No products found!
              </div>
              <pagination
                v-if="meta.current_page"
                :meta="meta"
                @pagination:switched="switchPage"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ShirtProduct from '@/components/product/ShirtProduct';
import pagination from '@/components/pagination/pagination';
export default {
  components: {
    ShirtProduct,
    pagination,
  },
  async asyncData({ $axios, route, params, app }) {
    const response = await $axios.$get('search', {
      params: {
        page: route.query.page,
        s: route.query.s,
      },
    });

    const products = response.data;
    const meta = response.meta;
    return {
      products,
      meta,
    };
  },
  data() {
    return {
      title: 'Search results "' + this.$route.query.s + '"',
      searchQuery: this.$route.query.s,
      products: [],
      meta: {},
    };
  },
  head() {
    return {
      title: this.title,
    };
  },
  watch: {
    $route() {
      this.getProducts();
    },
  },
  watchQuery: ['s'],
  methods: {
    async getProducts(page = this.$route.query.page) {
      const response = await this.$axios.$get('search', {
        params: {
          page,
          s: this.$route.query.s,
        },
      });
      this.products = response.data;
      this.meta = response.meta;
    },

    switchPage(page, s) {
      this.$router.replace({
        name: 'search',
        query: {
          page,
          s,
        },
      });
    },
  },
};
</script>
