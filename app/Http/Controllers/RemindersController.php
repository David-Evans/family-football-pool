<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Game;

use DB;

class RemindersController extends Controller
{
    public function sendReminders() {
        $game = new Game();
        $week = $game->getCurrentWeek();
        $week = 3;
        $users = DB::table('users')->get();
        $games = array();
        $games = $game->getGames($week);
        $gameCount = count($games);
        date_default_timezone_set('America/New_York');
        $now = date('Ymd');
        $isGameDay = FALSE;
        $londonGame = FALSE;

        // What day of the week is it?
        $dayOfWeek = date('D');
        foreach ($games as $game) {
			// Is this game today?
			// London games
			$rightNow = strtotime("now");
			$gameDateTime = $game->game_datetime;
			$result = ($rightNow < strtotime($gameDateTime)) ? "unlocked" : "locked";
			$hour = date('H',strtotime($game->game_datetime));
			$day = date('D',strtotime($game->game_datetime));
			if ($day == $dayOfWeek) { $isGameDay = TRUE; }
			if ($hour == '09') { $londonGame = TRUE; }

        }

        // Is today a game day?
        // Set up Cron to run only at target send times
        	// Wed (Thanksgiving)
        	// Thu
        	// Sat
        	// Sun
        	// Mon
        if ($isGameDay) {
        	switch ($dayOfWeek) {
        		case "Thu":
        			$copy = "Last chance to lock in your Thursday night pick!";
        			break;
        		case "Sun":
        			$copy = "Last chance to lock in your Sunday picks!";
        			break;
        		case "Mon":
        			$copy = "Last chance to lock in your Monday night pick!";
        			break;
        		case "Sat":
        			break;
        	}
        	$this->sendSMSReminders($copy);
        } elseif ($londonGame && $dayOfWeek == "Sat") {
        	// Send reminders
        	$copy = "There's a London game tomorrow morning, make sure you made your pick!";
        	$this->sendSMSReminders($copy);
        } elseif ($week == 12) {
        	// Thanksgiving
        	if ($dayOfWeek == "Wed") {
        		// Send reminders
        		$copy = "Tomorrow is Turkey Day, three games.  Did you make your picks?";
	        	$this->sendSMSReminders($copy);
        	}
        } else {
        	// Don't send any reminders
        }
        	// If Sunday, send reminders at 1200 (ET)
        	// If Thursday, send reminders at 1900 (ET)
        	// If Monday, send reminders at 1900 (ET)
        // Is there a London game? If so, send reminder on Saturday
        	// Send reminders at 1900 (ET)

        return view('pages.send-reminders')->with([
            'games' => $games,
            'week' => $week,
            'dayOfWeek' => $dayOfWeek,
            'londonGame' => $londonGame,
            'isGameDay' => $isGameDay
            ]);

    }

    function sendSMSReminders($copy) {
        $token = env("TROPO_KEY", "NULL");
        $token = "062c2492bf2ce44c88dc558bc892824725712a4dceaf8228aceea3c2ee6d889d042e63b95b64629eeb706c8b";

        $users = DB::table('users')->where('sms_number','!=','')->get();
        $result = Array();
        $result['token'] = $token;
        $result['msg'] = $copy." http://football.jalapenodave.com";

        foreach ($users as $user) {
            $numbertodial = $user->sms_number;
            try {
                $url = 'https://api.tropo.com/1.0/sessions?action=create&token='.$result['token'].'&numbertodial='.$numbertodial.'&msg='.rawurlencode($result['msg']);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                $result['curl-response'] = curl_exec($ch);
                curl_close($ch);
            } catch (Exception $e) {
                $result['success'] = 'false';
                $result['error'] = $e->getMessage();
                return view('pages.send-message')->with([
                    'result' => $result
                ]);
            }
        }

        return view('pages.send-message')->with([
            'result' => $result
        ]);
    }
    
}
