<template>
  <div class="field">
    <label class="attribute-name">{{ type }}</label>
    <!-- <div class="control">
      <div class="select is-fullwidth"> -->
    <div class="row">
      <div class="col-6">
        <div class="form-group">
          <select
            class="form-control"
            :value="selectedVariationId"
            @change="onChange($event, type)"
          >
            <option value="">Please choose</option>
            <option
              v-for="variation in variations"
              :key="variation.id"
              :value="variation.id"
              :disabled="!variation.in_stock"
            >
              {{ variation.name }}
              <div v-if="variation.price_varies">
                &#40;
                <vue-autonumeric
                  v-model="variation.price"
                  :options="options"
                  class="price"
                  tag="span"
                ></vue-autonumeric>
                &#41;
              </div>

              <template v-if="!variation.in_stock"> (out of stock) </template>
            </option>
          </select>
        </div>
      </div>
    </div>
  </div>
  <!-- </div>
  </div> -->
</template>

<script>
import VueAutonumeric from '@/node_modules/vue-autonumeric/src/components/VueAutonumeric.vue';

export default {
  components: {
    VueAutonumeric,
  },
  props: {
    type: {
      type: String,
      required: true,
    },

    variations: {
      type: Array,
      default: () => [],
    },

    value: {
      type: Object,
      default: null,
    },
  },
  data() {
    return {
      options: {
        alwaysAllowDecimalCharacter: true,
        caretPositionOnFocus: 'start',
        currencySymbol: '$',
        readOnly: true,
      },
    };
  },

  computed: {
    selectedVariationId() {
      if (!this.value || !this.findVariation(this.value.id)) {
        return null;
      }

      return this.value.id;
    },
  },

  methods: {
    onChange(event, type) {
      this.$emit('input', this.findVariation(event.target.value));
    },

    findVariation(id) {
      const variation = this.variations.find((v) => v.id === parseInt(id));

      if (typeof variation === 'undefined') {
        return null;
      }

      return variation;
    },
  },
};
</script>
