$(document).on('click','.border__tableButton--green', function(){
	addToCart('econom');
});

$(document).on('click','.border__tableButton--yellow', function(){
	addToCart('comfort');
});

$(document).on('click','.border__tableButton--orange', function(){
	addToCart('vip');
});

$(document).on('click','.border__tableButtons .header__cart--green a', function(){
	addToCart('econom');
});

$(document).on('click','.border__tableButtons .header__cart--yellow a', function(){
	addToCart('comfort');
});

$(document).on('click','.border__tableButtons .header__cart--orange a', function(){
	addToCart('vip');
});


$(document).on('click','.header__cart.header__cart--table.header__cart--green a', function(){
		addToCart('econom');
});
$(document).on('click','.header__cart.header__cart--table.header__cart--yellow a', function(){
		addToCart('comfort');
});
$(document).on('click','.header__cart.header__cart--table.header__cart--orange a', function(){
		addToCart('vip');
});



$(document).on('click','#buyCard',function(){

	if($('#agreed').is(':checked') === false)
	{
		$('.agreement span').addClass('error');
		$('.agreement a').addClass('error');
	}

		var name = $('#name').val();
		var phone = $('#phone').val();
		var email = $('#email').val();

		var city = $('#gorod').val();
		var street = $('#street').val();
		var dom = $('#dom').val();
		var flat = $('#flat').val();

		var payment = $('#payment option:selected').val();
		var comment = $('#comment').val();	
	
	if(phone == '')
	{
			$("body").animate({ scrollTop: 0 }, "slow");

			/*if(name == '')
			{
				$('#name').addClass('errorInput');
				$('#name').parent().find('.errorSpanClass').text('Это поле обязательное');
				$('#name').parent().find('.errorSpanClass').show();
			}*/

			if(phone == '')
			{
				$('#phone').addClass('errorInput');
				$('#phone').parent().find('.errorSpanClass').text('Это поле обязательное');
				$('#phone').parent().find('.errorSpanClass').show();
			}

			/*if(email == '')
			{
				$('#email').addClass('errorInput');
				$('#email').parent().find('.errorSpanClass').text('Это поле обязательное');
				$('#email').parent().find('.errorSpanClass').show();
			}

			if(city == '')
			{
				$('#gorod').addClass('errorInput');
				$('#gorod').parent().find('.errorSpanClass').text('Это поле обязательное');
				$('#gorod').parent().find('.errorSpanClass').show();
			}

			if(street == '')
			{
				$('#street').addClass('errorInput');
				$('#street').parent().find('.errorSpanClass').text('Это поле обязательное');
				$('#street').parent().find('.errorSpanClass').show();
			}

			if(dom == '')
			{
				$('#dom').addClass('errorInput');
				$('#dom').parent().find('.errorSpanClass').text('Это поле обязательное');
				$('#dom').parent().find('.errorSpanClass').show();
			}*/



	}
	else
	{
		if($('#payment option:selected').val() == 1)
		{
			//cash
			if($('#agreed').is(':checked') === true)
			{
				$.post('back.php', {payCash:'ok', name: name, phone: phone, email: email, city: city, street: street, dom: dom, flat: flat, payment: payment, comment: comment}, function(data){
					if(data == 'success')
					{
						$('#successModal').modal();
						$('#successModal').on($.modal.BEFORE_CLOSE, function(event, modal) {
							window.location.href = '/last/finish';
						});
					}
				});
			}
			else
			{
				$('.agreement span').addClass('error');
				$('.agreement a').addClass('error');
			}
		}

		if($('#payment option:selected').val() == 2)
		{
			
			if($('#agreed').is(':checked') === true)
			{
				$.post('back.php', {payCard:'ok', name: name, phone: phone, email: email, city: city, street: street, dom: dom, flat: flat, payment: payment, comment: comment}, function(data){
					console.log(data);
				});

				$('.hiddenLiqPay form').submit();
			
			} else {
				$('.agreement span').addClass('error');
				$('.agreement a').addClass('error');
			 }
			//pay online
			/*$.post('back.php', {pay:'ok', name: name, phone: phone, email: email, city: city, street: street, dom: dom, flat: flat, payment: payment, comment: comment}, function(data){
					console.log(data);
			});
		  */
		}

		
	}



});




function addToCart(package)
{
	$.post('back.php', {package: package}, function(response){
		if(response != 'error')
		{
		
			/*$("html, body").animate({ scrollTop: 0 }, "slow");*/
			$('#callme-modal2').modal();
			$('.block__table').removeClass('block__table--fixed');
		    $('.header__cart--f').html(response);
		}
	});

	
}


$(document).on('change', '.ccuCI', function(){
	$(this).removeClass('errorInput');
	$(this).parent().find('.errorSpanClass').hide();
})

$(document).on('click', '#callmeSubmit', function(){
	var phone = $('#callback-phone').val();
	console.log('clicked');
	if(phone.length == 13)
	{
		$.post('back.php', {phoneCall:true, phone: phone}, function(data){
			if(data == 'success')
			{
				$('#modal-message22').html('<h4 class="zoz zoz-blue">Ваш запрос отправлен</h4><p class="zoz-blueB">Мы свяжемся с Вами в ближайшее время. Спасибо за обращение!</p>');
			}
			else
			{
				$('#callback-phone').attr('style','border:1px solid red');
			}
		});
	}else
	{
		$('#callback-phone').attr('style','border:1px solid red');
	}
});



