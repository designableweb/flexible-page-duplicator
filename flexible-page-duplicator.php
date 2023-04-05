<?php
/**
 * Plugin Name: Page Duplicator
 * Description: A simple plugin to duplicate pages along with their ACF fields and content, including flexible content fields.
 * Version: 1.0
 * Author: ChatGPT4 for bill@designableweb.com
 * Text Domain: page-duplicator
 */

if ( ! function_exists( 'is_plugin_active' ) ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if ( is_plugin_active( 'advanced-custom-fields/acf.php' ) || is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
    function duplicate_page_with_acf_fields( $post_id ) {
        $original_post = get_post( $post_id );
        $acf_fields = get_field_objects( $post_id );

        $new_post = array(
            'post_title'   => $original_post->post_title . ' (Duplicate)',
            'post_content' => $original_post->post_content,
            'post_status'  => 'draft',
            'post_type'    => $original_post->post_type,
        );

        $new_post_id = wp_insert_post( $new_post );

        if ( $new_post_id && !empty( $acf_fields ) ) {
            foreach ( $acf_fields as $field_name => $field ) {
                update_field( $field['key'], $field['value'], $new_post_id );
            }

            update_post_meta( $new_post_id, '_wp_page_template', get_post_meta( $post_id, '_wp_page_template', true ) );
        }

        return $new_post_id;
    }

    function add_duplicate_page_link( $actions, $post ) {
        if ( $post->post_type === 'page' ) {
            $actions['duplicate'] = sprintf( '<a href="%s" title="%s">%s</a>', wp_nonce_url( admin_url( 'edit.php?post_type=page&duplicate_page=' . $post->ID ), 'duplicate_' . $post->ID ), __( 'Duplicate this page', 'page-duplicator' ), __( 'Duplicate', 'page-duplicator' ) );
        }

        return $actions;
    }

    add_filter( 'page_row_actions', 'add_duplicate_page_link', 10, 2 );

    function duplicate_page_action() {
        if ( isset( $_GET['duplicate_page'], $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'duplicate_' . $_GET['duplicate_page'] ) ) {
            $new_post_id = duplicate_page_with_acf_fields( $_GET['duplicate_page'] );

            if ( $new_post_id ) {
                wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
                exit;
            }
        }
    }

    add_action( 'admin_init', 'duplicate_page_action' );
} else {
    function page_duplicator_acf_notice() {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p><?php _e( 'Page Duplicator requires the Advanced Custom Fields plugin to be installed and activated.', 'page-duplicator' ); ?></p>
        </div>
        <?php
    }

    add_action( 'admin_notices', 'page_duplicator_acf_notice' );
}
