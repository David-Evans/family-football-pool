<?php
namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;

use App\Http\Requests;

use Auth;

use DB;

use App\Game;

use App\Pick;

use \Validator;

class PicksController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the picks for a given week.
     *
     * @return \Illuminate\Http\Response
     */
    public function makePicks() {
        $user = Auth::user();
        $game = new Game();
        $currDate = FALSE;
        $week = $game->getCurrentWeek();
        $picks = $game->showPicks($week);

        $myPicks = Pick::where([
            'user_id' => $user->id
            ])
            ->join('games','game_id', '=', 'games.id')
            ->select('picks.id','game_id','user_id','pick')
            ->get();

        $issues = $game->getMyPickIssues($week, $user);
        
/**
    Options for passing variables to a view:
        One big array:
            $data[];
            $data['first'] => 'Jalapeno';
            $data['last'] => 'Dave';

            return view('pages.make-picks', $data);

        Compact:
            $first = 'Jalapeno';
            $last = 'Dave';

            return view('pages.make-picks', compact('first','last'));

**/

        return view('pages.make-picks')->with([
            'user' => $user,
            'picks'=> $picks,
            'currDate' => $currDate,
            'week' => $week,
            'mypicks' => $myPicks,
            'issues' => $issues
        ]);
    }

    public function viewPicks() {
        $user = Auth::user();
        $users = DB::table('users')->get();
        $game = new Game();
        $currDate = FALSE;
        $week = $game->getCurrentWeek();
        $picks = $game->showAllPicks($week);
        $games = $game->getGames($week);
        $gameCount = count($games);
        $leaders = $game->getLeaders($week);
        $gamesInProgress = $game->getGamesInProgress($week);

        $result = array();
        foreach ($leaders as $leader) {
            array_push($result, $leader->wins);
        }
        $winCounts = array_unique($result);

//dd($users);
        return view('pages.view-picks')->with([
            'user' => $user,
            'users' => $users,
            'week'=> $week,
            'picks' => $picks,
            'games' => $games,
            'gameCount' => $gameCount,
            'winCounts' => $winCounts,
            'leaders' => $leaders,
            'gamesInProgress' => $gamesInProgress
        ]);
    }

    public function viewMyPicks() {
        $user = Auth::user();        
        $game = new Game();
        $currDate = FALSE;
        $week = $game->getCurrentWeek();
        $picks = $game->getMyPicks($week, $user);
        $gameCount = count($picks);

        return view('pages.view-my-picks')->with([
            'user' => $user,
            'week'=> $week,
            'picks' => $picks,
            'gameCount' =>$gameCount
        ]);
    }    

    public function viewMySummary() {
        $user = Auth::user();        
        $game = new Game();
        $currDate = FALSE;
        $week = $game->getCurrentWeek();
        $picks = $game->getMySummary($user);

        return view('pages.view-my-season-summary')->with([
            'user' => $user,
            'week'=> $week,
            'picks' => $picks
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $input = Request::all();
        $userId = $input['user_id'];

        try {
            foreach ($input as $name=>$value) {
                if (substr($name,0,4) == "pick" && $value != "") {
                    $gameId = str_replace("pick-","",$name);
                    // Check if a pick already exists
                    $existingPick = Pick::where([
                        'game_id' => $gameId,
                        'user_id' => $userId
                        ])
                        ->select('id','game_id','user_id','pick')
                        ->get();
                    if ($existingPick->count()) {
                        echo '<p>Update Pick: '.$existingPick[0]->pick.'</p>';
                        // Update existing pick
                        $id = $existingPick[0]->id;
                        $result = Pick::where ('id', $id)->update([
                            'pick' => $value
                            ]);
                    } else {
                        echo '<p>New Pick: '.$value.'</p>';
                        // Insert new pick
                        $result = Pick::insert([
                            'game_id' => $gameId,
                            'user_id' => $userId,
                            'pick' => $value,
                            'created_at' => date('Y-m-d h:i:s'),
                            'updated_at' => date('Y-m-d h:i:s')
                            ]);
                    }
                }
            }
            return redirect('picks')->with('status', 'Great! Your picks are now updated');
        } catch (Exception $e) {
            return redirect('picks')->withInput('status', 'Oops: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
