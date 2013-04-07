<?php

//FORM
function va_db_form_func( $atts , $content=null) {

	$message = $_GET['message'];
	if($message){
		//build form
		$db_return = '<div id="db_form_message">';
			if($message == 'success'){
				if(get_option('va_db_form_hide') == 'checked'){
					$extra_class = 'hidden';
				}
				$db_return .= '<span>'.get_option('va_db_form_mes_success').'</span>';
			}
		$db_return .='</div><!-- #db_form_message -->';
	}	
	$db_return .= '<form class="db-form form '.$extra_class.'" name="db_form" method="post" action="'.plugins_url( 'php/submit.php' , dirname(__FILE__) ).'">';
		$db_return .= '<input type="hidden" name="post_id" value="submit_front_form" />';
		$db_return .= '<input type="hidden" name="va_db_origin" value="'.get_the_ID().'" />';
		//$db_return .= '<table class="form-table">';
			$db_return .= do_shortcode($content);
		//$db_return .= '</table>';
	$db_return .= '</form>';
	
	//return
	return $db_return;

	
}
add_shortcode( 'db_form', 'va_db_form_func' );

//INPUT TEXT
function va_db_form_input_func( $atts, $content=null) {
	extract( shortcode_atts( array(
		'label' => '',
		'name' => 'sql_',
		'required' => '',
		'value' => ''
	), $atts ) );
	
	//build return
	$input_return = '<table class="form-table input-table"><tr valign="top">';
		$input_return .= '<th scope="row">';
			$input_return .= '<label>'.$label.'</label>';
		$input_return .= '</th>';
		$input_return .= '<td>';
			$input_return .= '<input class="input '.$required.'" type="text" name="'.$name.'" value="'.$value.'" onfocus="cleanInitInput(this)" />';
		$input_return .= '</td>';
	$input_return .= '</tr></table>';
	
	//return
	return $input_return;
}
add_shortcode( 'input', 'va_db_form_input_func' );

//TEXTAREA
function va_db_form_textarea_func( $atts, $content=null) {
	extract( shortcode_atts( array(
		'label' => '',
		'name' => 'sql_',
		'required' => '',
		'value' => ''
	), $atts ) );
	
	//build return
	$input_return = '<table class="form-table textarea-table"><tr valign="top">';
		$input_return .= '<th scope="row">';
			$input_return .= '<label>'.$label.'</label>';
		$input_return .= '</th>';
		$input_return .= '<td>';
			$input_return .= '<textarea class="input '.$required.'" type="text" name="'.$name.'" onfocus="cleanInitInput(this)">'.$value.'</textarea>';
		$input_return .= '</td>';
	$input_return .= '</tr></table>';
	
	//return
	return $input_return;
}
add_shortcode( 'textarea', 'va_db_form_textarea_func' );

//INPUT MAIL
function va_db_form_mail_func( $atts, $content=null) {
	extract( shortcode_atts( array(
		'label' => '',
		'name' => 'sql_',
		'required' => '',
		'value' => ''
	), $atts ) );
	
	//build return
	$mail_return = '<table class="form-table mail-table"><tr valign="top">';
		$mail_return .= '<th scope="row">';
			$mail_return .= '<label>'.$label.'</label>';
		$mail_return .= '</th>';
		$mail_return .= '<td>';
			$mail_return .= '<input class="input mail '.$required.'" type="text" name="'.$name.'" value="'.$value.'" onfocus="cleanInitInput(this)" />';
		$mail_return .= '</td>';
	$mail_return .= '</tr></table>';
	
	//return
	return $mail_return;
}
add_shortcode( 'mail', 'va_db_form_mail_func' );

//INPUT RADIO
function va_db_form_radio_func( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'label' => '',
		'name' => 'sql_',
		'required' => '',
		'value' => '',
		'description' => ''
	), $atts ) );
	
	//build return
	$radio_return = '<table class="form-table radio-table"><tr valign="top"><th style="display:inline-block; float:left;"><label>'.$description.'</label></th><td class="radio">';
	$i = 0;
	$labels = explode(";", $label);
	$radios = explode(";", $value);
	foreach ($radios as $radio) {
		$radio_return .= '<input class="radio '.$required.'" type="radio" name="'.$name.'" value="'.$radio.'" />'.$labels[(int)$i].'<br />';
		
		$i++;
	}
	$radio_return .= '</td><td class="breaker"></td></tr></table>';
	
	//return
	return $radio_return;
}
add_shortcode( 'radio', 'va_db_form_radio_func' );

//INPUT CHECKBOX
function va_db_form_checkbox_func( $atts, $content=null ){
	extract( shortcode_atts( array(
		'label' => $content,
		'name' => 'sql_',
		'required' => '',
		'value' => ''
	), $atts ) );
	
	//build return
	$checkbox_return = '<table class="form-table checkbox-table"><tr valign="top">';
		$checkbox_return .= '<td><input class="checkbox '.$required.'" type="checkbox" name="'.$name.'" value="'.$value.'" /><label>'.$label.'</label></td>';
	$checkbox_return .= '</tr></table>';
	
	//return
	return $checkbox_return;
}
add_shortcode( 'checkbox', 'va_db_form_checkbox_func' );

//INPUT SUBMIT
function va_db_form_submit_func( $atts, $content=null ){
	extract( shortcode_atts( array(
		'label' => ''
	), $atts ) );	
	
	//build return
	$submit_return = '<table class="form-table submit-table"><tr valign="top"><td><input class="button" type="button" value="'.$label.'" onclick="javascript:va_db_form_check();" /></td></tr></table>';
	
	//return
	return $submit_return;
}
add_shortcode( 'submit', 'va_db_form_submit_func' );

?>