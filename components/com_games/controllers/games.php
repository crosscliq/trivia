<?php
/**
 * @package	Games
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );

class GamesControllerGames extends GamesController
{
	function __construct() 
	{
		parent::__construct();
		$this->set('suffix', 'games');
	}

		/**
	 * Displays item
	 * @return void
	 */
	 function view($cachable=false, $urlparams = false)
	{	
		
		$user = $this->validateUser();
	
		$session = JFactory::getSession();
		$session->set('userid',$user->id);
		//checking whether the user logged in or not
		$userid = $session->get('userid');
		
		if($userid=='') {
			   $session->set('userid','');  //set to blank
			}

		$model = $this->getModel( $this->get('suffix') );
		$id = $model->getId();
		if(!$id) {
		$id	= 	$_REQUEST['id'];
		}
		$row = $model->getItem($id);
	
		$view   = $this->getView( $this->get('suffix'), 'html' );
		$view->setModel( $model, true );
		$view->assign( 'row', $row );
		$view->setLayout( 'view' );
		
		$model = $this->getModel( 'leaderboard' );
		
		$leaderboards = $model->getLeaderboard(JFactory::getUser()->id);
	
		$view->assign( 'leaderboard', $leaderboards );

		$view->setTask(true);
		
		// TODO take into account the $cachable value, as in $this->display(); 
		
		$view->display();
		//$this->footer();
		return $this;
	}



		/**
	 * Displays item
	 * @return void
	 */
	 function leaderboard($cachable=false, $urlparams = false)
	{	
		
		$model = $this->getModel( 'leaderboard' );
		
		$rows = $model->getLeaderboard(JFactory::getUser()->id);
	
		$view   = $this->getView( $this->get('suffix'), 'html' );
		$view->setModel( $model, true );
		$view->assign( 'rows', $rows );
		$view->setLayout( 'leaderboard' );
		
		$view->setTask(true);
		
		$view->display();
		//$this->footer();
		return $this;
	}



	function createUser($firstname, $lastname ) {

		$details = array();
		$details['name'] = $firstname . ' ' . $lastname;
		$un = $this->makeUN($firstname, $lastname);
		$details['username'] = $this->makeUN($un);
		$details['password'] = $this->makeUN($firstname, $lastname);

		$email = $this->makeUN($firstname, $lastname) . '@triv.2win.co';
		$details['email'] = $email;


		$helper = new DSCHelperUser();
		

		if($helper->usernameExists($un)) {
			//we have user;
		} else {
			//create the user
			$helper->createNewUser($details);
			
		}


	}


	function dologin() {


		//GET THE POSTED FIRST/LASTNAME
		$firstname = JRequest::getVar('firstname');
		$lastname = JRequest::getVar('lastname');
		$postedreturn = JRequest::getVar('return', '', 'method', 'base64');
	
		if ($postedreturn) 
        {
            $return = base64_decode($postedreturn);

            if (!JURI::isInternal($return)) {
                $return = '';
            }

        }

		
		
	
		$this->createUser($firstname, $lastname);
		
		//TRY TO LOG this USER in. 
		$un = $this->makeUN($firstname, $lastname);
		$pw = $this->makeUN($firstname, $lastname);
    	$credentials = array( 'username' => $un, 'password' => $pw);
    	$app = JFactory::getApplication('site');
   		$logged = $app->login($credentials, $options=array('silent' => true, 'remember' => true));


    	if($logged) {
    	$this->setRedirect($return);

    		
    		// we are looged in set the session and redirect to the game;
    	} else {

    		
    		die('all is lost');
    	

    	}



	}

	function findPrize($userid, $gameids) {
		Games::load( 'GamesTablePrizes', 'tables.prizes');
		$prize = DSCTable::getInstance('Prizes','GamesTable');
	
		$keys = array('game_id' => $gameids[0]);
	
		$return = null;

		
		if($prize->load($keys)) {
			
			$return = $prize;
			if($prize->redeemed >= $prize->qty) {
				//they won but there is no more prizes for this station. 
				$return = null;
			}
		} else {
			$return = null;
		}

		
		return $return;

	}


	function redeemWinner($userid, $gameid, $prize) {
		Games::load( 'GamesTableWinners', 'tables.winners');
		$winners = DSCTable::getInstance('Winners','GamesTable');
		$keys = array('user_id' => $userid, 'game_id' => $gameid, 'prize_id' => $prize->prize_id );
		$winners->load($keys);
		$winners->user_id = $userid;
		$winners->game_id = $gameid;
		$winners->prize_id = $prize->prize_id;
		
		if($winners->store()) {
			$prize->redeemed = $prize->redeemed +1;
			$prize->store();
		}

	}

	function isWinner($userid, $gameid) {
		$response = array();
		$response['winner'] = false;
		$chance = rand(1, 100);
		$winner = false;
		if($chance > 1){
		$response['winner'] = true;
		$response['prize'] = $this->findPrize($userid,  $gameid);
		
		if(empty($response['prize']->prize_id)) {
			//they won, but there is no more prizes
			$response['winner'] = false;
			$response['prize'] = 'null';
		} else {
			$this->redeemWinner($userid, $gameid, $response['prize']);
		}
		}	

		return $response;

	}


	function processQa() {

		//$questions =  JRequest::getVar('questions');
		$questions = array();

		$msg = array();
		$msg['response'] = 'Sorry Your are not a winner.';
	 	$msg['status'] = 'loser';
		$msg['error'] = '';

		foreach ($_POST as $key => $value) {
			if(is_numeric($key)) {
				$questions[$key] = $value ;
			}
		}

		$user_id = JFactory::getUser()->id;
		if($user_id) {
		$allcorrect = true;
		$gameids =  array();
		foreach ($questions as $questionid => $answerid ) {


			Games::load( 'GamesTableQuestions', 'tables.questions');
			$question = DSCTable::getInstance('Questions','GamesTable');

			if($question->load($questionid)) {
						$gameids[] = $question->game_id;
						Games::load( 'GamesTableAnswers', 'tables.answers');
						$answer = DSCTable::getInstance('Answers','GamesTable');
			
						if($answer->load($answerid)) {
						Games::load( 'GamesTableUseranswers', 'tables.useranswers');
						$table = DSCTable::getInstance('Useranswers','GamesTable');
						$keys = array('user_id' => $user_id, 'question_id' => $questionid, 'answer_id' => $answerid);
						$table->load($keys);
						$table->user_id = $user_id;
						$table->question_id = $questionid;
						$table->answer_id = $answerid;

						//TODO make Answers store the score so we can have partially right answers
						if($answer->correct == 1) {

						  $table->score = $question->value;
						} else {
							//if they got one wrong they don't get a chance to win. 
							$allcorrect = false;
							$table->score = 0;
						}
						
						$table->store();
					} else {
						//didn't find the answers
					}


			} else {
				//didn't find the question
			}

		}

	

		if($allcorrect) {
			$winner = $this->isWinner($user_id, $gameids['0']);
			
			if($winner['winner']) {
				$msg['response'] = 'You are a winner';
	 			$msg['status'] = 'winner';
	 			$msg['prize'] = $winner['prize'];
				$msg['error'] = '';	
			}

		}


	} else {
	 $msg['error'] = 'Not Logged in';
	}


		echo json_encode($msg);

	}






	function cleanNames($string) {

		return preg_replace("/[^A-Za-z0-9 ]/", '', $string);
	}
	function makeUN($firstname, $lastname){
		$un = $this->cleanNames($firstname) . $this->cleanNames($lastname);
		$un = strtolower($un);		
		return $un;
	}


	function validateUser($msg = null) {
		if(empty($msg)) {
			$msg = 'You must login first';
		}
		$user = JFactory::getUser();
		$userId = $user -> get('id');
		if (!$userId) {
			$app = JFactory::getApplication();
			$return = JFactory::getURI() -> toString();
			$url = 'index.php?option=com_games&view=games&task=login&Itemid=105';
			$url .= '&return=' . base64_encode($return);
			$url = JRoute::_($url,false);
			
			$app -> redirect($url, $msg);
			return false;
		}
		return $user;
	}


		/**
	 * Displays item
	 * @return void
	 */
	 function login($cachable=false, $urlparams = false)
	{	
		
		/*$model = $this->getModel( $this->get('suffix') );
		$model->getId();
		$row = $model->getItem();*/
	
		$view   = $this->getView( $this->get('suffix'), 'html' );
	//$view->setModel( $model, true );
		//$view->assign( 'row', $row );
		$view->setLayout( 'login' );

		 // if there is a return URL base64encoded, then set it for the form to use
        $return = JRequest::getVar('return', '', 'method', 'base64'); 
       
        $view->assign('return', $return );
	
		

		$view->setTask(true);
		
		// TODO take into account the $cachable value, as in $this->display(); 
		
		$view->display();
		//$this->footer();
		return $this;
	}
}
