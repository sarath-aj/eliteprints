module.exports = {
  root: true,
  env: {
    browser: true,
    node: true,
    // jest/globals: true,
    // cypress/globals: true
  },
  globals: {
    toastr: true,
    _: true,
    $: true,
  },
  parserOptions: {
    parser: 'babel-eslint',
  },
  extends: [
    '@nuxtjs',
    'plugin:prettier/recommended',
    'plugin:nuxt/recommended',

    // 'plugin:jest/all',
    // 'plugin:jest-formatting/strict',
    // 'plugin:cypress/recommended'

    // typescript
    // '@nuxtjs/eslint-config-typescript',
    // 'plugin:prettier/recommended',
    // 'plugin:nuxt/recommended',
  ],
  plugins: [
    // 'jest',
    // "jest-formatting",
    //  "cypress"
  ],

  // add your custom rules here
  rules: {
    'prettier/prettier': [
      'error',
      {
        endOfLine: 'auto',
      },
    ],
    'vue/no-mutating-props': 'off',
    // 'no-console': process.env.NODE_ENV === 'production' ? 'error' : 'off',
    // "no-debugger": process.env.NODE_ENV === "production" ? "error" : "off"
    // "vue/component-name-in-template-casing": ["error", "PascalCase"],
  },
};
