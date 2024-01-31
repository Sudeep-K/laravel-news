<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create News Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        <div class="">

                            <form method="post" action="{{ route('news.store') }}" enctype="multipart/form-data" class="max-w-md mx-auto">
                                @csrf
                                @method('post')




                                <div class="mb-5">
                                    <label for="title" name="title" class="form-label" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                    <input type="text" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter title" class="form-control" value="{{ old('title') }}" />
                                    <span>
                                        @error('title')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-5">
                                    <label for="content" name="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content</label>
                                    <textarea rows="8" type="text" name="content" placeholder="Enter content" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old('content') }}</textarea>
                                    <span>
                                        @error('content')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-5">
                                    <label for="image" name="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Banner
                                        Image</label>
                                    <input type="file" name="image" placeholder="Enter title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                    <span>
                                        @error('image')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-5">
                                    <label for="category_id" name="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categories</label>
                                    <select name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                        @foreach ($categories as $category)
                                        <option value={{ $category->id }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <span>
                                        @error('category_id')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <br>

                                <div class="mb-5">
                                    <label for="tags" name="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tags</label>
                                    <input type="text" name="tags" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                </div>

                                <br>



                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>