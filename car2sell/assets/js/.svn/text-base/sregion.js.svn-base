$(document).ready(function(){
    var $regions_showed = 0;
    $('#sel-reg-button').click(function(){
		
		if($regions_showed==0){
			
			$('.regions_select_area').show();
			$regions_showed = 1;
			$(".cities_select_area").hide();
			
		}else{
			$regions_showed = 0;
			$('.regions_select_area').hide();
			$('.cities_select_area').hide();
		}
		
	});
	
	//select region!
    $('.select-region').click(function(){
		var $region_id = $(this).attr('id');
		$region_id = $region_id.substr(1);
		$.post(  
                '/ajax/CityByRegionList/',  
                {region_id: $region_id},  
                function(responseText){  
					
					$(".cities_select_area").html(responseText);
                    $(".cities_select_area").show();
					$('.regions_select_area').hide();
                },  
                "html"  
       );  
	   return false;
	});
	//select city
	$('.select-city2').click(function(){
		var $city_id = $(this).attr('id');
		$city_id = $city_id.substr(1);
		$.post(  
                '/ajax/getCityByRegionList/',  
                {region_id: $region_id},  
                function(responseText){  
					
					$(".cities_select_area").html(responseText);
                    $(".cities_select_area").show();
					$('.select-region').hide();
                },  
                "html"  
       );  
	   return false;
	});

});