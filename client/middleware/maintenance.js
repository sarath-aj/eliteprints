export default function ({ redirect, route }) {
  const isMaintenance = process.env.isMaintenance || false;
  if (isMaintenance) {
    return redirect('/maintenance');
  }
  if (isMaintenance === false && route.path === '/maintenance') {
    return redirect('/');
  }
}
