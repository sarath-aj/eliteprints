<template lang="html">
  <div class="content">
    <div class="maintenance">
      <h1>Maintenance Mode</h1>
      <h1>Nuxt.js @code4mk</h1>
    </div>
  </div>
</template>

<script>
export default {
  head() {
    return {
      title: 'Site is in maintenance mode',
      meta: [
        {
          hid: 'robots',
          name: 'robots',
          content: 'noindex,nofollow',
        },
      ],
    };
  },
  mounted() {
    // console.log(this.$route.path);
  },
};
</script>

<style lang="css" scoped>
body,
html {
  height: 100%;
  width: 100%;
  font-family: 'Open Sans Condensed', sans-serif;
  font-size: 1em;
}
.maintenance h1 {
  font-size: 190%;
  color: #fff;
  text-shadow: -2px 2px 3px rgba(0, 0, 0, 0.5);

  /*
  color: #d6336c;
  */
  text-align: center;
}
.maintenance {
  /* width: 200px; */
  height: 200px;
  position: absolute;
  left: 50%;
  top: 50%;
  margin-left: -100px;
  fill: #d6336c;
}
.content {
  height: 100%;
  width: 100%;
  background-color: #5471b9;
}
</style>
