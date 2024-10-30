jQuery(document).ready(function(){
	
	jQuery('ul.tabs li').click(function(){
	    var tab_id = jQuery(this).attr('data-tab');
	    jQuery('ul.tabs li').removeClass('cfwr-current');
	    jQuery('.cfwr-tab-content').removeClass('cfwr-current');  
	    jQuery(this).addClass('cfwr-current');
	    jQuery("#"+tab_id).addClass('cfwr-current');
	});
    jQuery('form#your-profile').attr('enctype', 'multipart/form-data');

    var addButton = jQuery('.custom_add_options'); //Add button selector
    var wrapper = jQuery('.custom_field_option_body'); //Input field wrapper
    var fieldHTML = '<tr class="custom_field_option_tr"><td><input type="text" name="custom_field_option_value[]" placeholder="value" value=""></td><td><input type="text" name="custom_field_option_label[]" placeholder="label" value=""></td><td><span class="custom_remove_options"><img src="'+remove_icon.icon+'"></span></td></tr>';
    
    //Once add button is clicked
    jQuery(addButton).click(function(){
        jQuery(wrapper).append(fieldHTML);
    });
    
    //Once remove button is clicked
    jQuery(wrapper).on('click', '.custom_remove_options', function(e){
        e.preventDefault();
        jQuery(this).parent().parent().remove();
    });

    jQuery('.custom_field_type').on('change', function() {
        if ( jQuery(this).val() == 'radio' || jQuery(this).val() == 'select' ) {
            jQuery(".multiple_options").fadeIn(300);
            jQuery(".field_placeholder").fadeOut(300);
        } else {
            jQuery(".multiple_options").fadeOut(300);
            jQuery(".field_placeholder").fadeIn(300);
        }
    });
    if ( jQuery('.custom_field_type').val() == 'radio' || jQuery('.custom_field_type').val() == 'select' ) {
        jQuery(".multiple_options").show();
        jQuery(".field_placeholder").hide();
    } else {
        jQuery(".multiple_options").hide();
        jQuery(".field_placeholder").show();
    }

    jQuery('.cfwr_dl_data').sortable({
        update: function( event, ui ) {
            // $data = jQuery(this).find(".cfwr_add_new_fields_inner").attr('value');
            var value = new Array();
            jQuery('.cfwr_dl_data li').each(function() {
                value.push(jQuery(this).find(".cfwr_add_new_fields_inner").attr('value'));
            });

            var cfwr_drop_index = new Array();
            jQuery('.cfwr_dl_data li').each(function() {
                cfwr_drop_index.push(jQuery(this).find('.cfwr_add_new_fields_inner').attr("id"));
            });
            
            
            jQuery.ajax({
                type :'POST',       
                url  : ajaxurl,
                data :{
                    'action'  : 'cfwr_filed_sortable',
                    'post_meta'    : value,
                },
                success: function(result){

                }
            });
        }
    });

    if(jQuery(".enable_email_section").is(":checked")){ 
        jQuery(".email_subject_and_body_message").show();
    }else{
        jQuery(".email_subject_and_body_message").hide();
    }
    jQuery(".enable_email_section").click(function() {
        if(jQuery(this).is(":checked")) {
            jQuery(".email_subject_and_body_message").fadeIn(300);
        } else {
            jQuery(".email_subject_and_body_message").fadeOut(200);
        }
    });

    if(jQuery(".cfwr_login_reg_change_text").is(":checked")){ 
        jQuery(".cfwr_log_reg").show();
    }else{
        jQuery(".cfwr_log_reg").hide();
    }
    jQuery(".cfwr_login_reg_change_text").click(function() {
        if(jQuery(this).is(":checked")) {
            jQuery(".cfwr_log_reg").fadeIn(300);
        } else {
            jQuery(".cfwr_log_reg").fadeOut(200);
        }
    });
});