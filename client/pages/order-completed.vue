<template>
  <div class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="text-center order_complete">
            <i class="fa fa-check-circle" />
            <div class="heading_s1">
              <h3>Your order is completed!</h3>
            </div>
            <p>
              Thank you for your order! Your order is being processed and will
              be completed within 3-6 hours.
              <!-- You will receive an email confirmation when your order is completed. -->
            </p>
            <nuxt-link to="/" class="btn btn-fill-out">
              Continue Shopping
            </nuxt-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  middleware: ['showOrderCompletedPage'],
};
</script>

<style>
.order_complete i {
  color: #ff324d;
  font-size: 80px;
  margin-bottom: 20px;
}
</style>
