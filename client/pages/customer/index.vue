<template>
  <div />
</template>

<script>
export default {
  layout: 'customer',
  middleware: ['auth'],
  mounted() {
    this.$router.push({ name: 'customer-overview' });
  },
};
</script>
