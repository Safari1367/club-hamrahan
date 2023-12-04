/*
Template: Instadash - Responsive Bootstrap 4 Admin Dashboard Template
Author: iqonicthemes.in
Design and Developed by: iqonicthemes.in
NOTE: This file contains the styling for responsive Template.
*/

/*----------------------------------------------
Index Of Script
------------------------------------------------

:: Tooltip
:: Fixed Nav
:: Magnific Popup
:: Ripple Effect
:: Sidebar Widget
:: FullScreen
:: Page Loader
:: Counter
:: Progress Bar
:: Page Menu
:: Close  navbar Toggle
:: Mailbox
:: chatuser
:: chatuser main
:: Chat start
:: user toggle
:: Data tables
:: Form Validation
:: Active Class for Pricing Table
:: Flatpicker
:: Scrollbar
:: checkout
:: Datatables
:: image-upload
:: video
:: Button
:: Pricing tab

------------------------------------------------
Index Of Script
----------------------------------------------*/

(function(jQuery) {



    "use strict";

    jQuery(document).ready(function() {



        /*---------------------------------------------------------------------
Page Loader
-----------------------------------------------------------------------*/
        jQuery("#load").fadeOut();
        jQuery("#loading").delay().fadeOut("");
        /*---------------------------------------------------------------------
        Tooltip
        -----------------------------------------------------------------------*/
        // jQuery('[data-toggle="popover"]').popover();
        // jQuery('[data-toggle="tooltip"]').tooltip();

        /*---------------------------------------------------------------------
        Fixed Nav
        -----------------------------------------------------------------------*/

         jQuery(window).on('scroll', function () {
            if (jQuery(window).scrollTop() > 0) {
                jQuery('.iq-top-navbar').addClass('fixed');
            } else {
                jQuery('.iq-top-navbar').removeClass('fixed');
            }
        });

        jQuery(window).on('scroll', function () {
            if (jQuery(window).scrollTop() > 0) {
                jQuery('.white-bg-menu').addClass('sticky-menu');
            } else {
                jQuery('.white-bg-menu').removeClass('sticky-menu');
            }
        });


        /*---------------------------------------------------------------------
        Magnific Popup
        -----------------------------------------------------------------------*/
        if(typeof jQuery.fn.magnificPopup !== typeof undefined){
            jQuery('.popup-gallery').magnificPopup({
                delegate: 'a.popup-img',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    titleSrc: function(item) {
                        return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                    }
                }
            });
            jQuery('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        }


        /*---------------------------------------------------------------------
        Ripple Effect
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', ".iq-waves-effect", function(e) {
            // Remove any old one
            jQuery('.ripple').remove();
            // Setup
            let posX = jQuery(this).offset().left,
                posY = jQuery(this).offset().top,
                buttonWidth = jQuery(this).width(),
                buttonHeight = jQuery(this).height();

            // Add the element
            jQuery(this).prepend("<span class='ripple'></span>");


            // Make it round!
            if (buttonWidth >= buttonHeight) {
                buttonHeight = buttonWidth;
            } else {
                buttonWidth = buttonHeight;
            }

            // Get the center of the element
            let x = e.pageX - posX - buttonWidth / 2;
            let y = e.pageY - posY - buttonHeight / 2;


            // Add the ripples CSS and start the animation
            jQuery(".ripple").css({
                width: buttonWidth,
                height: buttonHeight,
                top: y + 'px',
                left: x + 'px'
            }).addClass("rippleEffect");
        });

       /*---------------------------------------------------------------------
        Sidebar Widget
        -----------------------------------------------------------------------*/

        jQuery(document).on("click", '.iq-menu > li > a', function() {
            jQuery('.iq-menu > li > a').parent().removeClass('active');
            jQuery(this).parent().addClass('active');
        });

        // Active menu
        var parents = jQuery('li.active').parents('.iq-submenu.collapse');

        parents.addClass('show');


        parents.parents('li').addClass('active');
        jQuery('li.active > a[aria-expanded="false"]').attr('aria-expanded', 'true');

        /*---------------------------------------------------------------------
        FullScreen
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', '.iq-full-screen', function() {
            let elem = jQuery(this);
            if (!document.fullscreenElement &&
                !document.mozFullScreenElement && // Mozilla
                !document.webkitFullscreenElement && // Webkit-Browser
                !document.msFullscreenElement) { // MS IE ab version 11

                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                } else if (document.documentElement.msRequestFullscreen) {
                    document.documentElement.msRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            }
            elem.find('i').toggleClass('ri-fullscreen-line').toggleClass('ri-fullscreen-exit-line');
        });





        /*---------------------------------------------------------------------
        Counter
        -----------------------------------------------------------------------*/
        if (window.counterUp !== undefined) {
            const counterUp = window.counterUp["default"]
            const counters = jQuery(".counter");
            counters.each(function (ignore, counter) {
                var waypoint = new Waypoint( {
                    element: jQuery(this),
                    handler: function() {
                        counterUp(counter, {
                            duration: 1000,
                            delay: 10
                        });
                        this.destroy();
                    },
                    offset: 'bottom-in-view',
                } );
            });
        }


        /*---------------------------------------------------------------------
        Progress Bar
        -----------------------------------------------------------------------*/
        jQuery('.iq-progress-bar > span').each(function() {
            let progressBar = jQuery(this);
            let width = jQuery(this).data('percent');
            progressBar.css({
                'transition': 'width 2s'
            });

            setTimeout(function() {
                progressBar.appear(function() {
                    progressBar.css('width', width + '%');
                });
            }, 100);
        });

        jQuery('.progress-bar-vertical > span').each(function () {
            let progressBar = jQuery(this);
            let height = jQuery(this).data('percent');
            progressBar.css({
                'transition': 'height 2s'
            });
            setTimeout(function () {
                progressBar.appear(function () {
                    progressBar.css('height', height + '%');
                });
            }, 100);
        });



        /*---------------------------------------------------------------------
        Page Menu
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', '.wrapper-menu', function() {
            jQuery(this).toggleClass('open');
        });

        jQuery(document).on('click', ".wrapper-menu", function() {
            jQuery("body").toggleClass("sidebar-main");
        });


      /*---------------------------------------------------------------------
       Close  navbar Toggle
       -----------------------------------------------------------------------*/

        jQuery('.close-toggle').on('click', function () {
            jQuery('.h-collapse.navbar-collapse').collapse('hide');
        });


        /*---------------------------------------------------------------------
        Mailbox
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', 'ul.iq-email-sender-list li', function () {
            jQuery(this).next().addClass('show');
            // jQuery('.mail-box-detail').css('filter','blur(4px)');
        });

        jQuery(document).on('click', '.email-app-details li h4', function () {
            jQuery('.email-app-details').removeClass('show');
        });

        /*---------------------------------------------------------------------
        chatuser
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', '.chat-head .chat-user-profile', function () {
            jQuery(this).parent().next().toggleClass('show');
        });
        jQuery(document).on('click', '.user-profile .close-popup', function () {
            jQuery(this).parent().parent().removeClass('show');
        });

        /*---------------------------------------------------------------------
        chatuser main
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', '.chat-search .chat-profile', function () {
            jQuery(this).parent().next().toggleClass('show');
        });
        jQuery(document).on('click', '.user-profile .close-popup', function () {
            jQuery(this).parent().parent().removeClass('show');
        });

        /*---------------------------------------------------------------------
        Chat start
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', '#chat-start', function () {
            jQuery('.chat-data-left').toggleClass('show');
        });
        jQuery(document).on('click', '.close-btn-res', function () {
            jQuery('.chat-data-left').removeClass('show');
        });
        jQuery(document).on('click', '.iq-chat-ui li', function () {
            jQuery('.chat-data-left').removeClass('show');
        });
        jQuery(document).on('click', '.sidebar-toggle', function () {
            jQuery('.chat-data-left').addClass('show');
        });

        /*---------------------------------------------------------------------
        todo Page
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', '.todo-task-list > li > a', function () {
            jQuery('.todo-task-list li').removeClass('active');
            jQuery('.todo-task-list .sub-task').removeClass('show');
            jQuery(this).parent().toggleClass('active');
            jQuery(this).next().toggleClass('show');
        });
        jQuery(document).on('click', '.todo-task-list > li li > a', function () {
            jQuery('.todo-task-list li li').removeClass('active');
            jQuery(this).parent().toggleClass('active');
        });

        /*---------------------------------------------------------------------
        user toggle
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', '#custom-navbar-account', function() {

            jQuery('#mobile-toggle-active').addClass('show-data');
            jQuery('body').addClass('show-data-body')

        });
        jQuery(document).on('click', '.iq-user-toggle', function() {
            jQuery(this).parent().addClass('show-data');
            jQuery('body').addClass('show-data-body')


            event.preventDefault();
            jQuery(this).closest('a').addClass('show-data');
        });

        jQuery(document).on('click', ".close-data", function() {
            jQuery('.iq-user-toggle').parent().removeClass('show-data');
            jQuery('#mobile-toggle-active').removeClass('show-data');
            jQuery('body').removeClass('show-data-body');
        });
        jQuery(document).on("click", function(event){
        var $trigger = jQuery(".iq-user-toggle");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            jQuery(".iq-user-toggle").parent().removeClass('show-data');
        }
        });
        /*-------hide profile when scrolling--------*/
        jQuery(window).scroll(function () {
            let scroll = jQuery(window).scrollTop();
            if (scroll >= 10 && jQuery(".iq-user-toggle").parent().hasClass("show-data")) {
                jQuery(".iq-user-toggle").parent().removeClass("show-data");
                jQuery('#mobile-toggle-active').removeClass('show-data');
                jQuery('body').removeClass('show-data-body');
            }
        });
        let Scrollbar = window.Scrollbar;
        if (jQuery('.data-scrollbar').length) {

            Scrollbar.init(document.querySelector('.data-scrollbar'), { continuousScrolling: false });
        }

        
        /*---------------------------------------------------------------------
        Data tables
        -----------------------------------------------------------------------*/
        if(jQuery.fn.DataTable){
            jQuery('.data-table').DataTable( {

                language: {
                    "processing": "در حال پردازش...",
                    "search": "جستجو:",
                    "lengthMenu": "نمایش ورودی  _MENU_",
                    "info": "اطلاعات",
                    "infoEmpty": "ورودی از 0 تا 0 از 0 ورودی",
                    "infoFiltered": "(فیلتر شده از _MAX_ رکورد)",
                    "loadingRecords": "در حال بارگیری سوابق...",
                    "zeroRecords": "نتیجه ای یافت نشد.",
                    "emptyTable": "جدول خالی",
                    "paginate": {
                        "first": "اولین",
                        "previous": "قبلی",
                        "next": "بعدی",
                        "last": "آخرین"
                    },
                    "aria": {
                        "sortAscending": ": برای مرتب کردن یک ستون به ترتیب صعودی فعال کنید",
                        "sortDescending": ": برای مرتب کردن ستون به ترتیب نزولی فعال کنید"
                    },
                    "select": {
                        "rows": {
                            "_": "رکوردهای انتخاب شده: %d",
                            "1": "یک ورودی انتخاب شده است"
                        },
                        "cells": {
                            "_": "%d سلول انتخاب شد",
                            "1": "1 سلول انتخاب شد"
                        },
                        "columns": {
                            "1": "انتخاب 1 ستون",
                            "_": "انتخاب %d ستون"
                        }
                    },
                    "searchBuilder": {
                        "conditions": {
                            "string": {
                                "startsWith": "شروع با",
                                "contains": "حاوی",
                                "empty": "خالی",
                                "endsWith": "پایان با",
                                "equals": "برابر با",
                                "not": "نه",
                                "notEmpty": "پر",
                                "notContains": "حاوی نیست",
                                "notStartsWith": "شروع نشده با",
                                "notEndsWith": "پایان نشده با"
                            },
                            "date": {
                                "after": "بعد از",
                                "before": "قبل از",
                                "between": "بین",
                                "empty": "خالی",
                                "equals": "برابر با",
                                "not": "نه",
                                "notBetween": "بین نیست",
                                "notEmpty": "پر نیست"
                            },
                            "number": {
                                "empty": "خالی",
                                "equals": "برابر با",
                                "gt": "بزرگتر از",
                                "gte": "بزرگتر یا برابر با",
                                "lt": "کوچکتر از",
                                "lte": "کوچکتر یا برابر با",
                                "not": "نه",
                                "notEmpty": "پر نیست",
                                "between": "بین",
                                "notBetween": "بین نیست"
                            },
                            "array": {
                                "equals": "برابر با",
                                "empty": "خالی",
                                "contains": "حاوی",
                                "not": "نه برابر با",
                                "notEmpty": "پر نیست",
                                "without": "بدون"
                            }
                        },
                        "data": "داده",
                        "deleteTitle": "حذف شرط فیلتر",
                        "logicAnd": "و",
                        "logicOr": "یا",
                        "title": {
                            "0": "سازنده جستجو",
                            "_": "سازنده جستجو (%d)"
                        },
                        "value": "مقدار",
                        "add": "افزودن شرط",
                        "button": {
                            "0": "سازنده جستجو",
                            "_": "سازنده جستجو (%d)"
                        },
                        "clearAll": "پاک کردن همه",
                        "condition": "شرط",
                        "leftTitle": "معیارهای برتر",
                        "rightTitle": "معیارهای فاصله"
                    },
                    "searchPanes": {
                        "clearMessage": "پاک کردن همه",
                        "collapse": {
                            "0": "پنل‌های جستجو",
                            "_": "پنل‌های جستجو (%d)"
                        },
                        "count": "{total}",
                        "countFiltered": "{shown} ({total})",
                        "emptyPanes": "هیچ پنل جستجویی وجود ندارد",
                        "loadMessage": "در حال بارگیری پنل‌های جستجو",
                        "title": "فیلترها فعال هستند - %d",
                        "showMessage": "نمایش ورودی",
                        "collapseMessage": "پنهان کردن همه"
                    },
                    "buttons": {
                        "pdf": "PDF",
                        "print": "چاپ",
                        "collection": "مجموعه <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"></span>",
                        "colvis": "قابلیت نمایش ستون‌ها",
                        "colvisRestore": "بازیابی نمایش",
                        "copy": "کپی",
                        "copyTitle": "کپی به کلیپبورد",
                        "csv": "CSV",
                        "excel": "Excel",
                        "pageLength": {
                            "-1": "نمایش تمام ردیف‌ها",
                            "_": "نمایش %d ردیف",
                            "1": "نمایش 1 ردیف"
                        },
                        "removeState": "حذف",
                        "renameState": "تغییر نام",
                        "copySuccess": {
                            "1": "یک ردیف به کلیپبورد کپی شد",
                            "_": "%d ردیف به کلیپبورد کپی شد"
                        },
                        "createState": "ایجاد وضعیت",
                        "removeAllStates": "حذف همه وضعیت‌ها",
                        "savedStates": "وضعیت‌های ذخیره شده",
                        "stateRestore": "وضعیت %d",
                        "updateState": "به‌روزرسانی",
                        "copyKeys": "برای کپی داده‌های جدول به کلیپبورد، کلید ctrl یا ⌘ + C را فشار دهید. برای لغو، روی این پیغام کلیک کنید یا دکمه escape را بزنید."
                    },
                    "decimal": ".",
                    "infoThousands": ",",
                    "autoFill": {
                        "cancel": "لغو",
                        "fill": "پر کردن تمام سلول‌ها با <i>%d<i><\/i><\/i>",
                        "fillHorizontal": "پر کردن افقی",
                        "fillVertical": "پر کردن عمودی",
                        "info": "اطلاعات"
                    },
                    "datetime": {
                        "previous": "قبلی",
                        "next": "بعدی",
                        "hours": "ساعت",
                        "minutes": "دقیقه",
                        "seconds": "ثانیه",
                        "unknown": "نامشخص",
                        "amPm": [
                            "قبل از ظهر",
                            "بعد از ظهر"
                        ],
                        "months": {
                            "0": "ژانویه",
                            "1": "فوریه",
                            "2": "مارس",
                            "3": "آوریل",
                            "4": "مه",
                            "5": "ژوئن",
                            "6": "ژوئیه",
                            "7": "آگوست",
                            "8": "سپتامبر",
                            "9": "اکتبر",
                            "10": "نوامبر",
                            "11": "دسامبر"
                        },
                        "weekdays": [
                            "یک‌شنبه",
                            "دو‌شنبه",
                            "سه‌شنبه",
                            "چهار‌شنبه",
                            "پنج‌شنبه",
                            "جمعه",
                            "شنبه"
                        ]
                    },
                    "editor": {
                        "close": "بستن",
                        "create": {
                            "button": "ایجاد",
                            "title": "ایجاد ردیف جدید",
                            "submit": "ارسال"
                        },
                        "edit": {
                            "button": "ویرایش",
                            "title": "ویرایش",
                            "submit": "ارسال"
                        },
                        "remove": {
                            "button": "حذف",
                            "title": "حذف",
                            "submit": "حذف",
                            "confirm": {
                                "_": "آیا از حذف %d ردیف مطمئن هستید؟",
                                "1": "آیا از حذف 1 ردیف مطمئن هستید؟"
                            }
                        },
                        "multi": {
                            "restore": "بازگرداندن تغییرات",
                            "title": "مقادیر چندگانه",
                            "info": "ردیف‌های انتخاب شده مقادیر مختلفی برای این ورودی دارند. برای ویرایش و تنظیم مقدار یکسان برای همه‌ی ردیف‌ها، در اینجا کلیک یا لمس کنید، در غیر این صورت مقادیر فردی ذخیره خواهند شد.",
                            "noMulti": "این فیلد باید به صورت جداگانه ویرایش شود و به عنوان بخشی از گروه نیست."
                        },
                        "error": {
                            "system": "خطای سیستمی رخ داده است (<a target=\"\\\" rel=\"nofollow\" href=\"\\\">جزئیات<\/a>)."
                        }
                    },
                    "searchPlaceholder": "جستجو...",
                    "stateRestore": {
                        "creationModal": {
                            "button": "ایجاد",
                            "search": "جستجو",
                            "columns": {
                                "search": "جستجو در ستون‌ها",
                                "visible": "نمایش ستون‌ها"
                            },
                            "name": "نام:",
                            "order": "ترتیب",
                            "paging": "صفحه‌بندی",
                            "scroller": "موقعیت اسکرول",
                            "searchBuilder": "سازنده جستجو",
                            "select": "انتخاب",
                            "title": "ایجاد وضعیت جدید",
                            "toggleLabel": "شامل:"
                        },
                        "removeJoiner": "و",
                        "removeSubmit": "حذف",
                        "renameButton": "تغییر نام",
                        "duplicateError": "وضعیت با این نام قبلاً ایجاد شده است.",
                        "emptyError": "نام نمی‌تواند خالی باشد.",
                        "emptyStates": "هیچ وضعیت ذخیره شده‌ای وجود ندارد.",
                        "removeConfirm": "آیا از حذف %s مطمئن هستید؟",
                        "removeError": "حذف وضعیت ممکن نیست.",
                        "removeTitle": "حذف وضعیت",
                        "renameLabel": "نام جدید برای %s:",
                        "renameTitle": "تغییر نام وضعیت"
                    },
                    "thousands": " "
            }

                });
        }




        /*---------------------------------------------------------------------
        Form Validation
        -----------------------------------------------------------------------*/

        // Example starter JavaScript for disabling form submissions if there are invalid fields
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

      /*---------------------------------------------------------------------
       Active Class for Pricing Table
       -----------------------------------------------------------------------*/
      jQuery("#my-table tr th").click(function () {
        jQuery('#my-table tr th').children().removeClass('active');
        jQuery(this).children().addClass('active');
        jQuery("#my-table td").each(function () {
          if (jQuery(this).hasClass('active')) {
            jQuery(this).removeClass('active')
          }
        });
        var col = jQuery(this).index();
        jQuery("#my-table tr td:nth-child(" + parseInt(col + 1) + ")").addClass('active');
      });

        /*------------------------------------------------------------------
        Flatpicker
        * -----------------------------------------------------------------*/
      if (jQuery('.date-input').hasClass('basicFlatpickr')) {
          jQuery('.basicFlatpickr').flatpickr();
          jQuery('#inputTime').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
          });
          jQuery('#inputDatetime').flatpickr({
            enableTime: true
          });
          jQuery('#inputWeek').flatpickr({
            weekNumbers: true
          });
          jQuery("#inline-date").flatpickr({
              inline: true
          });
          jQuery("#inline-date1").flatpickr({
              inline: true
          });
      }

        /*---------------------------------------------------------------------
        Scrollbar
        -----------------------------------------------------------------------*/

        jQuery(window).on("resize", function () {
            if (jQuery(this).width() <= 1299) {
                jQuery('#salon-scrollbar').addClass('data-scrollbar');
            } else {
                jQuery('#salon-scrollbar').removeClass('data-scrollbar');
            }
        }).trigger('resize');

        jQuery('.data-scrollbar').each(function () {
            var attr = jQuery(this).attr('data-scroll');
            if (typeof attr !== typeof undefined && attr !== false){
            let Scrollbar = window.Scrollbar;
            var a = jQuery(this).data('scroll');
            Scrollbar.init(document.querySelector('div[data-scroll= "' + a + '"]'));
            }
        });


         /*---------------------------------------------------------------------
           Datatables
        -----------------------------------------------------------------------*/
        if(jQuery('.data-tables').length)
        {
            jQuery('.data-tables').DataTable(
              {
                  language: {
                      search: "_INPUT_",
                      searchPlaceholder: "Search..."
                  }
              }
          );

        }


      /*---------------------------------------------------------------------
      image-upload
      -----------------------------------------------------------------------*/

      jQuery('.form_gallery-upload').on('change', function() {
          var length = jQuery(this).get(0).files.length;
          var galleryLabel  = jQuery(this).attr('data-name');

          if( length > 1 ){
            jQuery(galleryLabel).text(length + " files selected");
          } else {
            jQuery(galleryLabel).text(jQuery(this)[0].files[0].name);
          }
        });

    /*---------------------------------------------------------------------
        video
      -----------------------------------------------------------------------*/
      jQuery(document).ready(function(){
        jQuery('.form_video-upload input').change(function () {
            jQuery('.form_video-upload p').text(this.files.length + " file(s) selected");
      });
    });


        /*---------------------------------------------------------------------
        Button
        -----------------------------------------------------------------------*/

        jQuery('.qty-btn').on('click',function(){
          var id = jQuery(this).attr('id');

          var val = parseInt(jQuery('#quantity').val());

          if(id == 'btn-minus')
          {
            if(val != 0)
            {
              jQuery('#quantity').val(val-1);
            }
            else
            {
              jQuery('#quantity').val(0);
            }

          }
          else
          {
            jQuery('#quantity').val(val+1);
          }
        });
        if (jQuery.fn.select2 !== undefined) {
            jQuery("#single").select2({
                placeholder: "Select a Option",
                allowClear: true
            });
            jQuery("#multiple").select2({
                placeholder: "Select a Multiple Option",
                allowClear: true
            });
            jQuery("#multiple2").select2({
                placeholder: "Select a Multiple Option",
                allowClear: true
            });
        }

        /*---------------------------------------------------------------------
        Pricing tab
        -----------------------------------------------------------------------*/
        jQuery(window).on('scroll', function (e) {

            // Pricing Pill Tab
            var nav = jQuery('#pricing-pills-tab');
            if (nav.length) {
                var contentNav = nav.offset().top - window.outerHeight;
                if (jQuery(window).scrollTop() >= (contentNav)) {
                    e.preventDefault();
                    jQuery('#pricing-pills-tab li a').removeClass('active');
                    jQuery('#pricing-pills-tab li a[aria-selected=true]').addClass('active');
                }
            }
        });

    });

})(jQuery);
