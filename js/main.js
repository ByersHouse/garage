

$( "input" ).keyup(function( event ) {

if (this.value.length == this.maxLength && $(this).hasClass('callContentInput--two')) {
  var $next = $(this).next('.callContentInput');
  
  if ($next.length)
  {
  	$(this).next('.callContentInput').attr('disabled', false);
      $(this).next('.callContentInput').focus();
  }
  	
  else {
      $(this).blur();
  }

}

if (this.value.length == this.maxLength && $(this).hasClass('callContentInput--three')) {
    var second_length = $('.callContentInput--two').val();
    if(second_length.length < 2)
    {
      var _value = $(this).val();
      var first = _value.substr(0,1);
      var result = _value.substr(1);
      
      var prevTwo = $('.callContentInput--two').val();
     
      $(this).attr('value', result);
      $(this).val(result);

      $('.callContentInput--two').attr('value', prevTwo+first);
      $('.callContentInput--two').val(prevTwo+first)  
    }
}

if(this.value.length == 0)
{
   $(this).prev('.callContentInput').focus();
}



});



$(document).on('click','.faqQuestion', function(){
	
	if( $(this).parent().find('.faqAnswer').hasClass('faqAnswer--opened') )
	{
		$(this).parent().find('.faqAnswer').removeClass('faqAnswer--opened');
	}
	else
	{
		$(this).parent().find('.faqAnswer').addClass('faqAnswer--opened');
	}

});



$(window).on( 'scroll', function ( event ) {
  

  if($(window).width() >= 1025)
  {
    var p = $('#plans');
    var pos = $(window).scrollTop();
    if(pos < 1440) {
         $('.block__table').show();
         $('.block__table').removeClass('block__table--fixed');
    }
    else if(pos >= 1440 && pos <= 2250)
    {
      $('.block__table').show();
    	$('.block__table').addClass('block__table--fixed');
    }
    else
    {
      $('.block__table').hide();
      $('.block__table').removeClass('block__table--fixed');
    }
  }


});


$(document).ready(function(){
  if(document.location.hash === "#cart"){
    
    if($(window).width() > 768)
    {
           $('body').animate({
                scrollTop: 1300
        }, 'slow');

        $('body').animate({
                scrollTop: 1300
        }, 'slow');
    }

    if($(window).width() < 768)
    {
           $('body').animate({
                scrollTop: 1720
        }, 'slow');

        $('body').animate({
                scrollTop: 1720
        }, 'slow');
    }

     
  }

});
