<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6">
                    <div class="mt-6 mb-6">
                        <div class="grid grid-cols-5">
                            @foreach($categories as $category)
                                <a class="px-2 py-2 border-solid border border-gray-400 rounded mx-2 my-2 text-center hover:bg-gray-400"
                                   href="{{ route('categories.show', ['blogCategory' => $category]) }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
