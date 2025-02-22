$(document).ready(function () {
  var currentPath = window.location.pathname.split("/").pop();

  // Sidebar menu active class toggle
  $(".sidebar a").each(function () {
    var lastPartHref = $(this).attr("href").split("/").pop();
    if (currentPath === lastPartHref) {
      $(this).addClass("active");
    } else {
      $(this).removeClass("active");
    }
  });
});
