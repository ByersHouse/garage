$(document).on('click', '#podbor', function(){
	

	var select1 = $('#year option:selected').val();
	var select2 = $('#type option:selected').val();
	var select3 = $('#fuel option:selected').val();
	$('.home__calc .bluebutton').text('Идет подбор...');	
	

	if(select1 != '0' && select2 != '0' && select3 != '0')
	{
		setTimeout(showCalcSuccess, 1200);
	}
	else
	{
		if(select1 == '0' && select2 == '0' && select3 == '0')
		{
			setTimeout(showCalcError(1), 1200);
		}	
		else if(select1 != '0' && select2 == '0' && select3 == '0')
		{
			setTimeout(showCalcError(2), 1200);	
		}
		else if(select1 == '0' && select2 != '0' && select3 == '0')
		{
			setTimeout(showCalcError(3), 1200);	
		}
		else if(select1 == '0' && select2 == '0' && select3 != '0')
		{
			setTimeout(showCalcError(4), 1200);	
		}
		else if(select1 != '0' && select2 != '0' && select3 == '0')
		{
			setTimeout(showCalcError(5), 1200);	
		}
		else if(select1 == '0' && select2 != '0' && select3 != '0')
		{
			setTimeout(showCalcError(6), 1200);	
		}
		else if(select1 != '0' && select2 == '0' && select3 != '0')
		{
			setTimeout(showCalcError(7), 1200);	
		}
	}

});


function showCalcSuccess()
{
	var plan = 0;
	var economy = 0;

	$('.home__calc .bluebutton').text('Подобрать');	
	var select1 = $('#year option:selected').val();
	if( (select1 == '2000-2009') || (select1 == '1995-1999') || (select1 == '2010') || (select1 == '2011') || (select1 == '2012') || (select1 == '2013') || (select1 == '2014'))
	{
		var plan = 'Comfort';
		var economy = 6870;
	}
	else if(select1 == 'do1995')
	{
		var plan = 'ЭКОНОМ';
		var economy = 4210;
	}
	else
	{
		var plan = 'VIP';
		var economy = 57850;
	}

	var select3 = $('#fuel option:selected').val();

	if( select3 == 'd50')
	{
		var final_economy = parseInt(economy+1500);
		var final_message = 'С этим пакетом Ваша экономия на топливе составит до 1500 грн/год. Общая годовая экономия — около '+final_economy+' грн.';
	}
	else if(select3 == 'l51_100')
	{
		var final_economy = parseInt(economy+3000);
		var final_message = 'С этим пакетом Ваша экономия на топливе составит до 3000 грн/год. Общая годовая экономия — около '+final_economy+' грн.';
	}
	else if(select3 == 'l101_200')
	{
		var final_economy = parseInt(economy+6000);
		var final_message = 'С этим пакетом Ваша экономия на топливе составит до 6000 грн/год. Общая годовая экономия — около '+final_economy+' грн.';
	}
	else if(select3 == 'l201_400')
	{
		var final_economy = parseInt(economy+12000);
		var final_message = 'С этим пакетом Ваша экономия на топливе составит до 12000 грн/год. Общая годовая экономия — около '+final_economy+' грн.';
	}
	else if(select3 == 'l400')
	{
		var final_economy = parseInt(economy+12000);
		var final_message = 'С этим пакетом Ваша экономия на топливе составит не менее 12000 грн/год. Общая годовая экономия — не менее '+final_economy+' грн.';
	}
	else
	{

	}

	$('.calc__error').hide();
	$('.calc__message').html('<div class="calc_result">Мы рекомендуем Вам пакет <a href="javascript:;" class="scrollToPlan">'+plan+'</a></div>');
	$('.calc__message2').html('<div class="calc_result2">'+final_message+'</div>');
}

$(document).on('click', '.scrollToPlan', function(){ 
 $('html, body').animate({
        scrollTop: $("#plans").offset().top
    }, 1000);
});


$(document).on('click', '.bgsdf', function(){
	$('html, body').animate({
        scrollTop: $("#plans").offset().top
    }, 1000);
});

function showCalcError(type)
{
	$('.home__calc .bluebutton').text('Подобрать');	
	if(type == 1)
	{
		$('.calc__error').html('<div class="calc_errorText">Пожалуйста, выберите год выпуска автомобиля, тип автомобиля, потребление топлива в месяц</div>');
	}
	else if(type == 2)
	{
		$('.calc__error').html('<div class="calc_errorText">Пожалуйста, выберите тип автомобиля, потребление топлива в месяц</div>');
	}
	else if(type == 3)
	{
		$('.calc__error').html('<div class="calc_errorText">Пожалуйста, выберите год выпуска автомобиля, потребление топлива в месяц</div>');
	}
	else if(type == 4)
	{
		$('.calc__error').html('<div class="calc_errorText">Пожалуйста, выберите год выпуска автомобиля, тип автомобиля</div>');
	}
	else if(type == 5)
	{
		$('.calc__error').html('<div class="calc_errorText">Пожалуйста, выберите потребление топлива в месяц</div>');
	}
	else if(type == 6)
	{
		$('.calc__error').html('<div class="calc_errorText">Пожалуйста, выберите год выпуска автомобиля</div>');
	}
	else if(type == 7)
	{
		$('.calc__error').html('<div class="calc_errorText">Пожалуйста, выберите тип автомобиля</div>');
	}
	
}