<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6">
                    <div class="mt-6 mb-6">
                        <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                            @foreach($posts as $post)
                                <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                    <div class="flex flex-col">
                                        <div class="timerstamp">
                                            <p class="muted text-gray-400">{{ $post->created_at->diffForHumans() . ' by ' . $post->author->name }}</p>
                                        </div>
                                        <a href="{{ route('blog.show', ['post' => $post]) }}"
                                           class="mt-6 text-xl font-semibold hover:underline text-gray-900 dark:text-white">{{ $post->title }}</a>
                                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                            {{ Str::words($post->body, 20, '...')  }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if( isset($posts) )
                            {{ $posts->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
