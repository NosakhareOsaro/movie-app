<x-front-layout>
    <main class="max-w-6xl mx-auto mt-8">
        <div class="grid grid-cols-2 gap-4 mt-4 md:grid-cols-5">
            @foreach ($casts as $cast)
                <x-movie-card>
                    <x-slot name="image">
                        <a href="{{ route('casts.show', $cast->slug) }}">
                            <img class=""
                                src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $cast->poster_path }}">
                        </a>
                    </x-slot>
                    <a href="{{ route('casts.show', $cast->id) }}">
                        <span class="text-white">{{ $cast->name }}</span>
                    </a>
                </x-movie-card>
            @endforeach
        </div>
        <div class="flex p-2 m-2">
            {{ $casts->links() }}
        </div>
    </main>
</x-front-layout>