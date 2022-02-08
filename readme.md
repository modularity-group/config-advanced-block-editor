# config-block-editor

This module builds on WordPress and Modularity.

Hide several standard blocks. Enable Block-Reusables and Block-Patterns interface in WP Dashboard. 

---

Version: 1.2.0

Author: Matze https://modularity.group

License: MIT

---

Improves ability to work with blocks.

**reusables**
- shows **Block-Reusables** below **Appearance** Admin Menu
- exposes functions `get_block_reusable($title)` and `the_block_reusable($title)` to get a reusable block in templates

**patterns**
- implements Admin UI to create and manage pattern-blocks that can be easily inserted in the block editor
- shows **Block-Patterns** below **Appearance** Admin Menu.

---

1.3.0 (Matze)
- remove reduce blocks script

1.2.0 (Matze)
- repair reduce blocks functionality with pluggable block_editor_asset script enqueue 

1.1.0 (Matze)
- rename from config-block-control
- simplify module-structure
