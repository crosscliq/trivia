<?php
/**
 * @package	Games
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

Games::load('GamesViewBase','views.base');

class GamesViewConfig extends GamesViewBase 
{
	function getLayoutVars($tpl=null) 
	{
		$layout = $this->getLayout();
		switch(strtolower($layout))
		{
			case "default":
			default:
				$this->_default($tpl);
			  break;
		}
	}
	
	function _default($tpl = null) 
	{
		// check config
			$row = Games::getInstance();
			$this->assign( 'row', $row );
		
		// add toolbar buttons
			JToolBarHelper::save('save');
			JToolBarHelper::cancel( 'close', JText::_( 'Close' ) );
			
			// add the core ACL options button only if access allows them to
			if (JFactory::getUser()->authorise('core.admin', 'com_games')) {
			    JToolBarHelper::preferences('com_games');
			}
			
		// plugins
        	$filtered = array();
	        $items = DSCTools::getPlugins( 'Games' );
			for ($i=0; $i<count($items); $i++) 
			{
				$item = &$items[$i];
				// Check if they have an event
				if ($hasEvent = DSCTools::hasEvent( $item, 'onListConfigGames', 'Games' )) {
					// add item to filtered array
					$filtered[] = $item;
				}
			}
			$items = $filtered;
			$this->assign( 'items_sliders', $items );
			
		// Add pane
			jimport('joomla.html.pane');
			$sliders = JPane::getInstance( 'sliders' );
			$this->assign('sliders', $sliders);
			
		// form
			$validate = JUtility::getToken();
			$form = array();
			$view = strtolower( JRequest::getVar('view') );
			$form['action'] = "index.php?option=com_games&controller={$view}&view={$view}";
			$form['validate'] = "<input type='hidden' name='{$validate}' value='1' />";
			$this->assign( 'form', $form );
			
		// set the required image
		// TODO Fix this to use defines
			$required = new stdClass();
			$required->text = JText::_( 'Required' );
			$required->image = "<img src='".JURI::root()."/media/com_games/images/required_16.png' alt='{$required->text}'>";
			$this->assign('required', $required );
    }
    
}
