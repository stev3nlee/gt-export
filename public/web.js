$(document).ready(function() {
    [].slice.call(document.querySelectorAll('.form-control')).forEach(function(inputEl) {
        if (inputEl.value.trim() !== '') {
        }
        inputEl.addEventListener('focus', onInputFocus);
        inputEl.addEventListener('blur', onInputBlur);
    });

    function onInputFocus(ev) {
        $(ev.target.parentNode).addClass('filled-text');
    }

    function onInputBlur(ev) {
        if (ev.target.value.trim() === '') {
            $(ev.target.parentNode).removeClass('filled-text');
        }
    }

    $(".click-menu").click(function(a) {
        a.preventDefault();
        $("body").toggleClass("offcanvas-menu-open");
        $(".bg-dark-menu").show();
        $(".bg-dark-menu").animate({
            opacity: .7
        });
    });

    $("html").click(function(a) {
        if (!$(a.target).parents().is(".click-menu") && !$(a.target).is("#menu") && !$(a.target).is(".close-menu") && !$(a.target).parents().is("#menu")) {
            $("body").removeClass("offcanvas-menu-open");
            $(".bg-dark-menu").hide();
            $(".bg-dark-menu").animate({
                opacity: 0
            });
        }
    });

    $(".close-menu").click(function(a) {
        $("body").removeClass("offcanvas-menu-open");
        $(".bg-dark-menu").hide();
        $(".bg-dark-menu").animate({
            opacity: 0
        });
    });

    $(document).keyup(function(a) {
        if (27 == a.keyCode) {
            $("body").removeClass("offcanvas-menu-open");
            $(".bg-dark-menu").hide();
            $(".bg-dark-menu").animate({
                opacity: 0
            });
            $(".bg-dark-cart").hide();
            $(".bg-dark-cart").animate({
                opacity: 0
            });
            $('#cart').removeClass('open');
            $('body').removeClass('no-scroll');
        }
    });

    $(".click-cart").click(function(a) {
        var _token = $("input[name='_token']").val();
        const data = {
            _token:_token
        }
         $.ajax({
                method: 'POST',
                url : mainlink + '/load-cart',
                data : data,
                success: function(data){
                    $('#cart').html(data);
                    var cart_total = $("#cart-total").html();
                    $("#cart-count").html(cart_total);
                    a.preventDefault();
                    $('#cart').addClass('open');
                    $('body').addClass('no-scroll');
                    $(".bg-dark-cart").show();
                    $(".bg-dark-cart").animate({
                        opacity: .7
                    });

                    $(".click-remove").click(function(a) {
                        var cart_id = $(this).data('cart');
                        remove_cart(cart_id);
                    });

                    $('.click-surprise').click(function(event) {
                        surprise();
                    });

                    $(".close-cart").click(function(a) {
                        $('#cart').removeClass('open');
                        $('body').removeClass('no-scroll');
                        $(".bg-dark-cart").hide();
                        $(".bg-dark-cart").animate({
                             opacity: 0
                        });
                    });

                },
                error: function(xhr, ajaxOptions, thrownError){
                    let error = jQuery.parseJSON( xhr.responseText );
                    if(error.errorCode == 20100){
                        $('#message-failed').html("Please <a href="+mainlink+"/login>login</a> into your account before add your products to cart.");
                    }
                    else{
                        $('#message-failed').html("Something went wrong. Please try again later!");
                    }
                    $("#modal-failed").modal("toggle");
                }
        });
    });

    function remove_cart(cart_id){
        var _token = $("input[name='_token']").val();
        var cart_now = $("#cart-count").html();
        var total_cart = parseInt(cart_now)- parseInt(1);
        const data = {
                        _token:_token,
                        cart_id:cart_id
                    }
        $.ajax({
                method: 'POST',
                url : mainlink + '/remove-cart',
                data : data,
                success: function(data){
                    $('#cart').html(data);
                    $("#cart-count").html(total_cart);
                    $(".click-remove").click(function(a) {
                        var cart_id = $(this).data('cart');
                        remove_cart(cart_id);
                    });
                    $('.click-surprise').click(function(event) {
                        surprise();
                    });
                },
                error: function(xhr, ajaxOptions, thrownError){
                    let error = jQuery.parseJSON( xhr.responseText );
                    if(error.errorCode == 20100){
                        $('#message-failed').html("Please <a href="+mainlink+"/login>login</a> into your account before add your products to cart.");
                    }
                    else{
                        $('#message-failed').html("Something went wrong. Please try again later!");
                    }
                    $("#modal-failed").modal("toggle");
                }
        });

    }

    $(".close-cart").click(function(a) {
        $('#cart').removeClass('open');
        $('body').removeClass('no-scroll');
        $(".bg-dark-cart").hide();
        $(".bg-dark-cart").animate({
            opacity: 0
        });
    });

    $("html").click(function(a) {
        if (!$(a.target).parents().is(".click-cart") && !$(a.target).is("#cart") && !$(a.target).is(".close-cart") && !$(a.target).parents().is("#cart") && !$(a.target).parents().is(".click-pop-cart")) {
            $('#cart').removeClass('open');
            $('body').removeClass('no-scroll');
            $(".bg-dark-cart").hide();
            $(".bg-dark-cart").animate({
                opacity: 0
            });
        }
    });

    $(".only-number").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    function surprise(){
        var _token = $("input[name='_token']").val();
        const data = {
            _token:_token
        }
         $.ajax({
                method: 'POST',
                url : mainlink + '/surprise-me',
                data : data,
                success: function(data){
                    $('#cart').html(data);
                    var cart_total = $("#cart-total").html();
                    $("#cart-count").html(cart_total);
                    $(this).hide();
                    $('ul.l-link li .bdr').hide();
                    $('.box-surprise').show();
                },
                error: function(xhr, ajaxOptions, thrownError){
                    let error = jQuery.parseJSON( xhr.responseText );
                    if(error.errorCode == 20100){
                        $('#message-failed').html("Please <a href="+mainlink+"/login>login</a> into your account before add your products to cart.");
                    }
                    else{
                        $('#message-failed').html("Something went wrong. Please try again later!");
                    }
                    $("#modal-failed").modal("toggle");
                }
        });
    }

    $('.remove-surprise').click(function(event) {
        $('.click-surprise').show();
        $('ul.l-link li .bdr').show();
        $('.box-surprise').hide();
    });

    var myVar = setInterval(myTimer, 3000); 
  
    function myTimer() { 
        $('#modal-success').modal('hide');
        $('#modal-failed').modal('hide');
    }
});