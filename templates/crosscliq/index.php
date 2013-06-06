<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
//JHtml::_('bootstrap.framework');

// Add Stylesheets
//$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');

// Load optional RTL Bootstrap CSS
//JHtml::_('bootstrap.loadCss', false, $this->direction);

// Add current user information
//$user = JFactory::getUser();



?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
	<?php // Add Stylesheets
$doc->addStyleSheet('templates/'.$this->template.'/css/styles.css');

// Add Scripts
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/jquery-1.7.2.min.js', 'text/javascript');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/custom.js', 'text/javascript');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/pietimer.js', 'text/javascript');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/jquery.rabidScratchCard.prod.js', 'text/javascript');

?>

	 <script>


$(document).ready(function() {
			$(".modal").click( function(){ $(this).toggleClass('hide'); } );
			$(".score_btn").click( function(event){  $('.modal').toggleClass('hide'); event.stopPropagation(); } );
			$("#1").rabidScratchCard({
	
				revealRadius:40,
				percentComplete:70,
				revealOnComplete:true,
				updateOnMouseMove:false,//setting this option is processor intensive. So, set this only if necessary. If set to false, % will be calculated only on muse up of scracthing
				updateOnFingerMove:false,
			       onScratchComplete : function(percentScratched) {
	
			    }
			});


    setTimeout(function() { $('#loader').fadeOut(500); }, 1500);
var score=0;
var qid=1;	
var questions = {}

	$('li:first-child .timer').pietimer({
			seconds: 5,
			color: 'rgba(0, 0, 0, 0.5)',
			height: 25,
			width: 25
		},
		function(){

			//$('.timer').parents().css({'color':'red'});

			setTimeout(function() { $('li:first-child .timer').parents('li').remove(); }, 900);
			$('li:first-child .timer').parents('li').css({ margin: '-200px 5px 0px 5px', opacity: '0' });

			$('li:first-child .timer').parents('li').next().addClass('no-blur');
		
			$('li:first-child .timer').pietimer('start');

		});


			$('li:first-child .timer').pietimer('start');
	
	
			// set up click/tap panels
			$('.no-blur .click').live('click',function(event){
				$(this).toggleClass('flip');
			});

		
		
		$(".front button").click(function(event){
		
		$(this).toggleClass('clicked');	
	
		setTimeout(function() { $(this).parents('div li').remove(); }, 100);
		$(this).parents('li').css({ margin: '-200px 5px 0px 5px', opacity: '0' });
		$(this).parents('li').next().addClass('no-blur');
		//$(this).parents('li').remove(); 



		
		if ($(this).data('clr') == 'green') { 
			$('.score').css({'font-size':'27px'});
			score=score+5/100*100;
			$('.score').text(score);

			$('.score-box').toggleClass('green',3000);
			setTimeout(function() { 
				$('.score-box').toggleClass('green',0); 
			$('.score').css({'font-size':'25px'});
			},1000);

		} else {
			$('.score').css({'font-size':'27px'});
			$('.score-box').toggleClass('red',3000);
			setTimeout(function() { 
				$('.score-box').toggleClass('red',0); 
			$('.score').css({'font-size':'25px'});
			},1000);
				
		}
		

		questions[$(this).parents('div').data('questionid')] = $(this).data('answerid');

		console.log( 'question id: ' + $(this).parents('div').data('questionid') + ' ' + ' answerid: ' + $(this).data('answerid') );

		
		if ($(this).parents('div').data('id') == '5') { 

			console.log(questions);

//do apost like this
baseUrl = '<?php echo JURI::root(); ?>/index.php?option=com_games&view=games&task=processQa&format=raw&tmpl=component';
$.ajax({
  	url: baseUrl,
  	data: questions,
  	type: 'post',
  	success: function(data) {
  		console.log(data);
  	}
});


			$('#scratch').fadeIn();
			console.log('final question answered');	

		}

		event.stopPropagation();
	
		});
	

});

	
	</script>
	
</head>

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
?>">


	<!-- Body -->
	<div class="body">
		<jdoc:include type="component" />
	</div>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
