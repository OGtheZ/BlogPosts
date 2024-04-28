<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update your blog') . ': ' . $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="" href="{{ url()->previous() }}">
                <button type="button"
                        class="mb-6 w-full flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                    <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18"/>
                    </svg>
                    <span>Go back</span>
                </button>
            </a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-form action="{{ route('blog.update', ['post' => $post]) }}" method="post">
                    @csrf
                    <div class="category-box ml-2 mt-2 mr-2">
                        <x-input-label for="categories" :value="__('Category')"/>
                        <div class="checkboxes grid grid-cols-4">
                            @foreach($categories as $category)
                                <div class="flex items-center mb-4">
                                    <input id="checkbox{{$loop->index}}" type="checkbox"
                                           @if( in_array($category->id, $setCategories)) checked @endif
                                           value="{{ $category->id }}" name="categories[]"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox{{$loop->index}}"
                                           class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="mx-2 my-2 max-w-2xl">
                        <x-input-label for="title" :value="__('Title')"/>
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                      :value="old('title')" value="{{ $post->title }}"/>
                        <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                    </div>
                    <div class="mx-2 my-2">
                        <label for="body" class="text-gray-500">{{ __('Body') }}</label>
                        <x-textarea id="body" class="block mt-1 w-full border-gray-300 rounded-md" rows="20"
                                    style="resize:none" name="body" :value="old('body')">
                            {{ $post->body }}
                        </x-textarea>
                        <x-input-error :messages="$errors->get('body')" class="mt-2"/>
                    </div>
                    <x-primary-button
                        class="text-white ml-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        type="submit">Submit
                    </x-primary-button>
                </x-form>
            </div>
        </div>
    </div>
</x-app-layout>
