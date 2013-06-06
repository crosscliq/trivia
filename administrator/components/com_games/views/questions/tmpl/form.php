<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php $form = @$this -> form; ?>
<?php $row = @$this -> row; ?>
<?php JHTML::_('behavior.calendar');
	JHtml::_('behavior.formvalidation');

?>
 
<form action="<?php echo JRoute::_( @$form['action'] ) ?>" method="post" class="adminform" name="adminForm" id="adminForm" enctype="multipart/form-data" >

	<fieldset>
		<legend>
			<?php echo JText::_("BASIC INFORMATION"); ?>
		</legend>

		<table class="admintable">
			<tr>
				<td class="key"> <?php echo JText::_('ID'); ?>: </td>
				<td> <?php echo @$row -> testimonial_id; ?> </td>
			</tr>
			
			<tr>
				<td class="key"> <?php echo JText::_('game_id'); ?>: </td>
				<td>
					<input type="text" name="game_id" id="game_id" value="<?php echo @$row -> game_id; ?> " />
				
				</td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('question_title'); ?>: </td>
				<td>
						<input type="text" name="question_title" id="question_title" value="<?php echo @$row -> question_title; ?> " />
			
				</td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('question_text'); ?>: </td>
				<td>
						<input type="text" name="question_text" id="question_text" value="<?php echo @$row -> question_text; ?> " />
				
				</td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('value'); ?>: </td>
				<td>
				<input type="text" name="value" id="value" value="<?php echo @$row -> value; ?> " />

				</td>
			</tr>

			<tr>
				<td class="key"> <?php echo JText::_('ordering'); ?>: </td>
				<td>
				<input type="text" name="ordering" id="ordering" value="<?php echo @$row -> ordering; ?> " />
			
				</td>
			</tr>
			
			<tr>
				<td class="key"> <?php echo JText::_('datecreated'); ?>: </td>
				<td>
				<input type="text" name="datecreated" id="datecreated" value="<?php echo @$row -> datecreated; ?> " />
			
				</td>
			</tr>
	
			<tr>
                    <td style="width: 100px; text-align: right;" class="key">
                        <?php echo JText::_( 'Enabled' ); ?>:
                    </td>
                    <td>
                        <?php echo  DSCGrid::btbooleanlist('enabled', '', @$row->enabled, 'Enabled', 'Disabled') ; ?>
                      
                    </td>
                </tr>    
			
			
			
		</table>
	</fieldset>
	<div>
		<input type="hidden" name="testimonial_id" id="id" value="<?php echo @$row -> testimonial_id; ?>" />
		<input type="hidden" name="params" id="params" value="" />
		<input type="hidden" name="task" value="" />
	</div>
</form>
