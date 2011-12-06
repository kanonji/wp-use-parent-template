<?php
/*
* Plugin Name: WP Use parent template
* Plugin URI:https://github.com/kanonji/wp-use-parent-template
* Version: 0.4
* Description: To use parent template for child categories or pages. This plugin patches template hierarchy.
* Author: kanonji
* Author URI: http://twitter.com/kanonji
*/
/*
* MIT license
* http://www.opensource.org/licenses/mit-license.php
*/

define('WP-USE-PARENT-TEMPLATE_VERSION', '0.4');

add_action('template_redirect', 'category_patch');
add_action('template_redirect', 'page_patch');

function category_patch(){
    if(is_category() === false)
        return;
    $cat_ID = absint( get_query_var('cat') );
    $category = get_category( $cat_ID );
    if (is_wp_error($category) || $category->category_parent == 0)
        return;
    $templates = array();
    $templates[] = "category-{$category->slug}.php";
    $templates[] = "category-$cat_ID.php";
    $parentId = $category->category_parent;
    $category = get_category($parentId);
    if ( !is_wp_error($category) )
        $templates[] = "category-{$category->slug}.php";
    $templates[] = "category-$parentId.php";
    $templates[] = "category.php";
    $templates[] = "archive.php";
    $templates[] = "index.php";
    $template = locate_template($templates);
    include apply_filters('category_template', $template);
    exit();
}

function page_patch(){
    if(is_page() === false)
        return;
    global $wp_query;
    $id = (int) $wp_query->post->ID;
    if($parentId = $wp_query->post->post_parent)
        $parent = get_page($parentId)->post_name;
    $template = get_post_meta($id, '_wp_page_template', true);
    $pagename = get_query_var('pagename');
  
    if ( 'default' == $template )
      $template = '';
    $templates = array();
    if ( !empty($template) && !validate_file($template) )
        $templates[] = $template;
    if ( $pagename )
        $templates[] = "page-$pagename.php";
    $templates[] = "page-$id.php";
    if($parent)
        $templates[] = "page-$parent.php";
    if($parentId)
        $templates[] = "page-$parentId.php";
    $templates[] = "page.php";
    $templates[] = "index.php";
    $template = locate_template($templates);
    include apply_filters('page_template', $template);
    exit();
}
