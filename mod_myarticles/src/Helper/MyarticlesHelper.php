<?php

/**
 * @package     Joomla Modules
 * @subpackage  mod_myarticles
 *
 * @copyright   (C) 2023 René Kreijveld Webdevelopment <https://www.renekreijveld.nl>
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Joomla\Module\Myarticles\Site\Helper;

use \Joomla\CMS\Factory;
use \Joomla\Database\ParameterType;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Helper for mod_stats
 *
 * @since  1.5
 */
class MyarticlesHelper
{
    /**
     * Get list of stats
     *
     * @param   \Joomla\Registry\Registry  &$params  module parameters
     *
     * @return  array
     */
    public static function &getList(&$params)
    {
        $db   = Factory::getContainer()->get('DatabaseDriver');
        $user = $user = Factory::getApplication()->getIdentity();

        // Module parameters
        $articles = $params->get('articles', 5);
        $ordering = $params->get('ordering', 'title_a');

        // Map ordering parameters to SQL queries
        $orderingMap = [
            'title_a'    => $db->quoteName('title') . ' ASC',
            'title_d'    => $db->quoteName('title') . ' DESC',
            'created_a'  => $db->quoteName('created') . ' ASC',
            'created_d'  => $db->quoteName('created') . ' DESC',
            'modified_a' => $db->quoteName('modified') . ' ASC',
            'modified_d' => $db->quoteName('modified') . ' DESC',
        ];

        // Get articles
        $query = $db->getQuery(true)
            ->select($db->quoteName(array('id', 'title')))
            ->from($db->quoteName('#__content'))
            ->where($db->quoteName('created_by') . ' = :user_id')
            ->bind(':user_id', $user->id, ParameterType::INTEGER)
            ->order($orderingMap[$ordering])
            ->setLimit($articles);

        $query->setLimit($articles);
        $db->setQuery($query);
        $myArticles = $db->loadObjectList();

        return $myArticles;
    }
}
