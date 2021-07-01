export const state = () => ({
  categories: [],
});

// export const getters = {
//   categories: (state) => state.categories,
// };

// export const mutations = {
//   SET_CATEGORIES(state, categories) {
//     state.categories = categories;
//   },
// };

export const actions = {
  async nuxtServerInit({ dispatch }) {
    await dispatch('contact-info/getContactInfo');

    if (this.$auth.loggedIn) {
      await dispatch('cart/getCart');
    }
  },
};
