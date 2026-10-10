@php
    $datos = $this->getEstadisticas();
@endphp
<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Clientes por etapa hipotecaria
        </x-slot>
        <div class="space-y-3">
            @foreach ($datos['etapas'] as $item)
                <div class="space-y-1">
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-xs font-medium text-gray-700 dark:text-gray-200">
                            {{ $item['etapa'] }}
                        </span>
                        <span class="inline-flex min-w-8 justify-center rounded-md px-2 py-0.5 text-xs font-semibold"
                            style="background-color: #EAF4EE; color: #174A3A;">
                            {{ $item['cantidad'] }}
                        </span>
                    </div>
                    <div class="w-full overflow-hidden rounded-full bg-gray-100 dark:bg-gray-700" style="height: 7px;">
                        <div class="h-full rounded-full" style="
                                            width: {{ $item['ancho'] }}%;
                                            background-color: {{ $item['etapa'] === 'Término' ? '#10B981' : '#174A3A' }};
                                        "></div>
                    </div>
                </div>
            @endforeach
            <div class="border-t border-gray-200 pt-3 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium text-gray-600 dark:text-gray-300">
                        Total de clientes
                    </span>
                    <span class="text-base font-bold text-gray-900 dark:text-white">
                        {{ $datos['total'] }}
                    </span>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>