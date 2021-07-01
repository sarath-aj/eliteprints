<template>
  <div>
    <Header />
    <nuxt />
    <ScrollToTop />
    <CookieConsent />
    <Footer />
  </div>
</template>

<script>
import ScrollToTop from '@/components/utilities/ScrollToTop.vue';
import CookieConsent from '@/components/utilities/CookieConsent.vue';
import Header from './partials/Header.vue';
import Footer from './partials/Footer.vue';

export default {
  components: {
    Header,
    Footer,
    ScrollToTop,
    CookieConsent,
  },
  data() {
    return {
      title: 'ElitePrints | Home',
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
        { rel: 'stylesheet', href: '/css/styles.css' },
        { rel: 'stylesheet', href: '/css/mediaquery.css' },
        { rel: 'stylesheet', href: '/css/address.css' },
        { rel: 'stylesheet', href: '/css/ionicons.min.css' },
        { rel: 'stylesheet', href: '/css/themify-icons.css' },
        { rel: 'stylesheet', href: '/css/linearicons.css' },
        { rel: 'stylesheet', href: '/css/flaticon.css' },
        { rel: 'stylesheet', href: '/css/simple-line-icons.css' },
        {
          rel: 'stylesheet',
          href: 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',
        },
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
