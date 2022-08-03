let loggedIn = document.cookie.match(new RegExp("login=true"));
let logged_id = document.cookie.match(new RegExp("logged_id=([\\d])."));
let isLoginPage = document.location.href.match(/login.php/i);

console.log(isLoginPage);
if (loggedIn && isLoginPage) {
  document.location.href = "/deal/index.php";
}
