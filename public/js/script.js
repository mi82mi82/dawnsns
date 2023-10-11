$(function() {
  $('.imgbox').click(function() {
    $('.menu-list').slideToggle();
  });
});

// モーダル部分
$(function () { //①
  $('.posts-edit').each(function () {
    $(this).on('click', function () {
      var target = $(this).data('target');
      var modal = document.getElementById(target);
      $(modal).fadeIn();
      return false;
    });
  });
  $('.modalClose').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
});