<template>
  <form @submit.prevent="store">
    <div class="field mt-3">
      <div ref="card" />
    </div>

    <div class="field">
      <div class="control">
        <br />
        <button class="btn btn-fill-out btn-sm" :disabled="storing">
          Store card
        </button>
        <button
          href="#"
          class="btn btn-dark btn-sm"
          @click.prevent="$emit('cancel')"
        >
          Cancel
        </button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      stripe: null,
      card: null,
      storing: false,
    };
  },

  mounted() {
    this.initStripe();
    this.initCard();
  },

  methods: {
    initStripe() {
      // this.stripe = window.Stripe("pk_test_lVQwmmn25dGU1YbjpFXnSxxQ");
      this.stripe = window.Stripe(process.env.STRIPE_PUBLIC_KEY);
    },

    initCard() {
      this.card = this.stripe.elements().create('card', {
        style: {
          base: {
            fontSize: '16px',
          },
        },
      });

      this.card.mount(this.$refs.card);
    },

    async store() {
      this.storing = true;

      const { token, error } = await this.stripe.createToken(this.card);

      if (error) {
        toastr.options = {
          positionClass: 'toast-bottom-right',
        };
        toastr.error('Something went wrong, please try again..');
      } else {
        const response = await this.$axios.$post('payment-methods', {
          token: token.id,
        });

        toastr.options = {
          positionClass: 'toast-bottom-right',
        };
        toastr.success('Payment Method Added');
        this.$emit('added', response.data);
      }

      this.storing = false;
    },
  },
};
</script>
