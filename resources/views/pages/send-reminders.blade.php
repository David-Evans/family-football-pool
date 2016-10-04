<?php

/**
[ ] Check DB for Games about to start
[ ] Who hasn't made their pick? Who has?
[ ] Send reminders: Change copy for those who haven't ("You haven't made a pick!") vs. "Last chance to change your pick"
[ ] What about London games?
**/

?>
<p>Week: {{ $week }}</p>
<p>Day: {{ $dayOfWeek }}</p>
<p>London: {{ $londonGame }}</p>
<p>IsGameDay: {{ $isGameDay }}</p>
<ul>
@foreach($games as $game)
<?php
$time = date('H',strtotime($game->game_datetime));
?>
<li>{{ $time }}</li>
@endforeach
</ul>
<?php
//dd($games);
?>