let isAdmin = document.cookie.match(/is_admin=1/i);

const BASE_URL = document.location.origin;
if (!isAdmin) {
  document.location.href = BASE_URL + "/index.php";
}
