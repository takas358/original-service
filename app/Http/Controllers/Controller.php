<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \app\Enquete;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function counts($user){
        
        //お気に入り登録したアンケートの個数・・・「お気に入り」タブ
        $count_favorites = $user->favorites()->count();
        //自分が投稿したアンケートの個数・・・「マイ・アンケート」タブ
        $count_my_enquetes = $user->enquetes()->count();
        //他人が投稿したアンケートの個数・・・「アンケート閲覧」タブ
        $count_the_others = Enquete::get()->count() - $count_my_enquetes;
        
        return [
            'count_favorites' => $count_favorites,
            'count_my_enquetes' => $count_my_enquetes,
            'count_the_others' => $count_the_others,
        ];
    }
}
