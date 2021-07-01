<template>
  <div>
    <div class="breadcrumb_section bg_gray page-title-mini">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="page-title">
              <h1>{{ title }}</h1>
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
                <a href="/" itemprop="item" title="Home">
                  Home
                  <meta itemprop="name" content="Home" />
                </a>
              </li>
              <li class="breadcrumb-item active">
                {{ title }}
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <div class="row shop_container grid">
              <template v-if="products.length">
                <ShirtProduct
                  v-for="product in products"
                  :key="product.id"
                  :product="product"
                />
              </template>
              <template v-else> No results found </template>
            </div>
            <pagination
              v-if="meta.total"
              :meta="meta"
              @pagination:switched="switchPage"
            />
          </div>

          <filters />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import queryString from 'query-string';
import ShirtProduct from '@/components/product/ShirtProduct';
import pagination from '@/components/pagination/pagination';
import filters from '@/components/filters/Filters';

export default {
  components: {
    ShirtProduct,
    pagination,
    filters,
  },
  async asyncData({ $axios, route, params, app }) {
    const filters = route.query;
    const response = await $axios.$get('filter-products/women', {
      params: {
        page: route.query.page,
        ...filters,
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
      title: 'Women T-Shirts',
      products: [],
      meta: null,
    };
  },
  head() {
    return {
      title: this.title,
    };
  },
  watch: {
    '$route.query': {
      handler(query) {
        this.getProducts(1, query);
      },
      deep: true,
    },
  },
  methods: {
    setQueryParameters() {
      const filtersQueryString = queryString.stringify(
        _.omit(this.$route.query, ['page']),
        { encode: false }
      );
      history.replaceState(
        null,
        null,
        '?page=' + this.$route.query.page + '&' + filtersQueryString
      );
    },
    async getProducts(
      page = this.$route.query.page,
      filters = this.$route.query
    ) {
      await this.$axios
        .get('filter-products/women', {
          params: {
            page,
            ...filters,
          },
        })
        .then((response) => {
          this.products = response.data.data;
          this.meta = response.data.meta;
          if (this.$route.query.page) {
            this.setQueryParameters();
          }
        });
    },
    switchPage(page) {
      const filters = this.$route.query;
      this.$router.replace({
        query: {
          ...filters,
          page,
        },
      });
    },
  },
};
</script>
