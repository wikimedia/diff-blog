<?php
namespace PublishPress\Permissions\Collab\Revisionary;

class PostFilters
{
    private $filtered_post_clauses_type = '';

    function __construct()
    {
        add_filter('presspermit_main_posts_clauses_types', [$this, 'flt_posts_clauses_object_types'], 10, 2);
        add_filter('presspermit_main_posts_clauses_where', [$this, 'flt_posts_clauses_where'], 10, 1);
        add_filter('presspermit_meta_cap', [$this, 'flt_meta_cap']);

        add_filter('revisionary_require_edit_others_drafts', [$this, 'fltRequireEditOthersDrafts'], 10, 4);

        add_filter('presspermit_base_cap_replacements', [$this, 'fltBaseCapReplacements'], 10, 3);
    }

    function fltBaseCapReplacements($replace_caps, $reqd_caps, $post_type) {
        if ($type_obj = get_post_type_object($post_type)) {
            if (!empty($type_obj->cap->edit_posts)) {
                $replace_caps['list_others_revisions'] = $type_obj->cap->edit_posts;
            }
        }

        return $replace_caps;
    }

    function fltRequireEditOthersDrafts($require, $post_type, $post_status, $args) {
        $status_obj = get_post_status_object($post_status);

        if ($status_obj && !empty($status_obj->capability_status)) { // Custom statuses with non-default capability mapping won't be available to Revisors by default
            $require = false;
        }

        return $require;
    }

    function flt_posts_clauses_object_types($object_types)
    {
        global $wp_query;

        if ($wp_query->is_preview && defined('REVISIONARY_VERSION')) {
            if (!empty($wp_query->query['p'])) {
                $post_id = $wp_query->query['p'];
            } elseif(!empty($wp_query->query['page_id'])) {
                $post_id = $wp_query->query['page_id'];
            } else {
                return;
            }

            if ($_post = get_post($post_id)) {
                if ('revision' == $_post->post_type) { // for past revisions
                    if ($_type = get_post_field('post_type', $_post->post_parent)) {
                        $object_types = $_type;
                        $this->filtered_post_clauses_type = $_type;
                    }
                }
            }
        }

        return $object_types;
    }

    function flt_posts_clauses_where($objects_where)
    {
        if ($this->filtered_post_clauses_type) {
            $objects_where = str_replace("post_type = 'post'", "post_type = '$this->filtered_post_clauses_type'", $objects_where);

            $this->filtered_post_clauses_type = '';
        }

        return $objects_where;
    }

    // this is no longer used as a filter, but still called internally
    function fltPostsWhere($where, $args)
    {
        // for past revisions
        if (defined('REVISIONARY_VERSION') && !is_admin() && !empty($_REQUEST['post_type']) && ('revision' == $_REQUEST['post_type']) 
        && (!empty($_REQUEST['preview']) || !empty($_REQUEST['preview_id']))) {
            $matches = [];
            if (preg_match("/post_type = '([0-9a-zA-Z_\-]+)'/", $where, $matches)) {
                if ($matches[1]) {
                    global $wpdb;
                    $where = str_replace(
                        "$wpdb->posts.post_type = '{$matches[1]}'", 

                        "( $wpdb->posts.post_type = '{$matches[1]}' " 
                        . " OR ( $wpdb->posts.post_type = 'revision'"
                        . " AND $wpdb->posts.post_status IN ('inherit')"
                        . " AND $wpdb->posts.post_parent IN ( SELECT ID FROM $wpdb->posts WHERE post_type = '{$matches[1]}' ) ) ) ",

                       // . " OR ( $wpdb->posts.post_status IN ('pending-revision', 'future-revision') "
                       // . " AND $wpdb->posts.comment_count IN ( SELECT ID FROM $wpdb->posts WHERE post_type = '{$matches[1]}' ) ) )", 
                        
                        $where
                    );
                }
            }
        }

        return $where;
    }

    function flt_meta_cap($meta_cap)
    {
        // for past revisions @todo: pending, future revisions?
        if (defined('REVISIONARY_VERSION') && ('read_post' == $meta_cap) && !is_admin() && !empty($_REQUEST['post_type']) 
        && ('revision' == $_REQUEST['post_type']) && (!empty($_REQUEST['preview']) || !empty($_REQUEST['preview_id']))) {
            $meta_cap = 'edit_post';
        }
        return $meta_cap;
    }
}
