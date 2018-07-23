<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Post;
use Illuminate\Http\Request;
use Log;

interface UserType{
    const General_User=1;
    const Admin=2;
}

class PostController extends Controller
{
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
    public function store(Request $request)
    {
        Log::info($request->all());
        $post=Post::create(['created_by'=>Auth::id()]+$request->all());
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::where(['id'=>$id])->with(['createdBy'])->first();
        return response()->json(['data'=>$post]);
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
        Log::info('inside Edit');
        Log::info($request->all());
        $post=Post::find($id);
        if($post->created_by==Auth::id() || Auth::user()->user_type==UserType::Admin){
            $post->fill($request->all());
            $post->save();
        }
        
        return redirect('/home');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::info('inside Delete');
        $post=Post::find($id);
        if($post->created_by==Auth::id() || Auth::user()->user_type==UserType::Admin){
             $post->delete();
        }
        return redirect('/home');   
    }
}
