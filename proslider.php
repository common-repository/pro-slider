<?php
/*
 * Plugin Name:       Pro Slider
 * Plugin URI:        https://dreamreflectionmedia.com/
 * Description:       Welcome to the Pro Slider you can build your own slider with pro slider it will help you to grow your business.
 * Version:           1.0
 * Requires at least: 5.2
 * Author:            Pankaj Bachhal
 * Author URI:        https://www.instagram.com/pankaj_bachhal/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       proplugin
 * Tags:              Pro slider, slider, new slider, slider, proslider, Dream reflection media, pankaj bachhal, dynamic slider, pro image
*/
defined('ABSPATH') || die("You Can't Access this File Directly");
define('PROSLIDER_DIR_PATH', __FILE__); // PLUGIN_DIR_PATH - Global variable
define('PROSLIDER_PLUGIN_DIR_PATH', plugin_dir_url( __FILE__ )); // PLUGIN_DIR_PATH - Global variable


class proslider{
    function __construct(){
        $this->plugin = plugin_basename(__FILE__);
        
        function load_media_files() {
        wp_enqueue_media();
        }
        add_action( 'admin_enqueue_scripts', 'load_media_files' );
        }

}
$proslider = new proslider();


add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'prosliderstng' );

function prosliderstng ( $actions ) {
$myprolinks = array(
'<a href="' . admin_url( 'admin.php?page=proslider' ) .'">Go To</a>',
);
$actions = array_merge( $actions, $myprolinks );
return $actions;
}
register_activation_hook(__FILE__, function(){
    global $wpdb;
    $pro__slider__table = $wpdb->prefix . 'proslider';
    $get_charset = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $pro__slider__table (
    id int(11) NOT NULL AUTO_INCREMENT,
    pro__name varchar(2000) NOT NULL,
    pro__images varchar(5000) NOT NULL,
    PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
});

register_deactivation_hook(__FILE__,function(){
    global $wpdb;
    $pro__slider__table = $wpdb->prefix . 'proslider';
    $sql = "DROP TABLE IF EXISTS $pro__slider__table";
    $wpdb->query($sql);
    
});

// backend style & script
add_action('admin_enqueue_scripts','proslider_backend__files');
function proslider_backend__files(){
    wp_enqueue_style('proslider__dev__css', plugins_url('/assets/procss/prostyle.css', __FILE__) );
    wp_enqueue_script('proslider__dev__js', plugins_url('/assets/projs/projavascript.js',  __FILE__));
    wp_enqueue_script('jquery');
    wp_localize_script('proslider__dev__js','ajax_object',admin_url("admin-ajax.php"));
    
}
// Frontend style & script 
add_action('wp_enqueue_scripts','proslider_frontend_fiels');
function proslider_frontend_fiels(){
    wp_enqueue_style('proslider__css', plugins_url('/assets/procss/prostyle.css', __FILE__) );
    wp_enqueue_script('jquery');
    wp_enqueue_script('proslider__js', plugins_url('/assets/projs/projavascript.js',  __FILE__));
    wp_localize_script('proslider__js','ajax_object',admin_url("admin-ajax.php"));

}

function menu__of__proslider(){
    add_menu_page(
        "proslider", //page title
        "Proslider", //menu title
        "manage_options", //admin level
        "proslider", //page slug ~ parent slug
        "proslider__main__callback__function", //callback function
        "dashicons-images-alt2", //icon url
        "null" //position
        );
    add_submenu_page(
        "proslider", //parent slug
        "My Sliders", //page title
        "My Sliders", //menu title
        "manage_options", //capability = user level access
        "my-sliders", //menu slug
        "call__me__sub_menu_of__orslider"  //callback function
        );
    add_submenu_page(
        "proslider", //parent slug
        "Get Premium", //page title
        "Get Premium", //menu title
        "manage_options", //capability = user level access
        "get-premium", //menu slug
        "call__me__Premium_virsion"  //callback function
         );        

}
add_action("admin_menu","menu__of__proslider");

function call__me__sub_menu_of__orslider(){
 //all page functions
 require_once plugin_dir_path( __FILE__ )."/proview/allsliders.php";
 wp_enqueue_style('proslider__bootstrap_min__css', plugins_url('/assets/procss/bootstrap.min.css', __FILE__) );
 wp_enqueue_script('proslider__js', plugins_url('/assets/projs/projavascript.js', __FILE__));
 wp_enqueue_script('proslider__icon_js', plugins_url('/assets/projs/proicon.js', __FILE__));
 wp_enqueue_script('proslider__bootstrap_bundle_js', plugins_url('/assets/projs/bootstrap.bundle.min.js', __FILE__));

}

function call__me__Premium_virsion(){
    //all page functions
    require_once plugin_dir_path( __FILE__ )."/proview/Premium_virsion.php";
    wp_enqueue_style('proslider__bootstrap_min__css', plugins_url('/assets/procss/bootstrap.min.css', __FILE__) );
    wp_enqueue_script('proslider__js', plugins_url('/assets/projs/projavascript.js', __FILE__));
    wp_enqueue_script('proslider__icon_js', plugins_url('/assets/projs/proicon.js', __FILE__));
    wp_enqueue_script('proslider__bootstrap_bundle_js', plugins_url('/assets/projs/bootstrap.bundle.min.js', __FILE__));
   
   }

 function proslider__main__callback__function(){
    //all page functions
    require_once plugin_dir_path( __FILE__ )."/proview/mainProSlider.php";
    wp_enqueue_style('proslider__bootstrap_min__css', plugins_url('/assets/procss/bootstrap.min.css', __FILE__) );
    wp_enqueue_script('proslider__js', plugins_url('/assets/projs/projavascript.js', __FILE__));
    wp_enqueue_script('proslider__icon_js', plugins_url('/assets/projs/proicon.js', __FILE__));
    wp_enqueue_script('proslider__bootstrap_bundle_js', plugins_url('/assets/projs/bootstrap.bundle.min.js', __FILE__));
}

//slider data
add_action('wp_ajax_pro_slider_data','sub_ajax_pro_slider_data');
add_action('wp_ajax_nopriv_pro_slider_data','sub_ajax_pro_slider_data');
function sub_ajax_pro_slider_data(){
    if($_REQUEST['param']=='save_plugin'){
    global $wpdb;
    $pro__slider__table = $wpdb->prefix . 'proslider';
    $pro__slider_name__is = sanitize_text_field($_REQUEST['pro__sliders_name']);
    $slide_image = sanitize_text_field($_REQUEST['prs1']);
    $data = array(
    "pro__name"=>$pro__slider_name__is,
    "pro__images"=>$slide_image,
    );
    $wpdb->insert($pro__slider__table, $data);
    echo json_encode(array("status"=>1,"message"=>'success',"data"=>$data));
    }
    wp_die();
    }


    //delete the data from the table
    add_action('wp_ajax_delete_pro_slider_by_id','confirmed__deleted_the_slider');

    add_action('wp_ajax_nopriv_delete_pro_slider_by_id','confirmed__deleted_the_slider');

    function confirmed__deleted_the_slider(){
    if($_REQUEST['param']=='save_plugin'){

    global $wpdb;
    $prefix = $wpdb->prefix;
    $table = $prefix.'proslider';
    $where = array( 'id' => sanitize_text_field($_REQUEST['id']) );
    $wpdb->delete($table, $where);
    $success = sanitize_text_field('success');
    $statusval = sanitize_text_field(1);

    echo json_encode(array("status"=>esc_attr($statusval),"msg"=>esc_attr($success)));

    }
    wp_die();

    }


//edit

    add_action('wp_ajax_edit__pro__slides','edit__the__pro_slides_here_fun');
    add_action('wp_ajax_nopriv_edit__pro__slides','edit__the__pro_slides_here_fun');
    function edit__the__pro_slides_here_fun(){
        if (!isset($_REQUEST['rdm-nonce']) || ! wp_verify_nonce( $_REQUEST['rdm-nonce'], 'edit__pro__slides' ) ) {
            wp_send_json_error(['message' => 'Error']);
        }
        else if($_REQUEST['param']=='save_plugin'){
            global $wpdb;
            $prefix = $wpdb->prefix;
            $pro__table__for__update = $prefix.'proslider';
            $all_updated__slides = sanitize_text_field($_REQUEST['prs2']);
            $pro_updated__data = array(
                "pro__images"=> $all_updated__slides
            );
            $where_pro__slider = array( 'id' => sanitize_text_field($_REQUEST['id']) );
            $wpdb->update($pro__table__for__update, $pro_updated__data, $where_pro__slider);
           
            $proo__success = sanitize_text_field('success');
            $proo__statusval = sanitize_text_field(1);

            echo json_encode(array("status"=>esc_attr($proo__statusval),"msg"=>esc_attr($proo__success)));
        }
        wp_die();
    }

//shortcode function

add_shortcode("proslider-code","proslider__short__code__fun");

function proslider__short__code__fun($params){
    $values = shortcode_atts(
        array(
        "slider__id"=>"try"
        ),$params,
        'proslider-parameter'
        );
    ob_start();
    include plugin_dir_path( __FILE__ )."/proview/mainProSliderFront.php"; // we have attached php file to this shortcode
    wp_enqueue_style('jquery__hislide__css', plugins_url('/assets/procss/jquery.hislide.css', __FILE__) );
    wp_enqueue_script('proslider__js', plugins_url('/assets/projs/projavascript.js',  __FILE__));
    wp_enqueue_script('proslider__hislide__js', plugins_url('/assets/projs/hislide.js',  __FILE__));
    return ob_get_clean();
}