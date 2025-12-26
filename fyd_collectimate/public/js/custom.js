(function($){

    $(document).ready(function(){
        $('#mc-header #sidebarCollapse').click(function(){
            var classes_ = $('#sidebar-menu').attr('class');
            if (classes_.indexOf("active") !== -1) {
                $('#sidebar-menu').removeClass('active');
                $('#main-content').removeClass('active');
            } else {
                $('#sidebar-menu').addClass('active');
                $('#main-content').addClass('active');
            }
        });

        $('#sidebar-menu ul li a.is_accordion').click(function(){
            var classes_ = $(this).parent('li').find('.submenu').attr('class');

            if (classes_.indexOf("show") !== -1) {
                $(this).parent('li').find('.submenu').first().removeClass('show');
            } else {
                $(this).parent('li').find('.submenu').first().addClass('show');
            }
        });
    });
})(jQuery);
