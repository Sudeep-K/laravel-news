<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <a href="{{ route('news.index') }}">Go back to homepage</a>
    <h1>Single Page</h1>

    <div>
        <img src="{{ asset($news->banner_image) }}" alt=" " style="height:200px;" />
    </div>
    <p>
        {{ $news->content }}
    </p>
</body>

</html>
