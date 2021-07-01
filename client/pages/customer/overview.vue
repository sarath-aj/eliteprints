<template>
  <div class="card">
    <div class="card-header">
      <h3>Account information</h3>
    </div>
    <div class="card-body">
      <div class="form-group">
        <i class="fa fa-user" /> Name: <strong>{{ user.name }}</strong>
      </div>
      <div class="form-group">
        <i class="fa fa-envelope" /> Email: <strong>{{ user.email }}</strong>
      </div>
      <div class="form-group">
        <i class="fa fa-phone" /> Phone: <strong>{{ getMobile() }}</strong>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mixins: ['user'],
  layout: 'customer',
  middleware: ['auth'],
  head() {
    return {
      title: this.user.name,
      meta: [
        {
          hid: 'robots',
          name: 'robots',
          content: 'noindex,nofollow',
        },
      ],
    };
  },
  methods: {
    getMobile() {
      return this.user.mobile || 'N/A';
    },
  },
};
</script>
