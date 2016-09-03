<?php

use Illuminate\Database\Seeder;
use App\Team;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Empty the table (start fresh)
        Team::truncate();

        // Load with NFL season schedule
		DB::table('teams')->insert(array(
			array('team_name' => '49ers','team_city' => 'San Francisco', 'team_city_short' => 'SF', 'nfl_conference' => 'NFC', 'nfl_division' => 'West'),
			array('team_name' => 'Bears','team_city' => 'Chicago', 'team_city_short' => 'NULL', 'nfl_conference' => 'NFC', 'nfl_division' => 'North'),
			array('team_name' => 'Bengals','team_city' => 'Cincinnati', 'team_city_short' => 'NULL', 'nfl_conference' => 'AFC', 'nfl_division' => 'North'),
			array('team_name' => 'Bills','team_city' => 'Buffalo', 'team_city_short' => 'NULL', 'nfl_conference' => 'AFC', 'nfl_division' => 'East'),
			array('team_name' => 'Broncos','team_city' => 'Denver', 'team_city_short' => 'NULL', 'nfl_conference' => 'AFC', 'nfl_division' => 'West'),
			array('team_name' => 'Browns','team_city' => 'Cleveland', 'team_city_short' => 'NULL', 'nfl_conference' => 'AFC', 'nfl_division' => 'North'),
			array('team_name' => 'Buccaneers','team_city' => 'Tampa Bay', 'team_city_short' => 'TB', 'nfl_conference' => 'NFC', 'nfl_division' => 'South'),
			array('team_name' => 'Cardinals','team_city' => 'Arizona', 'team_city_short' => 'NULL', 'nfl_conference' => 'NFC', 'nfl_division' => 'West'),
			array('team_name' => 'Chargers','team_city' => 'San Diego', 'team_city_short' => 'NULL', 'nfl_conference' => 'AFC', 'nfl_division' => 'West'),
			array('team_name' => 'Chiefs','team_city' => 'Kansas City', 'team_city_short' => 'KC', 'nfl_conference' => 'AFC', 'nfl_division' => 'West'),
			array('team_name' => 'Colts','team_city' => 'Indianapolis', 'team_city_short' => 'NULL', 'nfl_conference' => 'AFC', 'nfl_division' => 'South'),
			array('team_name' => 'Cowboys','team_city' => 'Dallas', 'team_city_short' => 'NULL', 'nfl_conference' => 'NFC', 'nfl_division' => 'East'),
			array('team_name' => 'Dolphins','team_city' => 'Miami', 'team_city_short' => 'NULL', 'nfl_conference' => 'AFC', 'nfl_division' => 'East'),
			array('team_name' => 'Eagles','team_city' => 'Philadelphia', 'team_city_short' => 'NULL', 'nfl_conference' => 'NFC', 'nfl_division' => 'East'),
			array('team_name' => 'Falcons','team_city' => 'Atlanta', 'team_city_short' => 'NULL', 'nfl_conference' => 'NFC', 'nfl_division' => 'South'),
			array('team_name' => 'Giants','team_city' => 'New York', 'team_city_short' => 'NY', 'nfl_conference' => 'NFC', 'nfl_division' => 'East'),
			array('team_name' => 'Jaguars','team_city' => 'Jacksonville', 'team_city_short' => 'NULL', 'nfl_conference' => 'AFC', 'nfl_division' => 'South'),
			array('team_name' => 'Jets','team_city' => 'New York', 'team_city_short' => 'NY', 'nfl_conference' => 'AFC', 'nfl_division' => 'East'),
			array('team_name' => 'Lions','team_city' => 'Detroit', 'team_city_short' => 'NULL', 'nfl_conference' => 'NFC', 'nfl_division' => 'North'),
			array('team_name' => 'Packers','team_city' => 'Green Bay', 'team_city_short' => 'GB', 'nfl_conference' => 'NFC', 'nfl_division' => 'North'),
			array('team_name' => 'Panthers','team_city' => 'Carolina', 'team_city_short' => 'NULL', 'nfl_conference' => 'NFC', 'nfl_division' => 'South'),
			array('team_name' => 'Patriots','team_city' => 'New England', 'team_city_short' => 'NE', 'nfl_conference' => 'AFC', 'nfl_division' => 'East'),
			array('team_name' => 'Raiders','team_city' => 'Oakland', 'team_city_short' => 'NULL', 'nfl_conference' => 'AFC', 'nfl_division' => 'West'),
			array('team_name' => 'Rams','team_city' => 'Los Angeles', 'team_city_short' => 'LA', 'nfl_conference' => 'NFC', 'nfl_division' => 'West'),
			array('team_name' => 'Ravens','team_city' => 'Baltimore', 'team_city_short' => 'NULL', 'nfl_conference' => 'AFC', 'nfl_division' => 'North'),
			array('team_name' => 'Redskins','team_city' => 'Washington', 'team_city_short' => 'NULL', 'nfl_conference' => 'NFC', 'nfl_division' => 'East'),
			array('team_name' => 'Saints','team_city' => 'New Orleans', 'team_city_short' => 'NO', 'nfl_conference' => 'NFC', 'nfl_division' => 'South'),
			array('team_name' => 'Seahawks','team_city' => 'Seattle', 'team_city_short' => 'NULL', 'nfl_conference' => 'NFC', 'nfl_division' => 'West'),
			array('team_name' => 'Steelers','team_city' => 'Pittsburgh', 'team_city_short' => 'NULL', 'nfl_conference' => 'AFC', 'nfl_division' => 'North'),
			array('team_name' => 'Texans','team_city' => 'Houston', 'team_city_short' => 'NULL', 'nfl_conference' => 'AFC', 'nfl_division' => 'South'),
			array('team_name' => 'Titans','team_city' => 'Tennessee', 'team_city_short' => 'NULL', 'nfl_conference' => 'AFC', 'nfl_division' => 'South'),
			array('team_name' => 'Vikings','team_city' => 'Minnesota', 'team_city_short' => 'NULL', 'nfl_conference' => 'NFC', 'nfl_division' => 'North')
		));
    }
}
