<?php

/**
 * @package     Joomla Modules
 * @subpackage  mod_myarticles
 *
 * @copyright   (C) 2023 René Kreijveld Webdevelopment <https://www.renekreijveld.nl>
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<ul class="mod-myarticles list-group">
    <?php foreach ( $list as $article ): ?>
        <li class="list-group-item">
            <?php echo $article->title; ?>
        </li>
    <?php endforeach; ?>
</ul>