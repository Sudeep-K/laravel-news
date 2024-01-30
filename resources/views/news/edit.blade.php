<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <h1>Edit Page</h1>

    <form method="post" action="{{ route('news.update', ['news' => $news->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="title" name="title" class="form-label">Title</label>
            <input type="text" name="title" placeholder="Enter title" class="form-control"
                value="{{ $news->title }}" />
            <span>
                @error('title')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div>
            <label for="content" name="content">Content</label>
            <textarea type="text" name="content" placeholder="Enter content">{{ $news->content }}</textarea>
            <span>
                @error('content')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div>
            <label for="category_id" name="category_id">Categories</label>
            <select name="category_id">

                @foreach ($categories as $category)
                    <option value={{ $category->id }} @if ($category->id == $news->category_id) {{ 'selected' }} @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <span>
                @error('category_id')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div>
            <label for="image" name="image">Banner Image</label>
            <input type="file" name="image" placeholder="Enter title" />
            <span>
                @error('image')
                    {{ $message }}
                @enderror
            </span>
        </div>


        <button type="submit">Submit</button>
    </form>

</body>

</html>
