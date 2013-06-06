<?php
/**
 * @version	1.5
 * @package	Games
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

defined('_JEXEC') or die('Restricted access');

class GamesViewBase extends DSCViewAdmin
{
    public function __construct($config = array())
    {
        parent::__construct($config);
    
        $this->defines = Games::getInstance();
    }
    
	public function display($tpl=null)
	{
		JHTML::_('stylesheet', 'admin.css', 'media/com_games/css/');
		
		parent::display($tpl);
	}
}