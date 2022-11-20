<div class="relative pointer-events-auto">
    <button type="button" wire:click="showSearch"
        class="w-52 md:w-72 flex items-center text-sm leading-6 text-gray-400 rounded-md ring-1 ring-gray-900/10 shadow-sm py-1.5 pl-2 pr-3 hover:ring-gray-300 dark:bg-gray-700 dark:highlight-white/5 dark:hover:bg-gray-900"><svg
            width="24" height="24" fill="none" aria-hidden="true" class="flex-none mr-3">
            <path d="m19 19-3.5-3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"></path>
            <circle cx="11" cy="11" r="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"></circle>
        </svg>Quick search...<span class="flex-none pl-3 ml-auto text-xs font-semibold">⌘K</span></button>
    <x-jet-dialog-modal wire:model="showSearchModal">
        <x-slot name="title">Search Movies</x-slot>
        <x-slot name="content">

            <div class="flex flex-col">
                <input wire:model="search" type="text" class="w-full rounded dark:bg-gray-700"
                    placeholder="Search Movie">
                <div wire:loading class="w-full p-4 mx-auto mt-4 border border-blue-300 rounded-md shadow">
                    <div class="flex space-x-4 animate-pulse">
                        <div class="w-10 h-10 bg-gray-200 rounded-full"></div>
                        <div class="flex-1 py-1 space-y-6">
                            <div class="h-2 bg-gray-200 rounded"></div>
                            <div class="space-y-3">
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="h-2 col-span-2 bg-gray-200 rounded"></div>
                                    <div class="h-2 col-span-1 bg-gray-200 rounded"></div>
                                </div>
                                <div class="h-2 bg-gray-200 rounded"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (!empty($search))
                    <div class="" wire:loading.remove>
                        @if (!empty($searchResults))
                            @foreach ($searchResults->groupByType() as $type => $modelSearchResults)
                                <h1>{{ $type }}</h1>
                                @foreach ($modelSearchResults as $searchResult)
                                    <a href="{{ $searchResult->url }}">
                                        <div
                                            class="p-2 m-2 bg-gray-200 rounded-md cursor-pointer hover:bg-gray-300 dark:bg-gray-500 dark:hover:bg-gray-700">
                                            {{ $searchResult->title }}</div>
                                    </a>
                                @endforeach
                            @endforeach
                        @else
                            <div>No Results</div>
                        @endif
                    </div>
                @endif
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-m-button wire:click="closeSearchModal" class="text-white bg-gray-600 hover:bg-gray-800">Cancel
            </x-m-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>