<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>News Home Page</h1>
    @foreach ($news as $singleNews)
        <h2>
            <a href="{{ route('news.show', $singleNews) }}">{{ $singleNews->title }}</a>
        </h2>
        <p>{{ $singleNews->content }}</p>
        <hr>
    @endforeach
</body>

</html>
