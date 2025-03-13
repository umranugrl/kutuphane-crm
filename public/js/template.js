(function($) {
  'use strict';
  $(function() {
    var body = $('body');
    var contentWrapper = $('.content-wrapper');
    var scroller = $('.container-scroller');
    var footer = $('.footer');
    var sidebar = $('.sidebar');

    function addActiveClass(element) {
        var elementHref = element.attr('href').split("/").slice(-1)[0]; // Sadece son segmenti al
        if (current === elementHref) { // Tam eşleşme yap
            element.parents('.nav-item').last().addClass('active');

            if (element.parents('.sub-menu').length) {
                element.closest('.collapse').addClass('show');
                element.addClass('active');
            }
            if (element.parents('.submenu-item').length) {
                element.addClass('active');
            }
        }
    }

    var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, ''); // Şu anki sayfanın son segmentini al
    $('.nav li a', sidebar).each(function() {
        var $this = $(this);
        addActiveClass($this);
    });

    // Sidebar'daki diğer açık menüleri kapat
    sidebar.on('show.bs.collapse', '.collapse', function() {
      sidebar.find('.collapse.show').collapse('hide');
    });

    // Sidebar minimize
    $('[data-toggle="minimize"]').on("click", function() {
      body.toggleClass('sidebar-icon-only');
    });

    // Checkbox ve radio butonları için input-helper ekle
    $(".form-check label,.form-radio label").append('<i class="input-helper"></i>');
  });
})(jQuery);
