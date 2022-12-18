<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Models\Review;
class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::getAllOrderByUpdated_at();
        return view('review.index',compact('reviews'));
    }

    public function indexScore()
    {
        $reviews = Review::getAllOrderByScore();
        return view('review.index',compact('reviews'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        
        return view('review.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ddd($request->all());
    // バリデーション
    $validator = Validator::make($request->all(), [
        'title' => 'required | max:50',
        'description' => 'required',
        'score' => 'required',
    ]);
    // バリデーション:エラー
    if ($validator->fails()) {
    return redirect()
        ->route('review.create')
        ->withInput()
        ->withErrors($validator);
    }

    
    // //画像の保存
    // $filename = $request->imgpath->getClientOriginalName();
    // //送信したファイル名が存在しないならばTrueを返す、存在するならfalseを返す
    // $doesnt_exists = Review::where('imgpath', $filename)->doesntExist();
    // $counts = Review::where('imgpath', $filename)->count();
    // ddd($counts);
    // // ddd($doesnt_exists);
    // //その名前のファイルがDBになかったら(Trueならば)、storeAs関数でstore/app/publicに画像を保存し、そのパスを$imgに入れる。
    // if($doesnt_exists){
      //   $img = $request->imgpath->storeAs('',$filename,'public');
      // }
      // else {
        
        // }
        
    $img = $request->imgpath->store('public');
    $img = substr($img, 7);
    //imagepathの追加
    $result = Review::create([
      'imgpath' => $img,
      'title' => $request->title,
      'description' => $request->description,
      'score' => $request->score
    ]);

    // Review::insert([
    //   'title' => $request->title,
    //   'description' => $request->description,
    //   'imgpath' => $img
    // ]);

    

    // ルーティング「todo.index」にリクエスト送信（一覧ページに移動）
    return redirect()->route('review.index');
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