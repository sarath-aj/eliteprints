<template>
  <div>
    <nuxt />
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: 'Checkout',
    };
  },
  head() {
    return {
      title: this.title,
      link: [
        {
          rel: 'stylesheet',
          href: 'https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap',
        },
        { rel: 'stylesheet', href: '/bootstrap/css/bootstrap.min.css' },
        { rel: 'stylesheet', href: '/css/checkout.css' },
        { rel: 'stylesheet', href: '/css/mediaquery.css' },
        { rel: 'stylesheet', href: '/css/address.css' },
        { rel: 'stylesheet', href: '/css/ionicons.min.css' },
        { rel: 'stylesheet', href: '/css/themify-icons.css' },
        { rel: 'stylesheet', href: '/css/linearicons.css' },
        { rel: 'stylesheet', href: '/css/flaticon.css' },
        { rel: 'stylesheet', href: '/css/simple-line-icons.css' },
      ],
      script: [
        {
          src: '/js/jquery-3.5.1.min.js',
        },
        {
          src: '/js/popper.min.js',
          body: true,
        },
        {
          src: '/bootstrap/js/bootstrap.min.js',
          body: true,
        },

        { src: 'https://js.stripe.com/v3/' },
      ],
    };
  },
};
</script>
