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
defined( '_JEXEC' ) or die( 'Restricted access' );

Games::load('GamesTable','tables.base');

class GamesTableGames extends GamesTable 
{
	public function GamesTableGames( &$db ) 
	{
		$tbl_key 	= 'game_id';
		$tbl_suffix = 'games';
		$this->set( '_suffix', $tbl_suffix );
		$name 		= "games";
		
		parent::__construct( "#__{$name}_{$tbl_suffix}", $tbl_key, $db );	
	}
    
}