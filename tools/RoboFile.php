<?php
/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2015-2018 Teclib' and contributors.
 *
 * http://glpi-project.org
 *
 * based on GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2003-2014 by the INDEPNET Development Team.
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of GLPI.
 *
 * GLPI is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * GLPI is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with GLPI. If not, see <http://www.gnu.org/licenses/>.
 * ---------------------------------------------------------------------
 */
class RoboFile extends \Robo\Tasks
{
   /**
    * Minify all
    *
    * @return void
    */
   public function minify() {
      $this->minifyCSS()
         ->minifyJS();
   }

   /**
    * Minify CSS stylesheets
    *
    * @return void
    */
   public function minifyCSS() {
      $css_dir = __DIR__ . '/../css';

      if (is_dir($css_dir)) {
         $it = new RegexIterator(
            new RecursiveIteratorIterator(
               new RecursiveDirectoryIterator($css_dir)
            ),
            "/\\.css\$/i"
         );

         foreach ($it as $css_file) {
            if (!$this->endsWith($css_file->getFilename(), 'min.css')) {
               $this->taskMinify($css_file->getRealpath())
                  ->to(str_replace('.css', '.min.css', $css_file->getRealpath()))
                  ->type('css')
                  ->run();
            }
         }
      }
      return $this;
   }

   /**
    * Minify JavaScript files stylesheets
    *
    * @return void
    */
   public function minifyJS() {
      $js_dir = __DIR__ . '/../js';

      if (is_dir($js_dir)) {
         $it = new RegexIterator(
            new RecursiveIteratorIterator(
               new RecursiveDirectoryIterator($js_dir)
            ),
            "/\\.js\$/i"
         );

         foreach ($it as $js_file) {
            if (!$this->endsWith($js_file->getFilename(), 'min.js')) {
               $this->taskMinify($js_file->getRealpath())
                  ->to(str_replace('.js', '.min.js', $js_file->getRealpath()))
                  ->type('js')
                  ->run();
            }
         }
      }

      return $this;
   }

   /**
    * Checks if a string ends with another string
    *
    * @param string $haystack Full string
    * @param string $needle   Ends string
    *
    * @return boolean
    * @see http://stackoverflow.com/a/834355
    */
   private function endsWith($haystack, $needle) {
      $length = strlen($needle);
      if ($length == 0) {
         return true;
      }

      return (substr($haystack, -$length) === $needle);
   }
}
