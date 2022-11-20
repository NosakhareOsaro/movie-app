<x-front-layout>
    @if (!empty($episode))
        <main class="my-2">
            <section class="bg-gradient-to-r from-indigo-700 to-transparent">
                <div class="max-w-6xl p-2 m-4 mx-auto">
                    <div class="flex">
                        <div class="w-3/12">
                            <div class="w-full">
                                <img class="w-full h-full rounded"
                                    src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $episode->season->poster_path }}">
                            </div>
                        </div>
                        <div class="w-8/12">
                            <div class="p-6 m-4">
                                <h1 class="flex text-4xl font-bold text-white">{{ $episode->name }}</h1>
                                <div class="flex p-3 space-x-4 text-white">
                                    <span>{{ $episode->season->name }}</span>

                                </div>
                                <div class="flex space-x-4">
                                    @foreach ($episode->trailers as $trailer)
                                        <livewire:movie-trailer :trailer="$trailer"></livewire:movie-trailer>
                                    @endforeach
                                </div>
                            </div>
                            <div class="p-8 text-white">
                                <p>{{ $episode->overview }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="max-w-6xl p-2 mx-auto bg-gray-200 rounded dark:bg-gray-900">

                <div class="w-4/12">
                    <h1 class="flex text-xl font-bold text-white">Latest episodes</h1>
                    <div class="grid grid-cols-3 gap-2">
                        @if (!empty($latest))
                            @foreach ($latest as $lepisode)
                                <a href="{{ route('movies.show', $lepisode->slug) }}">
                                    <img class="w-full h-full rounded-lg"
                                        src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $lepisode->season->poster_path }}">
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