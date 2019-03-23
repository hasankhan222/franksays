<?php
namespace Codelight\GDPR\Modules\WooCommerceGdpr;

use Codelight\GDPR\Components\Consent\ConsentManager;
use Codelight\GDPR\DataSubject\DataSubjectManager;
include_once(WC_ABSPATH . 'includes/class-wc-privacy-erasers.php');

class WooCommerceGdpr
{   
    public function __construct(DataSubjectManager $dataSubjectManager, ConsentManager $consentManager)
    {  	
        $this->dataSubjectManager = $dataSubjectManager;
        $this->consentManager = $consentManager;
        
        if (!gdpr('options')->get('enable_woo_compatibility'))
        {
            return;
        }
        if (!class_exists('WooCommerce')) 
        {
            return;
        }
        add_filter('gdpr/data-subject/data', [$this, 'getWoocommerceExportData'], 20, 2);
        add_action('gdpr/data-subject/delete', [$this, 'deleteWoocommerceEntries']);
        add_action('gdpr/data-subject/anonymize', [$this, 'anonymizeWoocommerceEntries']);
        add_action( 'woocommerce_review_order_before_submit', [$this, 'gdpr_woo_add_checkout_privacy_policy'], 9 );
        add_action( 'woocommerce_checkout_process', [$this, 'gdpr_woo_not_approved_privacy'] );
    }
    /*
    *   Fatch all order with details have following status. 'wc-pending','wc-on-hold','wc-processing', 'wc-completed','wc-cancelled','wc-refunded','wc-failed'
    *   
    */
    public function getWoocommerceExportData(array $data, $email)
    {   
        $order_statuses = array('wc-pending','wc-on-hold','wc-processing', 'wc-completed','wc-cancelled','wc-refunded','wc-failed');
        $customer_orders = wc_get_orders( array(
            'meta_key' => '_billing_email',
            'meta_value' => $email,
            'post_status' => $order_statuses,
            'numberposts' => -1
        ) );
        foreach($customer_orders as $order )
        {
            $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
            $order = wc_get_order( $order_id );
            $order_data = $order->get_data();
            if($order_id)
            {
                $title  = __('Order Information: Order ID - ', 'gdpr') . ' ' . $order_id;
            }
            foreach ($order_data as $order_key => $order_detail) 
            {
                $data[$title][$order_key][]= $order_detail;
            }
        }
        return $data;
    }
    /*
    *   'wc-pending','wc-on-hold','wc-completed','wc-cancelled','wc-refunded','wc-failed'
    *   will change wc-completed order's user to anonymize
    *   delete other all orders.
    */
    public function deleteWoocommerceEntries($email)
    {
        $order_statuses = array('wc-pending','wc-on-hold','wc-completed','wc-cancelled','wc-refunded','wc-failed');
        $customer_orders = wc_get_orders( array(
            'meta_key' => '_billing_email',
            'meta_value' => $email,
            'post_status' => $order_statuses,
            'numberposts' => -1
        ) );
        foreach($customer_orders as $order )
        {
            $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
            if($order->get_status() != "completed" || $order->get_status() != "processing")
            {
                $this->wc_gdpr_delete_orders($order_id);
            } 
            if($order->get_status() == "completed")           
            {
                $this->anonymizeWoocommerceEntries($email);
            }
        }
    }
    /*
    *   Anonymize user information from order by email address.
    */
    public function anonymizeWoocommerceEntries($email)
    {
        $order_statuses = array('wc-completed');
        $customer_orders = wc_get_orders( array(
            'meta_key' => '_billing_email',
            'meta_value' => $email,
            'post_status' => $order_statuses,
            'numberposts' => -1
        ) );
        foreach($customer_orders as $order )
        {
            \WC_Privacy_Erasers::remove_order_personal_data($order);
        }
    }
    /*
    *   Delete all order infromation from order ID.
    */
    public function wc_gdpr_delete_orders($order_id)
    {   
        // delete order with all information
        global $wpdb;
        $delete_order_itemmeta = $wpdb->query("DELETE FROM {$wpdb->prefix}woocommerce_order_itemmeta WHERE order_item_id IN (SELECT  order_item_id FROM {$wpdb->prefix}woocommerce_order_items WHERE order_id = ".$order_id.")");
        $delete_order_items = $wpdb->query("DELETE FROM {$wpdb->prefix}woocommerce_order_items WHERE order_id =".$order_id);
        $delete_order_comment = $wpdb->query("DELETE FROM {$wpdb->prefix}comments WHERE comment_type = 'order_note' AND comment_post_ID =".$order_id);
        $delete_order_meta = $wpdb->query("DELETE FROM {$wpdb->prefix}postmeta WHERE post_id =".$order_id);
        $delete_order = $wpdb->query("DELETE FROM {$wpdb->prefix}posts WHERE post_type = 'shop_order' AND ID = ".$order_id);
    }
    /*
    *   Add checkout GDPR content
    */
    public function gdpr_woo_add_checkout_privacy_policy() 
    {   
        $policyPage = gdpr('options')->get('policy_page');
        $policyPageUrl = get_permalink($policyPage);
        if(isset($policyPageUrl) && $policyPage != "0")
        {            
            woocommerce_form_field( 'gdpr_woo_consent', array(
                'type'          => 'checkbox',
                'class'         => array('form-row privacy'),
                'label_class'   => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
                'input_class'   => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
                'required'      => true,
                'label'         => sprintf(
                                        __('I accept the %sPrivacy Policy%s', 'gdpr-framework'),
                                        "<a href='{$policyPageUrl}' target='_blank'>",
                                        "</a>"
                                    ),
            )); 
        }        
    }
    /*
    *   Track consent and check for Privacy Policy consent.
    */
    public function gdpr_woo_not_approved_privacy()
    {   
        $policyPage = gdpr('options')->get('policy_page');
        $policyPageUrl = get_permalink($policyPage);
        if ( ! (int) isset( $_POST['gdpr_woo_consent'] ) ) 
        {
            if(isset($policyPageUrl) && $policyPage != "0")
            {
                wc_add_notice( __( 'Please acknowledge the Privacy Policy' ), 'error' );
            }
        } else {
            if (isset( $_POST['billing_email']) || isset( $_POST['gdpr_woo_consent'] ))
            {
                $dataSubject = $this->dataSubjectManager->getByEmail($_POST['billing_email']);
                $dataSubject->giveConsent('gdpr_woo_consent');
            }
        }
    }

}
