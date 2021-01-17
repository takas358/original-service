{{-- 
-------------------------------------------------------------------------------------
   ナビゲーションバー・エラーメッセージを表示
-------------------------------------------------------------------------------------
--}}

<!DOCTYPE html>
<html lang = "ja">
    <div class="footerFixed">
        <head>
            <meta charset="UTF-8">
            {{-- ---------- サービス名を表示 ---------- --}}
            <title>Open Enquete</title>
            <meta name="viewport" content="width=device-width", initial-scale=1, shrink-to-fit=no">
            <link rel="Stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
            <link rel="Stylesheet" href="/css/footer.css">
        </head>
    
        <body>
            {{-- ---------- ナビゲーションバーを表示 ---------- --}}
            @include('commons.navbar')
            {{-- ---------- エラーメッセージを表示 ---------- --}}
            <div class="container">
                @include('commons.messages')
                @yield('content')
            </div>

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
            <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        </body>
    
        <footer>
            <small>&copy; 2021 Open Enquete</small>
        </footer>
    </div>
</html>