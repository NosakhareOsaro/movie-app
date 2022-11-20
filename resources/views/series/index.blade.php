<x-front-layout>
    <div class="max-w-6xl mx-auto mt-4">
        <section class="p-2 mt-4 bg-gray-200 rounded dark:bg-gray-900 dark:text-white">
            <div class="grid grid-cols-2 gap-4 rounded sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6">
                @foreach ($series as $serie)
                    <x-movie-card>
                        <x-slot name="image">
                            <a href="{{ route('series.show', $serie->slug) }}">
                                <div class="aspect-w-2 aspect-h-3">
                                    <img class="object-cover"
                                        src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $serie->poster_path }}">
                                </div>
                                <div class="absolute inset-0 z-10 bg-gradient-to-t from-black to-transparent"></div>

                                <div
                                    class="absolute w-12 h-6 text-center text-blue-400 bg-gray-800 rounded x-10 left-2 top-2 group-hover:bg-gray-700">
                                    New
                                </div>
                                <div
                                    class="absolute z-10 text-sm font-bold text-indigo-300 bottom-2 left-2 group-hover:text-blue-700">
                                    {{ $serie->seasons_count }} Season/s
                                </div>
                            </a>
                        </x-slot>
                        <a href="{{ route('series.show', $serie->slug) }}">
                            <div class="font-bold dark:text-white group-hover:text-blue-400">
                                {{ $serie->name }}
                            </div>
                        </a>
                    </x-movie-card>
                @endforeach
            </div>
            <div class="p-2 m-2">
                {{ $series->links() }}
            </div>
        </section>
    </div>
</x-front-layout>