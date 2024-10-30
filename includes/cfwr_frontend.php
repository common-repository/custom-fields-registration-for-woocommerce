<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('CFWR_frontend_menu')) {

    class CFWR_frontend_menu {

        protected static $CFWR_instance;

		function CFWR_registration_form_field() {
            global $cfwr_comman,$wp_roles;
            
            $myargs = array(
               'post_type' => 'wporg_custom_field', 
               'posts_per_page' => -1, 
               'meta_key' => 'cfwr_field_ajax_id', 
               'orderby' => 'meta_value', 
               'order' => 'ASC'
            );
            $posts = get_posts($myargs);
            
            if(!empty($posts)){
                foreach ($posts as $key => $post_id) {
                    $custom_field_label = get_post_meta($post_id->ID,'custom_field_label',true);
                    $custom_field_slug_name = get_post_meta($post_id->ID,'custom_field_slug_name',true);
                    $custom_register_field_type = get_post_meta($post_id->ID,'custom_register_field_type',true);
                    $custom_field_required = get_post_meta($post_id->ID,'custom_field_required',true);
                    $custom_field_size = get_post_meta($post_id->ID,'custom_field_size',true);
                    $custom_field_placeholder = get_post_meta($post_id->ID,'custom_field_placeholder',true);
                    if( get_post_meta($post_id->ID,"custom_field_checkbox",true) == 'yes' && $custom_register_field_type != 'radio' && $custom_register_field_type != 'select' && $custom_register_field_type != 'textarea' && $custom_register_field_type != 'checkbox' && $custom_register_field_type != 'image' ){
                        ?>
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide custom_register_field" style="display: inline-block;width: <?php if($custom_field_size == 'full_width'){echo '100%';}elseif($custom_field_size == 'half_width'){echo '49%';}?>;">
                            <label for="reg_<?php echo esc_html($custom_field_slug_name);?>" style="<?php if($cfwr_comman['cfwr_hide_field_labels'] == 'yes'){echo 'display: none;';}?>"><?php echo esc_html($custom_field_label); ?>
                            <?php if($custom_field_required == 'yes'){ ?>
                            <span class="required">*</span>
                            <?php } ?>
                            </label>
                            <input type="<?php echo esc_html($custom_register_field_type);?>" class="woocommerce-Input woocommerce-Input--<?php echo esc_html($custom_register_field_type);?> input-<?php echo esc_html($custom_register_field_type);?>" placeholder="<?php echo esc_html($custom_field_placeholder);?>" name="<?php echo esc_html($custom_field_slug_name);?>" id="reg_<?php echo esc_html($custom_field_slug_name);?>" value="<?php if ( ! empty( $_POST[$custom_field_slug_name] ) ) echo esc_attr( $_POST[$custom_field_slug_name] ); ?>" />
                        </p>
                        <?php
                    }elseif($custom_register_field_type == 'radio'){
                        if( get_post_meta($post_id->ID,"custom_field_checkbox",true) == 'yes'){
                            ?>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide custom_register_field" style="display: inline-block;width: <?php if($custom_field_size == 'full_width'){echo '100%';}elseif($custom_field_size == 'half_width'){echo '49%';}?>;">
                                <label for="reg_<?php echo esc_html($custom_field_slug_name);?>" style="<?php if($cfwr_comman['cfwr_hide_field_labels'] == 'yes'){echo 'display: none;';}?>"><?php echo esc_html($custom_field_label); ?>
                                    <?php if($custom_field_required == 'yes'){ ?>
                                        <span class="required">*</span>
                                    <?php } ?>
                                </label>
                                <?php
                                $custom_field_option_value = get_post_meta($post_id->ID,'custom_field_option_value',true);
                                $custom_field_option_label = get_post_meta($post_id->ID,'custom_field_option_label',true);
                                foreach ($custom_field_option_value as $key => $value) {
                                    ?>
                                    
                                    <label for="reg_<?php echo esc_html($value);?>"><input type="<?php echo esc_html($custom_register_field_type);?>" class="woocommerce-Input woocommerce-Input--<?php echo esc_html($custom_register_field_type);?> input-<?php echo esc_html($custom_register_field_type);?>" name="<?php echo esc_html($custom_field_slug_name);?>" id="reg_<?php echo esc_html($value);?>" value="<?php echo esc_html($value);?>"<?php if (isset($_POST[$custom_field_slug_name]) && $_POST[$custom_field_slug_name] == $value ) echo "checked"; ?> /><?php echo esc_html($custom_field_option_label[$key]);?></label>
                                <?php
                                }
                                ?>
                            </p>
                            <?php
                        }
                    }elseif($custom_register_field_type == 'select'){
                        if( get_post_meta($post_id->ID,"custom_field_checkbox",true) == 'yes'){
                            ?>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide custom_register_field" style="display: inline-block;width: <?php if($custom_field_size == 'full_width'){echo '100%';}elseif($custom_field_size == 'half_width'){echo '49%';}?>;">
                                <label style="<?php if($cfwr_comman['cfwr_hide_field_labels'] == 'yes'){echo 'display: none;';}?>"><?php echo $custom_field_label; ?>
                                <?php if($custom_field_required == 'yes'){ ?>
                                    <span class="required">*</span>
                                <?php } ?>
                                </label>
                                <select name="<?php echo esc_html($custom_field_slug_name);?>" class="woocommerce-Input woocommerce-Input--<?php echo esc_html($custom_register_field_type);?> input-<?php echo esc_html($custom_register_field_type);?>">
                                    <option>select option</option>
                                <?php
                                $custom_field_option_value = get_post_meta($post_id->ID,'custom_field_option_value',true);
                                $custom_field_option_label = get_post_meta($post_id->ID,'custom_field_option_label',true);
                                foreach ($custom_field_option_value as $key => $value) {
                                    ?>
                                     <option value="<?php echo esc_html($value);?>"<?php if (isset($_POST[$custom_field_slug_name]) && sanitize_text_field($_POST[$custom_field_slug_name]) == $value ) echo "selected"; ?>><?php echo esc_html($custom_field_option_label[$key]);?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </p>
                            <?php
                        }
                    }elseif($custom_register_field_type == 'textarea'){
                        if( get_post_meta($post_id->ID,"custom_field_checkbox",true) == 'yes'){
                            ?>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide custom_register_field" style="display: inline-block;width: <?php if($custom_field_size == 'full_width'){echo '100%';}elseif($custom_field_size == 'half_width'){echo '49%';}?>;">
                                <label for="reg_<?php echo esc_html($custom_field_slug_name);?>" style="<?php if($cfwr_comman['cfwr_hide_field_labels'] == 'yes'){echo 'display: none;';}?>"><?php echo $custom_field_label; ?>    <?php if($custom_field_required == 'yes'){ ?>
                                        <span class="required">*</span>
                                    <?php } ?>
                                </label>
                                <textarea name="<?php echo esc_html($custom_field_slug_name);?>" placeholder="<?php echo esc_html($custom_field_placeholder);?>" id="reg_<?php echo esc_html($custom_field_slug_name);?>" class="woocommerce-Input woocommerce-Input--<?php echo esc_html($custom_register_field_type);?> input-<?php echo esc_html($custom_register_field_type);?>"><?php if ( ! empty( $_POST[$custom_field_slug_name] ) ) echo $_POST[$custom_field_slug_name]; ?></textarea>
                            </p>
                            <?php
                        }
                    }elseif($custom_register_field_type == 'checkbox'){
                        if( get_post_meta($post_id->ID,"custom_field_checkbox",true) == 'yes'){
                            ?>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide custom_register_field" style="display: inline-block;width: <?php if($custom_field_size == 'full_width'){echo '100%';}elseif($custom_field_size == 'half_width'){echo '49%';}?>;">
                                <label for="reg_<?php echo esc_html($custom_field_slug_name);?>" style="<?php if($cfwr_comman['cfwr_hide_field_labels'] == 'yes'){echo 'display: none;';}?>"><?php echo esc_html($custom_field_label); ?>
                                    <?php if($custom_field_required == 'yes'){ ?>
                                        <span class="required">*</span>
                                    <?php } ?>
                                </label>
                                <input type="<?php echo esc_html($custom_register_field_type);?>" class="woocommerce-Input woocommerce-Input--<?php echo esc_html($custom_register_field_type);?> input-<?php echo esc_html($custom_register_field_type);?>" placeholder="<?php echo esc_html($custom_field_placeholder);?>" name="<?php echo esc_html($custom_field_slug_name);?>" id="reg_<?php echo esc_html($custom_field_slug_name);?>" value="yes"<?php if (isset($_POST[$custom_field_slug_name]) && $_POST[$custom_field_slug_name] == 'yes' ) echo "checked"; ?> />
                            </p>
                            <?php
                        }
                    }elseif($custom_register_field_type == 'image'){
                        ?>
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide custom_register_field" style="display: inline-block;width: <?php if($custom_field_size == 'full_width'){echo '100%';}elseif($custom_field_size == 'half_width'){echo '49%';}?>;">
                            <label for="reg_<?php echo esc_html($custom_field_slug_name);?>" style="<?php if($cfwr_comman['cfwr_hide_field_labels'] == 'yes'){echo 'display: none;';}?>"><?php echo esc_html($custom_field_label); ?>
                                <?php if($custom_field_required == 'yes'){ ?>
                                <span class="required">*</span>
                                <?php } ?>
                            </label>
                            <input type="file" class="woocommerce-Input woocommerce-Input--<?php echo esc_html($custom_register_field_type);?> input-<?php echo esc_html($custom_register_field_type);?>" placeholder="<?php echo esc_html($custom_field_placeholder);?>" name="<?php echo esc_html($custom_field_slug_name);?>" id="reg_<?php echo esc_html($custom_field_slug_name);?>"   accept='image/*,.pdf'  />
                        </p>
                    <?php 
                    }
                }
            }
		}
 
        function CFWR_enctype_custom_registration_forms() {
           echo 'enctype="multipart/form-data"';
        }

        function CFWR_wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
            global $cfwr_comman;

            $all_post_ids = get_posts(array(
                'fields'          => 'ids',
                'posts_per_page'  => -1,
                'post_type' => 'wporg_custom_field'
            ));

            if(!empty($all_post_ids)){
                foreach ($all_post_ids as $key => $post_id) {
                    $custom_field_label = get_post_meta($post_id,'custom_field_label',true);
                    $custom_field_slug_name = get_post_meta($post_id,'custom_field_slug_name',true);
                    $custom_register_field_type = get_post_meta($post_id,'custom_register_field_type',true);
                    $custom_field_required = get_post_meta($post_id,'custom_field_required',true);
                    $custom_field_size = get_post_meta($post_id,'custom_field_size',true);
                    $custom_field_placeholder = get_post_meta($post_id,'custom_field_placeholder',true);
                    if( get_post_meta($post_id,"custom_field_checkbox",true) == 'yes' ){                        
                        if($custom_register_field_type == "image"){
                            if ( empty($_FILES[$custom_field_slug_name]['name']) ) {
                                if($custom_field_required == 'yes'){
                                    $req_msg = str_replace("{field_label}",$custom_field_label,$cfwr_comman['cfwr_field_label_require_text']);
                                    $validation_errors->add( $custom_field_slug_name.'_error', __( $req_msg, 'woocommerce' ) );
                                } 
                            }
                        }else{
                            if ( empty( $_POST[$custom_field_slug_name] )  ) {
                                if($custom_field_required == 'yes'){
                                    $req_msg = str_replace("{field_label}",$custom_field_label,$cfwr_comman['cfwr_field_label_require_text']);
                                    $validation_errors->add( $custom_field_slug_name.'_error', __( $req_msg, 'woocommerce' ) ); 
                                }
                            }
                        }
                    }
                }
            }
            return $validation_errors;
        }

        function CFWR_wooc_save_extra_register_fields( $customer_id ) {
            $all_post_ids = get_posts(array(
                'fields'          => 'ids',
                'posts_per_page'  => -1,
                'post_type' => 'wporg_custom_field'
            ));
            
            if(!empty($all_post_ids)){
                foreach ($all_post_ids as $key => $post_id) { 
                 $custom_field_slug_name = get_post_meta($post_id,'custom_field_slug_name',true);           
                    $custom_register_field_type = get_post_meta($post_id,'custom_register_field_type',true);
                    if ( isset( $_POST[$custom_field_slug_name] ) && get_post_meta($post_id,"custom_field_checkbox",true) == 'yes' ) {
                        update_user_meta( $customer_id, $custom_field_slug_name, sanitize_text_field( $_POST[$custom_field_slug_name] ) );
                    }
                   
                    if($custom_register_field_type == "image"){
                        if ( isset( $_FILES[$custom_field_slug_name] ) ) {
                            require_once( ABSPATH . 'wp-admin/includes/image.php' );
                            require_once( ABSPATH . 'wp-admin/includes/file.php' );
                            require_once( ABSPATH . 'wp-admin/includes/media.php' );
                            $attachment_id = media_handle_upload( $custom_field_slug_name, 0 );  
                            if (!empty($attachment_id) ) {
                                update_user_meta( $customer_id, $custom_field_slug_name, $attachment_id );
                            }else{
                                update_user_meta( $customer_id,  $custom_field_slug_name, NULL);
                            }
                        }
                    }
                }
            }
        }

        function send_welcome_email_to_new_user($user_id) {
            global $cfwr_comman;
            wp_set_password( sanitize_text_field($_POST['password']), $user_id );
            if ($cfwr_comman['cfwr_user_email_sent'] == 'yes') {
                $user = get_userdata($user_id);
                $user_email = $user->user_email;

                if (!empty($cfwr_comman['cfwr_user_email_subject_msg'])) {
                    $sub_message = $cfwr_comman['cfwr_user_email_subject_msg'];
                }else{
                    $sub_message = 'Your account has been created succefully.';
                }
                if (!empty($cfwr_comman['cfwr_user_email_body_msg'])) {
                    $msg_b = str_replace("{site_name}",get_bloginfo( 'name' ),$cfwr_comman['cfwr_user_email_body_msg']);
                    $body_message = $msg_b;
                }else{
                    $msg_b1 = str_replace("{site_name}",get_bloginfo( 'name' ),'Thanks for creating an account on {site_name}.');
                    $body_message = $msg_b1;
                }

                $to = $user_email;
                $subject = $sub_message;
                $body = $body_message;
                $headers = array('Content-Type: text/html; charset=UTF-8');
                wp_mail($to, $subject, $body, $headers);
            }
        }

        function CFWR_translate_woocommerce_strings( $translated, $untranslated, $domain ) {
            global $cfwr_comman;
            if($cfwr_comman['cfwr_login_reg_change_text'] == 'yes'){
                if ( ! is_admin() && 'woocommerce' === $domain ) {
                    switch ( $translated ) {         
                        case 'Login':         
                            $translated = $cfwr_comman['cfwr_login_change_text'];
                        break;         
                        case 'Register':         
                            $translated = $cfwr_comman['cfwr_reg_change_text'];
                        break;
                    }
                }             
                return $translated;     
            }    
        }

        function bbloomer_oc_custom_fields_query_vars( $vars ) {
            $vars[] = 'oc-custom-fields';
            return $vars;
        }

        function bbloomer_add_oc_custom_fields_link_my_account( $items ) {
            $items['oc-custom-fields'] = 'Custom Fields';
            return $items;
        }          
          
        function bbloomer_oc_custom_fields_content() {
            $user_id = get_current_user_id();
            echo '<h3 class="heading">Custom Fields</h3>';
            $myargs = array(
               'post_type' => 'wporg_custom_field', 
               'posts_per_page' => -1, 
               'meta_key' => 'cfwr_field_ajax_id', 
               'orderby' => 'meta_value', 
               'order' => 'ASC'
            );
            $posts = get_posts($myargs );
            ?>
            <form method="POST" enctype="multipart/form-data">
                <table class="form-table">
                    <?php
                    if(!empty($posts)){
                        foreach ($posts as $key => $post_id) {
                            $custom_field_label = get_post_meta($post_id->ID,'custom_field_label',true);
                            $custom_field_slug_name = get_post_meta($post_id->ID,'custom_field_slug_name',true);
                            $custom_register_field_type = get_post_meta($post_id->ID,'custom_register_field_type',true);
                            $custom_field_required = get_post_meta($post_id->ID,'custom_field_required',true);
                            $custom_field_size = get_post_meta($post_id->ID,'custom_field_size',true);
                            $custom_field_placeholder = get_post_meta($post_id->ID,'custom_field_placeholder',true);
                            if( get_post_meta($post_id->ID,"custom_field_checkbox",true) == 'yes' && $custom_register_field_type != 'radio' && $custom_register_field_type != 'select' && $custom_register_field_type != 'textarea' && $custom_register_field_type != 'checkbox' && $custom_register_field_type != 'image' && $custom_register_field_type != 'password' ){
                                ?>
                                <tr>
                                    <th><label for="reg_<?php echo esc_html($custom_field_slug_name);?>"><?php echo esc_html($custom_field_label); ?></label></th>
                                    <td><input type="<?php echo esc_html($custom_register_field_type);?>" class="woocommerce-Input woocommerce-Input--<?php echo esc_html($custom_register_field_type);?> input-<?php echo esc_html($custom_register_field_type);?>" placeholder="<?php echo esc_html($custom_field_placeholder);?>" name="<?php echo esc_html($custom_field_slug_name);?>" id="reg_<?php echo esc_html($custom_field_slug_name);?>" value="<?php echo get_user_meta( $user_id, $custom_field_slug_name, true ); ?>" style="width: 25em;" /></td>
                                </tr>
                                </p>
                                <?php
                            }elseif($custom_register_field_type == 'radio'){
                                if( get_post_meta($post_id->ID,"custom_field_checkbox",true) == 'yes'){
                                    ?>
                                    <tr>
                                        <th><label for="reg_<?php echo esc_html($custom_field_slug_name);?>"><?php echo esc_html($custom_field_label); ?></label></th>
                                        <td><?php
                                        $custom_field_option_value = get_post_meta($post_id->ID,'custom_field_option_value',true);
                                        $custom_field_option_label = get_post_meta($post_id->ID,'custom_field_option_label',true);
                                        foreach ($custom_field_option_value as $key => $value) {
                                            ?>
                                            
                                            <label for="reg_<?php echo esc_html($value);?>"><input type="<?php echo esc_html($custom_register_field_type);?>" class="woocommerce-Input woocommerce-Input--<?php echo esc_html($custom_register_field_type);?> input-<?php echo esc_html($custom_register_field_type);?>" name="<?php echo esc_html($custom_field_slug_name);?>" id="reg_<?php echo esc_html($value);?>" value="<?php echo esc_html($value);?>"<?php if (get_user_meta( $user_id, $custom_field_slug_name, true ) == $value ) echo "checked"; ?> /><?php echo esc_html($custom_field_option_label[$key]);?></label>
                                        <?php
                                        }
                                        ?></td>
                                    </tr>
                                    <?php
                                }
                            }elseif($custom_register_field_type == 'select'){
                                if( get_post_meta($post_id->ID,"custom_field_checkbox",true) == 'yes'){
                                    ?>
                                    <tr>
                                        <th><label><?php echo $custom_field_label; ?></label></th>
                                        <td><select name="<?php echo esc_html($custom_field_slug_name);?>" class="woocommerce-Input woocommerce-Input--<?php echo esc_html($custom_register_field_type);?> input-<?php echo esc_html($custom_register_field_type);?>" style="width: 25em;">
                                            <option>select option</option>
                                        <?php
                                        $custom_field_option_value = get_post_meta($post_id->ID,'custom_field_option_value',true);
                                        $custom_field_option_label = get_post_meta($post_id->ID,'custom_field_option_label',true);
                                        foreach ($custom_field_option_value as $key => $value) {
                                            ?>
                                             <option value="<?php echo esc_html($value);?>"<?php if (get_user_meta( $user_id, $custom_field_slug_name, true ) == $value ) echo "selected"; ?>><?php echo esc_html($custom_field_option_label[$key]);?></option>
                                        <?php
                                        }
                                        ?>
                                        </select></td>
                                    </tr>
                                    <?php
                                }
                            }elseif($custom_register_field_type == 'textarea'){
                                if( get_post_meta($post_id->ID,"custom_field_checkbox",true) == 'yes'){
                                    ?>
                                    <tr>
                                        <th><label for="reg_<?php echo esc_html($custom_field_slug_name);?>"><?php echo $custom_field_label; ?></label></th>
                                        <td><textarea name="<?php echo esc_html($custom_field_slug_name);?>" placeholder="<?php echo esc_html($custom_field_placeholder);?>" id="reg_<?php echo esc_html($custom_field_slug_name);?>" class="woocommerce-Input woocommerce-Input--<?php echo esc_html($custom_register_field_type);?> input-<?php echo esc_html($custom_register_field_type);?>" style="width: 25em;"><?php echo get_user_meta( $user_id, $custom_field_slug_name, true ); ?></textarea></td>
                                    </tr>
                                    <?php
                                }
                            }elseif($custom_register_field_type == 'checkbox'){
                                if( get_post_meta($post_id->ID,"custom_field_checkbox",true) == 'yes'){
                                    ?>
                                    <tr>
                                        <th><label for="reg_<?php echo esc_html($custom_field_slug_name);?>"><?php echo esc_html($custom_field_label); ?></label></th>
                                        <td><input type="<?php echo esc_html($custom_register_field_type);?>" class="woocommerce-Input woocommerce-Input--<?php echo esc_html($custom_register_field_type);?> input-<?php echo esc_html($custom_register_field_type);?>" placeholder="<?php echo esc_html($custom_field_placeholder);?>" name="<?php echo esc_html($custom_field_slug_name);?>" id="reg_<?php echo esc_html($custom_field_slug_name);?>" value="yes"<?php if (get_user_meta( $user_id, $custom_field_slug_name, true ) == 'yes' ) echo "checked"; ?> /></td>
                                    </tr>
                                    <?php
                                }
                            }elseif($custom_register_field_type == 'image'){?>
                                 <tr>
                                    <th><label for="reg_<?php echo esc_html($custom_field_slug_name);?>"><?php echo esc_html($custom_field_label); ?></label></th>
                                    <td>
                                        <?php  
                                        $attechment_id = get_user_meta( $user_id, $custom_field_slug_name, true );
                                        $attechment_url = wp_get_attachment_url( $attechment_id );   
                                        ?>
                                        <img class="customimag" src="<?php echo esc_html($attechment_url);?> " >
                                        <input type="file" class="woocommerce-Input woocommerce-Input--<?php echo esc_html($custom_register_field_type);?> input-<?php echo esc_html($custom_register_field_type);?>" placeholder="<?php echo esc_html($custom_field_placeholder);?>" name="<?php echo esc_html($custom_field_slug_name);?>" id="reg_<?php echo esc_html($custom_field_slug_name);?>" value="<?php echo get_user_meta( $user_id, $custom_field_slug_name, true ); ?>" style="width: 25em;" /></td>
                                </tr>
                            <?php 
                            }
                        }
                    }
                    ?>
                </table>
                <div class="oc_cust_submit">
                    <input type="hidden" name="action" value="cfwr_save_occf">
                    <input type="submit" name="submit" value="Save Changes" class="button button-primary">
                </div>
            </form>
            <?php
        }      

        function bbloomer_add_oc_custom_fields_endpoint() {
            add_rewrite_endpoint( 'oc-custom-fields', EP_ROOT | EP_PAGES );
            if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'cfwr_save_occf') {
                $user_id = get_current_user_id();
                $all_post_ids = get_posts(array(
                    'fields'          => 'ids',
                    'posts_per_page'  => -1,
                    'post_type' => 'wporg_custom_field'
                ));
                
                if(!empty($all_post_ids)){
                    foreach ($all_post_ids as $key => $post_id) {   
                        $custom_register_field_type = get_post_meta($post_id,'custom_register_field_type',true);         
                        $custom_field_slug_name = get_post_meta($post_id,'custom_field_slug_name',true);
                        if ( isset( $_POST[$custom_field_slug_name] ) && get_post_meta($post_id,"custom_field_checkbox",true) == 'yes' ) {
                            update_user_meta( $user_id, $custom_field_slug_name, sanitize_text_field( $_POST[$custom_field_slug_name] ) );
                        }
                        if($custom_register_field_type == "image"){
                            if ( isset( $_FILES[$custom_field_slug_name] ) && get_post_meta($post_id,"custom_field_checkbox",true) == 'yes' ) {

                                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                                $attachment_id = media_handle_upload( $custom_field_slug_name, 0 ); 
                                
                                if (!empty($attachment_id) ) {
                                    update_user_meta( $user_id, $custom_field_slug_name, $attachment_id );
                                }else{
                                    update_user_meta( $user_id,  $custom_field_slug_name, NULL);
                                }
                            }
                        }
                    }
                }
            }
        }    
        
        function init() {
            global $cfwr_comman;
            if ($cfwr_comman['cfwr_enable_plugin'] == 'yes') {
            	add_action( 'woocommerce_register_form_start', array($this,'CFWR_registration_form_field') );  
                add_action( 'woocommerce_register_post', array($this,'CFWR_wooc_validate_extra_register_fields'), 10, 3 );
                add_action( 'woocommerce_created_customer', array($this,'CFWR_wooc_save_extra_register_fields') );
                add_action( 'user_register', array($this,'send_welcome_email_to_new_user'));
                add_action( 'woocommerce_register_form_tag', array($this,'CFWR_enctype_custom_registration_forms' ));
                add_filter( 'gettext', array($this,'CFWR_translate_woocommerce_strings'), 999, 3 );
                add_filter( 'query_vars', array($this,'bbloomer_oc_custom_fields_query_vars'), 0 );
                add_filter( 'woocommerce_account_menu_items', array($this,'bbloomer_add_oc_custom_fields_link_my_account') );
                add_action( 'woocommerce_account_oc-custom-fields_endpoint', array($this,'bbloomer_oc_custom_fields_content') );
                add_action( 'init', array($this,'bbloomer_add_oc_custom_fields_endpoint') );
            }    
        }
    
        public static function CFWR_instance() {
            if (!isset(self::$CFWR_instance)) {
                self::$CFWR_instance = new self();
                self::$CFWR_instance->init();
            }
            return self::$CFWR_instance;
        }

    }
    CFWR_frontend_menu::CFWR_instance();
}