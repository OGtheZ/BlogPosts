<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="title">
                <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
                    {{ $post->title }}
                </h2>
                <p class="text-lg text-gray-400">{{ 'by ' . $post->author->name }}</p>
            </div>

            <a class="" href="{{ url()->previous() }}"><button type="button" class="mt-3 w-full flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                    <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                    <span>Go back</span>
                </button></a>

            <div class="max-w-7xl mx-auto p-6">
                <div class="mt-6">
                    <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex focus:outline focus:outline-2 focus:outline-red-500">
                        <p>{{ $post->body }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
