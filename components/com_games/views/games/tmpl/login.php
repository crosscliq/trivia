


<form name="loginform" id="loginformid" action="<?php echo JURI::base(); ?>index.php?option=com_games&view=games&task=dologin" method="post" >


First name: <input type="text" name="firstname"><br>
Last name: <input type="text" name="lastname">
<input type="hidden" name="return" value="<?php echo $this->return; ?>">
<input type="submit" name="submit" id='submit'>
</form>

<script>
	 <script>


$(document).ready(function() {
			$('#loginformid').submit(function(e) {  e.preventDefault(); 
				$('#loader').fadeIn();
				$('#loginformid').trigger('submit');
			 } );

			
		});
</script>

<div class="full_nav" style="display:none;">
		<div class="loader"><div class="loader-bg"></div><span class="loader-txt">Loading</span></div>

		
    </div>