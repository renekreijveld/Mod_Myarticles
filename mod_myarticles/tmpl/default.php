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
            <a href="/index.php?option=com_content&view=article&id=<?php echo $article->id; ?>"><?php echo $article->title; ?></a>&nbsp;<a href="/index.php?option=com_content&task=article.edit&a_id=<?php echo $article->id; ?>">Edit</a>
        </li>
    <?php endforeach; ?>
</ul>