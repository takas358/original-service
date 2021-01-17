<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    
/*
-------------------------------------------------------------------------------------------- 
   お気に入り登録
--------------------------------------------------------------------------------------------
*/
    public function store(Request $request, $id)
    {
        \Auth::user()->favorite($id);
        //直前ページに戻る
        return back()->with('flash_message', 'お気に入り登録しました！');
    }
    
/*
-------------------------------------------------------------------------------------------- 
   お気に入り解除
--------------------------------------------------------------------------------------------
*/
    public function destroy($id)
    {
        \Auth::user()->unfavorite($id);
        //直前ページに戻る
        return back()->with('flash_message', 'お気に入り解除しました');;
    }
}
