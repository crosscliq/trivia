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

Games::load( 'GamesModelDashboard', 'models.dashboard' );

Class GamesModelLeaderboard extends GamesModelDashboard {



	function getLeaderboard($user_id = null, $limit = 10) {
		$db = JFactory::getDbo();
 
		$query = "SELECT ua.user_id, users.name,  sum(ua.score) as total 
FROM triv_games_useranswers as ua 
 LEFT JOIN triv_users as users ON  users.id = ua.user_id 

 GROUP BY user_id ORDER BY total DESC";
 		$db->setQuery($query);
 		$results = $db->loadObjectList();
 		$find = 1;

 		$leaderboard = array();
 		$i =1;
 			
 			foreach($results as $user) {
 				$user->rank = $i;

 				$sql = " SELECT * from triv_games_winners  WHERE  user_id = '". $user->user_id . "'";
 				$db->setQuery($sql);
 				$user->winner_ids = $db->loadObjectList();

 				if($user_id == $user->user_id) {
 					$user->active = 1;
 					$find = 0;
 					if($i > $limit) {
 						$leaderboard[] = $user;
 					}
 				} 
 				$limit++;
 				if($i < $limit) {
 					$leaderboard[] = $user;
 				}
 				
 				$i++;
 			} 

 		return $leaderboard;


	}


	function getWonStations($user_id = null, $limit = 10) {
		$db = JFactory::getDbo();
 
		$sql = " SELECT * from triv_games_winners ";

 		$db->setQuery($query);
 		$results = $db->loadObjectList();
 		

 		return $results;


	}


}
