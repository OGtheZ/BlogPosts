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
                        <div class="flex justify-between">
                            @foreach($categories as $category)
                                <a href="{{ route('categories.blogs', ['category' => $category]) }}" class="border-solid border-gray-400 rounded font-bold hover:underline">{{ $category->name }}</a>
                            @endforeach
                        </div>
                        @if(request()->routeIs('categories.blogs'))
                            <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                                @foreach($posts as $post)
                                    <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                        <div class="flex flex-col">
                                            <div class="timerstamp">
                                                <p class="muted text-gray-400">{{ $post->created_at->diffForHumans() . ' by ' . $post->author->name }}</p>
                                            </div>
                                            @if(request()->routeIs('blog.own_list'))
                                                <div class="icons w-16 flex justify-between justify-items-center">
                                                    <a href="{{ route('blog.edit', ['post' => $post]) }}" >
                                                        <svg class="max-h-5 max-w-5" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 30 30">
                                                            <path d="M 22.828125 3 C 22.316375 3 21.804562 3.1954375 21.414062 3.5859375 L 19 6 L 24 11 L 26.414062 8.5859375 C 27.195062 7.8049375 27.195062 6.5388125 26.414062 5.7578125 L 24.242188 3.5859375 C 23.851688 3.1954375 23.339875 3 22.828125 3 z M 17 8 L 5.2597656 19.740234 C 5.2597656 19.740234 6.1775313 19.658 6.5195312 20 C 6.8615312 20.342 6.58 22.58 7 23 C 7.42 23.42 9.6438906 23.124359 9.9628906 23.443359 C 10.281891 23.762359 10.259766 24.740234 10.259766 24.740234 L 22 13 L 17 8 z M 4 23 L 3.0566406 25.671875 A 1 1 0 0 0 3 26 A 1 1 0 0 0 4 27 A 1 1 0 0 0 4.328125 26.943359 A 1 1 0 0 0 4.3378906 26.939453 L 4.3632812 26.931641 A 1 1 0 0 0 4.3691406 26.927734 L 7 26 L 5.5 24.5 L 4 23 z"></path>
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('blog.delete', ['post' => $post]) }}" onclick="return(confirm('Are you sure?'))">
                                                        <svg class="h-5 w-5 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            @endif

                                            <a href="{{ route('blog.view', ['post' => $post]) }}" class="mt-6 text-xl font-semibold hover:underline text-gray-900 dark:text-white">{{ $post->title }}</a>
                                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                                {{ Str::words($post->body, 20, '...')  }}
                                            </p>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
