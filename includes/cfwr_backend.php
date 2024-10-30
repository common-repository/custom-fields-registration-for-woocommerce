<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('CFWR_admin_menu')) {

    class CFWR_admin_menu {

        protected static $CFWR_instance;

        function CFWR_submenu_page() {
            add_submenu_page('edit.php?post_type=wporg_custom_field',__( 'woocommerce Custom Fields Registration', 'Custom Fields Registration' ),'Settings','manage_options','custom-fields-registration-settings',array($this, 'CFWR_callback'));
        }

        function CFWR_callback(){
        	global $cfwr_comman;
        	?>
        	<div class="cfwr-container">
	            <form method="post">
	            	<div class="wrap">
	                	<h2><?php echo __('Custom Fields For Woocommerce Registration','custom-fields-for-woocommerce-registration');?></h2>	            		
	            	</div>
	                <ul class="tabs">
	                    <li class="tab-link cfwr-current" data-tab="cfwr-tab-general"><?php echo __('General Setting','custom-fields-for-woocommerce-registration');?></li>
                    	<li class="tab-link" data-tab="cfwr-tab-registration-fields"><?php echo __('Registration Fields','custom-fields-for-woocommerce-registration');?></li>
	                </ul>
	                <div id="cfwr-tab-general" class="cfwr-tab-content cfwr-current">
	                	<table class="data_table">
	                        <tbody>
	                            <tr>
	                                <th>
	                                    <label><?php echo __('Enable Authentication','custom-fields-for-woocommerce-registration');?></label>
	                                </th>
	                                <td>
	                                    <input type="checkbox" name="cfwr_comman[cfwr_enable_plugin]" value="yes"<?php if($cfwr_comman['cfwr_enable_plugin'] == 'yes'){echo "checked";}?>>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th>
	                                    <label><?php echo __('Enable User Registration Email','custom-fields-for-woocommerce-registration');?></label>
	                                </th>
	                                <td>
	                                    <input type="checkbox" name="cfwr_comman[cfwr_user_email_sent]" class="enable_email_section" value="yes"<?php if($cfwr_comman['cfwr_user_email_sent'] == 'yes'){echo "checked";}?>>
	                                </td>
	                            </tr>
	                            <tr class="email_subject_and_body_message">
	                                <th>
	                                    <label><?php echo __('User Registration Email Subject Message','custom-fields-for-woocommerce-registration');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" class="regular-text" name="cfwr_comman[cfwr_user_email_subject_msg]" value="<?php echo $cfwr_comman['cfwr_user_email_subject_msg']?>">
	                                </td>
	                            </tr>
	                            <tr class="email_subject_and_body_message">
	                                <th>
	                                    <label><?php echo __('User Registration Email Body Message','custom-fields-for-woocommerce-registration');?></label>
	                                </th>
	                                <td>
	                                    <textarea name="cfwr_comman[cfwr_user_email_body_msg]" class="regular-text" rows="5"><?php echo $cfwr_comman['cfwr_user_email_body_msg']?></textarea>
	                                    <p class="cfwr_description"><strong>Note : </strong> {site_name} = <?php echo get_bloginfo( 'name' );?></p>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th>
	                                    <label><?php echo __('Hide Field labels','custom-fields-for-woocommerce-registration');?></label>
	                                </th>
	                                <td>
	                                   	<select name="cfwr_comman[cfwr_hide_field_labels]" class="regular-text">
	                                   		<option value="yes" <?php if($cfwr_comman['cfwr_hide_field_labels'] == 'yes'){echo "selected";}?>>Yes</option>
	                                   		<option value="no" <?php if($cfwr_comman['cfwr_hide_field_labels'] == 'no'){echo "selected";}?>>No</option>
	                                   	</select>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th>
	                                    <label><?php echo __('Change Login/Register Title Text','custom-fields-for-woocommerce-registration');?></label>
	                                </th>
	                                <td>
	                                   	<input type="checkbox" class="cfwr_login_reg_change_text" name="cfwr_comman[cfwr_login_reg_change_text]" value="yes" <?php if($cfwr_comman['cfwr_login_reg_change_text'] == 'yes'){echo "checked";}?>>
	                                   	<label>Enable/Disable</label>
	                                </td>
	                            </tr>
	                            <tr class="cfwr_log_reg">
	                                <th>
	                                    <label><?php echo __('Change Login Title Text','custom-fields-for-woocommerce-registration');?></label>
	                                </th>
	                                <td>
	                                   	<input type="text" class="regular-text" name="cfwr_comman[cfwr_login_change_text]" value="<?php echo $cfwr_comman['cfwr_login_change_text'];?>">
	                                </td>
	                            </tr>
	                            <tr class="cfwr_log_reg">
	                                <th>
	                                    <label><?php echo __('Change Register Title Text','custom-fields-for-woocommerce-registration');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" class="regular-text" name="cfwr_comman[cfwr_reg_change_text]" value="<?php echo $cfwr_comman['cfwr_reg_change_text'];?>">
	                                </td>
	                            </tr>
	                            <tr>
	                                <th>
	                                    <label><?php echo __('Field Required Message Text','custom-fields-for-woocommerce-registration');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" class="regular-text" name="cfwr_comman[cfwr_field_label_require_text]" value="<?php echo $cfwr_comman['cfwr_field_label_require_text'];?>">
	                                	<p class="cfwr_description"><strong>Note : </strong> {field_label} = Register field labels..</p>
	                                </td>
	                            </tr>
	                        </tbody>
	                    </table>
	                </div>
	                <div id="cfwr-tab-registration-fields" class="cfwr-tab-content">
    					<div class="cfwr_add_new_fields">
							<span class="cfwr_note"><?php echo __('Registration Fields','custom-fields-for-woocommerce-registration');?></span>
							<?php 
							$myargs = array(
					           'post_type' => 'wporg_custom_field', 
					           'posts_per_page' => -1, 
					           'meta_key' => 'cfwr_field_ajax_id', 
					           'orderby' => 'meta_value', 
					           'order' => 'ASC'
					        );
					        $posts = query_posts($myargs );
					        if (!empty($posts)) {
								?>
								<ul class="cfwr_dl_data">
									<?php
							        foreach ($posts as $key => $post) {
										$cfwr_field_ajax_id = get_post_meta($post->ID,'cfwr_field_ajax_id',true);
										$custom_field_label = get_the_title($post->ID);
										$custom_field_slug_name = get_post_meta($post->ID,'custom_field_slug_name',true);
										$custom_field_checkbox = get_post_meta($post->ID,'custom_field_checkbox',true);
		                        	?>
		                        	<li>
		                        		<div class="cfwr_add_new_fields_inner" value="<?php echo esc_attr($post->ID);?>" id="<?php echo $custom_field_slug_name;?>">
		                        			<span class="cfwr_label">
		                        				<?php echo __($custom_field_label,'custom-fields-for-woocommerce-registration');?>
		                        			</span>
		                        			<span class="cfwr_checkbox">
		                        				<input type="checkbox" name="<?php echo $custom_field_slug_name;?>" value="yes"<?php if($custom_field_checkbox == 'yes'){echo "checked";}?>>
		                        				<?php
		                        					$link = admin_url() . "post.php?post=" . $post->ID . "&action=delete";
													$delLink = wp_nonce_url($link);
		                        				?>
		                        				<a href="<?php echo admin_url( '/admin.php?page=custom-fields-registration-settings' );?>&action=delete_post&post_id=<?php echo $post->ID;?>"><img class="remove_field" data-id="<?php echo esc_attr($post->ID);?>" src="<?php echo CFWR_PLUGIN_DIR.'/images/remove.png';?>"></a>
		                        			</span>
		                        		</div>
			                        </li>
		                        	<?php
									}
									?>
								</ul>
								<?php

					        }else{
					        	echo "<div class='register_empty_fields'>";
					        	echo "<p class='empty_register_fields'>Registration fields is not set....</p>";
					        	echo "<a href='".admin_url()."post-new.php?post_type=wporg_custom_field' class='add_field_button button-primary'>Add registration fields</a>";
					        	echo "</div>";
					        }
							?>
						</div>	
	                </div>
	                <div class="submit_button">
	                    <input type="hidden" name="cfwr_form_submit" value="cfwr_save_option">
	                    <input type="submit" value="Save changes" name="submit" class="button-primary" id="cfwr-btn-space">
	                </div>
               	</form>
           	</div>
        	<?php
        }

        function CFWR_filed_sortable(){
        	
        	foreach ($_REQUEST['post_meta'] as $keypost_meta => $valuepost_meta) {
        		update_post_meta($valuepost_meta,'cfwr_field_ajax_id',(int)($keypost_meta));
        	}
			exit();
		}

        function CFWR_wporg_custom_post_type() {

        	$post_type = 'wporg_custom_field';
            $singular_name = 'Custom Register Field';
            $plural_name = 'Register Fields';
            $slug = 'wporg_custom_field';
            $labels = array(
                'name'               => _x( $plural_name, 'post type general name', 'custom-fields-for-woocommerce-registration' ),
                'singular_name'      => _x( $singular_name, 'post type singular name', 'custom-fields-for-woocommerce-registration' ),
                'menu_name'          => _x( $singular_name, 'admin menu name', 'custom-fields-for-woocommerce-registration' ),
                'name_admin_bar'     => _x( $singular_name, 'add new name on admin bar', 'custom-fields-for-woocommerce-registration' ),
                'add_new'            => __( 'Add New Field', 'custom-fields-for-woocommerce-registration' ),
                'add_new_item'       => __( 'Add New Field '.$singular_name, 'custom-fields-for-woocommerce-registration' ),
                'new_item'           => __( 'New '.$singular_name, 'custom-fields-for-woocommerce-registration' ),
                'edit_item'          => __( 'Edit '.$singular_name, 'custom-fields-for-woocommerce-registration' ),
                'view_item'          => __( 'View '.$singular_name, 'custom-fields-for-woocommerce-registration' ),
                'all_items'          => __( 'All '.$plural_name, 'custom-fields-for-woocommerce-registration' ),
                'search_items'       => __( 'Search '.$plural_name, 'custom-fields-for-woocommerce-registration' ),
                'parent_item_colon'  => __( 'Parent '.$plural_name.':', 'custom-fields-for-woocommerce-registration' ),
                'not_found'          => __( 'No Register Field found.', 'custom-fields-for-woocommerce-registration' ),
                'not_found_in_trash' => __( 'No Register Field found in Trash.', 'custom-fields-for-woocommerce-registration' )
            );

            $args = array(
                'labels'             => $labels,
                'description'        => __( 'Description', 'custom-fields-for-woocommerce-registration' ),
                'public'             => false,
                'publicly_queryable' => false,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => $slug ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => null,
                'supports'           => array( 'title' ),
                'menu_icon'          => 'dashicons-media-text',
                'show_in_rest'       =>  false,
            );
            register_post_type( $post_type, $args );
		}

		function CFWR_global_notice_meta_box() {

		    add_meta_box(
		        'cusrom_regster_field_id',
		        __( 'Custom Register Fields', 'Custom_Register' ),
		        array($this,'cusrom_field_meta_box_callback'),
		        'wporg_custom_field'
		    );
		}

		function cusrom_field_meta_box_callback($post){
			remove_meta_box( 'slugdiv', 'wporg_custom_field', 'normal' );
			?>
			<form method="post">
				<table class="meta_box_table">
					<tbody>
						<tr>
							<th>
								<label><?php echo __('Custom Registration Field Type','custom-fields-for-woocommerce-registration');?></label>
							</th>
							<td>
								<?php
								$custom_register_field_type = get_post_meta($post->ID,'custom_register_field_type',true);
								?>
								<select name="custom_register_field_type" class="regular-text custom_field_type">
									<option value="text"<?php if($custom_register_field_type == 'text'){echo "selected";}?>><?php echo __('Text','custom-fields-for-woocommerce-registration');?></option>
									<option value="number"<?php if($custom_register_field_type == 'number'){echo "selected";}?>><?php echo __('Number','custom-fields-for-woocommerce-registration');?></option>
									<option value="phone"<?php if($custom_register_field_type == 'phone'){echo "selected";}?>><?php echo __('Phone','custom-fields-for-woocommerce-registration');?></option>
									<option value="email"<?php if($custom_register_field_type == 'email'){echo "selected";}?>><?php echo __('Email','custom-fields-for-woocommerce-registration');?></option>
									<option value="image" disabled><?php echo __('Image','custom-fields-for-woocommerce-registration');?>     (Only available in pro version)</option>
									<option value="password"<?php if($custom_register_field_type == 'password'){echo "selected";}?>><?php echo __('Password','custom-fields-for-woocommerce-registration');?></option>
									<option value="textarea"<?php if($custom_register_field_type == 'textarea'){echo "selected";}?>><?php echo __('Textarea','custom-fields-for-woocommerce-registration');?></option>
									<option value="date" disabled><?php echo __('Date','custom-fields-for-woocommerce-registration');?>     (Only available in pro version)</option>
									<option value="radio" disabled><?php echo __('Radio','custom-fields-for-woocommerce-registration');?>     (Only available in pro version)</option>
									<option value="checkbox" disabled><?php echo __('Checkbox','custom-fields-for-woocommerce-registration');?>     (Only available in pro version)</option>
									<option value="select"<?php if($custom_register_field_type == 'select'){echo "selected";}?>><?php echo __('Select','custom-fields-for-woocommerce-registration');?></option>
									<option value="hidden"<?php if($custom_register_field_type == 'hidden'){echo "selected";}?>><?php echo __('Hidden','custom-fields-for-woocommerce-registration');?></option>
								</select>
								<label class="cfwr_pro_link">Only available in pro version <a href="https://xthemeshop.com/product/custom-fields-for-woocommerce-registration-pro/" target="_blank">link</a></label>
							</td>
						</tr>
						<tr>
							<th>
								<label><?php echo __('Field Label','custom-fields-for-woocommerce-registration');?></label>
							</th>
							<td>
								<?php
								$custom_field_label = get_post_meta($post->ID,'custom_field_label',true);
								?>
								<input type="text" class="regular-text" name="custom_field_label" value="<?php echo esc_attr($custom_field_label);?>">
							</td>
						</tr>
						<tr>
							<th>
								<label><?php echo __('Field Slug Name','custom-fields-for-woocommerce-registration');?></label>
							</th>
							<td>
								<?php
									if(!empty( get_post_meta($post->ID,'custom_field_slug_name',true))){
										$custom_field_slug_name = get_post_meta($post->ID,'custom_field_slug_name',true);
									}else{
										$custom_field_slug_name = get_post_meta($post->ID,'custom_field_label',true);
									}
								?>
								<input type="text" class="regular-text" name="custom_field_slug_name" value="<?php echo esc_attr($custom_field_slug_name);?>">
							</td>
						</tr>

						<tr>
							<th>
								<label><?php echo __('Field Required?','custom-fields-for-woocommerce-registration');?></label>
							</th>
							<td>
								<?php
								$custom_field_required = get_post_meta($post->ID,'custom_field_required',true);
								?>
								<input type="checkbox" class="regular-text" name="custom_field_required" value="yes"<?php if($custom_field_required == 'yes'){echo "checked";}?>>
							</td>
						</tr>
						<tr>
							<th>
								<label><?php echo __('Field Size','custom-fields-for-woocommerce-registration');?></label>
							</th>
							<td>
								<?php
								$custom_field_size = get_post_meta($post->ID,'custom_field_size',true);
								?>
								<select name="custom_field_size" class="regular-text">
									<option value="full_width"<?php if($custom_field_size == 'full_width'){echo "selected";}?>>Full Width</option>
									<option value="half_width"<?php if($custom_field_size == 'half_width'){echo "selected";}?>>Half Width</option>
								</select>
							</td>
						</tr>
						<tr class="multiple_options">
							<th>
								<label><?php echo __('Field Options','custom-fields-for-woocommerce-registration');?></label>
							</th>
							<td>
								<div class="custom_field_option_inner">
									<table>
										<thead>
											<tr class="custom_field_option_Label_main">
												<td>
													<label class="cfwr_add_field_options"><?php echo __('Add Field Options','custom-fields-for-woocommerce-registration');?></label>
												</td>
												<td>
													
												</td>
												<td>
													<span class="custom_add_options"><img src="<?php echo CFWR_PLUGIN_DIR.'/images/add_icon.png';?>"></span>
												</td>
											</tr>
										</thead>
										<tbody class="custom_field_option_body">
											<?php
											$custom_field_option_value = get_post_meta($post->ID,'custom_field_option_value',true);
											$custom_field_option_label = get_post_meta($post->ID,'custom_field_option_label',true);
											if(!empty($custom_field_option_value) && $custom_field_option_value['0'] != ''){
												foreach ($custom_field_option_value as $key => $value) {
												?>
												<tr class="custom_field_option_tr">
													<td>
														<input type="text" name="custom_field_option_value[]" placeholder="value" value="<?php echo esc_attr($value);?>">
													</td>
													<td>
														<input type="text" name="custom_field_option_label[]" placeholder="label" value="<?php echo esc_attr($custom_field_option_label[$key]);?>">
													</td>
													<td>
														<span class="custom_remove_options"><img src="<?php echo CFWR_PLUGIN_DIR.'/images/remove_icon.png';?>"></span>
													</td>
												</tr>
												<?php
												}
											}else{
												?>
												<tr class="custom_field_option_tr">
													<td>
														<input type="text" name="custom_field_option_value[]" placeholder="value" value="">
													</td>
													<td>
														<input type="text" name="custom_field_option_label[]" placeholder="label" value="">
													</td>
													<td>
														<span class="custom_remove_options"><img src="<?php echo CFWR_PLUGIN_DIR.'/images/remove_icon.png';?>"></span>
													</td>
												</tr>
												<?php
											}
											?>
										</tbody>
									</table>
								</div>
							</td>
						</tr>
						<tr class="field_placeholder">
							<th>
								<label><?php echo __('Field Placeholder','custom-fields-for-woocommerce-registration');?></label>
							</th>
							<td>
								<?php
									$custom_field_placeholder = get_post_meta($post->ID,'custom_field_placeholder',true); ?>
								<input type="text" class="regular-text" name="custom_field_placeholder" value="<?php echo esc_attr($custom_field_placeholder);?>">
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			<?php
		}

        function CFWR_recursive_sanitize_text_field( $array ) {
            foreach ( $array as $key => &$value ) {
                if ( is_array( $value ) ) {
                    $value = $this->CFWR_recursive_sanitize_text_field($value);
                }else{
                    $value = sanitize_text_field( $value );
                }
            }
            return $array;
        
        }

        function CFWR_custom_meta_box_field_save(){

		    if(isset($_REQUEST["custom_register_field_type"])){
		    	$custom_register_field_type = sanitize_text_field($_REQUEST["custom_register_field_type"]);
		        update_post_meta( get_the_ID(), 'custom_register_field_type', $custom_register_field_type );
		    }

		    if(isset($_REQUEST["custom_field_label"])){
		    	$custom_field_label = sanitize_text_field($_REQUEST["custom_field_label"]);
		        update_post_meta( get_the_ID(), 'custom_field_label', $custom_field_label );
		    }

		    if(isset($_REQUEST["custom_field_slug_name"])){
		    	$custom_field_slug_name = sanitize_text_field($_REQUEST["custom_field_slug_name"]);
		        update_post_meta( get_the_ID(), 'custom_field_slug_name', $custom_field_slug_name );
		    }

		    // if(isset($_REQUEST["custom_field_required"])){
		    	$custom_field_required = (!empty($_REQUEST['custom_field_required'])) ? sanitize_text_field($_REQUEST['custom_field_required']):'';
		    	//$custom_field_required = sanitize_text_field($_REQUEST["custom_field_required"]);
		        update_post_meta( get_the_ID(), 'custom_field_required', $custom_field_required );
		    // }

		    if(isset($_REQUEST["custom_field_size"])){
		    	$custom_field_size = sanitize_text_field($_REQUEST["custom_field_size"]);
		        update_post_meta( get_the_ID(), 'custom_field_size', $custom_field_size );
		    }

		    if(isset($_REQUEST["custom_field_placeholder"])){
		    	$custom_field_placeholder =sanitize_text_field($_REQUEST["custom_field_placeholder"]);
		        update_post_meta( get_the_ID(), 'custom_field_placeholder', $custom_field_placeholder );
		    }

		    if(isset($_REQUEST["custom_field_option_value"])){
		    	$custom_field_option_value = isset($_REQUEST["custom_field_option_value"] ) ? (array)$_REQUEST["custom_field_option_value"] : array();
				$custom_field_option_value = array_map( 'esc_attr', $custom_field_option_value );
		        update_post_meta( get_the_ID(), 'custom_field_option_value', $custom_field_option_value );
		    }
		    if(isset($_REQUEST["custom_field_option_label"])){
		    	$custom_field_option_label = isset($_REQUEST["custom_field_option_label"] ) ? (array)$_REQUEST["custom_field_option_label"] : array();
				$custom_field_option_label = array_map( 'esc_attr', $custom_field_option_label );
		        update_post_meta( get_the_ID(), 'custom_field_option_label', $custom_field_option_label );
		    }

	     	$all_post_ids = get_posts(array(
			    'fields'          => 'ids',
			    'posts_per_page'  => -1,
			    'post_type' => 'wporg_custom_field'
			));
			$all_post = count($all_post_ids);
		    update_post_meta( get_the_ID() ,'cfwr_field_ajax_id',$all_post);
		}


        function CFWR_save_option(){
        	if( current_user_can('administrator') ) {
        		if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete_post'){

                    wp_delete_post($_REQUEST['post_id']);

	                wp_redirect( admin_url( '/admin.php?page=custom-fields-registration-settings' ) );
	                exit;     
	            }

	            if(isset($_REQUEST['cfwr_form_submit']) && $_REQUEST['cfwr_form_submit'] == 'cfwr_save_option'){

                    $isecheckbox = array(
                    	'cfwr_enable_plugin',
                    	'cfwr_user_email_sent',
                    	'cfwr_user_email_sub_body_enable',
                    	'cfwr_login_reg_change_text',
                    );

                    foreach ($isecheckbox as $key_isecheckbox => $value_isecheckbox) {
                        if(!isset($_REQUEST['cfwr_comman'][$value_isecheckbox])){
                            $_REQUEST['cfwr_comman'][$value_isecheckbox] ='no';
                        }
                    }

        			$all_post_ids = get_posts(array(
					    'fields'          => 'ids',
					    'posts_per_page'  => -1,
					    'post_type' => 'wporg_custom_field'
					));

					foreach ($all_post_ids as $key => $valueee) {
						$custom_field_slug_name = get_post_meta($valueee,'custom_field_slug_name',true);
						update_post_meta( $valueee, 'custom_field_checkbox', sanitize_text_field($_REQUEST[$custom_field_slug_name]) );
					}

                    foreach ($_REQUEST['cfwr_comman'] as $key_cfwr_comman => $value_cfwr_comman) {
                        update_option($key_cfwr_comman, sanitize_text_field($value_cfwr_comman), 'yes');
                    }

	                wp_redirect( admin_url( '/admin.php?page=custom-fields-registration-settings' ) );
	                exit;     
	            }
	        }

        }	

        function CFWR_support_and_rating_notice() {
            $screen = get_current_screen();
            // print_r($screen );
            if( 'wporg_custom_field' == $screen->post_type) {
                ?>
                <div class="cfwr_ratess_open">
                    <div class="cfwr_rateus_notice">
                        <div class="cfwr_rtusnoti_left">
                            <h3>Rate Us</h3>
                            <label>If you like our plugin, </label>
                            <a target="_blank" href="https://wordpress.org/support/plugin/custom-fields-registration-for-woocommerce/reviews/?filter=5">
                                <label>Please vote us</label>
                            </a>
                            
                            <label>,so we can contribute more features for you.</label>
                        </div>
                        <div class="cfwr_rtusnoti_right">
                            <img src="<?php echo CFWR_PLUGIN_DIR;?>/images/review.png" class="cfwr_review_icon">
                        </div>
                    </div>
                    <div class="cfwr_support_notice">
                        <div class="cfwr_rtusnoti_left">
                            <h3>Having Issues?</h3>
                            <label>You can contact us at</label>
                            <a target="_blank" href="https://xthemeshop.com/contact/">
                                <label>Our Support Forum</label>
                            </a>
                        </div>
                        <div class="cfwr_rtusnoti_right">
                            <img src="<?php echo CFWR_PLUGIN_DIR;?>/images/support.png" class="cfwr_review_icon">
                        </div>
                       
                    </div>
                </div>
                <div class="cfwr_donate_main">
                   <img src="<?php echo CFWR_PLUGIN_DIR;?>/images/coffee.svg">
                   <h3>Buy me a Coffee !</h3>
                   <p>If you like this plugin, buy me a coffee and help support this plugin !</p>
                   <div class="cfwr_donate_form">
                        <a class="button button-primary ocwg_donate_btn" href="https://www.paypal.com/paypalme/shayona163/" data-link="https://www.paypal.com/paypalme/shayona163/" target="_blank">Buy me a coffee !</a>
                   </div>
                </div>
                <?php
            }
        }	

        function CFWR_custom_user_profile_fields( $user ){
            $user_id = $user->ID;
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
                                <?php  $attechment_id= get_user_meta( $user_id, $custom_field_slug_name, true );
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
            <?php
        }	

        function CFWR_save_custom_user_profile_fields( $user_id ) {
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
				
        function init() {
        	add_action( 'admin_menu',  array($this, 'CFWR_submenu_page'));
        	add_action( 'init',  array($this, 'CFWR_save_option'));
        	add_action( 'wp_ajax_nopriv_wg_roles_registration_ajax',array($this, 'CFWR_role_ajax') );
            add_action( 'wp_ajax_wg_roles_registration_ajax', array($this, 'CFWR_role_ajax') );
            add_action( 'init', array($this,'CFWR_wporg_custom_post_type'));
            add_action( 'add_meta_boxes', array($this,'CFWR_global_notice_meta_box') );
            add_action( 'save_post', array($this,'CFWR_custom_meta_box_field_save'));
            add_action( 'wp_ajax_cfwr_filed_sortable',array($this, 'CFWR_filed_sortable' ));
    		add_action( 'wp_ajax_nopriv_cfwr_filed_sortable',array($this, 'CFWR_filed_sortable' ));
    		add_action( 'admin_notices', array($this, 'CFWR_support_and_rating_notice' ));
            add_action( 'edit_user_profile', array($this,'CFWR_custom_user_profile_fields'),100 );
            add_action( 'show_user_profile', array($this,'CFWR_custom_user_profile_fields'),100 );
            add_action( 'personal_options_update', array($this,'CFWR_save_custom_user_profile_fields') );
            add_action( 'edit_user_profile_update', array($this,'CFWR_save_custom_user_profile_fields') );
        }

        public static function CFWR_instance() {
            if (!isset(self::$CFWR_instance)) {
                self::$CFWR_instance = new self();
                self::$CFWR_instance->init();
            }
            return self::$CFWR_instance;
        }
    }
    CFWR_admin_menu::CFWR_instance();
}

?>