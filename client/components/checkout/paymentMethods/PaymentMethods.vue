<template>
  <article class="message mt-4 mb-4">
    <div class="message-body">
      <h5 class="title is-5">Payment method</h5>

      <template v-if="selecting">
        <PaymentMethodSelector
          :payment-methods="paymentMethods"
          :selected-payment-method="selectedPaymentMethod"
          @selected="select"
        />
      </template>

      <template v-else-if="creating">
        <PaymentMethodCreator @cancel="creating = false" @added="create" />
      </template>

      <template v-else>
        <template v-if="selectedPaymentMethod">
          <div class="address-item-selected">
            <div class="address-item is-default" data-id="5">
              <p class="address">
                {{ selectedPaymentMethod.card_type }} ending
                {{ selectedPaymentMethod.last_four }}
              </p>
              <span class="default">Default</span>
            </div>
          </div>
          <br />
        </template>

        <div class="field is-grouped">
          <div class="control">
            <a
              v-if="paymentMethods.length"
              href=""
              class="btn btn-fill-out btn-sm"
              @click.prevent="selecting = true"
              >Change payment method</a
            >
            <a
              href=""
              class="btn btn-fill-out btn-sm"
              @click.prevent="creating = true"
              >Add a payment method</a
            >
          </div>
        </div>
      </template>
    </div>
  </article>
</template>

<script>
import PaymentMethodSelector from './PaymentMethodSelector.vue';
import PaymentMethodCreator from './PaymentMethodCreator.vue';

export default {
  components: {
    PaymentMethodSelector,
    PaymentMethodCreator,
  },

  props: {
    paymentMethods: {
      type: Array,
      required: true,
    },
  },

  data() {
    return {
      selecting: false,
      creating: false,
      localPaymentMethods: this.paymentMethods,
      selectedPaymentMethod: null,
    };
  },

  computed: {
    defaultPaymentMethod() {
      return this.localPaymentMethods.find((p) => p.default === 1);
    },
  },

  watch: {
    selectedPaymentMethod(paymentMethod) {
      this.$emit('input', paymentMethod.id);
    },
  },

  created() {
    if (this.paymentMethods.length) {
      this.switchPaymentMethod(this.defaultPaymentMethod);
    }
  },

  methods: {
    switchPaymentMethod(payment) {
      this.selectedPaymentMethod = payment;
    },

    select(paymentMethod) {
      this.switchPaymentMethod(paymentMethod);
      this.selecting = false;
    },

    create(payment) {
      this.localPaymentMethods.push(payment);
      this.creating = false;

      this.switchPaymentMethod(payment);
    },
  },
};
</script>
