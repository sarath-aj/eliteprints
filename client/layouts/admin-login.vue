<template>
  <!-- Page Container -->
  <div id="page-container">
    <nuxt />
  </div>
  <!-- END Page Container -->
</template>

<script>
export default {
  components: {},
  data() {
    return {};
  },

  head: {
    titleTemplate: '',
    link: [
      {
        rel: 'stylesheet',
        href: 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap',
      },
      { rel: 'stylesheet', href: '/admin/css/admin-login.css' },
    ],
  },
};
</script>
