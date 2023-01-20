function foy_register_session(){
    if(!session_id() ) {
        session_start();
    }
	// destroying session after 30 minute
	$currentTime = time();
	if ($currentTime > $_SESSION['expire']) {
		unset($_SESSION['coupon']);
		unset($_SESSION['start']);
		unset($_SESSION['expire']);
	}
}
add_action('init', 'foy_register_session');

//saving Ajax Data
function foy_save_enquiry_form_action() {
	unset($_SESSION['coupon']);
	if(isset($_REQUEST['coupon'])){
		$coupon = $_REQUEST['coupon'];
		$_SESSION['coupon'] = $coupon;
		echo "Request: ".$_REQUEST['coupon'];
		echo " Session: ".$_SESSION['coupon'];
		// Destroying session after 30 minute
		$_SESSION['start'] = time();
		$_SESSION['expire'] = time() + (30 * 60);
	}
	die();
}
add_action('wp_ajax_save_post_details_form','foy_save_enquiry_form_action');
add_action('wp_ajax_nopriv_save_post_details_form','foy_save_enquiry_form_action');

// to automatically apply coupon
function foy_apply_coupon() {
	if($_SESSION['coupon']){
		$coupon_code = $_SESSION['coupon'];
		if ( WC()->cart->has_discount( $coupon_code ) ) {
			return;
		}
		WC()->cart->apply_coupon( $coupon_code );
	}
}
add_action( 'woocommerce_before_cart', 'foy_apply_coupon' );

// unset session when coupon is removed
function coupon_removed_action( $coupon_code ) {
    unset($_SESSION['coupon']);
	unset($_SESSION['start']);
	unset($_SESSION['expire']);
}
add_filter("woocommerce_removed_coupon", 'coupon_removed_action');
