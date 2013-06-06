<div id="loader">
	<div class="loader-bg"></div>
		<span class="loader-txt"><b>Loading...</b></span>
	</div>
</div>
<div class="moby_wrap mini_nav_wrap">

<div class="modal hide">
<h1>Leader Board</h1>
<table width="100%">
 <thead>
  <td>Rank</td>
  <td>Name</td>
  <td align="right">Score</td>
 </thead>
 <tbody>
 	<?php  foreach ($this->leaderboard as $player) : ?>
  <tr <?php if(@$player->active){ echo 'class="active"';} ?> >
   <td>#<?php echo $player->rank; ?> </td>
   <td><?php echo $player->name; ?></td>
   <td align="right"><?php echo $player->total; ?></td>
  </tr>
  	<?php endforeach; ?>
</tbody>
</table>

</div>

    <header class="mini_nav"> 
    <a ontouchstart="" class="navigate_btn" href="#"></a>    
    <a id="logo" href="/"><img src="images/logo.png" alt=""></a>
    <a ontouchstart="" class="score_btn"></a>
    </header> 
    

    

    
	<div class="top-bar">
		<div class="info-box">
		<h1>TRIVIA</h1>
			<p>Click the question box to answer, speed matters!</p>
		</div>
		<div class="score-box">
			<div class="score-glass">
				<span class="score">0</span>
				<span class="score-title"><?php echo JFactory::getUser()->name; ?>'s Score</span>
			</div>
		</div>
	</div>
  
  <div id="questions">
	<ul>
		<?php $blur = 1; $i =1; foreach($this->row->questions as $question) : ?>
		<li class="<?php if($blur) {echo 'no-blur';} ?>" >
			<div class="click panel flip"> 
				<div class="front">
					<div class="pad" data-id="<?php echo $i; ?>" data-questionid="<?php echo $question->question_id; ?>">
						<p>
						<?php foreach($question->answers as $answer) :  ?>
						<button data-answerid="<?php echo $answer->answer_id; ?>"  <?php if($answer->correct) { echo 'data-clr="green"' ;} ?>><?php echo $answer->answer_text; ?></button>
						<hr/>
						
						<?php endforeach; ?>
						</p>
					</div>
				</div>
				<div class="back">
					<div class="pad">
						<h2><?php echo $question->question_text; ?></h2>
					</div>
				</div>
			</div>
	
		</li>
		<?php $blur = 0; $i++; ?>
		<?php endforeach; ?>



	</ul>  
    </div>

	<div id="scratch" style="-webkit-perspective: 1000; display: none;z-index:100000;padding-top:100px;top:0;width:100%; height:100%;background:rgba(255,255,255,0.8);text-align:center;">
  	<div id="1" class="scratchCard" data-backGroundImage="images/win.jpg"  data-foreGroundImage="images/reveal.jpg"></div>
	</div>

    <div class="full_nav" style="display:none;">
		<div class="loader"><div class="loader-bg"></div><span class="loader-txt">Loading</span></div>

		
    </div>


</div>    

