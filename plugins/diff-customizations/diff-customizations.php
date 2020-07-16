<?php
/*
Plugin Name: Diff Customizations
Plugin URI: https://diff.wikimedia.org
Description: Adds customizations seperate from theme.
Version: 0.3
Author: Chris Koerner
Author URI: https://meta.wikimedia.org/wiki/Community_Relations
*/

//limit access to Jetpack to admins

add_action( 'admin_menu', 'diff_no_jetpack_menu_non_admins', 999 );

function diff_no_jetpack_menu_non_admins() {
	if (
		class_exists( 'Jetpack' )
		&& ! current_user_can( 'manage_options' )
	) {
		remove_menu_page( 'jetpack' );
	}
}


//limit access to Tools and Comments capabilities to admins
//These menu items are useless given there are no tools to configure for other roles like Contributors

add_action('admin_init', 'diff_remove_tools_comments_pages');

function diff_remove_tools_comments_pages() {
	if (!current_user_can ('administrator')
	){
		remove_menu_page( 'edit-comments.php' );
		remove_menu_page('tools.php');
    }
}


//remove commments from adimin bar

add_action( 'wp_before_admin_bar_render', 'diff_remove_admin_menus' );

function diff_remove_admin_menus() {
	if (!current_user_can ('administrator')
	){
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
    }
}





//Let's remove some unnecessary widgets from the WordPress dashboard

function diff_disable_dashboard_widgets()
{
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // Remove Quick Draft
    remove_meta_box('dashboard_primary', 'dashboard', 'core'); // Remove WordPress Events and News
    remove_meta_box('notepad_widget', 'dashboard', 'core'); // Remove Notepad widget
}
add_action('admin_menu', 'diff_disable_dashboard_widgets');


//A little notice to contributors when they login

function diff_contributor_admin_notice(){
    global $pagenow;
    if ( $pagenow == 'index.php' ) {
    $user = wp_get_current_user();
    if ( in_array( 'contributor', (array) $user->roles ) ) {
    echo '<div class="notice notice-info is-dismissible">
          <p>Welcome to Diff. Please review the <a href="#">editorial guidelines</a>. Click on <a href="post-new.php">+ New</a> to start writing.</p>
         </div>';
    }
}
}
add_action('admin_notices', 'diff_contributor_admin_notice');

//one for the main editor
function block_notice_enqueue() {
    wp_enqueue_script(
        'block_notice-script',
        plugins_url( 'block-notice.js', __FILE__ )
    );
}
add_action( 'enqueue_block_editor_assets', 'block_notice_enqueue' );

//add editorial calendar to toolbar
add_action( 'admin_bar_menu', 'diff_calendar_toolbar', 999 );

function diff_calendar_toolbar( $wp_admin_bar ) {
        $args = array(
                'id'    => 'calendar',
                'title' => 'Editorial Calendar',
                'href'  => admin_url() . 'admin.php?page=pp-calendar',
        );
        $wp_admin_bar->add_node( $args );
}

//disable comments on media attachments
function diff_filter_media_comment_status( $open, $post_id ) {
    $post = get_post( $post_id );
    if( $post->post_type == 'attachment' ) {
        return false;
    }
    return $open;
}
add_filter( 'comments_open', 'diff_filter_media_comment_status', 10 , 2 );

//disble Jetpack module for WordPress.com login

add_filter( 'jetpack_get_available_modules', 'diff_disable_jetpack_sso' );
function diff_disable_jetpack_sso( $modules ) {
    if( isset( $modules['sso'] ) ) {
        unset( $modules['sso'] );
    }
    return $modules;
}

?>
