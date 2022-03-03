<style>
  .advanced-block-editor.wrap {
    max-width: 1000px;
  }
  .advanced-block-editor .all-blocks-list {
    columns: 3;
  }

  .advanced-block-editor label {
    vertical-align: baseline;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('blocks-select-all').onclick = function() {
      var checkboxes = document.querySelectorAll('.all-blocks-list input[type="checkbox"]');
      for (var checkbox of checkboxes) {
        checkbox.checked = true;
      }
    }
    document.getElementById('blocks-select-none').onclick = function() {
      var checkboxes = document.querySelectorAll('.all-blocks-list input[type="checkbox"]');
      for (var checkbox of checkboxes) {
        checkbox.checked = false;
      }
    }
  }, false);
</script>

<div class="wrap advanced-block-editor">
  <h1>Advanced Block-Editor</h1>
  <form method="POST">
    <input type="hidden" name="advanced-block-editor__update-settings" value="true">
    <h2>Block Reusables</h2>
    <ul>
      <li>Show Block-Reusables in Admin Menu at <code>Appearance > Block-Reusables</code> for Users with <code>xyz</code> capability</li>
      <li>Expose <code>get_block_reusable($title)</code> and <code>the_block_reusable($title)</code> to get a reusable block in PHP-templates.</li>
    </ul>
    <ul>
      <li>
        <input type="checkbox" name="advanced-block-editor__block-reusables" id="advanced-block-editor__block-reusables" <?php echo (get_option('advanced-block-editor__block-reusables') == 'on') ? 'checked' : ''; ?>>
        <label for="advanced-block-editor__block-reusables">Enable Block-Reusable Tools</label>
      </li>
    </ul>
    <hr>

    <h2>Block Pattern-Manager</h2>
    <ul>
      <li>Remove support for WP standard patterns</li>
      <li>Create Block-Patterns for the Block-Editor with the Block-Editor</li>
      <li>Manage Block-Patterns at <code>Appearance > Block-Patterns</code></li>
    </ul>
    <ul>
      <li>
        <input type="checkbox" name="advanced-block-editor__block-patterns" id="advanced-block-editor__block-patterns" <?php echo (get_option('advanced-block-editor__block-patterns') == 'on') ? 'checked' : ''; ?>>
        <label for="advanced-block-editor__block-patterns">Enable Block-Pattern Manager</label>
      </li>
    </ul>
    <hr>

    <h2>Supported Blocks</h2>
    <p>Disable all Blocks that the Theme is not supporting.</p>
    <button type="button" id="blocks-select-all">Select all</button> <button type="button" id="blocks-select-none">Select none</button>
    <ul class="all-blocks-list">
    <?php
    $block_registry = WP_Block_Type_Registry::get_instance();
    $registered_block_types = $block_registry->get_all_registered();
    $blocks_enabled = get_option('advanced-block-editor__blocks-enabled');
    foreach($block_registry->get_all_registered() as $registered_block){
      if($blocks_enabled){
        $block_checked = (in_array($registered_block->name,$blocks_enabled)) ? 'checked' : '';
      } else {
        $block_checked = "checked";
      }
      ?>
      <li>
        <input type="checkbox" name="advanced-block-editor__blocks[]" id="advanced-block-editor__<?= $registered_block->name ?>" value="<?= $registered_block->name ?>" <?= $block_checked ?>> <label for="advanced-block-editor__<?= $registered_block->name ?>"><?= $registered_block->name ?></label>
      </li>
      <?php
    }
    ?>
    </ul>


    <input type="submit" value="Save" class="button button-primary button-large">
  </form>
</div>
