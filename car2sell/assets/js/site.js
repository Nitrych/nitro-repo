$(document).ready(function(){
    highlightFavorItems();
	
	/*$('.post_row').hover(function(){
		 $post_id = substr($(this).attr('id') ,1 );
		 $(".add_to_favor#"+$post_id).css('display','block');
		 $(".add_to_favor#"+$post_id).css('background-position','-30px -57px');
	});
	*/

	$('select').selectbox();
	
	$('.add_to_favor').click(function(){
	
	  $id = $(this).attr('id');
	  $.post(  
                '/ajax/addFavor/',  
                {post_to_add: $id},  
                function(responseText){  
					$("#favor_added").show();
					setTimeout(function() { $("#favor_added").hide(); }, 5000);
					$("#favor_area").html(responseText);
					
                    $("#favor_area").show();
					highlightFavorItems();
                },  
                "html"
       );

	});
	
	$('.phone_trigger').click(function(){
	
	  $id = $(this).attr('id');
	  $.post(  
                '/ajax/getPhone/',  
				
                {post_id: $id},  
                function(responseText){  
					$(".phone_place").html(responseText);
					$(".phone_trigger").hide();
                },  
                "html"  
       );  
	
	});
	
	
	
    $('.fancybox').fancybox();
    
    $('.category_choose').live('click', function(){
        $('#PostForm_category').attr('value', parseInt($(this).attr('name')));
		$('#chosen_category_text').empty().text($(this).text());
		$('#choose_category_button span').empty().text('Изменить');
		$('#PostForm_category').trigger('blur');
        $.fancybox.close();
    });

	$('#PostForm_phone_number, #PostForm_icq, #PostForm_skype, #PostForm_near_adress').keyup(function(){
		if($(this).attr('value')>0) $(this).parents('.row').addClass('bg_success');
		else $(this).parents('.row').removeClass('bg_success');
	});

    
	$('.form_region').change(function(){
		var val = $(this).attr('value');
		if(val.indexOf('region')==-1)
		{
            //DEPRECATED hide city row when check main city in region select
			//$('#PostForm_city').empty().append('<option value="'+val+'">Выбрано</option>');
			//$('#PostForm_city').parents('.row').hide();
		}
		else
		{
			$('.form_city').parents('.row').removeClass('success').show();
			var region_id = parseInt(val.substr(7));
			$.ajax({
					type: 'POST',
					url: '/ajax/cityByRegion/',
					data: ({ region_id:region_id }),
					dataType: 'html',
					success: function(data)
					{
						if(data) $('.form_city').empty().append(data);

						$('.form_city').trigger('refresh');
					}
			});
		}
	});
    //function initDropdowns(city_id){
	//	
	//}

    $('#gototop').click(function(){
        $(document).scrollTop(0);
        return false;
    });
    setGoToTopButton();
    onscroll = onScrollWindow;
    
    $('input, select, textarea').focus(function(){
        $(this).parent().find('.infoMessage').show();
    }).focusout(function(){
        $(this).parent().find('.infoMessage').hide();
    });
    
    $('.left_count').keyup(function(event){
        var max = $(this).attr('maxlength');
        var current = $(this).val().length;
        var left = max - current;
        console.log(max+';'+current+';'+left);
        if(left<0 && event.which!=8 && event.which!=46)
        {
            return false;
        }
        $(this).parent().find('.number_left b').text(left);
    });

    $('.with_suggest').focus(function(){
        var name = $(this).attr('name');
        $('.suggest_box').hide();
        $(this).parent().find('.suggest_box[suggestfor="'+name+'"]').show();
    });
    
    $('.suggest_box li').click(function(){
        var name = $(this).parent('ul').attr('suggestfor');
        var value = $(this).text();
        $(this).parents('.col_2').find('input[name="'+name+'"]').attr('value', value);
        $(this).parent('ul').hide();
    });

    $('.with_suggest').click(function(event){
        event.stopPropagation();
    });
    $('body').click(function() {
        $('.suggest_box').hide();
    });
	
	var $hidable_status = 0;
	$('.hide_hidable').click(function() {
		//console.log("hited"+$hidable_status);
		var new_caption = $(this).attr('rel');
		if($hidable_status){
			$hidable_status = 0;
			$('.hidable').show();
			$('.hide_hidable').attr('rel', $('.hide_hidable').html() );
			$('.hide_hidable').html(new_caption);
		}else{
			$hidable_status = 1;
			$('.hidable').hide();
			$('.hide_hidable').attr('rel', $('.hide_hidable').html() );
			$('.hide_hidable').html(new_caption);
			
		}
    });
	
	
	$("#reportMe").fancybox({
	'scrolling'		: 'no',
	'titleShow'		: false,
	'onClosed'		: function() {
	    $("#login_error").hide();
	}
	});
	
	$('#report-textarea').focus(function() {
		if($(this).val()=='<напишите всю важную для проверки информацию. Если вы хотите, чтобы мы вам ответили, укажите тут ваш email-адрес>')
			$(this).val('');
	});
	
	$("#report-form").bind("submit", function() {
    //alert("report-form");
	//if ($("#login_name").val().length < 1 || $("#login_pass").val().length < 1) {
	 //   $("#login_error").show();
	  //  $.fancybox.resize();
	   // return false;
	//}

	//$.fancybox.showActivity();
   
	$.ajax({
		type		: "POST",
		cache	: false,
		url		: "http://fdmoz.org/site/spam",
		dataType: 'jsonp',
		data		: $(this).serializeArray(),
		success: function(json) {
			
			$.fancybox(json['res']);
		}
	});

	return false;
	});
	
	$('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}
	});
	
});

function highlightFavorItems(){
	var favorite = $.cookie("bookmarks");

	if (favorite==null){
	
		return false;
	}
	var fav_arr = favorite.split(',');
	var $post_id = 0;
	$.each(fav_arr, function(index, value) {
		$post_id = this;
		if ($(".add_to_favor#"+$post_id).length > 0){
			//$(".add_to_favor#"+$post_id).css('color','#aeaeae');
			console.log($post_id);
			$(".add_to_favor#"+$post_id).css('display','block');
			$(".add_to_favor#"+$post_id).css('background-position','-30px -57px');
			
		}
	});

}



function onScrollWindow() {
	var scrollTop = self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
	
	if(scrollTop > 100){
		$("#gototop").show();
	} else {
		$("#gototop").hide();
	}

}

function setGoToTopButton()
{
    var screen_w = screen.width;
    var left = (screen_w - 880)/2 + 880;
    $("#gototop").css('left', left+'px');
    var topOffset = self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
    if(topOffset > 100){
		$("#gototop").show();
	}
}

	function loadCities(region_id,id){
			$.ajax({
					type: 'POST',
					url: '/ajax/cityByRegion/',
					data: ({ region_id:region_id }),
					dataType: 'html',
					success: function(data)
					{
						if(data) $('.form_city').empty().append(data);
						$('.form_city').val( id ).attr('selected',true);
						$('.form_city').trigger('refresh');
		$				(".form_city option:eq("+id+")").attr('selected', 'selected'); 	
					}
			});
		
	}
	