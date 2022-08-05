document.addEventListener("DOMContentLoaded", function () {
  if (
    document.getElementsByTagName("body")[0].clientHeight < window.innerHeight
  ) {
    document.getElementsByTagName("footer")[0].style =
      "margin: 40px auto; text-align: center; width:90%; position: absolute; bottom: 0;";
  }
});
