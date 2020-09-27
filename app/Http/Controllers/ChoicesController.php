<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use App\User;
use App\Enquete;
use App\Choice;

class ChoicesController extends Controller
{

/*
--------------------------------------------------------------------------------------------
   選択肢の作成（入力画面遷移）
--------------------------------------------------------------------------------------------
*/

    public function create($enquete_id)
    {
        //選択肢と対となるアンケートの取得
        $enquete = Enquete::find($enquete_id);
        
        //選択肢作成の入力画面遷移
        return view('choices.create',[
            'enquete' => $enquete,
        ]);
    }

/*
--------------------------------------------------------------------------------------------
   選択肢の作成（DB登録）
--------------------------------------------------------------------------------------------
*/
    public function store(Request $request,$enquete_id)
    {
        //選択肢と対となるアンケートの取得
        $enquete = Enquete::find($enquete_id);
        
        //質問1～3それぞれに設定された選択肢のチェックとテーブル登録
        for($i = 1; $i <= 3; $i++){
            $question_name = 'question'.$i;
            if(! is_null($enquete->$question_name)){

                //入力した選択肢の数を算出
                $choice_count = 0;
                for($j = 1; $j <= 5; $j++){
                    $choice_column_name = 'choice'.$i.'_'.$j;
                    if(! is_null($request->$choice_column_name)){
                        $choice_count++;
                    }
                }
                
                //入力項目のチェック
                $min_column_name = 'min_select'.$i;
                $max_column_name = 'max_select'.$i;
                for($j = 2; $j <= 5; $j++){
                    $k = $j + 1;
                    $this->validate($request, [
                        //最小選択数・・・入力必須、数値のみ許可、最小値を1とする、最大値を入力した最大選択数とする
                        'min_select'.$i => 'required|numeric|min:1|max:'.$request->$max_column_name,
                        //最大選択数・・・入力必須、数値のみ許可、最小値を入力した最小選択数、最大値を入力した選択肢の数とする
                        'max_select'.$i => 'required|numeric|min:'.$request->$min_column_name.'|max:'.$choice_count,
                        //選択肢1・・・入力必須、30文字まで
                        'choice'.$i.'_1' => 'required|max:30',
                        //選択肢2～5・・・一つ後ろの選択肢が入力されていたら入力必須、30文字まで
                        'choice'.$i.'_'.$j => 'required_with:choice'.$i.'_'.$k.'|max:30',
                    ]);
                }
                //入力項目を選択肢テーブルに登録
                $choice_name = 'choice'.$i;
                $$choice_name = $enquete->choices()->where('question_number','=',$i)->first();
                if( is_null($$choice_name)){
                    $$choice_name = new Choice;
                }
                $$choice_name->enquete_id = $enquete_id;
                $$choice_name->question_number = $i;
                $$choice_name->min_select = $request->$min_column_name;
                $$choice_name->max_select = $request->$max_column_name;
                for($j = 1; $j <= 5; $j++){
                    $choice_field_name = 'choice'.$j;
                    $choice_column_name = 'choice'.$i.'_'.$j;
                    $$choice_name->$choice_field_name = $request->$choice_column_name;
                }
                $$choice_name->save();
            }
        }
        //トップページへ遷移する
        return redirect('/');
    }

/*
-------------------------------------------------------------------------------------------- 
   選択肢の更新（DB登録）
--------------------------------------------------------------------------------------------
*/
    public function update(Request $request, $id)
    {
        //storeメソッドを呼び出す　
        //※storeメソッドと同じことを行う
        $this->store($request, $id);
    }

}