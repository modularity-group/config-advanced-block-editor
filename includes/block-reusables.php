<?php

add_action('registered_post_type', function($type, $args) {
  if ($type != 'wp_block') { return; }
  $args->show_in_menu = 'themes.php';
  $args->labels->all_items = 'Block-Reusables';
}, 10, 2);

function get_block_reusable($title){
  return config_block_reusables_get($title);
}

function the_block_reusable($title) {
  echo config_block_reusables_get($title);
}

function config_block_reusables_get($title) {
  $block = get_page_by_title($title, OBJECT, "wp_block");
  if ($block) {
    return apply_filters("the_content", $block->post_content);
  }
  return "";
}
