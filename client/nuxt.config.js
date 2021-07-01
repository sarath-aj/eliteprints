import webpack from 'webpack';
// import i18n from './config/i18n';
const axios = require('axios');

export default {
  mode: 'universal',
  // Global page headers (https://go.nuxtjs.dev/config-head)
  head: {
    title: 'ElitePrints',
    htmlAttrs: {
      lang: 'en',
      dir: 'ltr',
    },
    meta: [
      { charset: 'utf-8' },
      {
        name: 'viewport',
        content: 'width=device-width, initial-scale=1, viewport-fit=cover',
      },
      { name: 'msvalidate.01', content: '0ECC88FC7CAA69CB1C34BA330A924572' },
      { name: 'apple-mobile-web-app-capable', content: 'yes' },
      { name: 'apple-mobile-web-app-status-bar-style', content: 'black' },
      {
        hid: 'description',
        name: 'description',
        content:
          "Buy the Best T-shirts from ElitePrints Stress no more about going store to store to find your perfect T-shirt. Whether it is girls or boys' T-shirts, pick a style that best reflects your style.",
      },
    ],
    noscript: [{ innerHTML: 'To use this site please enable javascript.' }],
    link: [
      { rel: 'shortcut icon', type: 'image/x-icon', href: '/favicon.png' },
      {
        rel: 'apple-touch-icon',
        type: 'image/x-icon',
        href: '/apple-touch-icon.png',
      },
      {
        rel: 'stylesheet',
        href: 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css',
        body: true,
      },
    ],
    script: [
      {
        src: 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js',
        body: true,
      },
      {
        body: false,
        type: 'application/ld+json',
        json: {
          '@context': 'https://schema.org',
          '@type': 'Organization',
          Name: 'ElitePrints',
          URL: 'https://eliteprints.herokuapp.com',
          contactPoint: [
            {
              '@type': 'ContactPoint',
              telephone: '4444-555-333',
              contactType: 'Customer Service',
            },
          ],
        },
      },
    ],
  },

  // Global CSS (https://go.nuxtjs.dev/config-css)
  css: [],

  // Plugins to run before rendering page (https://go.nuxtjs.dev/config-plugins)
  plugins: [
    '~/plugins/Vuelidate',
    '~/plugins/toastr',
    './plugins/mixins/user.js',
    {
      src: '~/plugins/RangeSlider',
      mode: 'client',
    },
    {
      src: '~/plugins/lingallery',
      ssr: false,
    },
    {
      src: '~/plugins/vue-product-zoomer',
      ssr: false,
    },
    {
      src: '~/plugins/auto-numeric.js',
      ssr: false,
    },
    // { src: '~/plugins/axe.js', mode: 'client', ssr: false }
  ],
  // Auto import components (https://go.nuxtjs.dev/config-components)
  components: true,

  // Modules for dev and build (recommended) (https://go.nuxtjs.dev/config-modules)
  buildModules: [
    '@nuxtjs/eslint-module',
    '@nuxtjs/stylelint-module',
    '@nuxtjs/composition-api/module',
    // 'nuxt-purgecss',
    // '@nuxtjs/html-validator',
    '@nuxtjs/pwa',
  ],
  router: {
    middleware: 'maintenance',
    linkExactActiveClass: '',
    linkActiveClass: '',
  },
  purgeCSS: {
    mode: 'postcss',
    enabled: true, // or `false` when in dev/debug mode
    paths: [
      'components/**/*.vue',
      'layouts/**/*.vue',
      'pages/**/*.vue',
      'plugins/**/*.js',
    ],
    styleExtensions: ['.css'],
    whitelist: ['body', 'html', 'nuxt-progress'],
    extractors: [
      {
        extractor: (content) => content.match(/[A-z0-9-:\\/]+/g) || [],
        extensions: ['html', 'vue', 'js'],
      },
    ],
  },

  // Modules (https://go.nuxtjs.dev/config-modules)
  modules: [
    'cookie-universal-nuxt',
    '@nuxtjs/axios',
    '@nuxtjs/auth',
    '@nuxtjs/dotenv',
    'nuxt-purgecss',
    [
      '@nuxtjs/redirect-module',
      {
        // Redirect option here
        redirect: [
          // { from: '^/myoldurl', to: '/mynewurl' }
        ],
      },
    ],

    [
      '@nuxtjs/gtm',
      {
        gtm: {
          id: 'GTM-WF4MT2J', // Used as fallback if no runtime config is provided
        },

        publicRuntimeConfig: {
          gtm: {
            id: process.env.GOOGLE_TAG_MANAGER_ID,
          },
        },
      },
    ],
    [
      '@nuxtjs/robots',
      {
        robots: {
          UserAgent: '*',
          Disallow: '/',
          Disallow: '/admin',
          Disallow: '/checkout',
          Disallow: '/cart',
          Disallow: '/maintenance',
          Sitemap: 'https://eliteprints.herokuapp.com/sitemap.xml',
        },
      },
    ],
    '@nuxtjs/sitemap',
    // [
    //   'nuxt-i18n',
    //   {
    //     vueI18nLoader: true,
    //     defaultLocale: 'en',
    //      locales: [
    //       {
    //          code: 'en',
    //          name: 'English'
    //       },
    //       {
    //          code: 'fr',
    //          name: 'Français'
    //       }
    //     ],
    //     vueI18n: i18n
    //   }
    // ],
  ],

  // Axios module configuration (https://go.nuxtjs.dev/config-axios)
  axios: {
    baseURL: 'https://mighty-cliffs-93649.herokuapp.com/api/',
    // baseURL: 'http://localhost:8000/api/',
  },
  // Sitemap
  sitemap: {
    hostname: 'https://eliteprints.herokuapp.com',
    gzip: true,
    cacheTime: 1000 * 60 * 15,
    exclude: [
      '/admin',
      '/admin/**',
      '/customer/**',
      '/checkout',
      '/cart',
      '/maintenance',
    ],
    defaults: {
      changefreq: 'daily',
      priority: 1,
      lastmod: new Date(),
    },
    routes: async () => {
      const response = await axios.get(
        'https://mighty-cliffs-93649.herokuapp.com/api/products-sitemap'
      );
      return response.data.data.map((product) => `/products/${product.slug}`);
    },
  },
  auth: {
    strategies: {
      user: {
        _scheme: 'local',
        endpoints: {
          login: {
            url: 'login',
            method: 'post',
            propertyName: 'meta.token',
          },
          user: {
            url: 'user',
            method: 'get',
            propertyName: 'data',
          },
          logout: {
            url: 'logout',
            method: 'post',
          },
        },
        //     redirect: {
        //   login: '/admin',
        //   logout: '/',
        //   callback: '/admin/login',
        //   home: '/'
        // }
      },
      admin: {
        _scheme: 'local',
        endpoints: {
          login: {
            url: 'admin/login',
            method: 'post',
            propertyName: 'meta.token',
          },
          user: {
            url: 'admin/user',
            method: 'get',
            propertyName: 'data',
          },
          logout: {
            url: 'admin/logout',
            method: 'post',
          },
        },
        redirect: {
          login: '/admin/login',
          logout: '/',
          callback: '/admin/login',
          home: '/admin',
        },
      },
    },
  },
  // Run ESLint on save

  // Build Configuration (https://go.nuxtjs.dev/config-build)
  build: {
    extend(config, ctx) {
      config.resolve.alias.AutoNumeric =
        '~/node_modules/autonumeric/dist/autoNumeric.min';

      if (ctx.isDev && ctx.isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/,
        });
      }
    },

    html: {
      minify: {
        collapseBooleanAttributes: true,
        decodeEntities: true,
        minifyCSS: true,
        minifyJS: true,
        processConditionalComments: true,
        removeEmptyAttributes: true,
        removeRedundantAttributes: true,
        trimCustomFragments: true,
        useShortDoctype: true,
        minifyURLs: true,
        removeComments: true,
        removeEmptyElements: true,
        preserveLineBreaks: false,
        collapseWhitespace: true,
      },
    },

    /**
     * add external plugins
     */
    plugins: [
      new webpack.ProvidePlugin({
        // global modules
        _: 'lodash',
      }),
    ],
  },
};
