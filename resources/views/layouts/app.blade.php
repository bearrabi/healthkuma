<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @yield('header')
</head>
<body>
    <div id="app">
        @yield('navbar')
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    
    <script>
        function delete_alert(e){
        if(!window.confirm('本当に削除しても大丈夫ですか？')){
            window.alert('キャンセルしました');
            return false;
        }
        document.deleteform.submit();
        }
    </script>
</body>
</html>
