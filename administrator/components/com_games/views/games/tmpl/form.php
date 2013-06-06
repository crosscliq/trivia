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
				<td> <?php echo @$row -> game_id; ?> </td>
			</tr>
			
			<tr>
				<td class="key"> <?php echo JText::_('Game Name'); ?>: </td>
				<td>
						<input type="text" name="game_name" id="game_name" value="<?php echo @$row -> game_name; ?> " />
			
				</td>
			</tr>
			<tr>
				<td class="key"> <?php echo JText::_('Game Owner'); ?>: </td>
				<td>
						<input type="text" name="user_id" id="user_id" value="<?php echo @$row -> user_name; ?> " />
			
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
		<input type="hidden" name="game_id" id="id" value="<?php echo @$row -> game_id; ?>" />
		<input type="hidden" name="params" id="params" value="" />
		<input type="hidden" name="task" value="" />
	</div>
</form>
