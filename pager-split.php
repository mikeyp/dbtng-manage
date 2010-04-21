<?php
// $Id: cron.php,v 1.42 2009/02/08 20:27:51 webchick Exp $

$remove = array(
  'functions' => array(
    'theme_pager',
    'theme_pager_first',
    'theme_pager_last',
    'theme_pager_previous',
    'theme_pager_next',
    'theme_pager_link'
    'pager_load_array',
  ),
);

/**
 * Do the merging
 */

// Fetch the source file content.
$content = file_get_contents('dbtng/includes/pager.inc');

// Delete code
foreach ($remove['functions'] as $function) {
  // Dunno why, but this only matches 1 function. Who cares, while() helps. 21/05/2009 sun
  $s = '@
(?:^/\*\*(?:(?!\*\*).)+?\*/\s+)?                       # Optional PHPDoc
^function\ ' . $function . '\(.*?\)  # Function name + arguments
(?:(?!^\}).)+?                                         # Function body
^\}                                                    # Closing function body
\s+                                                    # White-space to next function
@smx';
  while (preg_match($s, $content, $matches) && !empty($matches[0])) {
    $content = str_replace($matches[0], '', $content);
  }
}

if (!empty($move)) {
  // Remove code from source file.
  file_put_contents('dbtng/includes/pager.inc', $content);  
}
