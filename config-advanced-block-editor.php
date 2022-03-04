<?php defined("ABSPATH") or die;

add_action('admin_menu',function(){
  add_submenu_page(
    'modularity',
    'Advanced Block-Editor',
    'Adv. Block-Editor',
    'manage_options',
    'advanced-block-editor',
    'config_advanced_block_editor_admin_page_callback'
  );
});

function config_advanced_block_editor_admin_page_callback() {
  if(isset($_POST['advanced-block-editor__update-settings'])){
    if (isset($_POST['advanced-block-editor__block-reusables'])) {
      update_option('advanced-block-editor__block-reusables', $_POST['advanced-block-editor__block-reusables']);
    } else {
      delete_option('advanced-block-editor__block-reusables');
    }

    if (isset($_POST['advanced-block-editor__block-patterns'])) {
      update_option('advanced-block-editor__block-patterns', $_POST['advanced-block-editor__block-patterns']);
    } else {
      delete_option('advanced-block-editor__block-patterns');
    }

    if (isset($_POST['advanced-block-editor__blocks'])) {
      update_option('advanced-block-editor__blocks-enabled', $_POST['advanced-block-editor__blocks']);
    } else {
      delete_option('advanced-block-editor__blocks-enabled');
    }
  }
  include 'templates/admin-page.php';
}

add_filter( 'allowed_block_types_all', function ( $block_editor_context, $editor_context ) {
  $blocks_enabled = get_option('advanced-block-editor__blocks-enabled');
  if($blocks_enabled) return $blocks_enabled;
  return $block_editor_context;
}, 10, 2 );

if(get_option('advanced-block-editor__block-reusables') == 'on'){
  include_once 'includes/block-reusables.php';
}

if(get_option('advanced-block-editor__block-patterns') == 'on'){
  include_once 'includes/block-patterns.php';
}
