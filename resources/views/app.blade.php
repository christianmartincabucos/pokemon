<!doctype html>
<html >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="icon" href="{{asset('image/pokeball.png')}}">
    <title>{{env('APP_NAME')}}</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
      body{
        font-family: 'Poppins';
        background-color: azure;
        padding-top: 100px;
      }
    </style>
</head>
<body>
    <div id="app">
    </div>
   <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</body>
</html>