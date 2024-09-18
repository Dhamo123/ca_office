$(document).ready(function() {
  

  $('.nav-link').click(function () {
    $('.setting').parent().slideToggle();
    $(".fa-angle-left").toggleClass("fa-angle-down");
});
});