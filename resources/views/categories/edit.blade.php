<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- <a href="{{ route('news.create') }}">Create New News</a> --}}
                    <div class="flex justify-between mx-2 my-2">
                        <a href="{{ route('categories.index') }}" type="button"
                            class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Back
                            To Categories</a>

                    </div>

                    <div class="max-w-5xl mx-auto my-16">
                        <form method="post" action="{{ route('categories.update', ['category' => $category->id]) }}">
                            @csrf
                            @method('put')
                            <div class="space-y-12">
                                <div class="border-b border-gray-900/10 pb-12">
                                    <h2 class="text-xl font-semibold leading-7 text-gray-900">Edit Category</h2>
                                    <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed
                                        publicly so be careful what you share.</p>

                                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        <div class="sm:col-span-4">
                                            <label for="name"
                                                class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input value="{{ $category->name }}" type="text" name="name"
                                                        id="name"
                                                        class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                        placeholder="Health and Fitness">
                                                </div>
                                            </div>
                                            @error('name')
                                                <span class="mt-2 text-sm text-red-500">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-6 flex items-center justify-end gap-x-6">
                                        <button type="button"
                                            class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                                        <button type="submit"
                                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

