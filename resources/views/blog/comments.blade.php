<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="title">
                <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
                    {{ $post->title }}
                </h2>
                <p class="text-lg text-gray-400">{{ 'by ' . $post->author->name . ' on ' . $post->created_at }}</p>
            </div>

            <a class="" href="{{ route('blog.show', ['post' => $post]) }}"><button type="button" class="mt-3 w-full flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                    <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                    <span>Back to post</span>
                </button></a>
            <div class="comment-section flex">
                <div class="w-1/2 mr-auto p-6">
                    <div class="mt-6">
                        <h2>Comments</h2>
                        @foreach( $comments as $comment )
                            <div class=" mt-2 scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex focus:outline focus:outline-2 focus:outline-red-500">
                                <div class="comment-box">
                                    @can('delete', $comment)
                                        <a href="{{ route('comment.delete', ['blogComment' => $comment]) }}" onclick="return(confirm('Are you sure?'))">
                                            <svg class="h-5 w-5 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </a>
                                    @endcan
                                    <span class="text-gray-500">{{ 'by ' . $comment->author->name  . ' on ' . $comment->created_at }}</span>
                                    <p class="font-bold">{{ $comment->body }}</p>
                                </div>
                            </div>
                        @endforeach
                        {{ $comments->links() }}
                    </div>
                </div>
                @auth
                    <div class="w-1/2 ml-auto p-6">
                        <div class="mt-6">
                            <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex focus:outline focus:outline-2 focus:outline-red-500">
                                <form action="{{ route('blog.comment', ['post' => $post]) }}" method="post" class="w-full" name="comment">
                                    @csrf
                                    <h2>Add comment</h2>
                                    <x-textarea placeholder="Max 255 characters..." id="body" class="block mt-1 w-full border-gray-300 rounded-md" rows="5" style="resize:none" name="body" :value="old('body')">
                                    </x-textarea>
                                    <x-input-error :messages="$errors->get('body')" class="mt-2" />
                                    <div class="flex justify-end">
                                        <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>

        </div>
    </div>
</x-app-layout>
