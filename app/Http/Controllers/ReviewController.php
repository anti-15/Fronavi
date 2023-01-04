<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Models\Review;
use App\Models\Tag;
use Auth;
use \InterventionImage;
class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // ddd($review);
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
        'title' => 'required | max:25',
        'description' => 'required',
        'score' => 'required',
        'tag' => 'nullable'
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

    $file = $request->file('imgpath');
    
    // $height = getimagesize($file);
    // ddd($height);
    $name = $file->getClientOriginalName();

    //アスペクト比を維持して、画像サイズを横幅1080px、縦幅720pxにして保存する。
    $img = InterventionImage::make($file)->fit(1080, 720, function ($constraint) {
        $constraint->aspectRatio();
    })->save(storage_path('app/public/' .$name ) );

    //諸々書き込み
    $result = Review::create([
        'user_id' => Auth::user()->id,
        'imgpath' => $name,
        'title' => $request->title,
        'description' => $request->description,
        'score' => $request->score
    ]);

    //タグの文字列を結合
    if(!empty($request->freetag)){
        $input_tag = $request->tag . "、" . $request->freetag;
    }
    //freetagの入力がなかった場合は結合しない
    else {
        $input_tag = $request->tag;
    }

    // ddd($input_tag);

    $tag_ids = [];
    //、(全角カンマ)で区切って配列に格納する
    $tags = explode('、', $input_tag);
    foreach ($tags as $tag) {
        //同じものが存在すれば更新される
        $tag = Tag::updateOrCreate(
            [
                'name' => $tag,
            ]
        );
        //tagsテーブルに挿入するIDを格納する
        $tag_ids[] = $tag->id;
    }
    //syncメソッドで中間テーブルに書き込み
    $result->tags()->sync($tag_ids);
    // ddd($input_tag);
        
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
      $review = Review::find($id);
      return view('review.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::find($id);

        $tagResult = '';
        //タグを結合して文字列にする
        $tags = $review->tags;
        foreach($tags as $tag){
            if(($tag->name != '北海道') && ($tag->name != '東北') && ($tag->name != '関東') && ($tag->name != '関西') && ($tag->name != '中国・四国') && ($tag->name != '九州・沖縄')){

                $tagResult = $tagResult . '、' . $tag->name;
            }
        }

        //頭文字の、を切り取る
        if(mb_substr($tagResult, 0,1) == '、'){
            $tagResult = mb_substr($tagResult,1);
        }
        
        return view('review.edit', compact('review','tagResult'));
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
    $review = Review::find($id);
        //バリデーション
    $validator = Validator::make($request->all(), [
        'title' => 'required | max:25',
        'description' => 'required',
        'score' => 'required',
        'tag' => 'nullable'
    ]);
    // バリデーション:エラー
    if ($validator->fails()) {
    return redirect()
        ->route('review.edit', $id)
        ->withInput()
        ->withErrors($validator);
    }

    if(!empty($request->freetag)){
        $input_tag = $request->tag . "、" . $request->freetag;
    }
    //freetagの入力がなかった場合は結合しない
    else {
        $input_tag = $request->tag;
    }

    // ddd($input_tag);

    $tag_ids = [];
    //、(全角カンマ)で区切って配列に格納する
    $tags = explode('、', $input_tag);
    foreach ($tags as $tag) {
        //同じものが存在すれば更新される
        $tag = Tag::updateOrCreate(
            [
                'name' => $tag,
            ]
        );
        //tagsテーブルに挿入するIDを格納する
        $tag_ids[] = $tag->id;
    }
    //syncメソッドで中間テーブルに書き込み
    $review->tags()->sync($tag_ids);

    //データ更新処理
    $result = Review::find($id)->update($request->all());
    return redirect()->route('review.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Review::find($id)->delete();
        return redirect()->route('review.index');
    }
}