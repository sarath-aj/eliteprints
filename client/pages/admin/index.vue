<template>
  <main id="main-container">
    <div class="content">
      <div class="row">
        <div class="col-6 col-lg-3">
          <nuxt-link
            to="/admin/orders"
            class="block block-rounded block-link-shadow text-center"
          >
            <div class="block-content block-content-full">
              <div class="font-size-h2 text-primary">
                {{ reports.orders_today }}
              </div>
            </div>
            <div class="block-content py-2 bg-body-light">
              <p class="font-w600 font-size-sm text-muted mb-0">ORDERS TODAY</p>
            </div>
          </nuxt-link>
        </div>
        <div class="col-6 col-lg-3">
          <nuxt-link
            to="/admin/orders"
            class="block block-rounded block-link-shadow text-center"
          >
            <div class="block-content block-content-full">
              <div class="font-size-h2 text-warning">
                {{ reports.pending_orders }}
              </div>
            </div>
            <div class="block-content py-2 bg-body-light">
              <p class="font-w600 font-size-sm text-muted mb-0">
                PENDING ORDERS
              </p>
            </div>
          </nuxt-link>
        </div>
        <div class="col-6 col-lg-3">
          <nuxt-link
            to="/admin/customers"
            class="block block-rounded block-link-shadow text-center"
          >
            <div class="block-content block-content-full">
              <div class="font-size-h2 text-success">
                {{ reports.total_customers }}
              </div>
            </div>
            <div class="block-content py-2 bg-body-light">
              <p class="font-w600 font-size-sm text-muted mb-0">
                TOTAL CUSTOMERS
              </p>
            </div>
          </nuxt-link>
        </div>
        <div class="col-6 col-lg-3">
          <nuxt-link
            to="/admin/products"
            class="block block-rounded block-link-shadow text-center"
          >
            <div class="block-content block-content-full">
              <div class="font-size-h2 text-success">
                {{ reports.total_products }}
              </div>
            </div>
            <div class="block-content py-2 bg-body-light">
              <p class="font-w600 font-size-sm text-muted mb-0">
                TOTAL PRODUCTS
              </p>
            </div>
          </nuxt-link>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  layout: 'admin',
  middleware: 'auth-admin',
  async asyncData({ $axios, params, app }) {
    const response = await $axios.get('admin/reports');
    return {
      reports: response.data.data,
    };
  },
  data() {
    return {
      title: 'Reports',
      reports: {},
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
};
</script>
