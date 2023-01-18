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
            <x-tables::container>
                <x-tables::table>
                    <x-slot name="header">
                        <x-tables::header-cell width="50%">Key</x-tables::header-cell>
                        <x-tables::header-cell>Value</x-tables::header-cell>
                    </x-slot>

                    @foreach($$activeTab as $key => $value)
                        <x-tables::row>
                            <x-tables::cell class="px-4 py-1">{{ $key }}</x-tables::cell>
                            <x-tables::cell class="px-4 py-1">{{ $value }}</x-tables::cell>
                        </x-tables::row>
                    @endforeach
                </x-tables::table>
            </x-tables::container>
        </div>
    </div>
</x-filament::page>
