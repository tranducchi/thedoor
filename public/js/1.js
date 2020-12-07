

$(document).ready(function () {
    // BUtton hi us
    $('#hius').on('click', function(e){
        e.preventDefault()
        $.ajax({
            // header:{
            //     'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            // },
            url: 'add_hire',
            data: new FormData($("#form1 form")[0]),
            contentType: false,
            processData: false,
            method: 'post',
            success: function(data) {
                toastr.success(data.success)
                $('#form1 form')[0].reset();
            },
            error: function(error) {
                console.log(error);
                var errors = error.responseJSON;
                $.each(errors.errors, function(i, val) {
                    $("#form2 input[name=" + i + "]").siblings('.error-form').text(val[0]);
                  
                })
            }
        });
    });
    // end hius
    $('#something').on('click', function(e){
        e.preventDefault()
        $.ajax({

            header:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            url: 'add_somethingelse',
            data: new FormData($("#form3")[0]),
            contentType: false,
            processData: false,
            method: 'post',
            success: function(data) {
                toastr.success(data.success)
                $('#form3')[0].reset();
            },
            error: function(error) {
                console.log(error);
                var errors = error.responseJSON;
                $.each(errors.errors, function(i, val) {
                    $("#form3 input[name=" + i + "]").siblings('.error-form').text(val[0]);
                    $("#form3 textarea").siblings('.error-form').text(val[0]);
                  
                })
            }
        });
    });
    $('.three-owl').owlCarousel({
        loop: true,
        margin: 10,
        //nav:true,
        //navText: ["<img src='img/p3-pre.png'>","<img src='img/p3-next.png'>"],
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
        
    });
    $('.two-carousel').owlCarousel({
        loop: true,
        margin: 10,
        //nav:true,
        //navText: ["<img src='img/p3-pre.png'>","<img src='img/p3-next.png'>"],
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    });
// one carousel
    $('.one-owl').owlCarousel({
     
        loop: true,
        margin: 10,
        //nav:true,
        //navText: ["<img src='img/p3-pre.png'>","<img src='img/p3-next.png'>"],
        responsive: {
            0: {
                items: 3,
             
            },
            600: {
                items: 3,
             
            },
            1000: {
                items: 3,
            
            }
        }
        
    })
    var owl = $('.one-owl');
    owl.owlCarousel();
    // Go to the next item
    $('.customNextBtn').click(function() {
        owl.trigger('next.owl.carousel');
        console.log("next");
    })
    // Go to the previous item
    $('.customPrevBtn').click(function() {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        owl.trigger('prev.owl.carousel', [300]);
        console.log("preview");
    })

    //stop next slide
    $('.carousel').carousel('pause');

    //open menu
    $('.menu-button').click(function () {
        $('span.btn1').toggleClass('rotate-right');
        $('span.btn2').toggleClass('rotate-left');
        $('.tab-menu').toggleClass("move-menu");
    });
    //close mennu click body
    $('body').click(function (evt) {
        if (evt.target.id == "list-menutab")
            return;
        if ($(evt.target).closest('#list-menutab').length) {
            return;
        }
        if (evt.target.id == "menu")
            return;
        if ($(evt.target).closest('#menu').length) {
            return;
        }
        $('.tab-menu').removeClass("move-menu");
        $('span.btn1').removeClass('rotate-right');
        $('span.btn2').removeClass('rotate-left');
    });
    $('#tabs-nav li:first-child').addClass('active');
    $('.tab-content').hide();
    $('.tab-content:first').show();

    // Click function
    $('#tabs-nav li').click(function () {
        $('#tabs-nav li').removeClass('active');
        $(this).addClass('active');
        $('.tab-content').hide();

        var activeTab = $(this).find('a').attr('href');
        $(activeTab).fadeIn();
        return false;
    });

    $('.customNextBtn').click(function () {
        owl.trigger('next.owl.carousel');
    })
    $('.customPrevBtn').click(function () {
        owl.trigger('prev.owl.carousel', [300]);
    })
});
// Click to div animate
$(document).on('click', 'a[href^="#"]', function (e) {
    // target element id
    var id = $(this).attr('href');

    // target element
    var $id = $(id);
    if ($id.length === 0) {
        return;
    }

    // prevent standard hash navigation (avoid blinking in IE)
    e.preventDefault();

    // top position relative to the document
    var pos = $id.offset().top;

    // animated top scrolling
    $('body, html').animate({ scrollTop: pos });
});
//preloaded
$('body').toggleClass('loaded');
//p3 img 


  
   

$('#range').on("input", function () {
    $('.output').val(this.value + ",000,000 VNĐ");
}).trigger("change");

