<?php
   function get_docroot() {
      $p = explode('/', getcwd());
      $rpath = '';
      while (!empty($p)) {
        if (array_pop($p) == 'docs') break;
        $rpath .= '../';
      }
      return $rpath;
   }
?>
