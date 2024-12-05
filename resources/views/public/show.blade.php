<x-guest-layout>
    <div class="text-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $article->title }}
        </h2>
    </div>

    <div class="text-gray-500 text-sm">
        Publié le {{ $article->created_at->format('d/m/Y') }} par <a href="{{ route('public.index', $article->user->id) }}">{{ $article->user->name }}</a>
    </div>

    <div>
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <p class="text-gray-700 dark:text-gray-300">{{ $article->content }}</p>
        </div>
    </div>
    <!-- Liste des commentaires -->
    @foreach ($article->comments as $comment)
        <hr>
        <div>
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-2xl font-bold">{{ $comment->user() }}</h2>
                <p class="text-gray-700 dark:text-gray-300">{{ substr($comment->content, 0, 30) }}...</p>
                
                
            </div>
        </div>
        <hr>
        @endforeach
        @auth
        <!-- Ajout d'un commentaire -->
        <form action="{{ route('comments.store') }}" method="post" class="mt-6">
        @csrf
        <input type="hidden" name="articleId" value="{{ $article->id }}">
        <input type="textarea" value="" name="commentaire" id="commentaire" placeholder="écrire commentaire" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Ajouter commentaire
                            </button>
        <!-- Ajouter le reste de votre formulaire -->
        </form>
        @endauth    
    
</x-guest-layout>