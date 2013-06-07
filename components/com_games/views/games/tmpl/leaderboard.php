<?php 
$document = JFactory::getDocument();
$document->addStyleSheet('http://twitter.github.io/bootstrap/assets/css/bootstrap.css');
$document->addStyleSheet('http://twitter.github.io/bootstrap/assets/css/bootstrap-responsive.css');
//$document->addScript($url);

?>
<br>
<div class="page-center"><h1>Leader Board</h1><br>
<table width="100%" class="table table-striped table-bordered">
 <thead>
  <td>Rank</td>
  <td>Name</td>
  <td align="right">Score</td>
 </thead>
 <tbody>
 	<?php  foreach ($this->rows as $player) : ?>
  <tr <?php if(@$player->active){ echo 'class="active"';$points = $player->total;  } ?> >
   <td>#<?php echo $player->rank; ?> </td>
   <td><?php echo $player->name; ?></td>
   <td align="right"><?php echo $player->total; ?><?php if($player->winner_id) {echo '&nbsp;&nbsp;<img src="images/win.png" align="center" height="13px"/>'; }?></td>
  </tr>
  	<?php endforeach; ?>
</tbody>
</table>
</div>