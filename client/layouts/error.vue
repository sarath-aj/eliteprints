<template>
  <div>
    <div v-if="error.statusCode === 404" class="mainbox">
      <div class="err">4</div>
      <i class="far fa-question-circle fa-spin" />
      <div class="err2">4</div>
      <div class="msg">
        Maybe this page moved? Got deleted? Is hiding out in quarantine? Never
        existed in the first place?
        <p>Let's go <a href="/">home</a> and try from there.</p>
      </div>
    </div>
    <h1 v-else>An error occurred</h1>
  </div>
</template>
<!-- purple x moss 2020 -->

<script>
export default {
  layout: 'error-layout',
  props: {
    error: {
      type: Object,
      default: null,
    },
  },
  data() {
    return {
      title: 'ElitePrints',
    };
  },
  head() {
    return {
      title: this.title,
      link: [
        { rel: 'stylesheet', href: '/css/error.css' },
        {
          rel: 'stylesheet',
          href: 'https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600;900&display=swap',
        },
      ],
      script: [
        {
          src: 'https://kit.fontawesome.com/4b9ba14b0f.js',
          crossorigin: 'anonymous',
        },
      ],
    };
  },
};
</script>
