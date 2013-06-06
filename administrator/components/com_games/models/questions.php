<?php
/**
* @package		Games
* @copyright	Copyright (C) 2009 DT Design Inc. All rights reserved.
* @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
* @link 		http://www.dioscouri.com
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');
if ( !class_exists('Games') ) 
             JLoader::register( "Games", JPATH_ADMINISTRATOR."/components/com_games/defines.php" );
        

Games::load('GamesModelBase','models.base');

class GamesModelQuestions extends GamesModelBase 
{


	protected function _buildQueryWhere(&$query)
    {
        $filter     = $this->getState('filter');
       	$filter_name      = $this->getState('filter_name');
		$filter_id_from = $this->getState('filter_id_from');
        $filter_id_to   = $this->getState('filter_id_to');
    	$filter_user_id    = $this->getState('filter_user_id');
		$filter_name    = $this->getState('filter_name');
        $filter_game_id   = $this->getState('filter_game_id');
    
        $filter_datecreated    = $this->getState('filter_datecreated');
        $filter_datemodified    = $this->getState('filter_datemodified');
		$filter_enabled    = $this->getState('filter_enabled');
		
		
		
        if ($filter) 
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter ) ) ).'%');
            $where = array();
            $where[] = 'LOWER(tbl.question_id) LIKE '.$key;
           
      
            $query->where('('.implode(' OR ', $where).')');
        }
		if ($filter_name) 
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter_name ) ) ).'%');
            $where = array();
            $where[] = 'LOWER(e.question_id) LIKE '.$key;
            $where[] = 'LOWER(tbl.title) LIKE '.$key;
      
            $query->where('('.implode(' OR ', $where).')');
        }
		
		 if (strlen($filter_id_from))
        {
            if (strlen($filter_id_to))
            {
                $query->where('tbl.question_id >= '.(int) $filter_id_from);  
            }
                else
            {
                $query->where('tbl.question_id = '.(int) $filter_id_from);
            }
        }
        
        if (strlen($filter_id_to))
        {
            $query->where('tbl.question_id <= '.(int) $filter_id_to);
        }
        
         if (strlen($filter_game_id))
        {
            $query->where('tbl.game_id = '.(int) $filter_game_id);
        }
    	
		
    	if (strlen($filter_datecreated))
        {
            $query->where("tbl.datecreated = '".$filter_datecreated."'");
        }
        if (strlen($filter_datemodified))
        {
            $query->where("tbl.datemodified = '".$filter_datemodified."'");
        }
          
		    
	    
		if (strlen($filter_enabled))
        {
            $query->where("tbl.enabled = '".$filter_enabled."'");
        }
	   
     
   
	 
    }

	 protected function _buildQueryGroup(&$query)
    {
    }

	/**
     * Builds JOINS clauses for the query
     */
    protected function _buildQueryJoins(&$query)
    {
     //$query->join( "LEFT", "#__games_games AS g ON g.game_id = tbl.game_id" );
	   
    }
	/**
	 * Builds SELECT fields list for the query
	 */
	protected function _buildQueryFields(&$query)
	{
		$fields = array();  

        $query -> select($this -> getState('select', 'tbl.*'));
        $query -> select($fields);
	}
	
	
	protected function prepareItem( &$item, $key=0, $refresh=false )
	{
			$item->link = 'index.php?option=com_games&view=questions&task=edit&id='.$item->question_id;
			
			parent::prepareItem(&$item, $key, $refresh );
	        $item->answers = $this->addAnswers($item->question_id);
            $item->num_answers = count($item->answers);
	}

    function addAnswers($pk) {
        Games::load('GamesModelAnswers','models.answers');
        $model = DSCModel::getInstance('Answers','GamesModel');
        $model->setState( 'filter_question_id', $pk );
        $answers = $model->getList();
    
        return $answers;
     }


    
	
	
}