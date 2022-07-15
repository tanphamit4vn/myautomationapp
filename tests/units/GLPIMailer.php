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

namespace tests\units;

use \DbTestCase;

/* Test for inc/notificationmailing.class.php .class.php */

class GLPIMailer extends DbTestCase {

   public function testValidateAddress() {
      $mailer = new \GLPIMailer;

      $this->boolean($mailer->validateAddress('user'))->isFalse();
      $this->boolean($mailer->validateAddress('user@localhost'))->isTrue();
      $this->boolean($mailer->validateAddress('user@localhost.dot'))->isTrue();
   }

   public function testPhpMailerLang() {
      $mailer = new \GLPIMailer;

      $mailer->setLanguage();
      $tr = $mailer->getTranslations();
      $this->string($tr['empty_message'])->isIdenticalTo('Message body empty');

      $mailer->setLanguage('fr');
      $tr = $mailer->getTranslations();
      $this->string($tr['empty_message'])->isIdenticalTo('Corps du message vide.');
   }
}
