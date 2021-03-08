<?php
/**
 * @package mam-meeting-room
 */

namespace Mam\MeetingRoom\Admin;


use Mam\MeetingRoom\Base\ServiceInterface;

class MeetingLogs implements ServiceInterface
{

    public function register()
    {
        add_action('init', [$this, 'add_custom_post_type'], 0);
        add_action('plugins_loaded', [$this, 'add_custom_fields']);
        add_action('plugins_loaded', [$this, 'add_custom_fields']);
        add_filter('manage_board-log_posts_columns', [$this, 'add_columns_headers']);
        add_action('manage_board-log_posts_custom_column', [$this, 'add_columns_content'], 10, 2);


    }

    public static function before_meeting_update($new_value, $old_value)
    {
        var_dump($new_value);
    }

    public static function add_columns_headers($columns)
    {
        $columns = array(
            'cb' => $columns['cb'],
            'before' => __('Content Before'),
            'after' => __('Content After'),
            'type' => __('Type'),
            'action' => __('Action'),
            'date' => __('Date'),
        );


        return $columns;
    }

    public function add_columns_content($column, $post_id)
    {
        switch ($column) {

            case 'before' :
                echo '<a href="#before-' . $post_id . '" data-fancybox>Before</a>
<div id="before-' . $post_id . '" style="display: none;width: 90%;max-width:767px;">' . get_field('content_before', $post_id) . '</div>';
                break;

            case 'after' :
                echo '<a href="#after-' . $post_id . '" data-fancybox>After</a>
<div id="after-' . $post_id . '" style="display: none;width: 90%;max-width:767px;">' . get_field('content_after', $post_id) . '</div>';
                break;

            case 'action' :
                $terms = get_the_term_list($post_id, 'log-action', '', ',', '');
                if (is_string($terms))
                    echo $terms;
                else
                    _e('Unable to get action(s)');
                break;

            case 'type' :
                $terms = get_the_term_list($post_id, 'log-type', '', ',', '');
                if (is_string($terms))
                    echo $terms;
                else
                    _e('Unable to get types(s)');
                break;

        }
    }

    public static function add_custom_fields()
    {
        acf_add_local_field_group(array(
            'key' => 'group_602b830349751',
            'title' => 'Board Logs',
            'fields' => array(
                array(
                    'key' => 'field_602b831708e0a',
                    'label' => 'Content Before',
                    'name' => 'content_before',
                    'type' => 'textarea',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'maxlength' => '',
                    'rows' => '',
                    'new_lines' => '',
                ),
                array(
                    'key' => 'field_602b832408e0b',
                    'label' => 'Content After',
                    'name' => 'content_after',
                    'type' => 'textarea',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'maxlength' => '',
                    'rows' => '',
                    'new_lines' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'board-log',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
        ));

    }

    public static function add_custom_post_type()
    {
        // Register Custom Board Log

        $labels = array(
            'name' => _x('Board Logs', 'Board Log General Name', 'mam-meeting-room'),
            'singular_name' => _x('Board Log', 'Board Log Singular Name', 'mam-meeting-room'),
            'menu_name' => __('Board Logs', 'mam-meeting-room'),
            'name_admin_bar' => __('Board Log', 'mam-meeting-room'),
            'archives' => __('Item Archives', 'mam-meeting-room'),
            'attributes' => __('Item Attributes', 'mam-meeting-room'),
            'parent_item_colon' => __('Parent Item:', 'mam-meeting-room'),
            'all_items' => __('All Items', 'mam-meeting-room'),
            'add_new_item' => __('Add New Item', 'mam-meeting-room'),
            'add_new' => __('Add New', 'mam-meeting-room'),
            'new_item' => __('New Item', 'mam-meeting-room'),
            'edit_item' => __('Edit Item', 'mam-meeting-room'),
            'update_item' => __('Update Item', 'mam-meeting-room'),
            'view_item' => __('View Item', 'mam-meeting-room'),
            'view_items' => __('View Items', 'mam-meeting-room'),
            'search_items' => __('Search Item', 'mam-meeting-room'),
            'not_found' => __('Not found', 'mam-meeting-room'),
            'not_found_in_trash' => __('Not found in Trash', 'mam-meeting-room'),
            'featured_image' => __('Featured Image', 'mam-meeting-room'),
            'set_featured_image' => __('Set featured image', 'mam-meeting-room'),
            'remove_featured_image' => __('Remove featured image', 'mam-meeting-room'),
            'use_featured_image' => __('Use as featured image', 'mam-meeting-room'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'mam-meeting-room'),
            'items_list' => __('Items list', 'mam-meeting-room'),
            'items_list_navigation' => __('Items list navigation', 'mam-meeting-room'),
            'filter_items_list' => __('Filter items list', 'mam-meeting-room'),
        );
        $args = array(
            'label' => __('Board Log', 'mam-meeting-room'),
            'description' => __('Board Logs', 'mam-meeting-room'),
            'labels' => $labels,
            'supports' => false,
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'post',
        );
        register_post_type('board-log', $args);

        $labels = array(
            'name' => _x('Log Action', 'taxonomy general name'),
            'singular_name' => _x('Log Action', 'taxonomy singular name'),
            'search_items' => __('Search Log Actions'),
            'all_items' => __('All Log Actions'),
            'parent_item' => __('Parent Log Action'),
            'parent_item_colon' => __('Parent Log Action:'),
            'edit_item' => __('Edit Log Action'),
            'update_item' => __('Update Log Action'),
            'add_new_item' => __('Add New Log Action'),
            'new_item_name' => __('New Log Action'),
            'menu_name' => __('Log Actions'),
        );
        $args = array(
            'labels' => $labels,
            'hierarchical' => false,
        );
        register_taxonomy('log-action', 'board-log', $args);

        $labels = array(
            'name' => _x('Log Type', 'taxonomy general name'),
            'singular_name' => _x('Log Type', 'taxonomy singular name'),
            'search_items' => __('Search Log Types'),
            'all_items' => __('All Log Types'),
            'parent_item' => __('Parent Log Type'),
            'parent_item_colon' => __('Parent Log Type:'),
            'edit_item' => __('Edit Log Type'),
            'update_item' => __('Update Log Type'),
            'add_new_item' => __('Add New Log Type'),
            'new_item_name' => __('New Log Type'),
            'menu_name' => __('Log Types'),
        );
        $args = array(
            'labels' => $labels,
            'hierarchical' => false,
        );
        register_taxonomy('log-type', 'board-log', $args);

    }

}