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
    <a href="{{ route('news.create') }}">Create New News</a>

    <div>
        @if (Session::has('message'))
            <div>
                <p>Informational message</p>
                <p>{{ Session::get('message') }}</p>
            </div>
        @endif
    </div>
    @foreach ($news as $singleNews)
        <h2>
            <a href="{{ route('news.show', $singleNews->id) }}">{{ $singleNews->title }}</a>
        </h2>
        <div>
            <img src="{{ asset($singleNews->banner_image) }}" alt=" " style="height:200px;" />
        </div>
        <p>{{ $singleNews->content }}</p>
        <a href="{{ route('news.edit', $singleNews->id) }}">Edit</a>

        <form action="{{ route('news.destroy', ['news' => $singleNews->id]) }}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" />
        </form>
        <hr>
    @endforeach
</body>

</html>
