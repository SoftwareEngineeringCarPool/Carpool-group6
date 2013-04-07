window.onload = function(){
	jQuery('textarea.true').each(function(){
		cleanInitInput(this);								  
	});
	jQuery('input.true').each(function(){
		cleanInitInput(this);								   
	});
}


function cleanInitInput(target){
	if(!target.initvalue){
		if(target.initvalue !== ''){
			target.initvalue = target.value;
			target.title = target.value;
			//alert(target.initvalue);
		}
	}else if(target.value == target.initvalue){
		target.value = "";	
	}	
}