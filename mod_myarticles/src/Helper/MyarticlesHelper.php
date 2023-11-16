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
        $db     = Factory::getContainer()->get('DatabaseDriver');
        $user   = $user = Factory::getApplication()->getIdentity();

        // Module parameters
        $articles = $params->get('articles', 5);
        $ordering   = $params->get('ordering', 'title_a');

        // Get articles
        $query = $db->getQuery(true)
            ->select($db->quoteName(array('id','title')))
            ->from($db->quoteName('#__content'))
            ->where($db->quoteName('created_by') . ' = :user_id')
            ->bind(':user_id', $user->id, ParameterType::INTEGER);
        switch ($ordering) {
            case 'title_a':
                $query->order($db->quoteName('title') . ' ASC');
                break;            
            case 'title_d':
                $query->order($db->quoteName('title') . ' DESC');
                break;            
            case 'created_a':
                $query->order($db->quoteName('created') . ' ASC');
                break;            
            case 'created_d':
                $query->order($db->quoteName('created') . ' DESC');
                break;            
            case 'modified_a':
                $query->order($db->quoteName('modified') . ' ASC');
                break;            
            case 'modified_d':
                $query->order($db->quoteName('modified') . ' DESC');
                break;            
        }        
        $query->setLimit($articles);
        $db->setQuery($query);
        $myArticles = $db->loadObjectList();

        return $myArticles;
    }
}
