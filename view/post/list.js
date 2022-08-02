let loggedIn = document.cookie.match(new RegExp("login=true"));
let logged_id = document.cookie.match(new RegExp("logged_id=([\\d])."));
if (!(loggedIn || logged_id)) {
  document.location.href = "../user/login.php";
}

document.addEventListener("DOMContentLoaded", function () {
  if (loggedIn && logged_id) {
    document.getElementById("id_user").value = logged_id[0].split("=")[1];
  }
});
