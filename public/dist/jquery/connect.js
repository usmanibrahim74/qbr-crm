$(document).ready(function() {
    const submenu_animation_speed = 200;

    const simulateClick = function (elem) {
        // Create our event (with options)
        var evt = new MouseEvent('click', {
            bubbles: true,
            cancelable: true,
            view: window
        });
        // If cancelled, don't dispatch our event
	   var canceled = !elem.dispatchEvent(evt);
    };

    const connectSidebar = function() {
        var select_sub_menus = $('.accordion-menu li:not(.open) ul'),
            active_page_sub_menu_link = $('.accordion-menu li.active-page > a');

        // Hide all sub-menus
        select_sub_menus.hide();

        // Accordion
        $(document).on('click','.accordion-menu li a',function () {
          var sub_menu = $(this).next('ul'),
            parent_list_el = $(this).parent('li'),
            active_list_element = $('.accordion-menu > li.open'),
            show_sub_menu = function() {
              sub_menu.slideDown(submenu_animation_speed);
              parent_list_el.addClass('open');
            },
            hide_sub_menu = function() {
              sub_menu.slideUp(submenu_animation_speed);
              parent_list_el.removeClass('open');
            },
            hide_active_menu = function() {
              $('.accordion-menu > li.open > ul').slideUp(submenu_animation_speed);
              active_list_element.removeClass('open');
            };

          if(sub_menu.length) {

            if(!parent_list_el.hasClass('open')) {
              if(active_list_element.length) {
                hide_active_menu();
              };
              show_sub_menu();
            } else {
              hide_sub_menu();
            };

            return false;

          };
        })

        if($('.active-page > ul').length) {
            active_page_sub_menu_link.click();
        };

        $(document).on('click','#sidebar-state', function(){
            $('body').toggleClass('compact-sidebar');
        });


        $(window).click(function() {
            if($('body').hasClass('small-screen-sidebar-active')) {
                var navToggle = document.querySelector('.small-screens-sidebar-link a');
                simulateClick(navToggle);
            }
        });

        $(document).on('click','.small-screens-sidebar-link a', function(){
            $('body').toggleClass('small-screen-sidebar-active');
            event.stopPropagation();
        });

        $(document).on('click','#sidebar-close', function(){
            $('body').toggleClass('small-screen-sidebar-active');
        });


        $(document).on('click','.page-sidebar',function(event){
            event.stopPropagation();
        });


        $(document).click(function(event){
            event.stopPropagation();
        });


        $(document).on('click','.hide-horizontal-bar', function(){
            $('body').toggleClass('small-screen-sidebar-active');
        });


        var horizontal_sub_menus = $('.horizontal-bar-menu li:not(.open) ul');

        // Hide all sub-menus
        horizontal_sub_menus.hide();

        // Accordion
        $(document).on('click', '.horizontal-bar-menu li a', function() {
            var sub_menu = $(this).next('ul'),
                parent_list_el = $(this).parent('li'),
                active_list_element = $('.horizontal-bar-menu > ul > li.open'),
                show_sub_menu = function() {
                    sub_menu.slideDown(submenu_animation_speed);
                    parent_list_el.addClass('open');
                },
                hide_sub_menu = function() {
                    sub_menu.slideUp(submenu_animation_speed);
                    parent_list_el.removeClass('open');
                },
                hide_active_menu = function() {
                    $('.horizontal-bar-menu > ul > li.open > ul').slideUp(submenu_animation_speed);
                    active_list_element.removeClass('open');
                };

            if(sub_menu.length) {

                if(!parent_list_el.hasClass('open')) {
                    if(active_list_element.length) {
                        hide_active_menu();
                    };
                    show_sub_menu();
                } else {
                    hide_sub_menu();
                };

                return false;

            };
        });


    };

    const dark_theme = function() {

        if(localStorage.getItem('theme') == 'dark') {
            $('body').addClass('dark-theme');
        }

        if(localStorage.getItem('theme') != 'dark' && $('body').hasClass('dark-theme')) {
            localStorage.setItem('theme', 'dark');
        }

        $(document).on('click', '#dark-theme-toggle',function() {
            $('body').toggleClass('dark-theme');
            if($('body').hasClass('dark-theme')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
            event.preventDefault();
        });
    };

    const plugins_init = function(){

        if($(window).width() > 767) {
        // Slimscroll
            $(document).on('mouseover','.slimscroll',function() {
              $(this).next('.slimScrollBar').css('opacity', 0.4);
            })
        }

        $('[data-toggle="popover"]').popover();
        $('[data-toggle="tooltip"]').tooltip(); // gives the scroll position

        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);

    };


    connectSidebar();
    dark_theme();
    plugins_init();
});

$(window).on("load", function () {
    setTimeout(function() {
    $('body').addClass('no-loader')}, 1000)
});
