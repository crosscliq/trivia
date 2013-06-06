<?php
/**
 * @version	0.1
 * @package	Games
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

class GamesController extends DSCControllerSite 
{
    public $default_view = 'dashboard';
	public $_models = array();
	public $message = "";
	public $messagetype = "";
	public $defines = null;
	
	function __construct( $config=array() )
	{
	    parent::__construct( $config );
	
	    $this->defines = Games::getInstance();
	    $this->user = JFactory::getUser();
	}
}

?>