<?php
if (!defined('ABSPATH'))
  exit;

if (!class_exists('CFWR_comman')) {

    class CFWR_comman {

        protected static $instance;

        public static function instance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
                self::$instance->init();
            }
             return self::$instance;
        }
         function init() {
            global $cfwr_comman;
            $optionget = array(
            	'cfwr_enable_plugin' => 'yes',
                'cfwr_user_email_sent' => 'yes',
                'cfwr_user_email_subject_msg' => 'Your account has been created succefully.',
                'cfwr_user_email_body_msg' => 'Thanks for creating an account on {site_name}.',
                'cfwr_hide_field_labels' => 'no',
                'cfwr_login_reg_change_text' => 'yes',
                'cfwr_login_change_text' => 'Login',
                'cfwr_reg_change_text' => 'Register',
                'cfwr_field_label_require_text' => '{field_label} is required!',
            );
           
            foreach ($optionget as $key_optionget => $value_optionget) {
               $cfwr_comman[$key_optionget] = get_option( $key_optionget,$value_optionget );
            }
        }
    }

    CFWR_comman::instance();
}
?>