<?php
/**
 * @version 1.5
 * @package Games
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

class GamesModelBase extends DSCModel
{
       public $cache_enabled = false;

    public function __construct($config = array())
    {
        parent::__construct($config);
    
        $this->defines = Games::getInstance();
    }
    
    public function getTable($name='', $prefix='GamesTable', $options = array())
    {
        JTable::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_games/tables' );
        return parent::getTable($name, $prefix, $options);
    }
}