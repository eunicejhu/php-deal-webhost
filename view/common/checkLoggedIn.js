let loggedIn = document.cookie.match(new RegExp("login=true"));
let logged_id = document.cookie.match(new RegExp("logged_id=([\\d])."));
let isLoginPage = document.location.href.match(/login.php/i);

const BASE_URL = document.location.origin;

if (loggedIn && isLoginPage) {
  document.location.href = BASE_URL + "/index.php";
}
