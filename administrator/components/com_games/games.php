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

// Check the registry to see if our Games class has been overridden
if ( !class_exists('Games') ) 
    JLoader::register( "Games", JPATH_ADMINISTRATOR . "/components/com_games/defines.php" );

// before executing any tasks, check the integrity of the installation
Games::getClass( 'GamesHelperDiagnostics', 'helpers.diagnostics' )->checkInstallation();

// Require the base controller
Games::load( 'GamesController', 'controller' );

// Require specific controller if requested
$controller = JRequest::getWord('controller', JRequest::getVar( 'view' ) );
if (!Games::load( 'GamesController'.$controller, "controllers.$controller" ))
    $controller = '';

if (empty($controller))
{
    // redirect to default
	$default_controller = new GamesController();
	$redirect = "index.php?option=com_games&view=" . $default_controller->default_view;
    $redirect = JRoute::_( $redirect, false );
    JFactory::getApplication()->redirect( $redirect );
}

DSC::loadBootstrap();

JHTML::_('stylesheet', 'common.css', 'media/dioscouri/css/');
JHTML::_('stylesheet', 'admin.css', 'media/com_games/css/');

$doc = JFactory::getDocument();
$uri = JURI::getInstance();
$js = "var com_games = {};\n";
$js.= "com_games.jbase = '".$uri->root()."';\n";
$doc->addScriptDeclaration($js);

$parentPath = JPATH_ADMINISTRATOR . '/components/com_games/helpers';
DSCLoader::discover('GamesHelper', $parentPath, true);

$parentPath = JPATH_ADMINISTRATOR . '/components/com_games/library';
DSCLoader::discover('Games', $parentPath, true);

// load the plugins
JPluginHelper::importPlugin( 'games' );

// Create the controller
$classname = 'GamesController'.$controller;
$controller = Games::getClass( $classname );
    
// ensure a valid task exists
$task = JRequest::getVar('task');
if (empty($task))
{
    $task = 'display';
    JRequest::setVar( 'layout', 'default' );
}
JRequest::setVar( 'task', $task );

// Perform the requested task
$controller->execute( $task );

// Redirect if set by the controller
$controller->redirect();
?>