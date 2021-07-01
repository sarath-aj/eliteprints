<template>
  <select
    id="address_country"
    class="form-control address-control-item"
    @change="onChanged($event)"
  >
    <option value="">Select country...</option>
    <option
      v-for="country in countries"
      :key="country.id"
      :value="country.id"
      :selected="country.id == countryId"
    >
      {{ country.name }}
    </option>
  </select>
</template>

<script>
export default {
  props: {
    // eslint-disable-next-line vue/require-default-prop
    countryId: Number,
  },
  data() {
    return {
      countries: [],
    };
  },
  async fetch() {
    const response = await this.$axios.$get('countries');
    this.countries = response.data;
  },

  methods: {
    onChanged(event) {
      this.$emit('input', event.target.value);
    },
  },
};
</script>
