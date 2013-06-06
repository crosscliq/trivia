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
				<td> <?php echo @$row -> answer_id; ?> </td>
			</tr>
			
			<tr>
				<td class="key"> <?php echo JText::_('question_id'); ?>: </td>
				<td>
					<input type="text" name="question_id" id="question_id" value="<?php echo @$row -> question_id; ?> " />
				
				</td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('answer_text'); ?>: </td>
				<td>
						<input type="text" name="answer_text" id="answer_text" value="<?php echo @$row -> answer_text; ?> " />
			
				</td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('ordering'); ?>: </td>
				<td>
						<input type="text" name="ordering" id="ordering" value="<?php echo @$row -> ordering; ?> " />
				
				</td>
			</tr>
			
			<tr>
                    <td style="width: 100px; text-align: right;" class="key">
                        <?php echo JText::_( 'Enabled' ); ?>:
                    </td>
                    <td>
                        <?php echo  DSCGrid::btbooleanlist('correct', '', @$row->correct, 'Correct Answer', 'Wrong') ; ?>
                      
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
		<input type="hidden" name="answer_id" id="id" value="<?php echo @$row -> answer_id; ?>" />
		<input type="hidden" name="params" id="params" value="" />
		<input type="hidden" name="task" value="" />
	</div>
</form>
