// JavaScript Document
jQuery(document).ready(function() {
       
    jQuery("#health_insurance_no").click(function() {
        if(jQuery(this).is(":checked") ) {
            jQuery("#disappear").fadeOut(1000);
    } else {
      jQuery("#disappear").fadeIn(1000);
    }
    });
	
	jQuery("#health_insurance_yes").click(function() {
        if(jQuery(this).is(":checked") ) {
            jQuery("#disappear").fadeIn(1000);
    } else {
      jQuery("#disappear").fadeOut(1000);
    }
    });
	

});