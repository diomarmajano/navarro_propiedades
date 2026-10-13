<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#F5F0E7">
    <meta name="description" content="Consulta el avance de tu solicitud en Navarro Propiedades.">
    <title>Seguimiento de solicitud | Navarro Propiedades</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --ink:#123C35; --green:#1B594D; --green-soft:#2F7566; --cream:#F5F0E7; --gold:#C8A96B; }
        body { font-family:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif; }
        html { scroll-behavior:smooth; }
        .premium-glass { background:rgba(255,253,249,.9); backdrop-filter:blur(18px); -webkit-backdrop-filter:blur(18px); }
        .hero-surface { background:linear-gradient(117deg,#123C35 0%,#1B594D 67%,#286454 100%); }
        .hero-orb { background:radial-gradient(circle,rgba(200,169,107,.16),transparent 66%); }
        .soft-shadow { box-shadow:0 12px 38px rgba(18,60,53,.055); }
        .progress-orbit { background:conic-gradient(#2F7566 calc(var(--pct) * 1%),#E8E8E0 0); }
        .progress-fill { transition:width .9s cubic-bezier(.2,.8,.2,1); }
        .stage-card { transition:box-shadow .25s ease,border-color .25s ease,transform .25s ease; }
        .stage-card:hover { border-color:rgba(47,117,102,.3); box-shadow:0 10px 30px rgba(18,60,53,.08); }
        .stage-card[open] .stage-chevron { transform:rotate(180deg); }
        .stage-chevron { transition:transform .22s ease; }
        .stage-card[open] .stage-body { animation:stage-in .25s ease both; }
        .entry { animation:fade-up .65s both; }
        .entry-delay { animation:fade-up .7s .12s both; }
        @keyframes fade-up { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        @keyframes stage-in { from{opacity:0;transform:translateY(-5px)} to{opacity:1;transform:translateY(0)} }
        @keyframes sheet-in { from{transform:translateY(100%);opacity:.85} to{transform:translateY(0);opacity:1} }
        .js-reveal [data-reveal]:not(.is-visible) { opacity:0;transform:translateY(15px); }
        [data-reveal] { transition:opacity .6s ease,transform .6s cubic-bezier(.2,.75,.3,1); }
        .update-item { transition:background-color .2s ease,transform .2s ease,border-color .2s ease; }
        .update-item:hover { background-color:#FFFFFF;border-color:rgba(47,117,102,.3);transform:translateY(-2px); }
        button:focus-visible,a:focus-visible,summary:focus-visible,input:focus-visible,textarea:focus-visible { outline:2px solid #C8A96B;outline-offset:3px; }
        .form-loading { opacity:.8;cursor:wait; }
        .form-loading .loading-indicator { display:inline-block; }
        .loading-indicator { display:none;width:14px;height:14px;border-radius:50%;border:2px solid currentColor;border-right-color:transparent;animation:spin .7s linear infinite; }
        @keyframes spin { to{transform:rotate(360deg)} }
        #resumen,#novedades,#etapas { scroll-margin-top:92px; }
        dialog::backdrop { background:rgba(7,28,22,.58); backdrop-filter:blur(6px); }
        dialog[open] { animation:fade-up .22s both; }
        .mobile-dock { background:rgba(18,60,53,.96);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);box-shadow:0 12px 32px rgba(18,60,53,.24); }
        .mobile-dock a.is-active { background:rgba(255,255,255,.13);color:white; }
        @media(max-width:1023px) {
            .mobile-dock { bottom:calc(10px + env(safe-area-inset-bottom,0px)); }
            body:has(.mobile-dock) main { padding-bottom:115px; }
            body:has(.mobile-dock) footer { padding-bottom:calc(85px + env(safe-area-inset-bottom,0px)); }
        }
        @media(max-width:639px) {
            dialog#modalConsulta { position:fixed;inset:auto 0 0 0;margin:0;width:100%;max-width:100%;max-height:88dvh;border-radius:24px 24px 0 0;padding-bottom:env(safe-area-inset-bottom,0px); }
            dialog#modalConsulta[open] { animation:sheet-in .33s cubic-bezier(.18,.78,.28,1) both; }
        }
        @media(prefers-reduced-motion:reduce) {
            html{scroll-behavior:auto}
            .entry,.entry-delay,dialog[open],dialog#modalConsulta[open],.stage-card[open] .stage-body,.loading-indicator{animation:none}
            .stage-card,.stage-chevron,.progress-fill,[data-reveal],.update-item{transition:none}
            .js-reveal [data-reveal]:not(.is-visible){opacity:1;transform:none}
        }
    </style>
</head>
<body class="min-h-screen bg-[#F5F0E7] text-[#123C35] antialiased selection:bg-[#C8A96B]/35">
    {{-- Misma identidad de la nueva página premium --}}
    <header class="premium-glass sticky top-0 z-40 border-b border-[#123C35]/10">
        <div class="mx-auto flex h-[72px] max-w-[1180px] items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="flex min-w-0 items-center gap-2.5" aria-label="Navarro Propiedades, ir al inicio">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-[14px] bg-[#123C35] text-white">
                    <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3.5 10 8.5-7 8.5 7"/><path d="M5.5 9.5V20h13V9.5"/><path d="M10 20v-6h4v6"/></svg>
                </span>
                <span class="min-w-0 leading-tight">
                    <span class="block truncate text-[15px] font-bold tracking-[-.04em] sm:text-base">Navarro</span>
                    <span class="block text-[10px] font-semibold uppercase tracking-[.2em] text-[#2F7566]">Propiedades</span>
                </span>
            </a>
            <div class="flex shrink-0 items-center gap-2 sm:gap-3">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 rounded-full px-2.5 py-2 text-[12px] font-semibold text-[#123C35]/70 transition hover:text-[#123C35] sm:px-4 sm:text-[13px]">
                    <span aria-hidden="true">←</span> <span class="hidden min-[355px]:inline">Volver al inicio</span><span class="min-[355px]:hidden">Inicio</span>
                </a>
                <a href="{{ url('/admin/login') }}" class="inline-flex items-center rounded-full border border-[#123C35]/20 bg-white/80 px-3.5 py-2.5 text-xs font-semibold transition hover:border-[#123C35]/40 hover:bg-white sm:px-5 sm:text-[13px]">Ingresar</a>
            </div>
        </div>
    </header>

    @isset($cliente)
        @php
            $procesos = $cliente->procedures->sortBy('orden')->values();
            $totalEtapas = $procesos->count();
            $estadosCompletados = ['completado', 'completada', 'finalizado', 'finalizada', 'terminado', 'terminada'];
            $estadosActuales = ['en_proceso', 'en proceso', 'en curso', 'desarrollo', 'en desarrollo', 'revision', 'revisión', 'en revision', 'en revisión'];
            $etapasCompletadas = $procesos->filter(fn ($proceso) => in_array(mb_strtolower(trim($proceso->estado ?? '')), $estadosCompletados))->count();
            $progreso = $totalEtapas ? (int) round($etapasCompletadas / $totalEtapas * 100) : 0;
            $etapaActual = $procesos->first(fn ($proceso) => in_array(mb_strtolower(trim($proceso->estado ?? '')), $estadosActuales));

            // Movimientos reales calculados a partir de los campos existentes.
            // No afirmamos que sean "no leídos": eso requeriría almacenamiento adicional.
            $novedades = $procesos->map(function ($proceso) use ($estadosCompletados) {
                $estado = mb_strtolower(trim($proceso->estado ?? ''));
                $fueActualizado = $proceso->created_at && $proceso->updated_at
                    && $proceso->updated_at->greaterThan($proceso->created_at->copy()->addSeconds(60));

                if (in_array($estado, $estadosCompletados) && filled($proceso->fecha_completado)) {
                    $tipo = 'Etapa completada';
                    $fecha = \Illuminate\Support\Carbon::parse($proceso->fecha_completado);
                } elseif ($fueActualizado) {
                    $tipo = in_array($estado, $estadosCompletados) ? 'Etapa completada' : 'Actualización de etapa';
                    $fecha = $proceso->updated_at;
                } elseif (filled($proceso->fecha_inicio)) {
                    $tipo = 'Etapa iniciada';
                    $fecha = \Illuminate\Support\Carbon::parse($proceso->fecha_inicio);
                } else {
                    return null;
                }

                return [
                    'id' => $proceso->id,
                    'tipo' => $tipo,
                    'titulo' => $proceso->titulo,
                    'fecha' => $fecha,
                    'detalle' => filled($proceso->descripcion) ? $proceso->descripcion : null,
                ];
            })->filter()->sortByDesc(fn ($item) => $item['fecha']->timestamp)->take(3)->values();
        @endphp
    @endisset

    <main class="mx-auto max-w-[1180px] px-4 pb-12 pt-6 sm:px-6 sm:pt-8 lg:px-8">
        {{-- Hero compacto; el buscador siempre es visible. --}}
        <section class="hero-surface entry relative isolate overflow-hidden rounded-[26px] p-5 text-white sm:p-7 lg:rounded-[30px] lg:p-9">
            <div class="hero-orb pointer-events-none absolute -right-28 -top-28 h-[430px] w-[430px] rounded-full" aria-hidden="true"></div>
            <div class="pointer-events-none absolute -bottom-36 left-[25%] h-[260px] w-[260px] rounded-full border-[45px] border-white/[.035]" aria-hidden="true"></div>
            <div class="relative grid items-center gap-6 lg:grid-cols-[1.1fr_.9fr] lg:gap-10">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1.5 text-[10px] font-semibold uppercase tracking-[.17em] text-white/85">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#C8A96B]"></span> Portal de seguimiento
                    </div>
                    <h1 class="mt-4 max-w-[550px] text-[clamp(2.15rem,4.4vw,3.85rem)] font-semibold leading-[1.09] tracking-[-.068em]">
                        Tu solicitud. <span class="text-[#E6C68D]">Cada avance, claro.</span>
                    </h1>
                    <p class="mt-3 max-w-[480px] text-[13px] leading-[1.75] text-white/70 sm:text-[14px]">
                        Sigue cada etapa de tu proceso inmobiliario y mantente al tanto de las actualizaciones de nuestro equipo.
                    </p>
                    <div class="mt-5 flex flex-wrap items-center gap-x-4 gap-y-2 text-[11px] font-medium text-white/65 sm:text-xs">
                        <span class="inline-flex items-center gap-2"><span class="flex h-5 w-5 items-center justify-center rounded-full bg-white/10 text-[#E6C68D]">✓</span> Progreso por etapas</span>
                        <span class="inline-flex items-center gap-2"><span class="flex h-5 w-5 items-center justify-center rounded-full bg-white/10 text-[#E6C68D]">✓</span> Actualizaciones del proceso</span>
                    </div>
                </div>
                <div class="rounded-[21px] border border-white/20 bg-white/[.11] p-4 shadow-[0_12px_40px_rgba(0,0,0,.08)] backdrop-blur-xl sm:p-5">
                    <div class="mb-3 flex items-center justify-between gap-3">
                        <div>
                            <p class="text-[10px] font-semibold uppercase tracking-[.16em] text-[#E6C68D]">Consulta de solicitud</p>
                            <h2 class="mt-1 text-[18px] font-semibold tracking-[-.035em] text-white">Ingresa tu RUT</h2>
                        </div>
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-[12px] bg-white/10 text-[#EAD2A4]" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M8 4h8l4 4v12H4V4h4Z"/><path d="M14 4v5h6"/><path d="M8 14h8M8 17h5"/></svg>
                        </span>
                    </div>
                    <form action="{{ route('seguimiento.buscar') }}" method="POST" data-feedback-form class="flex flex-col gap-2 sm:flex-row lg:flex-col xl:flex-row">
                        @csrf
                        <label for="rut" class="sr-only">RUT del cliente</label>
                        <input id="rut" name="rut" type="text" value="{{ old('rut', $cliente->rut ?? '') }}" placeholder="12.345.678-9" required maxlength="20" autocomplete="off" aria-describedby="rut-ayuda" class="min-h-[49px] min-w-0 flex-1 rounded-[13px] border border-white/15 bg-white px-4 text-[13px] font-medium text-[#123C35] outline-none placeholder:text-[#123C35]/40 focus:border-[#C8A96B] focus:ring-2 focus:ring-[#C8A96B]/35" />
                        <button type="submit" data-loading-label="Consultando..." class="inline-flex min-h-[49px] shrink-0 items-center justify-center gap-3 rounded-[13px] bg-[#C8A96B] px-5 text-[13px] font-bold text-[#123C35] transition hover:bg-[#E4C68F]"><span data-submit-text>Consultar</span><span class="loading-indicator" aria-hidden="true"></span><span aria-hidden="true">→</span></button>
                    </form>
                    <p id="rut-ayuda" class="mt-2.5 text-[11px] leading-5 text-white/60">Consulta la solicitud asociada a tu RUT.</p>
                    @if (session('error'))
                        <div role="alert" class="mt-3 rounded-xl border border-red-200/35 bg-red-950/35 px-3 py-2.5 text-xs font-medium text-white">{{ session('error') }}</div>
                    @endif
                    @error('rut')
                        <div role="alert" class="mt-3 rounded-xl border border-red-200/35 bg-red-950/35 px-3 py-2.5 text-xs font-medium text-white">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </section>

        @if (session('consulta_success'))
            <div role="status" class="mt-4 rounded-[16px] border border-[#A8D5BE] bg-[#E5F2E9] px-4 py-3 text-[13px] font-medium text-[#17513F]">{{ session('consulta_success') }}</div>
        @endif

        @isset($cliente)
            {{-- Resumen ejecutivo del proceso: identidad + etapa actual + porcentaje --}}
            <section id="resumen" data-reveal class="entry-delay mt-4 overflow-hidden rounded-[22px] border border-[#123C35]/10 bg-[#FFFDF9] soft-shadow sm:rounded-[24px]">
                <div class="grid divide-y divide-[#123C35]/10 lg:grid-cols-[1fr_1.02fr_210px] lg:divide-x lg:divide-y-0">
                    <div class="px-5 py-5 sm:px-7 sm:py-6">
                        <p class="text-[10px] font-bold uppercase tracking-[.19em] text-[#2F7566]">Solicitud consultada</p>
                        <h2 class="mt-2 break-words text-[24px] font-semibold leading-tight tracking-[-.055em] sm:text-[28px]">{{ $cliente->nombre }} {{ $cliente->apellido }}</h2>
                        <p class="mt-2 text-xs font-medium text-[#123C35]/55">RUT · {{ $cliente->rut }}</p>
                        <div class="mt-4 inline-flex items-center gap-2 rounded-full border border-[#123C35]/10 bg-[#F1F4EF] px-3 py-1.5 text-[11px] font-semibold text-[#1B594D]">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#2F7566]"></span>
                            {{ $totalEtapas }} {{ $totalEtapas === 1 ? 'etapa registrada' : 'etapas registradas' }}
                        </div>
                    </div>
                    <div class="px-5 py-5 sm:px-7 sm:py-6">
                        <p class="text-[10px] font-bold uppercase tracking-[.19em] text-[#2F7566]">Estado de tu trámite</p>
                        @if ($etapaActual)
                            <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-[#E8EFE8] px-3 py-1.5 text-[11px] font-semibold text-[#1B594D]"><span class="h-1.5 w-1.5 animate-pulse rounded-full bg-[#2F7566]"></span> En curso · Etapa {{ $etapaActual->orden ?? ($procesos->search($etapaActual) + 1) }} de {{ $totalEtapas }}</div>
                            <h3 class="mt-3 text-[20px] font-semibold leading-[1.25] tracking-[-.045em]">{{ $etapaActual->titulo }}</h3>
                            <p class="mt-2 line-clamp-2 text-[12px] leading-5 text-[#123C35]/60">{{ filled($etapaActual->descripcion) ? $etapaActual->descripcion : 'Pronto encontrarás aquí nuevas actualizaciones.' }}</p>
                        @elseif ($totalEtapas > 0 && $etapasCompletadas === $totalEtapas)
                            <h3 class="mt-3 text-[20px] font-semibold tracking-[-.04em]">Solicitud completada</h3>
                            <p class="mt-2 text-[12px] leading-5 text-[#123C35]/60">Todas las etapas registradas han finalizado.</p>
                        @else
                            <h3 class="mt-3 text-[20px] font-semibold tracking-[-.04em]">En seguimiento</h3>
                            <p class="mt-2 text-[12px] leading-5 text-[#123C35]/60">Revisa el detalle de las etapas a continuación.</p>
                        @endif
                    </div>
                    <div class="flex items-center gap-5 px-5 py-5 sm:px-7 lg:flex-col lg:justify-center lg:gap-2 lg:text-center">
                        <div class="progress-orbit flex h-[98px] w-[98px] shrink-0 items-center justify-center rounded-full p-[8px]" style="--pct: {{ $progreso }};" data-progress="{{ $progreso }}" role="img" aria-label="{{ $progreso }} por ciento completado">
                            <div class="flex h-full w-full flex-col items-center justify-center rounded-full bg-[#FFFDF9]"><span data-progress-number class="text-[23px] font-bold tracking-[-.07em]">{{ $progreso }}%</span></div>
                        </div>
                        <div><p class="text-[12px] font-semibold">Progreso general</p><p class="mt-1 text-[11px] text-[#123C35]/55">{{ $etapasCompletadas }} de {{ $totalEtapas }} completadas</p></div>
                    </div>
                </div>
            </section>

            {{-- Novedades personalizadas usando fechas y cambios reales de las etapas. --}}
            <section id="novedades" data-reveal class="mt-5 rounded-[22px] border border-[#123C35]/10 bg-[#FFFDF9] p-4 soft-shadow sm:p-5" aria-labelledby="titulo-novedades">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-[13px] bg-[#E6EEE8] text-[#1B594D]" aria-hidden="true">
                            <svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/><path d="M10 21h4"/></svg>
                        </span>
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-[.17em] text-[#2F7566]">Actividad de tu solicitud</p>
                            <h2 id="titulo-novedades" class="mt-0.5 text-[19px] font-semibold tracking-[-.045em]">Últimas novedades</h2>
                        </div>
                    </div>
                    @if ($novedades->isNotEmpty())
                        <span class="rounded-full bg-[#F1F4EF] px-3 py-1.5 text-[10px] font-semibold text-[#1B594D]">{{ $novedades->count() }} {{ $novedades->count() === 1 ? 'movimiento' : 'movimientos' }}</span>
                    @endif
                </div>
                @if ($novedades->isNotEmpty())
                    <ul class="mt-4 grid gap-2.5 md:grid-cols-3">
                        @foreach ($novedades as $novedad)
                            <li class="min-w-0">
                                <a href="#etapa-{{ $novedad['id'] }}" data-update-link class="update-item flex h-full min-h-[115px] flex-col justify-between rounded-[15px] border border-[#123C35]/10 bg-[#F8F7F1] p-3.5 focus-visible:outline-2 focus-visible:outline-[#C8A96B]">
                                    <div>
                                        <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-[#2F7566]"><span class="h-1.5 w-1.5 rounded-full bg-[#C8A96B]"></span> {{ $novedad['tipo'] }}</span>
                                        <p class="mt-1.5 line-clamp-1 text-[13px] font-semibold tracking-[-.025em] text-[#123C35]">{{ $novedad['titulo'] }}</p>
                                        @if ($novedad['detalle'])
                                            <p class="mt-1 line-clamp-2 text-[11px] leading-5 text-[#123C35]/60">{{ $novedad['detalle'] }}</p>
                                        @endif
                                    </div>
                                    <div class="mt-3 flex items-center justify-between text-[10px] text-[#123C35]/50">
                                        <time datetime="{{ $novedad['fecha']->toDateString() }}">{{ $novedad['fecha']->format('d/m/Y') }}</time>
                                        <span class="font-semibold text-[#1B594D]">Ver etapa →</span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <p class="mt-2 text-[10px] leading-5 text-[#123C35]/45">Movimientos registrados en las etapas; no son notificaciones de lectura pendiente.</p>
                @else
                    <div class="mt-4 flex items-center gap-3 rounded-[14px] border border-dashed border-[#123C35]/15 bg-[#F8F7F1] px-4 py-4">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#E6EEE8] text-[#1B594D]" aria-hidden="true">✓</span>
                        <p class="text-[12px] leading-5 text-[#123C35]/65">Aún no hay movimientos registrados. Aquí aparecerán las etapas iniciadas, completadas o actualizadas por el equipo.</p>
                    </div>
                @endif
            </section>

            {{-- Etapas en lista editorial plegable; la actual se muestra expandida --}}
            <div class="mt-7 grid items-start gap-5 lg:grid-cols-[minmax(0,1fr)_286px]">
                <section id="etapas" data-reveal aria-labelledby="titulo-etapas" class="min-w-0">
                    <div class="mb-4 flex flex-wrap items-end justify-between gap-3">
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-[.19em] text-[#2F7566]">Historial de solicitud</p>
                            <h2 id="titulo-etapas" class="mt-1.5 text-[27px] font-semibold tracking-[-.06em] sm:text-[31px]">Tu proceso, paso a paso.</h2>
                        </div>
                        <span class="rounded-full border border-[#123C35]/12 bg-[#FFFDF9] px-3 py-2 text-[11px] font-medium text-[#123C35]/60">{{ $totalEtapas }} etapas</span>
                    </div>
                    <div class="relative space-y-2.5">
                        @forelse ($procesos as $indice => $proceso)
                            @php
                                $estado = mb_strtolower(trim($proceso->estado ?? ''));
                                $esCompletado = in_array($estado, $estadosCompletados);
                                $esActual = in_array($estado, $estadosActuales);
                                $numeroEtapa = $proceso->orden ?? ($indice + 1);
                                $estadoLabel = $esCompletado ? 'Completada' : ($esActual ? 'En curso' : (in_array($estado, ['pendiente','en espera','']) ? 'Pendiente' : ucfirst($proceso->estado ?? 'Pendiente')));
                            @endphp
                            <details id="etapa-{{ $proceso->id }}" class="stage-card group overflow-hidden rounded-[18px] border {{ $esActual ? 'border-[#2F7566]/40 bg-[#F7FAF6]' : ($esCompletado ? 'border-[#C4D9CB] bg-[#FFFDF9]' : 'border-[#123C35]/10 bg-[#FFFDF9]') }}" @if($esActual) open @endif>
                                <summary class="flex cursor-pointer list-none items-center gap-3 p-3.5 focus-visible:outline-2 focus-visible:outline-offset-[-3px] focus-visible:outline-[#2F7566] sm:gap-4 sm:px-5 sm:py-4 [&::-webkit-details-marker]:hidden">
                                    <div class="flex h-[39px] w-[39px] shrink-0 items-center justify-center rounded-[13px] text-[12px] font-bold {{ $esCompletado ? 'bg-[#DCEBE1] text-[#1B594D]' : ($esActual ? 'bg-[#123C35] text-white' : 'bg-[#F1EEE7] text-[#123C35]/45') }}" aria-hidden="true">
                                        @if ($esCompletado)
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 4 4L19 6"/></svg>
                                        @else
                                            {{ str_pad((string) $numeroEtapa, 2, '0', STR_PAD_LEFT) }}
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-[10px] font-medium uppercase tracking-[.12em] text-[#123C35]/40">Etapa {{ $numeroEtapa }}</p>
                                        <h3 class="mt-1 break-words text-[14px] font-semibold leading-5 tracking-[-.025em] sm:text-[15px]">{{ $proceso->titulo }}</h3>
                                    </div>
                                    <span class="hidden shrink-0 rounded-full px-3 py-1.5 text-[10px] font-bold sm:inline-flex {{ $esCompletado ? 'bg-[#E5F1E8] text-[#246349]' : ($esActual ? 'bg-[#DCEBE1] text-[#174A3A]' : 'bg-[#F1EEE7] text-[#123C35]/55') }}">{{ $estadoLabel }}</span>
                                    <svg class="stage-chevron h-4 w-4 shrink-0 text-[#123C35]/45" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>
                                </summary>
                                <div class="stage-body border-t border-[#123C35]/[.08] px-4 pb-4 pt-3 sm:px-5">
                                    <div class="mb-2 flex flex-wrap items-center gap-2 sm:hidden"><span class="rounded-full bg-[#E8EFE8] px-2.5 py-1 text-[10px] font-bold text-[#1B594D]">{{ $estadoLabel }}</span></div>
                                    <p class="text-[12px] leading-[1.7] text-[#123C35]/65 sm:text-[13px]">{{ filled($proceso->descripcion) ? $proceso->descripcion : 'Te informaremos aquí cuando haya novedades sobre esta etapa.' }}</p>
                                    @if ($proceso->fecha_inicio || $proceso->fecha_completado || $proceso->updated_at)
                                        <div class="mt-3 flex flex-wrap gap-x-5 gap-y-1.5 text-[10px] font-medium text-[#123C35]/45 sm:text-[11px]">
                                            @if ($proceso->fecha_inicio)
                                                <span>Inicio: {{ \Illuminate\Support\Carbon::parse($proceso->fecha_inicio)->format('d/m/Y') }}</span>
                                            @endif
                                            @if ($proceso->fecha_completado)
                                                <span>Completada: {{ \Illuminate\Support\Carbon::parse($proceso->fecha_completado)->format('d/m/Y') }}</span>
                                            @elseif ($proceso->updated_at)
                                                <span>Última actualización: {{ $proceso->updated_at->format('d/m/Y') }}</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </details>
                        @empty
                            <div class="rounded-[20px] border border-dashed border-[#123C35]/15 bg-[#FFFDF9] px-5 py-10 text-center">
                                <p class="font-semibold">Todavía no hay etapas registradas.</p>
                                <p class="mt-1 text-xs text-[#123C35]/55">Cuando nuestro equipo registre avances, los verás en esta sección.</p>
                            </div>
                        @endforelse
                    </div>
                    <p class="mt-3 text-[11px] text-[#123C35]/45">Selecciona una etapa para ver su descripción y fechas.</p>
                </section>

                {{-- Resumen lateral y contacto; útil sin añadir altura innecesaria --}}
                <aside data-reveal class="space-y-3 lg:sticky lg:top-[90px]" aria-label="Ayuda y resumen">
                    <div class="rounded-[21px] border border-[#123C35]/10 bg-[#FFFDF9] p-5 soft-shadow">
                        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-[13px] bg-[#E6EEE8] text-[#1B594D]" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 7v5l3 2"/><circle cx="12" cy="12" r="9"/></svg></div>
                        <p class="text-[10px] font-bold uppercase tracking-[.17em] text-[#2F7566]">Resumen rápido</p>
                        <h3 class="mt-1.5 text-[18px] font-semibold tracking-[-.04em]">{{ $etapasCompletadas }} etapas completadas</h3>
                        <div class="mt-3 h-2 overflow-hidden rounded-full bg-[#E9E7DF]"><div data-progress-bar="{{ $progreso }}" class="progress-fill h-full rounded-full bg-[#2F7566]" style="width: {{ $progreso }}%"></div></div>
                        <p class="mt-2 text-[11px] text-[#123C35]/55">{{ $totalEtapas - $etapasCompletadas }} {{ $totalEtapas - $etapasCompletadas === 1 ? 'etapa restante' : 'etapas restantes' }}</p>
                    </div>
                    <div class="overflow-hidden rounded-[21px] bg-[#123C35] p-5 text-white">
                        <span class="flex h-10 w-10 items-center justify-center rounded-[13px] bg-white/10 text-[#C8A96B]" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M8 10h8M8 14h5m-8 6 1.8-3.6A8 8 0 1 1 20 14.5"/></svg></span>
                        <h3 class="mt-4 text-[20px] font-semibold tracking-[-.05em]">¿Necesitas ayuda?</h3>
                        <p class="mt-2 text-xs leading-[1.75] text-white/65">Envíanos una consulta sobre tu solicitud. Nuestro equipo podrá revisarla.</p>
                        <button type="button" onclick="abrirModalConsulta()" class="mt-4 flex min-h-[43px] w-full items-center justify-center gap-2 rounded-full bg-[#C8A96B] px-4 text-xs font-bold text-[#123C35] transition hover:bg-[#E4C68F]">Enviar una consulta <span aria-hidden="true">↗</span></button>
                    </div>
                    <a href="{{ url('/') }}" class="flex items-center justify-between rounded-[17px] border border-[#123C35]/10 bg-white/50 px-4 py-3 text-xs font-semibold text-[#123C35] transition hover:bg-white">Volver a Navarro Propiedades <span aria-hidden="true">→</span></a>
                </aside>
            </div>

            {{-- Dock móvil: accesos reales, cómodos con una mano y siempre visibles --}}
            <nav aria-label="Navegación del seguimiento" class="mobile-dock fixed bottom-3 left-3 right-3 z-40 grid grid-cols-4 gap-1 rounded-[22px] border border-white/15 px-2 py-2 text-white lg:hidden">
                <a href="#resumen" data-dock-link class="flex min-h-[52px] flex-col items-center justify-center gap-1 rounded-[14px] text-white/85 transition hover:bg-white/10 focus-visible:bg-white/10">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><path d="M14 17h7M17.5 14v7"/></svg>
                    <span class="text-[10px] font-medium">Resumen</span>
                </a>
                <a href="#novedades" data-dock-link class="flex min-h-[52px] flex-col items-center justify-center gap-1 rounded-[14px] text-white/85 transition hover:bg-white/10 focus-visible:bg-white/10">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/><path d="M10 21h4"/></svg>
                    <span class="text-[10px] font-medium">Novedades</span>
                </a>
                <a href="#etapas" data-dock-link class="flex min-h-[52px] flex-col items-center justify-center gap-1 rounded-[14px] text-white/85 transition hover:bg-white/10 focus-visible:bg-white/10">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m8 7 2 2 4-4M8 17l2 2 4-4"/><path d="M16 8h5M16 18h5"/></svg>
                    <span class="text-[10px] font-medium">Etapas</span>
                </a>
                <button type="button" onclick="abrirModalConsulta()" class="flex min-h-[52px] flex-col items-center justify-center gap-1 rounded-[14px] bg-[#C8A96B] text-[#123C35] transition hover:bg-[#E4C68F]">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 10h8M8 14h5m-8 6 1.8-3.6A8 8 0 1 1 20 14.5"/></svg>
                    <span class="text-[10px] font-bold">Consulta</span>
                </button>
            </nav>

            {{-- Modal nativo accesible; conserva el flujo de consultas del controlador actual --}}
            <dialog id="modalConsulta" aria-labelledby="tituloModal" class="m-auto max-h-[90dvh] w-[calc(100%-2rem)] max-w-[500px] overflow-y-auto rounded-[24px] border border-[#123C35]/10 bg-[#FFFDF9] p-0 text-[#123C35] shadow-[0_32px_85px_rgba(0,0,0,.25)]">
                <div id="sheetHandle" class="flex h-6 cursor-grab items-center justify-center touch-pan-y sm:hidden" aria-hidden="true"><div class="h-1 w-11 rounded-full bg-[#123C35]/20"></div></div>
                <div class="border-b border-[#123C35]/10 px-5 py-5 sm:px-7">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-[.18em] text-[#2F7566]">Atención personalizada</p>
                            <h2 id="tituloModal" class="mt-2 text-[24px] font-semibold tracking-[-.05em]">¿En qué podemos ayudarte?</h2>
                            <p class="mt-2 text-[12px] leading-5 text-[#123C35]/60">Envía tu consulta sobre el proceso. Nuestro equipo la revisará.</p>
                        </div>
                        <button type="button" onclick="cerrarModalConsulta()" aria-label="Cerrar ventana" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#F1EEE7] text-[22px] text-[#123C35]/70 hover:bg-[#E9E4DA]">&times;</button>
                    </div>
                </div>
                <form action="{{ route('seguimiento.consultas.store') }}" method="POST" data-feedback-form class="px-5 py-5 sm:px-7">
                    @csrf
                    <input type="hidden" name="rut" value="{{ $cliente->rut }}">
                    <label for="mensajeConsulta" class="mb-2 block text-[12px] font-semibold">Tu mensaje</label>
                    <textarea id="mensajeConsulta" name="mensaje" rows="5" minlength="5" maxlength="2000" required placeholder="Cuéntanos en qué podemos ayudarte..." class="w-full resize-y rounded-[14px] border border-[#123C35]/20 bg-white px-4 py-3 text-[13px] leading-6 outline-none focus:border-[#2F7566] focus:ring-2 focus:ring-[#2F7566]/15">{{ old('mensaje') }}</textarea>
                    @error('mensaje')
                        <p role="alert" class="mt-2 text-[12px] font-medium text-red-700">{{ $message }}</p>
                    @enderror
                    <div class="mt-4 flex justify-end gap-2.5">
                        <button type="button" onclick="cerrarModalConsulta()" class="rounded-full border border-[#123C35]/15 bg-white px-4 py-2.5 text-[12px] font-semibold">Cancelar</button>
                        <button type="submit" data-loading-label="Enviando..." class="inline-flex min-h-[43px] items-center justify-center gap-2 rounded-full bg-[#123C35] px-5 py-2.5 text-[12px] font-semibold text-white transition hover:bg-[#1B594D]"><span data-submit-text>Enviar consulta</span><span class="loading-indicator" aria-hidden="true"></span><span aria-hidden="true">→</span></button>
                    </div>
                </form>
            </dialog>

            <script>
                function abrirModalConsulta() {
                    const modal = document.getElementById('modalConsulta');
                    if (modal && !modal.open) modal.showModal();
                }
                function cerrarModalConsulta() {
                    const modal = document.getElementById('modalConsulta');
                    if (modal && modal.open) modal.close();
                }
                document.getElementById('modalConsulta')?.addEventListener('click', function (event) {
                    if (event.target === this) this.close();
                });
                @if ($errors->has('mensaje'))
                    window.addEventListener('DOMContentLoaded', abrirModalConsulta);
                @endif
            </script>
        @else
            {{-- Estado inicial sin RUT consultado: útil, sin ilustrar datos reales. --}}
            <section class="mt-4 grid gap-3 md:grid-cols-3">
                <article class="rounded-[20px] border border-[#123C35]/10 bg-[#FFFDF9] p-5 soft-shadow">
                    <span class="text-[11px] font-bold tracking-[.12em] text-[#2F7566]">01 · CONSULTA</span>
                    <h2 class="mt-2 text-[16px] font-semibold tracking-[-.03em]">Ingresa tu RUT</h2>
                    <p class="mt-1.5 text-xs leading-5 text-[#123C35]/60">Utiliza el formulario superior para encontrar tu solicitud.</p>
                </article>
                <article class="rounded-[20px] border border-[#123C35]/10 bg-[#FFFDF9] p-5 soft-shadow">
                    <span class="text-[11px] font-bold tracking-[.12em] text-[#2F7566]">02 · AVANCES</span>
                    <h2 class="mt-2 text-[16px] font-semibold tracking-[-.03em]">Revisa tus etapas</h2>
                    <p class="mt-1.5 text-xs leading-5 text-[#123C35]/60">Consulta el estado y las fechas registradas de tu trámite.</p>
                </article>
                <article class="rounded-[20px] border border-[#123C35]/10 bg-[#FFFDF9] p-5 soft-shadow">
                    <span class="text-[11px] font-bold tracking-[.12em] text-[#2F7566]">03 · CONTACTO</span>
                    <h2 class="mt-2 text-[16px] font-semibold tracking-[-.03em]">Habla con nuestro equipo</h2>
                    <p class="mt-1.5 text-xs leading-5 text-[#123C35]/60">Si tienes una solicitud registrada, podrás enviar consultas al revisarla.</p>
                </article>
            </section>
            <div class="mt-4 flex flex-wrap items-center justify-between gap-3 rounded-[19px] bg-[#E5E7DC] px-5 py-4">
                <p class="text-[12px] font-medium text-[#123C35]/75">¿Necesitas orientación sobre tu proceso inmobiliario?</p>
                <a href="mailto:contacto@navarropropiedades.cl" class="text-[12px] font-bold text-[#1B594D] hover:underline">Escríbenos →</a>
            </div>
        @endisset
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const reveals = document.querySelectorAll('[data-reveal]');
            if (!reduceMotion && 'IntersectionObserver' in window && reveals.length) {
                document.documentElement.classList.add('js-reveal');
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (!entry.isIntersecting) return;
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    });
                }, { threshold: 0.08, rootMargin: '0px 0px 40px 0px' });
                reveals.forEach((element) => observer.observe(element));
            }

            const circle = document.querySelector('[data-progress]');
            const bar = document.querySelector('[data-progress-bar]');
            if (circle && !reduceMotion) {
                const target = Math.max(0, Math.min(100, Number(circle.dataset.progress) || 0));
                const counter = circle.querySelector('[data-progress-number]');
                let animated = false;
                circle.style.setProperty('--pct', '0');
                if (counter) counter.textContent = '0%';
                if (bar) bar.style.width = '0%';
                const animateProgress = () => {
                    if (animated) return;
                    animated = true;
                    const duration = 850;
                    const start = performance.now();
                    const frame = (now) => {
                        const elapsed = Math.min(1, (now - start) / duration);
                        const eased = 1 - Math.pow(1 - elapsed, 3);
                        const amount = target * eased;
                        circle.style.setProperty('--pct', amount.toFixed(2));
                        if (counter) counter.textContent = `${Math.round(amount)}%`;
                        if (elapsed < 1) window.requestAnimationFrame(frame);
                    };
                    if (bar) requestAnimationFrame(() => { bar.style.width = `${target}%`; });
                    requestAnimationFrame(frame);
                };
                if ('IntersectionObserver' in window) {
                    const progressObserver = new IntersectionObserver((entries) => {
                        if (entries.some((entry) => entry.isIntersecting)) {
                            animateProgress();
                            progressObserver.disconnect();
                        }
                    }, { threshold: 0.2 });
                    progressObserver.observe(circle);
                } else animateProgress();
            }

            const dockLinks = [...document.querySelectorAll('[data-dock-link]')];
            if (dockLinks.length) {
                const setActive = (target) => dockLinks.forEach((link) => {
                    const active = link.getAttribute('href') === `#${target}`;
                    link.classList.toggle('is-active', active);
                    if (active) link.setAttribute('aria-current', 'location');
                    else link.removeAttribute('aria-current');
                });
                dockLinks.forEach((link) => link.addEventListener('click', () => setActive(link.hash.slice(1))));
                let checking = false;
                window.addEventListener('scroll', () => {
                    if (checking) return;
                    checking = true;
                    requestAnimationFrame(() => {
                        let active = 'resumen';
                        ['resumen','novedades','etapas'].forEach((id) => {
                            const el = document.getElementById(id);
                            if (el && el.getBoundingClientRect().top <= 190) active = id;
                        });
                        setActive(active);
                        checking = false;
                    });
                }, { passive:true });
                setActive('resumen');
            }

            document.querySelectorAll('[data-update-link]').forEach((link) => {
                link.addEventListener('click', (event) => {
                    const hash = link.getAttribute('href');
                    if (!hash || !hash.startsWith('#')) return;
                    const stage = document.getElementById(hash.slice(1));
                    if (!stage) return;
                    event.preventDefault();
                    stage.open = true;
                    history.replaceState(null, '', hash);
                    stage.scrollIntoView({ behavior: reduceMotion ? 'instant' : 'smooth', block: 'start' });
                    stage.querySelector('summary')?.focus({ preventScroll:true });
                });
            });

            // Cerrar la hoja móvil deslizando hacia abajo desde la pequeña asa superior.
            const sheetHandle = document.getElementById('sheetHandle');
            if (sheetHandle) {
                let touchStart = null;
                sheetHandle.addEventListener('pointerdown', (event) => {
                    if (event.pointerType !== 'touch') return;
                    touchStart = event.clientY;
                    sheetHandle.setPointerCapture(event.pointerId);
                });
                sheetHandle.addEventListener('pointerup', (event) => {
                    if (touchStart !== null && event.clientY - touchStart > 65) cerrarModalConsulta();
                    touchStart = null;
                });
                sheetHandle.addEventListener('pointercancel', () => { touchStart = null; });
            }

            document.querySelectorAll('[data-feedback-form]').forEach((form) => {
                form.addEventListener('submit', () => {
                    if (!form.checkValidity()) return;
                    const button = form.querySelector('button[type="submit"]');
                    if (!button || button.disabled) return;
                    button.disabled = true;
                    button.classList.add('form-loading');
                    const label = button.querySelector('[data-submit-text]');
                    if (label) label.textContent = button.dataset.loadingLabel || 'Enviando...';
                });
            });
        });
    </script>
    <footer class="border-t border-[#123C35]/10 bg-[#FFFDF9]/70">
        <div class="mx-auto flex max-w-[1180px] flex-col justify-between gap-2 px-4 py-5 text-[11px] text-[#123C35]/55 sm:flex-row sm:items-center sm:px-6 lg:px-8">
            <p>© {{ date('Y') }} Navarro Propiedades · Seguimiento de solicitudes</p>
            <div class="flex flex-wrap gap-x-5 gap-y-2"><a href="{{ url('/') }}" class="hover:text-[#123C35]">Inicio</a><a href="mailto:contacto@navarropropiedades.cl" class="hover:text-[#123C35]">Contacto</a><a href="{{ url('/admin/login') }}" class="hover:text-[#123C35]">Acceso al equipo</a></div>
        </div>
    </footer>
</body>
</html>