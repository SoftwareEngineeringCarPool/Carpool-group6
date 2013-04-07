va_db_form_switch_fields = function(target){
	
	$va_db_changed_value = jQuery(target).val();
	
	if($va_db_changed_value == 'e'){
		jQuery('tr.d').addClass('hidden');
		jQuery('tr.e').removeClass('hidden');
	}else if($va_db_changed_value == 'd'){
		jQuery('tr.e').addClass('hidden');
		jQuery('tr.d').removeClass('hidden');
	}else if($va_db_changed_value == 'custom'){
		jQuery('tr.no_c').addClass('hidden');
		jQuery('tr.c').removeClass('hidden');	
	}else if($va_db_changed_value != 'custom'){
		jQuery('tr.c').addClass('hidden');
		jQuery('tr.no_c').removeClass('hidden');
	}
		
}