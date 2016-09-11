@extends("layouts.master")

@section("content")        

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-cog fa-fw"></i> Week {{ $week }} Picks
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Picks for week {{ $week }}</div>

                <div class="panel-body">
<table id="view-picks"><tbody>
<tr>
    <th>Player</th>
@for($i=1;$i<=$gameCount;$i++)
    <th><strong>{{ $i }}</strong></th>
@endfor
</tr>

@foreach ($users as $user)
    <tr>
        <td><img src="/images/avatars/{{ strtolower($user->avatar) }}" class="avatar" /></td>
    @foreach ($games as $game)
        <?php 
            $myPick = userPick($game->id, $user->id, $picks); 
            echo '<td>'.$myPick.'</td>';
        ?>
    @endforeach
    </tr>
@endforeach

</tbody></table>
				</div>
			</div>
		</div>
	</div>
@endsection

<?php
    function userPick ($gameId, $userId, $picks) {
        $result = "";
        // cache-bustersss
        foreach ($picks as $pick) {
            if ($pick->game_id == $gameId && $pick->user_id == $userId) {
                return '<img src="/images/logos/'.strtolower($pick->pick).'.png" />';
            }
        }
        return $result;
    }
?>