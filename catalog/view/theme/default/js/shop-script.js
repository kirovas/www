$(document).ready(function() {

    $('.menu-index-toval-box a').click(function() {

        $('.menu-index-toval-box > a').removeClass('active');
        $('.index-toval-list > div').removeClass('active');
        $('.index-toval-list > div').slideUp(400);
        $(this).addClass('active');
        var Tovar_list = $(this).attr('href');
        $(Tovar_list).slideToggle(400);
        return false;
    });

    $(".index-one-clik").fancybox({
        fitToView: false,
        width: '600px',
        height: 'auto',
        autoSize: false,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none',
        padding: '0px'
    });
    $(".fancybox").fancybox({
    });

    $(".call-form").fancybox({
        fitToView: false,
        width: '600px',
        height: 'auto',
        autoSize: false,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none',
        padding: '0px'
    });

    $("#newsticker").jCarouselLite({
        vertical: true,
        hoverPause: true,
        btnPrev: "#index-news-prev",
        btnNext: "#index-news-next",
        visible: 3,
        auto: 3000,
        speed: 500
    });

    $("#mini-img-slider").jCarouselLite({
        vertical: false,
        hoverPause: true,
        btnPrev: "#index-news-prev",
        btnNext: "#index-news-next",
        visible: 6,
        auto: 5000,
        speed: 1000
    });

    $("#shop-feedback-list").jCarouselLite({
        vertical: true,
        hoverPause: true,
        btnPrev: "#news-prev",
        btnNext: "#news-next",
        visible: 4,
        auto: 3000,
        speed: 500
    });

//loadcart();

    $("#type_filter > li > a").click(function() {
        $("#type_filter > li > a").removeClass('active');
        $(this).addClass('active');
        $("#type_filter > li > ul").hide();
        $(this).next().show();

        return false;
    });


    $("#select-sort").click(function() {
        $("#sorting-list").slideToggle(200);
    });

//
    $("#select-pack").click(function() {
        $("#pack-list").slideToggle(200);
    });
//

    $('#block-category > ul > li > div > a').click(function() {
        var ID_Link = $(this).attr('id');
        if ($(this).parent().next().css("display") == "none") {
            $(this).parent().next().slideDown(400);
            $.cookie('wiev_cat_' + ID_Link + '', '1');

        } else {

            $(this).parent().next().slideUp(400);
            $.cookie('wiev_cat_' + ID_Link + '', '');

        }
    });
    if ($.cookie('wiev_cat_index1') == '1')
    {
        $('#block-category > ul > li > div > a#index1').parent().next().slideDown(400);
    } else {
        $('#block-category > ul > li > div > a#index1').parent().next().slideUp(400);
    }
    if ($.cookie('wiev_cat_index2') == '1')
    {
        $('#block-category > ul > li > div > a#index2').parent().next().slideDown(400);
    } else {
        $('#block-category > ul > li > div > a#index2').parent().next().slideUp(400);
    }
    if ($.cookie('wiev_cat_index3') == '1')
    {
        $('#block-category > ul > li > div > a#index3').parent().next().slideDown(400);
    } else {
        $('#block-category > ul > li > div > a#index3').parent().next().slideUp(400);
    }
    if ($.cookie('wiev_cat_index4') == '1')
    {
        $('#block-category > ul > li > div > a#index4').parent().next().slideDown(400);
    } else {
        $('#block-category > ul > li > div > a#index4').parent().next().slideUp(400);
    }
    if ($.cookie('wiev_cat_index5') == '1')
    {
        $('#block-category > ul > li > div > a#index5').parent().next().slideDown(400);
    } else {
        $('#block-category > ul > li > div > a#index5').parent().next().slideUp(400);
    }
    /*$('#block-category > ul > li > div > a').click(function(){

     if ($(this).attr('class') != 'active'){

     $('#block-category > ul > li > ul').slideUp(400);
     $(this).next().slideToggle(400);

     $('#block-category > ul > li > div > a').removeClass('active');
     $(this).addClass('active');
     $.cookie('select_cat', $(this).attr('id'));

     }else
     {

     $('#block-category > ul > li > div > a').removeClass('active');
     $('#block-category > ul > li > ul').slideUp(400);
     $.cookie('select_cat', '');
     }

     });

     if ($.cookie('select_cat') != '')
     {
     $('#block-category > ul > li > #'+$.cookie('select_cat')).addClass('active').next().show();
     }*/


    $('.top-auth').toggle(
            function() {
                $(".top-auth").attr("id", "active-button");
                $("#block-top-auth").fadeIn(200);
            },
            function() {
                $(".top-auth").attr("id", "");
                $("#block-top-auth").fadeOut(200);
            }
    );


    $('#button-pass-show-hide').click(function() {
        var statuspass = $('#button-pass-show-hide').attr("class");

        if (statuspass == "pass-show")
        {
            $('#button-pass-show-hide').attr("class", "pass-hide");

            var $input = $("#auth_pass");
            var change = "text";
            var rep = $("<input placeholder='Пароль' type='" + change + "' />")
                    .attr("id", $input.attr("id"))
                    .attr("name", $input.attr("name"))
                    .attr('class', $input.attr('class'))
                    .val($input.val())
                    .insertBefore($input);
            $input.remove();
            $input = rep;

        } else
        {
            $('#button-pass-show-hide').attr("class", "pass-show");

            var $input = $("#auth_pass");
            var change = "password";
            var rep = $("<input placeholder='Пароль' type='" + change + "' />")
                    .attr("id", $input.attr("id"))
                    .attr("name", $input.attr("name"))
                    .attr('class', $input.attr('class'))
                    .val($input.val())
                    .insertBefore($input);
            $input.remove();
            $input = rep;

        }



    });

    $("#button-auth").click(function() {

        var auth_login = $("#auth_login").val();
        var auth_pass = $("#auth_pass").val();


        if (auth_login == "" || auth_login.length > 30)
        {
            $("#auth_login").css("borderColor", "#FDB6B6");
            send_login = 'no';
        } else {

            $("#auth_login").css("borderColor", "#DBDBDB");
            send_login = 'yes';
        }


        if (auth_pass == "" || auth_pass.length > 15)
        {
            $("#auth_pass").css("borderColor", "#FDB6B6");
            send_pass = 'no';
        } else {
            $("#auth_pass").css("borderColor", "#DBDBDB");
            send_pass = 'yes';
        }



        if ($("#rememberme").prop('checked'))
        {
            auth_rememberme = 'yes';

        } else {
            auth_rememberme = 'no';
        }


        if (send_login == 'yes' && send_pass == 'yes')
        {
            $("#button-auth").hide();
            $(".auth-loading").show();

            $.ajax({
                type: "POST",
                url: "/include/auth.php",
                data: "login=" + auth_login + "&pass=" + auth_pass + "&rememberme=" + auth_rememberme,
                dataType: "html",
                cache: false,
                success: function(data) {

                    if (data == 'yes_auth')
                    {
                        location.reload();
                    } else
                    {
                        $("#message-auth").slideDown(400);
                        $(".auth-loading").hide();
                        $("#button-auth").show();

                    }

                }
            });
        }
    });


    $('#remindpass').click(function() {

        $('#input-email-pass').fadeOut(200, function() {
            $('#block-remind').fadeIn(300);
        });
    });

    $('#prev-auth').click(function() {

        $('#block-remind').fadeOut(200, function() {
            $('#input-email-pass').fadeIn(300);
        });
    });


    $('#button-remind').click(function() {

        var recall_email = $("#remind-email").val();

        if (recall_email == "" || recall_email.length > 20)
        {
            $("#remind-email").css("borderColor", "#FDB6B6");

        } else
        {
            $("#remind-email").css("borderColor", "#DBDBDB");

            $("#button-remind").hide();
            $(".auth-loading").show();

            $.ajax({
                type: "POST",
                url: "/include/remind-pass.php",
                data: "email=" + recall_email,
                dataType: "html",
                cache: false,
                success: function(data) {

                    if (data == 'yes')
                    {
                        $(".auth-loading").hide();
                        $("#button-remind").show();
                        $('#message-remind').attr("class", "message-remind-success").html("На ваш e-mail выслан пароль.").slideDown(400);

                        setTimeout("$('#message-remind').html('').hide(),$('#block-remind').hide(),$('#input-email-pass').show()", 3000);

                    } else
                    {
                        $(".auth-loading").hide();
                        $("#button-remind").show();
                        $('#message-remind').attr("class", "message-remind-error").html(data).slideDown(400);

                    }
                }
            });
        }
    });

    $('#auth-user-info').toggle(
            function() {
                $("#block-user").fadeIn(100);
            },
            function() {
                $("#block-user").fadeOut(100);
            }
    );


    $('#logout').click(function() {

        $.ajax({
            type: "POST",
            url: "/include/logout.php",
            dataType: "html",
            cache: false,
            success: function(data) {

                if (data == 'logout')
                {
                    location.reload();
                }

            }
        });
    });


    //Шаблон проверки email на правильность
    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }
    // Контактные данные
    $('#confirm-button-next').click(function(e) {

        var order_fio = $("#order_fio").val();
        var order_email = $("#order_email").val();
        var order_phone = $("#order_phone").val();
        var order_address = $("#order_address").val();

        if (!$(".order_delivery").is(":checked"))
        {
            $(".label_delivery").css("color", "#E07B7B");
            send_order_delivery = '0';

        } else {
            $(".label_delivery").css("color", "black");
            send_order_delivery = '1';


            // Проверка ФИО
            if (order_fio == "" || order_fio.length > 50)
            {
                $("#order_fio").css("borderColor", "#FDB6B6");
                send_order_fio = '0';

            } else {
                $("#order_fio").css("borderColor", "#DBDBDB");
                send_order_fio = '1';
            }


            //проверка email
            if (isValidEmailAddress(order_email) == false)
            {
                $("#order_email").css("borderColor", "#FDB6B6");
                send_order_email = '0';
            } else {
                $("#order_email").css("borderColor", "#DBDBDB");
                send_order_email = '1';
            }

            // Проверка телефона

            if (order_phone == "" || order_phone.length > 50)
            {
                $("#order_phone").css("borderColor", "#FDB6B6");
                send_order_phone = '0';
            } else {
                $("#order_phone").css("borderColor", "#DBDBDB");
                send_order_phone = '1';
            }

            // Проверка Адресса

            if (order_address == "" || order_address.length > 150)
            {
                $("#order_address").css("borderColor", "#FDB6B6");
                send_order_address = '0';
            } else {
                $("#order_address").css("borderColor", "#DBDBDB");
                send_order_address = '1';
            }

        }
        // Глобальная проверка
        if (send_order_delivery == "1" && send_order_fio == "1" && send_order_email == "1" && send_order_phone == "1" && send_order_address == "1")
        {
            // Отправляем форму
            return true;
        }

        e.preventDefault();

    });

    function loadcart() {
        $.ajax({
            type: "POST",
            url: "/include/loadcart.php",
            dataType: "html",
            cache: false,
            success: function(data) {

                if (data == 0)
                {

                    $("#block-basket > a").html("<span id='cart-total'>В корзине <b>0</b> товаров на сумму <b>0.00 руб</b></span>");

                } else
                {
                    $("#block-basket > a").html(data);

                }

            }
        });

    }


    function fun_group_price(intprice) {
        // Группировка цифр по разрядам
        var result_total = String(intprice);
        var lenstr = result_total.length;

        switch (lenstr) {
            case 4:
                {
                    groupprice = result_total.substring(0, 1) + " " + result_total.substring(1, 4);
                    break;
                }
            case 5:
                {
                    groupprice = result_total.substring(0, 2) + " " + result_total.substring(2, 5);
                    break;
                }
            case 6:
                {
                    groupprice = result_total.substring(0, 3) + " " + result_total.substring(3, 6);
                    break;
                }
            case 7:
                {
                    groupprice = result_total.substring(0, 1) + " " + result_total.substring(1, 4) + " " + result_total.substring(4, 7);
                    break;
                }
            default:
                {
                    groupprice = result_total;
                }
        }
        return groupprice;
    }

    /*$('.count-plus').live('click', {action: "plus"}, updateCartQuantity);
    $('.count-minus').live('click', {action: "minus"}, updateCartQuantity);
    $('.count-input').live('keyup', {action: "keyup", code: $(this)}, updateCartQuantity);*/

    $('.count-plus').live('click', function(event) {
    	var data = {};
    	data['element'] = $(this);
    	data['action'] = "plus";
    	updateCartQuantity(data);
    });

    $('.count-minus').live('click', function(event) {
    	var data = {};
    	data['element'] = $(this);
    	data['action'] = "minus";
    	updateCartQuantity(data);
    });

    $('.count-input').live('keyup', function(event) {
    	var data = {};
    	data['element'] = $(this).siblings(".count-plus");
    	data['action'] = "keyup";
    	data['keyCode'] = event.keyCode;
    	updateCartQuantity(data);
    });


    function updateCartQuantity(data) {
    	var pid = $(data['element']).siblings('input[type="text"]').attr("name");

    	var newcount = parseInt($(data['element']).siblings('input[type="text"]').val());
        if (isNaN(newcount)) {
        	newcount = 1;
        }

        switch (data.action) {
        	case 'plus':
        		newcount++;
        	break;
        	case 'minus':
        		if (newcount>1) { newcount--; } else {return false; }
        	break;
        	case 'keyup':
        		if (data.keyCode != 13) return false;
        	break;
        }

        var postdata = {};
        postdata[pid] = newcount;

        //alert(JSON.stringify(postdata));
        //return false;

        $.ajax({
            type: "POST",
            url: "/index.php?route=checkout/cart",
            data: postdata,
            dataType: "html",
            cache: false,
            beforeSend: function() {
            	$('.column-count').append('<span class="wait">&nbsp;<img src="/catalog/view/theme/default/images/loading.gif" alt="" /></span>');
            },
            complete: function() {
            	$('.wait').remove();
            },
           	success: function(data) {
            	$("#ajax-cart").html(data);
            	$('#cart').load('index.php?route=module/cart #cart > *');
            },
            error: function(xhr, ajaxOptions, thrownError) {
            	alert(thrownError + "\r\n" + xhr.statusText);
            }
        });
    }

    function  itog_price() {

        $.ajax({
            type: "POST",
            url: "/include/itog_price.php",
            dataType: "html",
            cache: false,
            success: function(data) {

                $(".itog-price > strong").html(data + " руб");

            }
        });

    }


    $('#button-send-review').click(function() {

        var name = $("#name_review").val();
        var good = $("#good_review").val();
        var bad = $("#bad_review").val();
        var comment = $("#comment_review").val();
        var iid = $("#button-send-review").attr("iid");

        if (name != "")
        {
            name_review = '1';
            $("#name_review").css("borderColor", "#DBDBDB");
        } else {
            name_review = '0';
            $("#name_review").css("borderColor", "#FDB6B6");
        }

        if (good != "")
        {
            good_review = '1';
            $("#good_review").css("borderColor", "#DBDBDB");
        } else {
            good_review = '0';
            $("#good_review").css("borderColor", "#FDB6B6");
        }

        if (bad != "")
        {
            bad_review = '1';
            $("#bad_review").css("borderColor", "#DBDBDB");
        } else {
            bad_review = '0';
            $("#bad_review").css("borderColor", "#FDB6B6");
        }


        // Глобальная проверка и отправка отзыва

        if (name_review == '1' && good_review == '1' && bad_review == '1')
        {
            $("#button-send-review").hide();
            $("#reload-img").show();

            $.ajax({
                type: "POST",
                url: "/include/add_review.php",
                data: "id=" + iid + "&name=" + name + "&good=" + good + "&bad=" + bad + "&comment=" + comment,
                dataType: "html",
                cache: false,
                success: function() {
                    setTimeout("$.fancybox.close()", 1000);
                }
            });
        }
    });

    $('#likegood').click(function() {

        var tid = $(this).attr("tid");

        $.ajax({
            type: "POST",
            url: "/include/like.php",
            data: "id=" + tid,
            dataType: "html",
            cache: false,
            success: function(data) {

                if (data == 'no')
                {
                    alert('Вы уже голосовали!');
                }
                else
                {
                    $("#likegoodcount").html(data);
                }

            }
        });
    });

    /*
     $('#input-search').bind('textchange', function() {

     var input_search = $("#input-search").val();

     if (input_search.length >= 3 && input_search.length < 150) {
     $.ajax({
     type: "POST",
     url: "/include/search.php",
     data: "text=" + input_search,
     dataType: "html",
     cache: false,
     success: function(data) {
     if (data > '') {
     $("#result-search").show().html(data);
     } else {
     $("#result-search").hide();
     }
     }
     });
     } else {
     $("#result-search").hide();
     }
     });
     */

    /* Search */
    $('.button-search').bind('click', function() {
        url = $('base').attr('href') + 'index.php?route=product/search';

        var search = $('input[name=\'search\']').attr('value');

        if (search) {
            url += '&search=' + encodeURIComponent(search);
        }

		alert(url);
        location = url;
    });

    $('#block-search input[name=\'search\']').bind('keydown', function(e) {
        if (e.keyCode == 13) {
            url = $('base').attr('href') + 'index.php?route=product/search';

            var search = $('#block-search input[name=\'search\']').attr('value');

            if (search) {
                url += '&search=' + encodeURIComponent(search);
            }

            location = url;
        }
    });

	$('#button-callback').click(function() {
		$.ajax({
		url: 'index.php?route=information/callback/submit',
		type: 'post',
		data: $('.form-callback').serialize(),
		dataType: 'json',
		beforeSend: function() {
			$('#button-callback').attr('disabled', true);
			$('.form-callback').after('<span class="wait">&nbsp;<img src="/catalog/view/theme/default/images/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('#button-callback').attr('disabled', false);
			$('.wait').remove();
		},
		success: function(json) {
			$('.warning, .error').remove();
            if (json['error']) {
            		if (json['error']['name']) {
						$('.form-callback').append('<span class="error"><br />'+json['error']['name']+'</span>');
					}
					if (json['error']['phone']) {
						$('.form-callback').append('<span class="error"><br />'+json['error']['phone']+'</span>');
					}
					if (json['error']['message']) {
						$('.form-callback').append('<span class="error"><br />'+json['error']['message']+'</span>');
					}
					if (json['error']['captcha']) {
						$('.form-callback').append('<span class="error"><br />'+json['error']['captcha']+'</span>');
				}
            } else {
            	if (json['redirect']) {
            		location = json['redirect'];
            	} else {
            		$('.callback-mustbeid').html(json['response']);
            	}
            }

		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
		return false;
	});

});