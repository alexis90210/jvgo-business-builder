jQuery(function ($) {
  $(document).ready(function () {
    $("#DataTable").DataTable({
      scrollX: true,
      order: [[3, "desc"]],
      paging: false,
      ordering: false,
      info: false,
      deferRender:    true,
        scrollCollapse: true,
        scroller:       true
    });
  });
});

