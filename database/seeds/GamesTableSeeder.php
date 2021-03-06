<?php

use Illuminate\Database\Seeder;
use App\Game;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Empty the table (start fresh)
        Game::truncate();

        // Load with NFL season schedule
		DB::table('games')->insert(array(
			array('week_id' => 1, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-09-08 20:30','visitor_team' => 'Panthers', 'home_team' => 'Broncos'),
			array('week_id' => 1, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-11 13:00','visitor_team' => 'Buccaneers', 'home_team' => 'Falcons'),
			array('week_id' => 1, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-11 13:00','visitor_team' => 'Vikings', 'home_team' => 'Titans'),
			array('week_id' => 1, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-11 13:00','visitor_team' => 'Browns', 'home_team' => 'Eagles'),
			array('week_id' => 1, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-11 13:00','visitor_team' => 'Bengals', 'home_team' => 'Jets'),
			array('week_id' => 1, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-11 13:00','visitor_team' => 'Raiders', 'home_team' => 'Saints'),
			array('week_id' => 1, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-11 13:00','visitor_team' => 'Chargers', 'home_team' => 'Chiefs'),
			array('week_id' => 1, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-11 13:00','visitor_team' => 'Bills', 'home_team' => 'Ravens'),
			array('week_id' => 1, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-11 13:00','visitor_team' => 'Bears', 'home_team' => 'Texans'),
			array('week_id' => 1, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-11 13:00','visitor_team' => 'Packers', 'home_team' => 'Jaguars'),
			array('week_id' => 1, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-11 16:05','visitor_team' => 'Dolphins', 'home_team' => 'Seahawks'),
			array('week_id' => 1, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-11 16:25','visitor_team' => 'Giants', 'home_team' => 'Cowboys'),
			array('week_id' => 1, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-11 16:25','visitor_team' => 'Lions', 'home_team' => 'Colts'),
			array('week_id' => 1, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-11 20:30','visitor_team' => 'Patriots', 'home_team' => 'Cardinals'),
			array('week_id' => 1, 'day_of_week' => 'Monday', 'game_datetime' => '2016-09-12 19:10','visitor_team' => 'Steelers', 'home_team' => 'Redskins'),
			array('week_id' => 1, 'day_of_week' => 'Monday', 'game_datetime' => '2016-09-12 22:20','visitor_team' => 'Rams', 'home_team' => '49ers'),
			array('week_id' => 2, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-09-15 20:25','visitor_team' => 'Jets', 'home_team' => 'Bills'),
			array('week_id' => 2, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-18 13:00','visitor_team' => '49ers', 'home_team' => 'Panthers'),
			array('week_id' => 2, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-18 13:00','visitor_team' => 'Cowboys', 'home_team' => 'Redskins'),
			array('week_id' => 2, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-18 13:00','visitor_team' => 'Bengals', 'home_team' => 'Steelers'),
			array('week_id' => 2, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-18 13:00','visitor_team' => 'Saints', 'home_team' => 'Giants'),
			array('week_id' => 2, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-18 13:00','visitor_team' => 'Dolphins', 'home_team' => 'Patriots'),
			array('week_id' => 2, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-18 13:00','visitor_team' => 'Chiefs', 'home_team' => 'Texans'),
			array('week_id' => 2, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-18 13:00','visitor_team' => 'Titans', 'home_team' => 'Lions'),
			array('week_id' => 2, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-18 13:00','visitor_team' => 'Ravens', 'home_team' => 'Browns'),
			array('week_id' => 2, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-18 16:05','visitor_team' => 'Seahawks', 'home_team' => 'Rams'),
			array('week_id' => 2, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-18 16:05','visitor_team' => 'Buccaneers', 'home_team' => 'Cardinals'),
			array('week_id' => 2, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-18 16:25','visitor_team' => 'Jaguars', 'home_team' => 'Chargers'),
			array('week_id' => 2, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-18 16:25','visitor_team' => 'Falcons', 'home_team' => 'Raiders'),
			array('week_id' => 2, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-18 16:25','visitor_team' => 'Colts', 'home_team' => 'Broncos'),
			array('week_id' => 2, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-18 20:30','visitor_team' => 'Packers', 'home_team' => 'Vikings'),
			array('week_id' => 2, 'day_of_week' => 'Monday', 'game_datetime' => '2016-09-19 20:30','visitor_team' => 'Eagles', 'home_team' => 'Bears'),
			array('week_id' => 3, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-09-22 20:25','visitor_team' => 'Texans', 'home_team' => 'Patriots'),
			array('week_id' => 3, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-25 13:00','visitor_team' => 'Cardinals', 'home_team' => 'Bills'),
			array('week_id' => 3, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-25 13:00','visitor_team' => 'Raiders', 'home_team' => 'Titans'),
			array('week_id' => 3, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-25 13:00','visitor_team' => 'Redskins', 'home_team' => 'Giants'),
			array('week_id' => 3, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-25 13:00','visitor_team' => 'Browns', 'home_team' => 'Dolphins'),
			array('week_id' => 3, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-25 13:00','visitor_team' => 'Ravens', 'home_team' => 'Jaguars'),
			array('week_id' => 3, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-25 13:00','visitor_team' => 'Lions', 'home_team' => 'Packers'),
			array('week_id' => 3, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-25 13:00','visitor_team' => 'Broncos', 'home_team' => 'Bengals'),
			array('week_id' => 3, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-25 13:00','visitor_team' => 'Vikings', 'home_team' => 'Panthers'),
			array('week_id' => 3, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-25 16:05','visitor_team' => 'Rams', 'home_team' => 'Buccaneers'),
			array('week_id' => 3, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-25 16:05','visitor_team' => '49ers', 'home_team' => 'Seahawks'),
			array('week_id' => 3, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-25 16:25','visitor_team' => 'Jets', 'home_team' => 'Chiefs'),
			array('week_id' => 3, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-25 16:25','visitor_team' => 'Chargers', 'home_team' => 'Colts'),
			array('week_id' => 3, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-25 16:25','visitor_team' => 'Steelers', 'home_team' => 'Eagles'),
			array('week_id' => 3, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-09-25 20:30','visitor_team' => 'Bears', 'home_team' => 'Cowboys'),
			array('week_id' => 3, 'day_of_week' => 'Monday', 'game_datetime' => '2016-09-26 20:30','visitor_team' => 'Falcons', 'home_team' => 'Saints'),
			array('week_id' => 4, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-09-29 20:25','visitor_team' => 'Dolphins', 'home_team' => 'Bengals'),
			array('week_id' => 4, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-02 09:30','visitor_team' => 'Colts', 'home_team' => 'Jaguars'),
			array('week_id' => 4, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-02 13:00','visitor_team' => 'Titans', 'home_team' => 'Texans'),
			array('week_id' => 4, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-02 13:00','visitor_team' => 'Browns', 'home_team' => 'Redskins'),
			array('week_id' => 4, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-02 13:00','visitor_team' => 'Seahawks', 'home_team' => 'Jets'),
			array('week_id' => 4, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-02 13:00','visitor_team' => 'Bills', 'home_team' => 'Patriots'),
			array('week_id' => 4, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-02 13:00','visitor_team' => 'Panthers', 'home_team' => 'Falcons'),
			array('week_id' => 4, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-02 13:00','visitor_team' => 'Raiders', 'home_team' => 'Ravens'),
			array('week_id' => 4, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-02 13:00','visitor_team' => 'Lions', 'home_team' => 'Bears'),
			array('week_id' => 4, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-02 16:05','visitor_team' => 'Broncos', 'home_team' => 'Buccaneers'),
			array('week_id' => 4, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-02 16:25','visitor_team' => 'Rams', 'home_team' => 'Cardinals'),
			array('week_id' => 4, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-02 16:25','visitor_team' => 'Saints', 'home_team' => 'Chargers'),
			array('week_id' => 4, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-02 16:25','visitor_team' => 'Cowboys', 'home_team' => '49ers'),
			array('week_id' => 4, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-02 20:30','visitor_team' => 'Chiefs', 'home_team' => 'Steelers'),
			array('week_id' => 4, 'day_of_week' => 'Monday', 'game_datetime' => '2016-10-03 20:30','visitor_team' => 'Giants', 'home_team' => 'Vikings'),
			array('week_id' => 5, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-10-06 20:25','visitor_team' => 'Cardinals', 'home_team' => '49ers'),
			array('week_id' => 5, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-09 13:00','visitor_team' => 'Patriots', 'home_team' => 'Browns'),
			array('week_id' => 5, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-09 13:00','visitor_team' => 'Eagles', 'home_team' => 'Lions'),
			array('week_id' => 5, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-09 13:00','visitor_team' => 'Bears', 'home_team' => 'Colts'),
			array('week_id' => 5, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-09 13:00','visitor_team' => 'Titans', 'home_team' => 'Dolphins'),
			array('week_id' => 5, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-09 13:00','visitor_team' => 'Redskins', 'home_team' => 'Ravens'),
			array('week_id' => 5, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-09 13:00','visitor_team' => 'Texans', 'home_team' => 'Vikings'),
			array('week_id' => 5, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-09 13:00','visitor_team' => 'Jets', 'home_team' => 'Steelers'),
			array('week_id' => 5, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-09 16:05','visitor_team' => 'Falcons', 'home_team' => 'Broncos'),
			array('week_id' => 5, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-09 16:25','visitor_team' => 'Bengals', 'home_team' => 'Cowboys'),
			array('week_id' => 5, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-09 16:25','visitor_team' => 'Bills', 'home_team' => 'Rams'),
			array('week_id' => 5, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-09 16:25','visitor_team' => 'Chargers', 'home_team' => 'Raiders'),
			array('week_id' => 5, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-09 20:30','visitor_team' => 'Giants', 'home_team' => 'Packers'),
			array('week_id' => 5, 'day_of_week' => 'Monday', 'game_datetime' => '2016-10-10 20:30','visitor_team' => 'Buccaneers', 'home_team' => 'Panthers '),
			array('week_id' => 6, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-10-13 20:25','visitor_team' => 'Broncos', 'home_team' => 'Chargers'),
			array('week_id' => 6, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-16 13:00','visitor_team' => '49ers', 'home_team' => 'Bills'),
			array('week_id' => 6, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-16 13:00','visitor_team' => 'Eagles', 'home_team' => 'Redskins'),
			array('week_id' => 6, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-16 13:00','visitor_team' => 'Browns', 'home_team' => 'Titans'),
			array('week_id' => 6, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-16 13:00','visitor_team' => 'Ravens', 'home_team' => 'Giants'),
			array('week_id' => 6, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-16 13:00','visitor_team' => 'Panthers', 'home_team' => 'Saints'),
			array('week_id' => 6, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-16 13:00','visitor_team' => 'Jaguars', 'home_team' => 'Bears'),
			array('week_id' => 6, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-16 13:00','visitor_team' => 'Rams', 'home_team' => 'Lions'),
			array('week_id' => 6, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-16 13:00','visitor_team' => 'Steelers', 'home_team' => 'Dolphins'),
			array('week_id' => 6, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-16 13:00','visitor_team' => 'Bengals', 'home_team' => 'Patriots'),
			array('week_id' => 6, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-16 16:05','visitor_team' => 'Chiefs', 'home_team' => 'Raiders'),
			array('week_id' => 6, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-16 16:25','visitor_team' => 'Falcons', 'home_team' => 'Seahawks'),
			array('week_id' => 6, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-16 16:25','visitor_team' => 'Cowboys', 'home_team' => 'Packers'),
			array('week_id' => 6, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-16 20:30','visitor_team' => 'Jets', 'home_team' => 'Cardinals'),
			array('week_id' => 7, 'day_of_week' => 'Monday', 'game_datetime' => '2016-10-17 20:30','visitor_team' => 'Colts', 'home_team' => 'Texans'),
			array('week_id' => 7, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-10-20 20:25','visitor_team' => 'Bears', 'home_team' => 'Packers'),
			array('week_id' => 7, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-23 09:30','visitor_team' => 'Giants', 'home_team' => 'Rams'),
			array('week_id' => 7, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-23 13:00','visitor_team' => 'Saints', 'home_team' => 'Chiefs'),
			array('week_id' => 7, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-23 13:00','visitor_team' => 'Colts', 'home_team' => 'Titans'),
			array('week_id' => 7, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-23 13:00','visitor_team' => 'Vikings', 'home_team' => 'Eagles'),
			array('week_id' => 7, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-23 13:00','visitor_team' => 'Browns', 'home_team' => 'Bengals'),
			array('week_id' => 7, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-23 13:00','visitor_team' => 'Redskins', 'home_team' => 'Lions'),
			array('week_id' => 7, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-23 13:00','visitor_team' => 'Raiders', 'home_team' => 'Jaguars'),
			array('week_id' => 7, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-23 13:00','visitor_team' => 'Bills', 'home_team' => 'Dolphins'),
			array('week_id' => 7, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-23 13:00','visitor_team' => 'Ravens', 'home_team' => 'Jets'),
			array('week_id' => 7, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-23 16:05','visitor_team' => 'Buccaneers', 'home_team' => '49ers'),
			array('week_id' => 7, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-23 16:05','visitor_team' => 'Chargers', 'home_team' => 'Falcons'),
			array('week_id' => 7, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-23 16:25','visitor_team' => 'Patriots', 'home_team' => 'Steelers'),
			array('week_id' => 7, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-23 20:30','visitor_team' => 'Seahawks', 'home_team' => 'Cardinals'),
			array('week_id' => 7, 'day_of_week' => 'Monday', 'game_datetime' => '2016-10-24 20:30','visitor_team' => 'Texans', 'home_team' => 'Broncos '),
			array('week_id' => 8, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-10-27 20:25','visitor_team' => 'Jaguars', 'home_team' => 'Titans'),
			array('week_id' => 8, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-30 09:30','visitor_team' => 'Redskins', 'home_team' => 'Bengals'),
			array('week_id' => 8, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-30 13:00','visitor_team' => 'Chiefs', 'home_team' => 'Colts'),
			array('week_id' => 8, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-30 13:00','visitor_team' => 'Raiders', 'home_team' => 'Buccaneers'),
			array('week_id' => 8, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-30 13:00','visitor_team' => 'Seahawks', 'home_team' => 'Saints'),
			array('week_id' => 8, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-30 13:00','visitor_team' => 'Lions', 'home_team' => 'Texans'),
			array('week_id' => 8, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-30 13:00','visitor_team' => 'Jets', 'home_team' => 'Browns'),
			array('week_id' => 8, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-30 13:00','visitor_team' => 'Packers', 'home_team' => 'Falcons'),
			array('week_id' => 8, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-30 13:00','visitor_team' => 'Patriots', 'home_team' => 'Bills'),
			array('week_id' => 8, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-30 16:05','visitor_team' => 'Chargers', 'home_team' => 'Broncos'),
			array('week_id' => 8, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-30 16:25','visitor_team' => 'Cardinals', 'home_team' => 'Panthers'),
			array('week_id' => 8, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-10-30 20:30','visitor_team' => 'Eagles', 'home_team' => 'Cowboys'),
			array('week_id' => 8, 'day_of_week' => 'Monday', 'game_datetime' => '2016-10-31 20:30','visitor_team' => 'Vikings', 'home_team' => 'Bears '),
			array('week_id' => 9, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-11-03 20:25','visitor_team' => 'Falcons', 'home_team' => 'Buccaneers'),
			array('week_id' => 9, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-06 13:00','visitor_team' => 'Lions', 'home_team' => 'Vikings'),
			array('week_id' => 9, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-06 13:00','visitor_team' => 'Eagles', 'home_team' => 'Giants'),
			array('week_id' => 9, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-06 13:00','visitor_team' => 'Jets', 'home_team' => 'Dolphins'),
			array('week_id' => 9, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-06 13:00','visitor_team' => 'Jaguars', 'home_team' => 'Chiefs'),
			array('week_id' => 9, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-06 13:00','visitor_team' => 'Cowboys', 'home_team' => 'Browns'),
			array('week_id' => 9, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-06 13:00','visitor_team' => 'Steelers', 'home_team' => 'Ravens'),
			array('week_id' => 9, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-06 16:05','visitor_team' => 'Saints', 'home_team' => '49ers'),
			array('week_id' => 9, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-06 16:05','visitor_team' => 'Panthers', 'home_team' => 'Rams'),
			array('week_id' => 9, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-06 16:25','visitor_team' => 'Colts', 'home_team' => 'Packers'),
			array('week_id' => 9, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-06 16:25','visitor_team' => 'Titans', 'home_team' => 'Chargers'),
			array('week_id' => 9, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-06 20:30','visitor_team' => 'Broncos', 'home_team' => 'Raiders'),
			array('week_id' => 9, 'day_of_week' => 'Monday', 'game_datetime' => '2016-11-07 20:30','visitor_team' => 'Bills', 'home_team' => 'Seahawks '),
			array('week_id' => 10, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-11-10 20:25','visitor_team' => 'Browns', 'home_team' => 'Ravens'),
			array('week_id' => 10, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-13 13:00','visitor_team' => 'Texans', 'home_team' => 'Jaguars'),
			array('week_id' => 10, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-13 13:00','visitor_team' => 'Broncos', 'home_team' => 'Saints'),
			array('week_id' => 10, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-13 13:00','visitor_team' => 'Rams', 'home_team' => 'Jets'),
			array('week_id' => 10, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-13 13:00','visitor_team' => 'Falcons', 'home_team' => 'Eagles'),
			array('week_id' => 10, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-13 13:00','visitor_team' => 'Chiefs', 'home_team' => 'Panthers'),
			array('week_id' => 10, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-13 13:00','visitor_team' => 'Bears', 'home_team' => 'Buccaneers'),
			array('week_id' => 10, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-13 13:00','visitor_team' => 'Vikings', 'home_team' => 'Redskins'),
			array('week_id' => 10, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-13 13:00','visitor_team' => 'Packers', 'home_team' => 'Titans'),
			array('week_id' => 10, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-13 16:05','visitor_team' => 'Dolphins', 'home_team' => 'Chargers'),
			array('week_id' => 10, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-13 16:25','visitor_team' => '49ers', 'home_team' => 'Cardinals'),
			array('week_id' => 10, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-13 16:25','visitor_team' => 'Cowboys', 'home_team' => 'Steelers'),
			array('week_id' => 10, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-13 20:30','visitor_team' => 'Seahawks', 'home_team' => 'Patriots'),
			array('week_id' => 10, 'day_of_week' => 'Monday', 'game_datetime' => '2016-11-14 20:30','visitor_team' => 'Bengals', 'home_team' => 'Giants '),
			array('week_id' => 11, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-11-17 20:25','visitor_team' => 'Saints', 'home_team' => 'Panthers'),
			array('week_id' => 11, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-20 13:00','visitor_team' => 'Steelers', 'home_team' => 'Browns'),
			array('week_id' => 11, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-20 13:00','visitor_team' => 'Ravens', 'home_team' => 'Cowboys'),
			array('week_id' => 11, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-20 13:00','visitor_team' => 'Jaguars', 'home_team' => 'Lions'),
			array('week_id' => 11, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-20 13:00','visitor_team' => 'Titans', 'home_team' => 'Colts'),
			array('week_id' => 11, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-20 13:00','visitor_team' => 'Bills', 'home_team' => 'Bengals'),
			array('week_id' => 11, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-20 13:00','visitor_team' => 'Buccaneers', 'home_team' => 'Chiefs'),
			array('week_id' => 11, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-20 13:00','visitor_team' => 'Bears', 'home_team' => 'Giants'),
			array('week_id' => 11, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-20 13:00','visitor_team' => 'Cardinals', 'home_team' => 'Vikings'),
			array('week_id' => 11, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-20 16:05','visitor_team' => 'Dolphins', 'home_team' => 'Rams'),
			array('week_id' => 11, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-20 16:25','visitor_team' => 'Patriots', 'home_team' => '49ers'),
			array('week_id' => 11, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-20 16:25','visitor_team' => 'Eagles', 'home_team' => 'Seahawks'),
			array('week_id' => 11, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-20 20:30','visitor_team' => 'Packers', 'home_team' => 'Redskins'),
			array('week_id' => 11, 'day_of_week' => 'Monday', 'game_datetime' => '2016-11-21 20:30','visitor_team' => 'Texans', 'home_team' => 'Raiders '),
			array('week_id' => 12, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-11-24 12:30','visitor_team' => 'Vikings', 'home_team' => 'Lions'),
			array('week_id' => 12, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-11-24 16:30','visitor_team' => 'Redskins', 'home_team' => 'Cowboys'),
			array('week_id' => 12, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-11-24 20:30','visitor_team' => 'Steelers', 'home_team' => 'Colts'),
			array('week_id' => 12, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-27 13:00','visitor_team' => 'Titans', 'home_team' => 'Bears'),
			array('week_id' => 12, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-27 13:00','visitor_team' => 'Jaguars', 'home_team' => 'Bills'),
			array('week_id' => 12, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-27 13:00','visitor_team' => 'Bengals', 'home_team' => 'Ravens'),
			array('week_id' => 12, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-27 13:00','visitor_team' => 'Cardinals', 'home_team' => 'Falcons'),
			array('week_id' => 12, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-27 13:00','visitor_team' => 'Giants', 'home_team' => 'Browns'),
			array('week_id' => 12, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-27 13:00','visitor_team' => 'Rams', 'home_team' => 'Saints'),
			array('week_id' => 12, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-27 13:00','visitor_team' => '49ers', 'home_team' => 'Dolphins'),
			array('week_id' => 12, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-27 13:00','visitor_team' => 'Chargers', 'home_team' => 'Texans'),
			array('week_id' => 12, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-27 16:05','visitor_team' => 'Seahawks', 'home_team' => 'Buccaneers'),
			array('week_id' => 12, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-27 16:25','visitor_team' => 'Panthers', 'home_team' => 'Raiders'),
			array('week_id' => 12, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-27 16:25','visitor_team' => 'Chiefs', 'home_team' => 'Broncos'),
			array('week_id' => 12, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-11-27 20:30','visitor_team' => 'Patriots', 'home_team' => 'Jets'),
			array('week_id' => 12, 'day_of_week' => 'Monday', 'game_datetime' => '2016-11-28 20:30','visitor_team' => 'Packers', 'home_team' => 'Eagles'),
			array('week_id' => 13, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-12-01 20:25','visitor_team' => 'Cowboys', 'home_team' => 'Vikings'),
			array('week_id' => 13, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-04 13:00','visitor_team' => 'Chiefs', 'home_team' => 'Falcons'),
			array('week_id' => 13, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-04 13:00','visitor_team' => 'Lions', 'home_team' => 'Saints'),
			array('week_id' => 13, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-04 13:00','visitor_team' => 'Rams', 'home_team' => 'Patriots'),
			array('week_id' => 13, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-04 13:00','visitor_team' => 'Broncos', 'home_team' => 'Jaguars'),
			array('week_id' => 13, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-04 13:00','visitor_team' => 'Texans', 'home_team' => 'Packers'),
			array('week_id' => 13, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-04 13:00','visitor_team' => 'Eagles', 'home_team' => 'Bengals'),
			array('week_id' => 13, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-04 13:00','visitor_team' => 'Dolphins', 'home_team' => 'Ravens'),
			array('week_id' => 13, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-04 13:00','visitor_team' => '49ers', 'home_team' => 'Bears'),
			array('week_id' => 13, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-04 16:05','visitor_team' => 'Bills', 'home_team' => 'Raiders'),
			array('week_id' => 13, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-04 16:25','visitor_team' => 'Giants', 'home_team' => 'Steelers'),
			array('week_id' => 13, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-04 16:25','visitor_team' => 'Redskins', 'home_team' => 'Cardinals'),
			array('week_id' => 13, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-04 16:25','visitor_team' => 'Buccaneers', 'home_team' => 'Chargers'),
			array('week_id' => 13, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-04 20:30','visitor_team' => 'Panthers', 'home_team' => 'Seahawks'),
			array('week_id' => 13, 'day_of_week' => 'Monday', 'game_datetime' => '2016-12-05 20:30','visitor_team' => 'Colts', 'home_team' => 'Jets '),
			array('week_id' => 14, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-12-08 20:25','visitor_team' => 'Raiders', 'home_team' => 'Chiefs'),
			array('week_id' => 14, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-11 13:00','visitor_team' => 'Steelers', 'home_team' => 'Bills'),
			array('week_id' => 14, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-11 13:00','visitor_team' => 'Broncos', 'home_team' => 'Titans'),
			array('week_id' => 14, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-11 13:00','visitor_team' => 'Saints', 'home_team' => 'Buccaneers'),
			array('week_id' => 14, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-11 13:00','visitor_team' => 'Redskins', 'home_team' => 'Eagles'),
			array('week_id' => 14, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-11 13:00','visitor_team' => 'Cardinals', 'home_team' => 'Dolphins'),
			array('week_id' => 14, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-11 13:00','visitor_team' => 'Chargers', 'home_team' => 'Panthers'),
			array('week_id' => 14, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-11 13:00','visitor_team' => 'Bengals', 'home_team' => 'Browns'),
			array('week_id' => 14, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-11 13:00','visitor_team' => 'Bears', 'home_team' => 'Lions'),
			array('week_id' => 14, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-11 13:00','visitor_team' => 'Texans', 'home_team' => 'Colts'),
			array('week_id' => 14, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-11 13:00','visitor_team' => 'Vikings', 'home_team' => 'Jaguars'),
			array('week_id' => 14, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-11 16:05','visitor_team' => 'Jets', 'home_team' => '49ers'),
			array('week_id' => 14, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-11 16:25','visitor_team' => 'Falcons', 'home_team' => 'Rams'),
			array('week_id' => 14, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-11 16:25','visitor_team' => 'Seahawks', 'home_team' => 'Packers'),
			array('week_id' => 14, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-11 20:30','visitor_team' => 'Cowboys', 'home_team' => 'Giants'),
			array('week_id' => 14, 'day_of_week' => 'Monday', 'game_datetime' => '2016-12-12 20:30','visitor_team' => 'Ravens', 'home_team' => 'Patriots'),
			array('week_id' => 15, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-12-15 20:25','visitor_team' => 'Rams', 'home_team' => 'Seahawks'),
			array('week_id' => 15, 'day_of_week' => 'Saturday', 'game_datetime' => '2016-12-17 20:25','visitor_team' => 'Dolphins', 'home_team' => 'Jets'),
			array('week_id' => 15, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-18 13:00','visitor_team' => 'Packers', 'home_team' => 'Bears'),
			array('week_id' => 15, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-18 13:00','visitor_team' => 'Buccaneers', 'home_team' => 'Cowboys'),
			array('week_id' => 15, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-18 13:00','visitor_team' => 'Jaguars', 'home_team' => 'Texans'),
			array('week_id' => 15, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-18 13:00','visitor_team' => 'Browns', 'home_team' => 'Bills'),
			array('week_id' => 15, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-18 13:00','visitor_team' => 'Eagles', 'home_team' => 'Ravens'),
			array('week_id' => 15, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-18 13:00','visitor_team' => 'Titans', 'home_team' => 'Chiefs'),
			array('week_id' => 15, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-18 13:00','visitor_team' => 'Lions', 'home_team' => 'Giants'),
			array('week_id' => 15, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-18 13:00','visitor_team' => 'Colts', 'home_team' => 'Vikings'),
			array('week_id' => 15, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-18 16:05','visitor_team' => 'Saints', 'home_team' => 'Cardinals'),
			array('week_id' => 15, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-18 16:05','visitor_team' => '49ers', 'home_team' => 'Falcons'),
			array('week_id' => 15, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-18 16:25','visitor_team' => 'Patriots', 'home_team' => 'Broncos'),
			array('week_id' => 15, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-18 16:25','visitor_team' => 'Raiders', 'home_team' => 'Chargers'),
			array('week_id' => 15, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-18 20:30','visitor_team' => 'Steelers', 'home_team' => 'Bengals'),
			array('week_id' => 15, 'day_of_week' => 'Monday', 'game_datetime' => '2016-12-19 20:30','visitor_team' => 'Panthers', 'home_team' => 'Redskins'),
			array('week_id' => 16, 'day_of_week' => 'Thursday', 'game_datetime' => '2016-12-22 20:25','visitor_team' => 'Giants', 'home_team' => 'Eagles'),
			array('week_id' => 16, 'day_of_week' => 'Saturday', 'game_datetime' => '2016-12-24 13:00','visitor_team' => 'Dolphins', 'home_team' => 'Bills'),
			array('week_id' => 16, 'day_of_week' => 'Saturday', 'game_datetime' => '2016-12-24 13:00','visitor_team' => 'Buccaneers', 'home_team' => 'Saints'),
			array('week_id' => 16, 'day_of_week' => 'Saturday', 'game_datetime' => '2016-12-24 13:00','visitor_team' => 'Jets', 'home_team' => 'Patriots'),
			array('week_id' => 16, 'day_of_week' => 'Saturday', 'game_datetime' => '2016-12-24 13:00','visitor_team' => 'Titans', 'home_team' => 'Jaguars'),
			array('week_id' => 16, 'day_of_week' => 'Saturday', 'game_datetime' => '2016-12-24 13:00','visitor_team' => 'Vikings', 'home_team' => 'Packers'),
			array('week_id' => 16, 'day_of_week' => 'Saturday', 'game_datetime' => '2016-12-24 13:00','visitor_team' => 'Chargers', 'home_team' => 'Browns'),
			array('week_id' => 16, 'day_of_week' => 'Saturday', 'game_datetime' => '2016-12-24 13:00','visitor_team' => 'Redskins', 'home_team' => 'Bears'),
			array('week_id' => 16, 'day_of_week' => 'Saturday', 'game_datetime' => '2016-12-24 13:00','visitor_team' => 'Falcons', 'home_team' => 'Panthers'),
			array('week_id' => 16, 'day_of_week' => 'Saturday', 'game_datetime' => '2016-12-24 16:05','visitor_team' => 'Colts', 'home_team' => 'Raiders'),
			array('week_id' => 16, 'day_of_week' => 'Saturday', 'game_datetime' => '2016-12-24 16:25','visitor_team' => 'Cardinals', 'home_team' => 'Seahawks'),
			array('week_id' => 16, 'day_of_week' => 'Saturday', 'game_datetime' => '2016-12-24 16:25','visitor_team' => '49ers', 'home_team' => 'Rams'),
			array('week_id' => 16, 'day_of_week' => 'Saturday', 'game_datetime' => '2016-12-24 20:25','visitor_team' => 'Bengals', 'home_team' => 'Texans'),
			array('week_id' => 16, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-25 16:30','visitor_team' => 'Ravens', 'home_team' => 'Steelers'),
			array('week_id' => 16, 'day_of_week' => 'Sunday', 'game_datetime' => '2016-12-25 20:30','visitor_team' => 'Broncos', 'home_team' => 'Chiefs'),
			array('week_id' => 16, 'day_of_week' => 'Monday', 'game_datetime' => '2016-12-26 20:30','visitor_team' => 'Lions', 'home_team' => 'Cowboys'),
			array('week_id' => 17, 'day_of_week' => 'Sunday', 'game_datetime' => '2017-01-01 13:00','visitor_team' => 'Saints', 'home_team' => 'Falcons'),
			array('week_id' => 17, 'day_of_week' => 'Sunday', 'game_datetime' => '2017-01-01 13:00','visitor_team' => 'Ravens', 'home_team' => 'Bengals'),
			array('week_id' => 17, 'day_of_week' => 'Sunday', 'game_datetime' => '2017-01-01 13:00','visitor_team' => 'Giants', 'home_team' => 'Redskins'),
			array('week_id' => 17, 'day_of_week' => 'Sunday', 'game_datetime' => '2017-01-01 13:00','visitor_team' => 'Texans', 'home_team' => 'Titans'),
			array('week_id' => 17, 'day_of_week' => 'Sunday', 'game_datetime' => '2017-01-01 13:00','visitor_team' => 'Panthers', 'home_team' => 'Buccaneers'),
			array('week_id' => 17, 'day_of_week' => 'Sunday', 'game_datetime' => '2017-01-01 13:00','visitor_team' => 'Packers', 'home_team' => 'Lions'),
			array('week_id' => 17, 'day_of_week' => 'Sunday', 'game_datetime' => '2017-01-01 13:00','visitor_team' => 'Jaguars', 'home_team' => 'Colts'),
			array('week_id' => 17, 'day_of_week' => 'Sunday', 'game_datetime' => '2017-01-01 13:00','visitor_team' => 'Patriots', 'home_team' => 'Dolphins'),
			array('week_id' => 17, 'day_of_week' => 'Sunday', 'game_datetime' => '2017-01-01 13:00','visitor_team' => 'Bears', 'home_team' => 'Vikings'),
			array('week_id' => 17, 'day_of_week' => 'Sunday', 'game_datetime' => '2017-01-01 13:00','visitor_team' => 'Bills', 'home_team' => 'Jets'),
			array('week_id' => 17, 'day_of_week' => 'Sunday', 'game_datetime' => '2017-01-01 13:00','visitor_team' => 'Cowboys', 'home_team' => 'Eagles'),
			array('week_id' => 17, 'day_of_week' => 'Sunday', 'game_datetime' => '2017-01-01 13:00','visitor_team' => 'Browns', 'home_team' => 'Steelers'),
			array('week_id' => 17, 'day_of_week' => 'Sunday', 'game_datetime' => '2017-01-01 16:25','visitor_team' => 'Cardinals', 'home_team' => 'Rams'),
			array('week_id' => 17, 'day_of_week' => 'Sunday', 'game_datetime' => '2017-01-01 16:25','visitor_team' => 'Raiders', 'home_team' => 'Broncos'),
			array('week_id' => 17, 'day_of_week' => 'Sunday', 'game_datetime' => '2017-01-01 16:25','visitor_team' => 'Chiefs', 'home_team' => 'Chargers'),
			array('week_id' => 17, 'day_of_week' => 'Sunday', 'game_datetime' => '2017-01-01 16:25','visitor_team' => 'Seahawks', 'home_team' => '49ers')
		));



    }
}
