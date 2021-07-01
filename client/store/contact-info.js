export const state = () => ({
  contactInfo: null,
});

export const getters = {
  contactInfo: (state) => state.contactInfo,
};

export const mutations = {
  SET_CONTACT_INFO(state, contactInfo) {
    state.contactInfo = contactInfo;
  },
};

export const actions = {
  async getContactInfo({ commit }) {
    const response = await this.$axios.$get('settings');

    commit('SET_CONTACT_INFO', response.data);
  },
};
