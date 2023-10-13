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
            <x-filament-tables::container>
                <x-filament-tables::table>
                    <x-slot name="header">
                        <x-filament-tables::header-cell>Key</x-filament-tables::header-cell>
                        <x-filament-tables::header-cell>Value</x-filament-tables::header-cell>
                    </x-slot>

                    @foreach($$activeTab as $key => $value)
                        <x-filament-tables::row>
                            <x-filament-tables::cell class="px-4 py-1"></x-filament-tables::cell>
                            <x-filament-tables::cell class="px-4 py-1">{{ $value }}</x-filament-tables::cell>
                        </x-filament-tables::row>
                    @endforeach
                </x-filament-tables::table>
            </x-filament-tables::container>
        </div>
    </div>
</x-filament::page>
