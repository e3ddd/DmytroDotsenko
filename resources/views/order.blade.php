<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Замовлення</title>
    <style>
        .photoBorder {
            margin-top: 20px;
            width: 100%;
            height: 40vh;

            background-repeat     : no-repeat;
            background-size       : contain;
            background-position-x : 50%;
            background-position-y : 50%;
        }
    </style>
</head>
<body>
 <div class="container">
     <div class="title">
         <h1>Дякую за замовлення, {{$email}} !</h1>
     </div>
     <div class="content">
{{--        <div style="background-image: url({{$painting->image}})" class="photoBorder">--}}
{{--         </div>--}}
         <p>Назва роботи: {{$painting['name']}}</p>
         <p>Ціна: {{$painting['price']}}</p>
     </div>
 </div>
</body>
</html>
