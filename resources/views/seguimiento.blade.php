<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento de solicitud</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#F4F0E8] text-[#24302A]">
    <div class="min-h-screen">
        {{-- ========================================= --}}
        {{-- HEADER --}}
        {{-- ========================================= --}}
        <header class="border-b border-[#DDD6C9] bg-[#F8F5EF]">
            <div class="mx-auto max-w-5xl px-5 py-6 sm:px-6">
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-11 w-11 items-center
                               justify-center rounded-xl
                               bg-[#174A3A]">
                        <svg class="h-5 w-5 text-[#F4F0E8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M9 12.75L11.25 15
                                   15 9.75
                                   M21 12a9 9 0 11-18 0
                                   9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p
                            class="text-sm font-semibold
                                   tracking-wide text-[#174A3A]">
                            Seguimiento
                        </p>
                        <p class="text-xs text-[#7C817B]">
                            Consulta el estado de tu solicitud
                        </p>
                        <a href="{{ url('/') }}"
                            class="mt-1 inline-block text-xs font-medium
                            text-[#174A3A] underline
                            hover:text-[#123B2F]">
                            Volver al inicio
                        </a>
                    </div>
                </div>
            </div>
        </header>
        {{-- ========================================= --}}
        {{-- CONTENIDO --}}
        {{-- ========================================= --}}
        <main class="mx-auto max-w-5xl px-5 py-12 sm:px-6 lg:py-16">
            {{-- ========================================= --}}
            {{-- TITULO --}}
            {{-- ========================================= --}}
            <div class="mx-auto max-w-2xl text-center">
                <span
                    class="inline-flex items-center rounded-full
                           border border-[#C8D8D0]
                           bg-[#E7EFEA]
                           px-4 py-1.5
                           text-xs font-semibold
                           uppercase tracking-[0.18em]
                           text-[#174A3A]">
                    Estado de solicitud
                </span>
                <h1
                    class="mt-5 text-4xl font-semibold
                           tracking-tight text-[#24302A]
                           sm:text-5xl">
                    Consulta tu solicitud
                </h1>
                <p
                    class="mx-auto mt-5 max-w-xl
                           text-base leading-7
                           text-[#6F766F]">
                    Ingresa tu RUT para consultar el estado
                    y los avances asociados a tu solicitud.
                </p>
            </div>
            {{-- ========================================= --}}
            {{-- BUSCADOR --}}
            {{-- ========================================= --}}
            <div class="mx-auto mt-10 max-w-xl">
                <form action="{{ route('seguimiento.buscar') }}" method="POST">
                    @csrf
                    <div
                        class="rounded-2xl
                               border border-[#D8D1C5]
                               bg-[#FFFDF9]
                               p-2
                               shadow-[0_12px_35px_rgba(48,55,49,0.08)]">
                        <div class="flex flex-col gap-2
                                   sm:flex-row">
                            <input type="text" name="rut" value="{{ old('rut') }}" placeholder="12.345.678-9"
                                autocomplete="off" required
                                class="h-14 flex-1 rounded-xl
                                       border-0
                                       bg-transparent
                                       px-4
                                       text-[#24302A]
                                       placeholder:text-[#A1A49E]
                                       outline-none
                                       focus:ring-2
                                       focus:ring-[#174A3A]/20">
                            <button type="submit"
                                class="h-14 rounded-xl
                                       bg-[#174A3A]
                                       px-8
                                       font-semibold
                                       text-white
                                       transition
                                       hover:bg-[#123B2F]
                                       active:scale-[0.98]">
                                Consultar
                            </button>
                        </div>
                    </div>
                </form>
                {{-- Error --}}
                @if (session('error'))
                    <div
                        class="mt-4 rounded-xl
                               border border-[#E8CACA]
                               bg-[#FAEEEE]
                               px-4 py-3
                               text-sm text-[#9B3D3D]">
                        {{ session('error') }}
                    </div>
                @endif
                {{-- Error de validación --}}
                @error('rut')
                    <div class="mt-3 text-sm text-[#9B3D3D]">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- ========================================= --}}
            {{-- RESULTADO --}}
            {{-- ========================================= --}}
            @isset($cliente)
                {{-- ========================================= --}}
                {{-- CLIENTE --}}
                {{-- ========================================= --}}
                <!-- Botón flotante -->
                <button type="button" onclick="abrirModalConsulta()"
                    class="fixed bottom-6 right-6 z-40 flex h-14 w-14
                        items-center justify-center rounded-full
                        bg-[#174A3A] text-white shadow-xl
                        transition hover:scale-105 hover:bg-[#123B2F]"
                    aria-label="Enviar una consulta">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 10h8M8 14h5m-8 6 1.8-3.6A8 8 0 1 1 20 14.5" />
                    </svg>
                </button>
                <!-- Modal de consulta -->
                <div id="modalConsulta"
                    class="fixed inset-0 z-50 hidden items-center
                            justify-center bg-black/50 p-4">
                    <div
                        class="w-full max-w-lg rounded-3xl
                                bg-[#FFFDF9] p-6 shadow-2xl sm:p-8">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-2xl font-semibold text-[#174A3A]">
                                    ¿Tienes alguna duda?
                                </h2>
                                <p class="mt-2 text-sm text-[#6F766F]">
                                    Envíanos tu consulta y nuestro equipo
                                    la revisará.
                                </p>
                            </div>
                            <button type="button" onclick="cerrarModalConsulta()" class="text-xl text-gray-500"
                                aria-label="Cerrar">
                                &times;
                            </button>
                        </div>
                        <form id="formConsulta" action="{{ route('seguimiento.consultas.store') }}" method="POST"
                            class="mt-6 space-y-4">
                            @csrf
                            <input type="hidden" name="rut" value="{{ $cliente->rut }}">
                            <div>
                                <label for="mensajeConsulta"
                                    class="mb-2 block text-sm font-medium
                                            text-[#24302A]">
                                    Escribe tu consulta
                                </label>
                                <textarea id="mensajeConsulta" name="mensaje" rows="5" maxlength="2000" required
                                    placeholder="Cuéntanos en qué podemos ayudarte..."
                                    class="w-full rounded-xl border border-[#D8D1C5]
                                        bg-white p-4 text-sm text-[#24302A]
                                        outline-none focus:border-[#174A3A]">{{ old('mensaje') }}</textarea>
                                @error('mensaje')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="flex justify-end gap-3">
                                <button type="button" onclick="cerrarModalConsulta()"
                                    class="rounded-xl border border-[#D8D1C5]
                                            px-5 py-3 text-sm text-[#536057]">
                                    Cancelar
                                </button>
                                <button type="submit"
                                    class="rounded-xl bg-[#174A3A]
                                            px-6 py-3 text-sm font-semibold
                                            text-white hover:bg-[#123B2F]">
                                    Enviar consulta
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    function abrirModalConsulta() {
                        const modal = document.getElementById('modalConsulta');
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                    }

                    function cerrarModalConsulta() {
                        const modal = document.getElementById('modalConsulta');
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    }
                    document.addEventListener('keydown', function(event) {
                        if (event.key === 'Escape') {
                            cerrarModalConsulta();
                        }
                    });
                    @if ($errors->has('mensaje'))
                        abrirModalConsulta();
                    @endif
                </script>
                @if (session('consulta_success'))
                    <div
                        class="mt-5 rounded-xl border border-[#B7D6C4]
                                bg-[#EAF4EE] p-4 text-sm text-[#174A3A]">
                        {{ session('consulta_success') }}
                    </div>
                @endif
                <section class="mt-12">
                    <div
                        class="overflow-hidden rounded-3xl
                               border border-[#D8D1C5]
                               bg-[#FFFDF9]
                               shadow-[0_15px_40px_rgba(48,55,49,0.07)]">
                        <div class="p-6 sm:p-8">
                            <div
                                class="flex flex-col gap-6
                                       sm:flex-row
                                       sm:items-center
                                       sm:justify-between">
                                <div>
                                    <p
                                        class="text-xs font-semibold
                                               uppercase tracking-[0.16em]
                                               text-[#8A8F88]">
                                        Cliente
                                    </p>
                                    <h2
                                        class="mt-2 text-2xl
                                               font-semibold
                                               text-[#24302A]">
                                        {{ $cliente->nombre }}
                                        {{ $cliente->apellido }}
                                    </h2>
                                    <p
                                        class="mt-2 font-mono
                                               text-sm
                                               text-[#174A3A]">
                                        RUT: {{ $cliente->rut }}
                                    </p>
                                </div>
                                <div
                                    class="w-fit rounded-full
                                           border border-[#C8D8D0]
                                           bg-[#E7EFEA]
                                           px-4 py-2
                                           text-sm font-semibold
                                           text-[#174A3A]">
                                    {{ $cliente->procedures->count() }}
                                    {{ $cliente->procedures->count() === 1 ? 'proceso' : 'procedures' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {{-- ========================================= --}}
                {{-- ========================================= --}}
                {{-- SEGUIMIENTO DE ETAPAS --}}
                {{-- ========================================= --}}
                @php
                    $procesos = $cliente->procedures->sortBy('orden')->values();
                    $totalEtapas = $procesos->count();
                    $etapasCompletadas = $procesos
                        ->filter(function ($proceso) {
                            return in_array(strtolower(trim($proceso->estado ?? '')), [
                                'completado',
                                'completada',
                                'finalizado',
                                'finalizada',
                                'terminado',
                                'terminada',
                            ]);
                        })
                        ->count();
                    $progreso = $totalEtapas > 0 ? (int) round(($etapasCompletadas / $totalEtapas) * 100) : 0;
                    $etapaActual = $procesos->first(function ($proceso) {
                        return in_array(strtolower(trim($proceso->estado ?? '')), [
                            'en_proceso',
                            'en proceso',
                            'en curso',
                            'desarrollo',
                            'en desarrollo',
                            'revision',
                            'revisión',
                            'en revision',
                            'en revisión',
                        ]);
                    });
                @endphp
                <section class="mt-12">
                    {{-- Resumen del progreso --}}
                    <div
                        class="overflow-hidden rounded-3xl border border-[#D8D1C5] bg-[#FFFDF9] shadow-[0_15px_40px_rgba(48,55,49,0.06)]">
                        <div class="p-6 sm:p-8">
                            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#174A3A]">
                                        Seguimiento de tu solicitud
                                    </p>
                                    <h3 class="mt-2 text-2xl font-semibold tracking-tight text-[#24302A] sm:text-3xl">
                                        Tu proceso paso a paso
                                    </h3>
                                    <p class="mt-2 max-w-2xl text-sm leading-6 text-[#6F766F]">
                                        Aquí puedes consultar las etapas de tu solicitud y revisar las actualizaciones de
                                        nuestro equipo.
                                    </p>
                                </div>
                                <div class="sm:text-right">
                                    <p class="text-sm text-[#777D77]">Progreso general</p>
                                    <p class="mt-1 text-3xl font-semibold tracking-tight text-[#174A3A]">
                                        {{ $progreso }}%
                                    </p>
                                    <p class="mt-1 text-xs text-[#8A8F88]">
                                        {{ $etapasCompletadas }} de {{ $totalEtapas }} etapas completadas
                                    </p>
                                </div>
                            </div>
                            <div class="mt-6 h-2.5 overflow-hidden rounded-full bg-[#E8E3DA]">
                                <div class="h-full rounded-full bg-[#2E7D5B] transition-all duration-500"
                                    style="width: {{ $progreso }}%"></div>
                            </div>
                            @if ($etapaActual)
                                <div
                                    class="mt-5 flex items-start gap-3 rounded-2xl border border-[#C8D8D0] bg-[#E7EFEA] p-4">
                                    <div
                                        class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#174A3A] text-white">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-[#174A3A]">
                                            Actualmente estás en la etapa
                                            {{ $etapaActual->orden ?? $procesos->search($etapaActual) + 1 }} de
                                            {{ $totalEtapas }}
                                        </p>
                                        <p class="mt-1 text-sm text-[#456357]">
                                            {{ $etapaActual->titulo }}
                                        </p>
                                    </div>
                                </div>
                            @elseif($totalEtapas > 0 && $etapasCompletadas === $totalEtapas)
                                <div
                                    class="mt-5 rounded-2xl border border-[#C7DED0] bg-[#E5F1EA] p-4 text-sm font-medium text-[#276849]">
                                    ¡Felicitaciones! Todas las etapas de tu solicitud están completadas.
                                </div>
                            @endif
                        </div>
                    </div>
                    {{-- Lista de etapas --}}
                    <div class="mb-8 mt-10">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#174A3A]">
                            Historial de etapas
                        </p>
                        <h3 class="mt-2 text-2xl font-semibold text-[#24302A]">
                            Avances de tu solicitud
                        </h3>
                        <p class="mt-2 text-sm leading-6 text-[#777D77]">
                            Cada etapa muestra su estado actual y el último mensaje registrado por nuestro equipo.
                        </p>
                    </div>
                    <div class="relative">
                        @if ($totalEtapas > 1)
                            <div class="absolute bottom-8 left-5 top-8 w-px bg-[#D8D1C5]"></div>
                        @endif
                        <div class="space-y-4">
                            @forelse($procesos as $indice => $proceso)
                                @php
                                    $estado = strtolower(trim($proceso->estado ?? ''));
                                    $esCompletado = in_array($estado, [
                                        'completado',
                                        'completada',
                                        'finalizado',
                                        'finalizada',
                                        'terminado',
                                        'terminada',
                                    ]);
                                    $esActual = in_array($estado, [
                                        'en_proceso',
                                        'en proceso',
                                        'en curso',
                                        'desarrollo',
                                        'en desarrollo',
                                        'revision',
                                        'revisión',
                                        'en revision',
                                        'en revisión',
                                    ]);
                                    $esPendiente = in_array($estado, ['pendiente', 'en espera', '']);
                                    if ($esCompletado) {
                                        $estadoLabel = 'Completada';
                                        $puntoClass = 'bg-[#2E7D5B] text-white border-[#2E7D5B]';
                                        $badgeClass = 'border-[#C7DED0] bg-[#E5F1EA] text-[#276849]';
                                        $numeroClass = 'bg-[#2E7D5B] text-white';
                                    } elseif ($esActual) {
                                        $estadoLabel = 'En curso';
                                        $puntoClass = 'bg-[#174A3A] text-white border-[#174A3A] ring-4 ring-[#E7EFEA]';
                                        $badgeClass = 'border-[#C8D8D0] bg-[#E7EFEA] text-[#174A3A]';
                                        $numeroClass = 'bg-[#174A3A] text-white';
                                    } else {
                                        $estadoLabel = $esPendiente ? 'Pendiente' : ucfirst($proceso->estado);
                                        $puntoClass = 'border-[#D8D1C5] bg-[#F4F0E8] text-[#777D77]';
                                        $badgeClass = 'border-[#D8DAD7] bg-[#EFF0EE] text-[#656B65]';
                                        $numeroClass = 'bg-[#EEEAE1] text-[#656B65]';
                                    }
                                    $numeroEtapa = $proceso->orden ?? $indice + 1;
                                @endphp
                                <article class="relative flex gap-4 sm:gap-5">
                                    {{-- Indicador numerado --}}
                                    <div
                                        class="relative z-10 flex h-10 w-10 shrink-0 items-center justify-center rounded-full border text-sm font-semibold {{ $puntoClass }}">
                                        @if ($esCompletado)
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m5 12 4 4L19 6" />
                                            </svg>
                                        @else
                                            {{ $numeroEtapa }}
                                        @endif
                                    </div>
                                    {{-- Tarjeta de etapa --}}
                                    <div
                                        class="min-w-0 flex-1 rounded-2xl border {{ $esCompletado ? 'border-[#C7DED0] bg-[#EAF4EE] shadow-[0_8px_25px_rgba(46,125,91,0.08)]' : ($esActual ? 'border-[#A9C6B8] bg-[#F8FBF8] shadow-[0_10px_28px_rgba(23,74,58,0.08)]' : 'border-[#D8D1C5] bg-[#FFFDF9] shadow-[0_8px_25px_rgba(48,55,49,0.04)]') }} p-5 transition sm:p-6">
                                        <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                                            <div class="min-w-0">
                                                <p
                                                    class="text-xs font-semibold uppercase tracking-[0.12em] text-[#8A8F88]">
                                                    Etapa {{ $numeroEtapa }} de {{ $totalEtapas }}
                                                </p>
                                                <h4 class="mt-1 text-lg font-semibold text-[#24302A]">
                                                    {{ $proceso->titulo }}
                                                </h4>
                                            </div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                @if ($esActual)
                                                    <span
                                                        class="inline-flex items-center gap-1.5 rounded-full border border-[#C8D8D0] bg-[#E7EFEA] px-3 py-1.5 text-xs font-bold text-[#174A3A]">
                                                        <span class="h-1.5 w-1.5 rounded-full bg-[#2E7D5B]"></span>
                                                        Usted está aquí
                                                    </span>
                                                @endif
                                                <span
                                                    class="inline-flex w-fit shrink-0 rounded-full border px-3 py-1.5 text-xs font-semibold {{ $badgeClass }}">
                                                    {{ $estadoLabel }}
                                                </span>
                                            </div>
                                        </div>
                                        <div
                                            class="mt-4 rounded-xl {{ $esCompletado || $esActual ? 'bg-[#DDEDE3]/80' : 'bg-[#F4F0E8]/70' }} px-4 py-3">
                                            <p class="mb-1 text-xs font-semibold uppercase tracking-wide text-[#777D77]">
                                                Detalle de la etapa
                                            </p>
                                            <p class="text-sm leading-6 text-[#4F5851]">
                                                {{ filled($proceso->descripcion) ? $proceso->descripcion : 'Te informaremos aquí cuando haya novedades sobre esta etapa.' }}
                                            </p>
                                        </div>
                                        @if ($proceso->fecha_inicio || $proceso->fecha_completado)
                                            <div
                                                class="mt-4 flex flex-wrap gap-x-5 gap-y-2 border-t border-[#E8E3DA] pt-4">
                                                @if ($proceso->fecha_inicio)
                                                    <p class="text-xs text-[#8A8F88]">
                                                        Inicio:
                                                        <span class="font-medium text-[#656B65]">
                                                            {{ \Illuminate\Support\Carbon::parse($proceso->fecha_inicio)->format('d/m/Y') }}
                                                        </span>
                                                    </p>
                                                @endif
                                                @if ($proceso->fecha_completado)
                                                    <p class="text-xs text-[#8A8F88]">
                                                        Completada:
                                                        <span class="font-medium text-[#656B65]">
                                                            {{ \Illuminate\Support\Carbon::parse($proceso->fecha_completado)->format('d/m/Y') }}
                                                        </span>
                                                    </p>
                                                @endif
                                            </div>
                                        @elseif($proceso->updated_at)
                                            <div class="mt-4 border-t border-[#E8E3DA] pt-3">
                                                <p class="text-xs text-[#8A8F88]">
                                                    Última actualización:
                                                    {{ $proceso->updated_at->format('d/m/Y') }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </article>
                            @empty
                                <div
                                    class="rounded-2xl border border-dashed border-[#D8D1C5] bg-[#FFFDF9] p-10 text-center">
                                    <div
                                        class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-[#E7EFEA]">
                                        <svg class="h-6 w-6 text-[#174A3A]" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 8v4l2.5 2.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </div>
                                    <p class="font-medium text-[#374039]">Aún no hay etapas registradas</p>
                                    <p class="mt-1 text-sm text-[#8A8F88]">
                                        Todavía no existen etapas asociadas a esta solicitud. Si necesitas ayuda, contacta a
                                        nuestro equipo.
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>
            @endisset
        </main>
        {{-- ========================================= --}}
        {{-- FOOTER --}}
        {{-- ========================================= --}}
        <footer class="border-t border-[#DDD6C9]
                   bg-[#EEEAE1]">
            <div class="mx-auto max-w-5xl
                       px-5 py-6
                       text-center sm:px-6">
                <p class="text-xs text-[#8A8F88]">
                    Sistema de seguimiento de solicitudes
                </p>
            </div>
        </footer>
    </div>
</body>

</html>
