<?php

/**
 * @package     Joomla Modules
 * @subpackage  mod_myarticles
 *
 * @copyright   (C) 2023 René Kreijveld Webdevelopment <https://www.renekreijveld.nl>
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Module\Myarticles\Site\Helper\MyarticlesHelper;

$list = MyarticlesHelper::getList($params);
require ModuleHelper::getLayoutPath('mod_myarticles', $params->get('layout', 'default'));