$(document).on('click', "#callMeFromBlock", function(){
	var part1 = '380';
	var part2 = $('.callContentInput--two').val();
	var part3 = $('.callContentInput--three').val();

	var phone = part1+part2+part3;

	if(phone.length == 12)
	{
		$.post('back.php', {phoneCallBlock:true, phone: phone}, function(data){
			if(data == 'success')
			{
				$('#mbcd').modal();
			}
			else
			{
				alert('Введите корректный номер телефона!');
			}
		});
	}
	else
	{
		$('.errorTextCallMe').show();
	}

});


$(document).on('mouseenter','.header__cart--f', function(){
	if($(window).width() >= 1025)
	{
		$(this).addClass('header__cart--f--opened');
		$('.hiddenText').animate({"right":"16px"}, 555);
		$('.hiddenText').show();
	}
	
});

$(document).on('mouseleave','.header__cart--f', function(){
		if($(window).width() >= 1025)
	{
		$('.hiddenText').hide();
		$(this).removeClass('header__cart--f--opened');
	$('.hiddenText').animate({"right":"-316px"},0);
	
	}
	
});


$(document).on('click', '.agreeCheck', function(){
	$('#buyCard').toggleClass('agreed');
});

$('input.callContentInput').keypress(function(e) {
	$('.errorTextCallMe').hide();
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
        a.push(i);

    if (!(a.indexOf(k)>=0))
        e.preventDefault();
});

$('input#phone').keypress(function(e) {
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
        a.push(i);

    if (!(a.indexOf(k)>=0))
        e.preventDefault();
});



$('.mfor').keypress(function(e) {
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
        a.push(i);

    if (!(a.indexOf(k)>=0))
        e.preventDefault();
});

$('#myModalCallback3').click(function(){
	$('#myModalCallback3').hide();
});


function checkReview()
{
	
	
}

function updateCaptcha()
{
	$.post('back.php', {updateCap: true}, function(data){
		$('#r_captcha').parent().find('img').attr('src', data);
	});
}


$(document).on('click','#leftReview', function(){
	var name = $('#r_name').val();
	var car = $('#r_car').val();
	var capt = $('#r_captcha').val();
	var email = $('#r_email').val();
	var review = $('#r_review').val();
	var rate = $('.star.checked').attr('data-rate');

	if(name == '' || car == '' || capt == '' || email == '' || review == '')
	{
		

		if(name == '')
		{
			$('#r_name').parent().find('.errorSpanClass2').show();
		}
		if(car == '')
		{
			$('#r_car').parent().find('.errorSpanClass2').show();
		}
		if(capt == '')
		{
			$('#r_captcha').parent().find('.errorSpanClass2').text('Это обязательное поле');
			$('#r_captcha').parent().find('.errorSpanClass2').show();
		}
		if(email == '')
		{
			$('#r_email').parent().find('.errorSpanClass2').show();
		}

		if(review == '')
		{
			$('#r_review').parent().find('.errorSpanClass2').show();
		}
	}
	else{
		var str = $('#r_captcha').val();
			$.post('back.php', {checkCap: str}, function(data){
			if(data == 'correct'){

				$.post('back.php', {makeReview:true, name:name, car:car, email: email, comment: review, rate: rate}, function(data){
					res = data;
					if(res == 'success')
					{
						$('#successModal4').modal();
						$('#successModal4').on($.modal.BEFORE_CLOSE, function(event, modal) {
							window.location.href = '/last/';
						});

					}
					else
					{
						alert(data);
					}
				});
			}
			else
			{
				updateCaptcha();
				$('#r_captcha').parent().find('.errorSpanClass2').text('Введите верные символы');
				$('#r_captcha').parent().find('.errorSpanClass2').show();
			}
		});
	}


});


$(document).on('change', '.wrLeft input, .wrRight textarea', function(){
	$(this).parent().find('.errorSpanClass2').hide();
})

$(document).on('change', '#r_captcha', function(){
	$(this).parent().find('.errorSpanClass2').hide();
})

$(document).on('click','.rw__rating a .star5',function(){
	$('.rw__rating .star').removeClass('checked');
	$(this).addClass('checked');
	$('.rw__rating .star').removeClass('star--o');
});

$(document).on('click','.rw__rating a .star4',function(){
	$('.rw__rating .star').removeClass('checked');
	$(this).addClass('checked');
	$('.rw__rating .star').removeClass('star--o');
	$('.rw__rating .star5').addClass('star--o');
});

$(document).on('click','.rw__rating a .star3',function(){
	$('.rw__rating .star').removeClass('checked');
	$(this).addClass('checked');
	$('.rw__rating .star').removeClass('star--o');
	$('.rw__rating .star4').addClass('star--o');
	$('.rw__rating .star5').addClass('star--o');
});

$(document).on('click','.rw__rating a .star2',function(){
	$('.rw__rating .star').removeClass('checked');
	$(this).addClass('checked');
	$('.rw__rating .star').removeClass('star--o');
	$('.rw__rating .star3').addClass('star--o');
	$('.rw__rating .star4').addClass('star--o');
	$('.rw__rating .star5').addClass('star--o');
});


$(document).on('click','.rw__rating a .star1',function(){
	$('.rw__rating .star').removeClass('checked');
	$(this).addClass('checked');
	$('.rw__rating .star').removeClass('star--o');
	$('.rw__rating .star2').addClass('star--o')
	$('.rw__rating .star3').addClass('star--o');
	$('.rw__rating .star4').addClass('star--o');
	$('.rw__rating .star5').addClass('star--o');
});