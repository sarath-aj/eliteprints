export default function ({ app, redirect }) {
  const showOrderCompletedPage = app.$cookies.get('show-order-completed-page');
  if (!showOrderCompletedPage) {
    return redirect('/');
  } else {
    app.$cookies.remove('show-order-completed-page');
  }
}
