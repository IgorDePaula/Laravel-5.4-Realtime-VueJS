<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        #users{
            float:left;
            width:150px;
            margin-left:20px;
            border:1px solid red;
            color:black;
        }
        #mensagens{
            float:left;
            width:850px;
            height:700px;
            margin-left:20px;
            border:1px solid red;
            color:black;
        }
        #form{
            float:left;
            width:850px;
        }
    </style>
</head>
<body>
<div class="full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @if (Auth::check())
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Register</a>
            @endif
        </div>
    @endif

    <div class="content">
        <ul id="users"></ul>
        <ul id="mensagens"></ul>
        <div id="form">
            <input type="mensagem" name="" id="mensagem">
            <input type="button" value="Enviar" id="enviar">
        </div>

    </div>
</div>
<script src="http://localhost:6001/socket.io/socket.io.js"></script>
<script src="{{asset('js/app.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#enviar').on('click',function(){
            var mensagem = $('#mensagem').val();
            var dados = {
                mensgem:mensagem,
                user: '{{Auth::user()->id}}'
            }
            $.ajax({
                method:'post',
                url:'{{url('/mensagem')}}',
                data:dados,
                success:function(data){
                    $('#mensagem').val('');
                    console.log(data);
                },
                error:function(data){
                    console.log(data,'error');
                },
                beforeSend:function(){
                    $('#mensagem').val('');
                    $('#mensagem').val('Carregando...');
                }

            })
        })
    })
</script>
</body>
</html>
