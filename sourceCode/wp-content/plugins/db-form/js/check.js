va_db_form_check = function(){
	cur_radio_name = '';
	va_db_fill =true;
	va_mail_fill =true;
	va_db_fill_radio = true;
	
	//TEXTAREA
	jQuery('textarea.true').each(function(){							  
		$check = jQuery(this).val().replace(/ /g,'');
		if($check === ''){
			va_db_fill =false;
			jQuery(this).addClass('fill');
		}else{
			if($check === jQuery(this).attr('title')){
				va_db_fill =false;
				jQuery(this).addClass('fill');
			}else{
				jQuery(this).removeClass('fill');
			}
		}	
	});
	//REST
	jQuery('input.true').each(function(){
		if(jQuery(this).hasClass('mail')){
			$check = jQuery(this).attr('value').replace(/ /g,'');
			if(!$check){
				va_mail_fill =false;
				jQuery(this).addClass('fill');
			}else{
				$mail_check = jQuery(this).attr('value');
				var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if(!filter.test($mail_check)){
					va_mail_fill =false;
					jQuery(this).addClass('fill');	
				}else{
					jQuery(this).removeClass('fill');	
				}
			}
		}else{
			if(jQuery(this).attr('type') == 'text'){
				$check = jQuery(this).attr('value').replace(/ /g,'');
				if($check === ''){
					va_db_fill =false;
					jQuery(this).addClass('fill');
				}else{
					if($check === jQuery(this).attr('title')){
						va_db_fill =false;
						jQuery(this).addClass('fill');
					}else{
						jQuery(this).removeClass('fill');
					}
				}
			}
			if(jQuery(this).attr('type') == 'checkbox'){
				$check = jQuery(this).attr('checked');
				if(!$check){
					va_db_fill =false;
					jQuery(this).parent().addClass('fill_2');
				}else{
					jQuery(this).parent().removeClass('fill_2');
				}
			}
			if(jQuery(this).attr('type') == 'radio'){
				
				if(cur_radio_name == jQuery(this).attr('name')){
					$check = jQuery(this).attr('checked');
					if(!$check){
					}else{
						va_db_fill_radio = true;
						jQuery(this).parent().removeClass('fill_2');	
					}
				}else{
					cur_radio_name = jQuery(this).attr('name');
					$check = jQuery(this).attr('checked');
					if(!$check){
						va_db_fill_radio =false;
						jQuery(this).parent().addClass('fill_2');
					}else{
						jQuery(this).parent().removeClass('fill_2');	
					}
				}
			}
		}
	});
	
	if(va_db_fill == true && va_mail_fill == true && va_db_fill_radio == true){
		document.db_form.submit();
	}
}