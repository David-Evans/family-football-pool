<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;

use App\Http\Requests;

use App\Chat;

use Auth;

use \Validator;

class ChatsController extends Controller
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
        $user = Auth::user();
        $chats = Chat::latest('chats.created_at')
                ->join('users', 'user_id', '=', 'users.id')
                ->select('users.name', 'users.avatar', 'chats.message', 'chats.created_at')
                ->get();

        return view('chat.index')->with([
            'chats' => $chats,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('chat.create')->with([
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(Request $request)
    public function store()
    {

        // validate that the post data is correct
        //$validator = Validator::getData(Request::all(), array('message' => 'required|min:2'));
        // $request = Request::all();
        $validator = Validator::make(Request::all(), [
            'message' => 'required|min:2',
        ]);

        // $this->validate(Request::all(), [
        //     'message' => 'required|min:2',
        // ]);

        if ($validator->passes()) {
            try {
                $input = Request::all();

                //Chat::create($input);
                $chat = new Chat();
                $chat->user_id = $input['user_id'];
                $chat->message = $input['message'];
                $chat->save();

                //return redirect('chat');
                return redirect('chat')->with('status', 'Thanks!');
            } catch (Exception $e) {
                // return Redirect::back()->withInput('inform', 'Oops: '.$e->getMessage());
                return redirect('chat')->withInput('status', 'Oops: '.$e->getMessage());
            }

        } else {
            // return Redirect::back()->withInput()->withErrors($validator);
            return redirect('chat')->withInput()->withErrors($validator);
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
