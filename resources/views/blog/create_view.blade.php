<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a new blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-form action="{{ route('blog.store') }}" method="post">
                    @csrf
                    <div class="category-box ml-2 mt-2">
                        <x-input-label for="categories" :value="__('Category')" />
                        <select class="mt-2 rounded border-gray-300" name="categories[]" id="categories" multiple="multiple">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mx-2 my-2 max-w-2xl">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"/>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="mx-2 my-2">
                        <label for="body" class="text-gray-500">{{ __('Body') }}</label>
                        <x-textarea id="body" class="block mt-1 w-full border-gray-300 rounded-md" rows="20" style="resize:none" name="body" :value="old('body')">
                        </x-textarea>
                        <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    </div>
                    <x-primary-button class="text-white ml-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                      type="submit">Submit</x-primary-button>
                </x-form>
            </div>
        </div>
    </div>
</x-app-layout>
@push('styles')
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css"
    />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js" defer></script>
@endpush
