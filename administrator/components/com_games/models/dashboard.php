<?php
/**
 * @version	1.5
 * @package	Games
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

Games::load('GamesModelBase','models.base');

class GamesModelDashboard extends GamesModelBase 
{
	function getTable($name='Config', $prefix='GamesTable', $options = array())
	{
		return parent::getTable($name, $prefix, $options);
	}
}