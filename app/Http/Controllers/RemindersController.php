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
            $location = $game->alt_location;
			if ($day == $dayOfWeek) { $isGameDay = TRUE; }
            if (strtolower($location) == 'london') { $londonGame = TRUE; }

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
        } elseif ($week == 13) {
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
        $nexmo_key=env("NEXMO_KEY","NULL");
        $nexmo_secret=env("NEXMO_SECRET","NULL");
        $nexmo_shortcode=env("NEXMO_SHORTCODE","NULL");
        $nexmo_number=env("NEXMO_NUMBER","NULL");
        $url = 'https://rest.nexmo.com/sms/json';

        $result = Array();
        $result['msg'] = rawurlencode($copy." https://football.jalapenodave.com");

        $users = DB::table('users')->where('sms_number','!=','')->get();

        foreach ($users as $user) {
            $smsNumber = $user->sms_number;
            try {
              $fields = array(
                'api_key' => $nexmo_key,
                'api_secret' => $nexmo_secret,
                'to' => '1'.$smsNumber,
                'from' => $nexmo_number,
                'text' => $message
              );

              $fields_string = '';
              foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
              rtrim($fields_string, '&');
              $ch = curl_init();
              curl_setopt($ch,CURLOPT_URL, $url);
              curl_setopt($ch,CURLOPT_POST, count($fields));
              curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
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
