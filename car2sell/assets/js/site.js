$(document).ready(function(){
    
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

	$('#PostForm_region').change(function(){
		var val = $(this).attr('value');
		if(val.indexOf('region')==-1)
		{
			$('#PostForm_city').empty().append('<option value="'+val+'">Выбрано</option>');
			$('#PostForm_city').parents('.row').hide();
		}
		else
		{
			$('#PostForm_city').parents('.row').removeClass('success').show();
			var region_id = parseInt(val.substr(7));
			$.ajax({
					type: 'POST',
					url: '/ajax/cityByRegion/',
					data: ({ region_id:region_id }),
					dataType: 'html',
					success: function(data)
					{
						if(data) $('#PostForm_city').empty().append(data);
					}
			});
		}
	});

});
