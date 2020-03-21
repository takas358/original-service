@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>会員登録</h1>
    </div>
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            
            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'ニックネーム')!!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('sex', '性別')!!}
                    {!! Form::select('age',
                            ['' => '選択してください', 
                            '1' => '男',
                            '2' => '女',
                            '3' => 'その他',
                            ],
                        null, ['class' => 'form-control']) 
                    !!}
                </div>
                <div class="form-group">
                    {!! Form::label('age', '年齢')!!}
                    {!! Form::select('age',
                            ['' => '選択してください', 
                            '1' => '0～9歳',
                            '2' => '10代',
                            '3' => '20代',
                            '4' => '30代',
                            '5' => '40代',
                            '6' => '50代',
                            '7' => '60代',
                            '8' => '70代',
                            '9' => '80代',
                            '10' => '90歳以上',
                            ],
                        null, ['class' => 'form-control']) 
                    !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', '都道府県')!!}
                    {!! Form::select('address',
                            ['' => '選択してください', 
                            '1' => '北海道',
                            '2' => '青森県',
                            '3' => '岩手県',
                            '4' => '秋田県',
                            '5' => '宮城県',
                            '6' => '山形県',
                            '7' => '福島県',
                            '8' => '茨城県',
                            '9' => '栃木県',
                            '10' => '群馬県',
                            '11' => '埼玉県',
                            '12' => '千葉県',
                            '13' => '東京都',
                            '14' => '神奈川県',
                            '15' => '新潟県',
                            '16' => '富山県',
                            '17' => '石川県',
                            '18' => '福井県',
                            '19' => '長野県',
                            '20' => '山梨県',
                            '21' => '岐阜県',
                            '22' => '静岡県',
                            '23' => '愛知県',
                            '24' => '三重県',
                            '25' => '滋賀県',
                            '26' => '奈良県',
                            '27' => '京都府',
                            '28' => '大阪府',
                            '29' => '和歌山県',
                            '30' => '兵庫県',
                            '31' => '香川県',
                            '32' => '徳島県',
                            '33' => '高知県',
                            '34' => '愛媛県',
                            '35' => '岡山県',
                            '36' => '鳥取県',
                            '37' => '広島県',
                            '38' => '島根県',
                            '39' => '山口県',
                            '40' => '福岡県',
                            '41' => '大分県',
                            '42' => '佐賀県',
                            '43' => '長崎県',
                            '44' => '宮崎県',
                            '45' => '熊本県',
                            '46' => '鹿児島県',
                            '47' => '沖縄県'
                            ],
                        null, ['class' => 'form-control']) 
                    !!}
                </div>
                <div class="form-group">
                    {!! Form::label('job', '職業')!!}
                    {!! Form::select('job',
                            ['' => '選択してください', 
                            '1' => '会社員',
                            '2' => '会社役員・取締役・経営者など',
                            '3' => '医師・看護師など',
                            '4' => '公務員',
                            '5' => '自営業・フリーランスなど',
                            '6' => '契約・派遣社員など',
                            '7' => 'アルバイト・パートタイムなど',
                            '8' => '無職',
                            '9' => '児童・生徒・学生など',
                            '10' => 'その他',
                            ],
                        null, ['class' => 'form-control']) 
                    !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス')!!}
                    {!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'パスワード（確認用）') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit('会員登録', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@endsection