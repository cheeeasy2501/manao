$(".nav-item").click(function () {
  var value = $(this).attr("data-link");
  $(".forms")
    .not("#" + value)
    .hide("2500");
  $(".forms")
    .filter("#" + value)
    .show("2500");
  $(this).siblings().removeClass("active");
  $(this).addClass("active");
});
