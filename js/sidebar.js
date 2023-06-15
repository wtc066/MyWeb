function openNav() {
  document.getElementById("mySidepanel").style.width = "360px";
}

function closeNav() {
  document.getElementById("mySidepanel").style.width = "0";
}

$(document).ready(function () {
  $('.openbtn').click(function () {
    openNav();
  });
  $('.closebtn').click(function () {
    closeNav();
  });
  $('#mySidepanel').mouseleave(function () {
    closeNav();
  });
});