<?xml version="1.0" encoding="utf-8"?>
<metadata>
	<layout title="Single Game">
		<message>
			<![CDATA[Displays  The Leaderboard for a game]]>
		</message>
	</layout>
    
    <!-- Joomla 1.6+ only -->
    <fields name="request">
        <fieldset name="request" addfieldpath="/administrator/components/com_games/elements">
            <field name="task" type="hidden" default="leaderboard" />
            
            <field name="id" type="gamesgames"
                label="Select Game"
              
                description="Select Game"
            />

        </fieldset>
    </fields>
    

</metadata>