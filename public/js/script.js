$(function() {
  $('.imgbox').click(function() {
    $('.menu-list').slideToggle();
  });
});

// モーダル部分
$(function () { //①
  $('.posts-edit').each(function () {
    $(this).on('click', function () {
      console.log(1);
      var target = $(this).data('target');
      var modal = document.getElementById(target);
      console.log(modal);
      $(modal).fadeIn();
      return false;
    });
  });
  $('.modalClose').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
});