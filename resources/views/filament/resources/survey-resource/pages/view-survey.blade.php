<x-filament::page>
    <div class="space-y-6">
        {{-- Render the widget --}}
        <x-filament-widgets::widgets
            {{-- :widgets="$this->getVisibleWidgets()"
            :columns="$this->getColumns()" --}}
        />

        {{-- Render the form --}}
        {{ $this->form }}

    </div>
</x-filament::page>
