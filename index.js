document.addEventListener("DOMContentLoaded", function () {
  console.log(
    "body client height: ",
    document.getElementsByTagName("body")[0].clientHeight
  );
  console.log("window height: ", window.innerHeight);
  if (
    document.getElementsByTagName("body")[0].clientHeight < window.innerHeight
  ) {
    console.log("hello");
    document.getElementsByTagName("footer")[0].style =
      "margin: 40px auto; text-align: center; width:90%; position: absolute; bottom: 0;";
  }
});
