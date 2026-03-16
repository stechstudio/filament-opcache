<x-filament::page>
    <div class="space-y-2">
        <div class="flex justify-center">
            <x-filament::tabs>
                @foreach($tabs as $tab)
                    <x-filament::tabs.item
                        :active="strtolower($tab) == $activeTab"
                        wire:click="$set('activeTab', '{{ strtolower($tab) }}')"
                    >
                        {{ $tab }}
                    </x-filament::tabs.item>
                @endforeach
            </x-filament::tabs>
        </div>

        <div wire:poll.10s>
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Key</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Value</th>
                    </tr>
                </thead>

                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($$activeTab as $key => $value)
                        <tr>
                            <td class="px-4 py-1">{{ $key }}</td>
                            <td class="px-4 py-1">{{ $value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-filament::page>
