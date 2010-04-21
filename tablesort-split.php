<?php
// $Id: cron.php,v 1.42 2009/02/08 20:27:51 webchick Exp $

$remove = array(
  'functions' => array(
    'tablesort_init',
    'tablesort_header',
    'tablesort_cell',
    'tablesort_get_order',
    'tablesort_get_sort',
  ),
);

/**
 * Do the merging
 */

// Fetch the source file content.
$content = file_get_contents('dbtng/includes/tablesort.inc');

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


// Remove code from source file.
file_put_contents('dbtng/includes/tablesort.inc', $content);  

