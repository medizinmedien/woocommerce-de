<?php
/**
 * Extensions support: include plugin parts with translations loaders.
 *
 * @package    WooCommerce German (de_DE)
 * @subpackage Extensions
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2012-2014, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/woocommerce-de/
 * @link       http://deckerweb.de/twitter
 *
 * @since      3.0.4
 */

/**
 * Exit if accessed directly
 *
 * @since 3.0.4
 */
if ( ! defined( 'WPINC' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


add_action( 'plugins_loaded', 'ddw_wcde_extensions_support_setup' );
/**
 * Load actual translations for some third-party WooCommerce Add-On/ Extension
 *    plugins.
 *
 * @since   3.0.4
 * @version 3.1.0
 *
 * @uses    ddw_wcde_unique_plugin_check() Check for existing plugins (that are active).
 * @uses    ddw_wcde_load_custom_translations() Load the textdomains for translation.
 */
function ddw_wcde_extensions_support_setup() {

	$wcde_thirdparty_addons = array(

		/** "404 Silent Salesman" (free, via WordPress.org) */
		'404-silent-salesman' => array(
			'unique_check'     => 'silentsalesman_404_init',	// function
			'slug'             => '404-silent-salesman',
			'loading_location' => 'global',
			'textdomains'      => array(
				'woothemes'
			),
		),

		/** AWD Weight/Country Shipping (free, via WordPress.org) */
		'awd-weightcountry-shipping' => array(
			'unique_check'     => 'init_awd_shipping', // function
			'slug'             => 'awd-weightcountry-shipping',
			'loading_location' => 'global',
			'textdomains'      => array(
				'woocommerce'
			),
		),

		/** Branding [premium] */
		'branding' => array(
			'unique_check'     => 'activate_woocommerce_branding', // function
			'slug'             => 'branding',
			'loading_location' => 'global',
			'textdomains'      => array(
				'wc_branding'
			),
		),

		/** Brands [premium] */
		'brands' => array(
			'unique_check'     => 'WC_Brands', // class
			'slug'             => 'brands',
			'loading_location' => 'global',
			'textdomains'      => array(
				'wc_brands',
				'woocommerce'
			),
		),

		/** Bundle Rate Shipping [premium] */
		'bundle-rate-shipping' => array(
			'unique_check'     => 'woocommerce_bundle_rate_shipping_load', // function
			'slug'             => 'bundle-rate-shipping',
			'loading_location' => 'global',
			'textdomains'      => array(
				'woocommerce-bundle-rate-shipping',
				'woocommerce-bundle-rate-shippin'
			),
		),

		/** Cart Rate Shipping [premium] */
		'cart-based-shipping' => array(
			'unique_check'     => 'WC_Cart_Based_Shipping', // class
			'slug'             => 'cart-based-shipping',
			'loading_location' => 'global',
			'textdomains'      => array(
				'woocommerce'
			),
		),

		/** Custom Availability [premium] */
		'custom-availability' => array(
			'unique_check'     => 'WC_Custom_Availability', // class
			'slug'             => 'custom-availability',
			'loading_location' => 'admin',
			'textdomains'      => array(
				'wb-wcca'
			),
		),

		/** Custom Coupon Message */
		'custom-coupon-message' => array(
			'unique_check'     => 'wccm_meta_boxes_setup', // function
			'slug'             => 'custom-coupon-message',
			'loading_location' => 'admin',
			'textdomains'      => array(
				'wccm-plugin'
			),
		),

		/** Dvin Woocommerce Wishlist [premium] */
		'dvin-wishlist' => array(
			'unique_check'     => 'DVIN_PLUGIN_WEBURL', // constant
			'slug'             => 'dvin-wishlist',
			'loading_location' => 'global',
			'textdomains'      => array(
				'dvinwcwl'
			),
		),

		/** Email Validation */
		'email-validation' => array(
			'unique_check'     => 'WooCommerce_Email_Validation', // class
			'slug'             => 'email-validation',
			'loading_location' => 'frontend',
			'textdomains'      => array(
				'wc_emailvalidation'
			),
		),

		/** Google Wallet Gateway [premium] */
		'google-wallet' => array(
			'unique_check'     => 'WC_Gateway_Google_Wallet', // class
			'slug'             => 'google-wallet',
			'loading_location' => 'global',
			'textdomains'      => array(
				'google_wallet',
				'payson'
			),
		),

		/** Gravity Forms Product Add-Ons [premium] */
		'gravityforms-addons' => array(
			'unique_check'     => 'woocommerce_gravityforms', // class
			'slug'             => 'gravityforms-addons',
			'loading_location' => 'global',
			'textdomains'      => array(
				'wc_gravityforms',
				'wc_gf_addons',
				'woocommerce'
			),
		),

		/** Klarna Gateway [premium] */
		'klarna' => array(
			'unique_check'     => 'WC_Gateway_Klarna', // class
			'slug'             => 'klarna',
			'loading_location' => 'global',
			'textdomains'      => array(
				'klarna'
			),
		),

		/** Menu Cart (Lite Version) */
		'menu-cart' => array(
			'unique_check'     => 'WcMenuCart', // class
			'slug'             => 'menu-cart',
			'loading_location' => 'global',
			'variant'          => 'neutral',
			'textdomains'      => array(
				'wcmenucart',
				'default'
			),
		),

		/** Ogone Gateway [premium] */
		'ogone' => array(
			'unique_check'     => 'init_ogone', // function
			'slug'             => 'ogone',
			'loading_location' => 'global',
			'textdomains'      => array(
				'wc-ogone',
				'woothemes'
			),
		),

		/** Payment Discounts */
		'payment-discounts' => array(
			'unique_check'     => 'WC_Payment_Discounts', // class
			'slug'             => 'payment-discounts',
			'loading_location' => 'admin',
			'textdomains'      => array(
				'wcpaydisc'
			),
		),

		/** Paymill Gateway (CodeCanyon Version) [premium] */
		'paymill-cc' => array(
			'unique_check'     => 'WC_PAYMILL_VERSION', // constant
			'slug'             => 'paymill-cc',
			'loading_location' => 'global',
			'textdomains'      => array(
				'wc_paymill',
				'wp_paymill'
			),
		),

		/** PayPal Digital Goods Gateway [premium] */
		'paypal-digital-goods' => array(
			'unique_check'     => 'init_paypal_digital_goods_gateway', // function
			'slug'             => 'paypal-digital-goods',
			'loading_location' => 'global',
			'textdomains'      => array(
				'ppdg',
				'default'
			),
		),

		/** PayPal Express Gateway [premium] */
		'paypal-express' => array(
			'unique_check'     => 'woocommerce_paypal_express_init', // function
			'slug'             => 'paypal-express',
			'loading_location' => 'global',
			'textdomains'      => array(
				'wc-paypal-express',
				'woocommerce',
				'woothemes',
				'default'
			),
		),

		/** Photos Product Tab */
		'photos-product-tab' => array(
			'unique_check'     => 'woo_photos_tab_min_required', // function
			'slug'             => 'photos-product-tab',
			'loading_location' => 'global',
			'textdomains'      => array(
				'wc_photos_product_tab',
				'wc_video_product_tab'
			),
		),

		/** PIP - Print Invoice/Packing List [premium] */
		'pip' => array(
			'unique_check'     => 'woocommerce_pip_activate', // function
			'slug'             => 'pip',
			'loading_location' => 'global',
			'textdomains'      => array(
				'woocommerce-pip'
			),
		),

		/** Product CSV Import Suite [premium] */
		'product-csv-import-suite' => array(
			'unique_check'     => 'WC_Product_CSV_Import_Suite', // class
			'slug'             => 'product-csv-import-suite',
			'loading_location' => 'global',
			'textdomains'      => array(
				'wc_csv_import',
				'woocommerce',
				'wordpress-importer',
				'default'
			),
		),

		/** Pushover for WooCommerce */
		'pushover-integration' => array(
			'unique_check'     => 'WC_PUSHOVER_DIR', // class
			'slug'             => 'pushover-integration',
			'loading_location' => 'admin',
			'textdomains'      => array(
				'wc_pushover',
				'wc_ups'
			),
		),

		/** QR Code Generator [premium] */
		'qr-code-generator' => array(
			'unique_check'     => 'qr_load', // function
			'slug'             => 'qr-code-generator',
			'loading_location' => 'admin',
			'textdomains'      => array(
				'woo_qrcode',
				'woocommerce'
			),
		),

		/** Region Filter [premium] */
		'region-filter' => array(
			'unique_check'     => 'WOOCOMMERCE_REGION_FILTER_VERSION', // constant
			'slug'             => 'region-filter',
			'loading_location' => 'global',
			'textdomains'      => array(
				'wbwcrf'
			),
		),

		/** Shipping Details [premium] */
		'shipping-details' => array(
			'unique_check'     => 'wooshippinginfo', // class
			'slug'             => 'shipping-details',
			'loading_location' => 'global',
			'textdomains'      => array(
				'wshipinfo-patsatech'
			),
		),

		/** Shipping Per Product [premium] */
		'shipping-per-product' => array(
			'unique_check'     => 'PER_PRODUCT_SHIPPING_VERSION', // constant
			'slug'             => 'shipping-per-product',
			'loading_location' => 'global',
			'textdomains'      => array(
				'wc_shipping_per_product',
				'woocommerce',
				'default'
			),
		),

		/** Skrill Gateway [premium] */
		'skrill' => array(
			'unique_check'     => 'woocommerce_skrill_init', // function
			'slug'             => 'skrill',
			'loading_location' => 'global',
			'textdomains'      => array(
				'wc_skrill'
			),
		),

		/** Subscribe To Newsletter [premium] */
		'subscribe-to-newsletter' => array(
			'unique_check'     => 'WC_Subscribe_To_Newsletter', // class
			'slug'             => 'subscribe-to-newsletter',
			'loading_location' => 'global',
			'textdomains'      => array(
				'wc_subscribe_to_newsletter',
				'woothemes'
			),
		),

		/** Table Rate Shipping (CodeCanyon version) [premium] */
		'trs-cc' => array(
			'unique_check'     => 'woocommerce_table_rate_shipping_init', // function
			'slug'             => 'trs-cc',
			'loading_location' => 'global',
			'textdomains'      => array(
				'woocommerce'
			),
		),

		/** Table Rate Shipping (WooThemes version) [premium] */
		'table-rate-shipping' => array(
			'unique_check'     => 'TABLE_RATE_SHIPPING_VERSION', // constant
			'slug'             => 'table-rate-shipping',
			'loading_location' => 'global',
			'textdomains'      => array(
				'wc_table_rate',
				'wc_shipping_zones'
			),
		),

		/** Video Product Tab */
		'video-product-tab' => array(
			'unique_check'     => 'woo_video_tab_min_required', // function
			'slug'             => 'video-product-tab',
			'loading_location' => 'global',
			'textdomains'      => array(
				'wc_video_product_tab'
			),
		),

		/** WooCommerce All In One SEO Pack */
		'wc-aiosp' => array(
			'unique_check'     => 'woo_ai_admin_init', // function
			'slug'             => 'wc-aiosp',
			'loading_location' => 'admin',
			'textdomains'      => array(
				'woo_ai',
				'woo_vl'
			),
		),

		/** Woo Product Importer */
		'woo-product-importer' => array(
			'unique_check'     => 'WebPres_Woo_Product_Importer', // class
			'slug'             => 'woo-product-importer',
			'loading_location' => 'admin',
			'textdomains'      => array(
				'woo-product-importer'
			),
		),

	);  // end of array

	/** Apply our translation loader for each add-on, if active */
	foreach ( $wcde_thirdparty_addons as $wcde_tpaddon => $tpaddon_id ) {

		/** Check for above add-ons if they exist (are active) */
		if ( ddw_wcde_unique_plugin_check( $tpaddon_id[ 'unique_check' ] ) ) {

			$is_neutral = ( ! isset( $addon_id[ 'variant' ] ) ) ? FALSE : TRUE;

			$loading_location = esc_attr( $tpaddon_id[ 'loading_location' ] );

			/** Finally load every textdomain from the given .mo file path - based on loading location */
			if ( is_admin() && 'admin' == $loading_location ) {

				/** Actually load the various textdomains for displaying translations */
				ddw_wcde_load_custom_translations(
					(array) $tpaddon_id[ 'textdomains' ],
					$tpaddon_id[ 'slug' ],
					TRUE,
					$is_neutral
				);

			} elseif ( ! is_admin() && 'frontend' == $loading_location ) {

				/** Actually load the various textdomains for displaying translations */
				ddw_wcde_load_custom_translations(
					(array) $tpaddon_id[ 'textdomains' ],
					$tpaddon_id[ 'slug' ],
					TRUE,
					$is_neutral
				);

			} elseif ( 'global' == $loading_location ) {

				/** Actually load the various textdomains for displaying translations */
				ddw_wcde_load_custom_translations(
					(array) $tpaddon_id[ 'textdomains' ],
					$tpaddon_id[ 'slug' ],
					TRUE,
					$is_neutral
				);

			}  // end if loading location check

		}  // end if

	}  // end foreach

}  // end of function ddw_wcde_extensions_support_setup