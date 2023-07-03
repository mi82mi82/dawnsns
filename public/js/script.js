$(function() {
  $('.nav-menu').hover(function() {
    $(this).children('.menu-list').stop().slideToggle();
  });
});