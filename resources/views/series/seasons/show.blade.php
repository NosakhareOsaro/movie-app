<x-front-layout>
    @if (!empty($season))
        <main class="my-2">
            <section class="bg-gradient-to-r from-indigo-700 to-transparent">
                <div class="max-w-6xl p-2 m-4 mx-auto">
                    <div class="flex">
                        <div class="w-3/12">
                            <div class="w-full">
                                <img class="w-full h-full rounded"
                                    src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $season->poster_path }}">
                            </div>
                        </div>
                        <div class="w-8/12">
                            <div class="p-6 m-4">
                                <h1 class="flex text-4xl font-bold text-white">{{ $season->name }}</h1>
                                <div class="flex p-3 space-x-4 text-white">
                                    <span>Serie: <strong>{{ $serie->name }}</strong></span>
                                    <span>{{ $serie->created_year }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <section class="max-w-6xl p-2 mx-auto bg-gray-200 rounded dark:bg-gray-900">
                <div class="flex justify-between">
                    <div class="w-7/12">
                        <h1 class="flex text-xl font-bold text-white">Episodes</h1>
                        <div class="grid grid-cols-2 gap-4 mt-4 md:grid-cols-5">
                            @foreach ($season->episodes as $episode)
                                <x-movie-card>
                                    <x-slot name="image">
                                        <a href="{{ route('episodes.show', $episode->slug) }}">
                                            <img class=""
                                                src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $season->poster_path }}">
                                        </a>
                                    </x-slot>
                                    <a href="{{ route('episodes.show', $episode->slug) }}">
                                        <span class="text-white">{{ $episode->name }}</span>
                                    </a>
                                </x-movie-card>
                            @endforeach
                        </div>
                    </div>
                    <div class="w-4/12">
                        <h1 class="flex text-xl font-bold text-white">Latest seasons</h1>
                        <div class="grid grid-cols-3 gap-2">
                            @if (!empty($latests))
                                @foreach ($latests as $lseason)
                                    <a href="{{ route('seasons.show', [$lseason->serie->slug, $lseason->slug]) }}">
                                        <img class="w-full h-full rounded-lg"
                                            src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $lseason->poster_path }}">
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </section>

        </main>
    @endif

</x-front-layout>