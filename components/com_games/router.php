<?php
/**
 * @package Games
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

if ( !class_exists('Games') ) {
    JLoader::register( "Games", JPATH_ADMINISTRATOR . "/components/com_games/defines.php" );
}

Games::load( "GamesHelperRoute", 'helpers.route' );

/**
 * Build the route
 * Is just a wrapper for GamesHelperRoute::build()
 * 
 * @param unknown_type $query
 * @return unknown_type
 */
function GamesBuildRoute(&$query)
{
    return GamesHelperRoute::build($query);
}

/**
 * Parse the url segments
 * Is just a wrapper for GamesHelperRoute::parse()
 * 
 * @param unknown_type $segments
 * @return unknown_type
 */
function GamesParseRoute($segments)
{
    return GamesHelperRoute::parse($segments);
}