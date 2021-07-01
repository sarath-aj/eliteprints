export default function ({ store, redirect }) {
  if (store.getters['Auth/isAdmin']) {
    return redirect('/admin');
  }
}
