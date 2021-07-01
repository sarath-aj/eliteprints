export const getters = {
  authenticated(state, getters, rootState) {
    return rootState.auth.loggedIn;
  },
  isAdmin(state, getters, rootState) {
    if (rootState.auth.loggedIn) {
      return rootState.auth.user.is_admin === 1;
    }

    return false;
  },
  user(state, getters, rootState) {
    return rootState.auth.user;
  },
};
