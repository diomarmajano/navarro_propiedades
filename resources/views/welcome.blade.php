<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#F5F0E7">
    <meta name="description" content="Navarro Propiedades. Asesoría inmobiliaria, gestión hipotecaria, venta y arriendo de propiedades, con seguimiento de solicitudes en línea.">
    <title>Navarro Propiedades | Tu próximo paso comienza aquí</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;450;500;550;600;650;700;750&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --ink: #123C35; --green: #1B594D; --light-green: #2F7566; --cream: #F5F0E7; --gold: #C8A96B; }
        html { scroll-behavior: smooth; scroll-padding-top: 96px; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        .premium-glass { background: rgba(255, 253, 249, .89); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }
        .hero-photo { background: #244a3d; }
        .hero-photo::after { content: ''; position: absolute; inset: 0; pointer-events: none; background: linear-gradient(180deg,rgba(10,36,29,.01) 10%,rgba(10,36,29,.14) 45%,rgba(10,36,29,.72) 100%); }
        .smooth-card { transition: transform .3s cubic-bezier(.2,.8,.2,1), box-shadow .3s ease, border-color .3s ease; }
        .smooth-card:hover { transform: translateY(-3px); box-shadow: 0 16px 42px rgba(18,60,53,.09); }
        .soft-border { border-color: rgba(18,60,53,.10); }
        .premium-shadow { box-shadow: 0 22px 65px rgba(18,60,53,.12), 0 4px 14px rgba(18,60,53,.04); }
        .intro-one { animation: enter .65s both; }
        .intro-two { animation: enter .7s .12s both; }
        .intro-three { animation: enter .7s .22s both; }
        @keyframes enter { from { opacity:0; transform:translateY(13px); } to { opacity:1; transform:translateY(0); } }
        @media (prefers-reduced-motion: reduce) { html { scroll-behavior: auto; } .intro-one,.intro-two,.intro-three { animation:none; } .smooth-card { transition:none; } }
    </style>
</head>
<body class="min-h-screen bg-[#F5F0E7] text-[#123C35] antialiased selection:bg-[#C8A96B]/35">
    <!-- Navegación compacta y siempre visible en móviles -->
    <header class="premium-glass sticky top-0 z-50 border-b border-[#123C35]/10">
        <div class="mx-auto flex h-[72px] max-w-[1240px] items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="flex min-w-0 items-center gap-2.5" aria-label="Navarro Propiedades, ir al inicio">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-[14px] bg-[#123C35] text-white">
                    <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3.5 10 8.5-7 8.5 7"/><path d="M5.5 9.5V20h13V9.5"/><path d="M10 20v-6h4v6"/></svg>
                </span>
                <span class="min-w-0 leading-tight">
                    <span class="block truncate text-[15px] font-bold tracking-[-.04em] sm:text-base">Navarro</span>
                    <span class="block text-[10px] font-semibold uppercase tracking-[.2em] text-[#2F7566]">Propiedades</span>
                </span>
            </a>

            <nav class="hidden items-center gap-7 text-[13px] font-medium text-[#123C35]/75 md:flex" aria-label="Navegación principal">
                <a href="#servicios" class="transition hover:text-[#2F7566]">Servicios</a>
                <a href="#acompanamiento" class="transition hover:text-[#2F7566]">Cómo trabajamos</a>
                <a href="#contacto" class="transition hover:text-[#2F7566]">Contacto</a>
            </nav>

            <div class="flex shrink-0 items-center gap-2 sm:gap-3">
                <a href="#consulta" class="hidden rounded-full bg-[#123C35] px-4 py-2.5 text-[13px] font-semibold text-white transition hover:bg-[#1B594D] sm:inline-flex">Consultar solicitud <span class="ml-2" aria-hidden="true">↗</span></a>
                <a href="{{ url('/admin/login') }}" class="inline-flex items-center justify-center rounded-full border border-[#123C35]/20 bg-white/75 px-3.5 py-2.5 text-xs font-semibold text-[#123C35] transition hover:border-[#123C35]/40 hover:bg-white sm:px-5 sm:text-[13px]">Ingresar</a>
            </div>
        </div>
    </header>

    <main>
        <!-- Hero editorial compacto: fotografía real + previsualización conceptual -->
        <section class="mx-auto max-w-[1240px] px-4 pb-5 pt-7 sm:px-6 lg:px-8 lg:pt-9">
            <div class="grid items-stretch gap-5 lg:grid-cols-[.97fr_1.03fr] lg:gap-7">
                <div class="intro-one flex flex-col justify-center rounded-[28px] border border-[#123C35]/5 bg-[#FFFDF9]/45 px-5 py-8 sm:px-9 lg:min-h-[435px] lg:px-10 lg:py-9">
                    <div class="mb-5 inline-flex w-fit items-center gap-2 rounded-full border border-[#123C35]/10 bg-white/80 px-3 py-1.5 text-[10px] font-semibold uppercase tracking-[.14em] text-[#1B594D] sm:text-[11px]">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#C8A96B]"></span>
                        Asesoría inmobiliaria · Chile
                    </div>
                    <h1 class="max-w-[575px] text-[clamp(2.75rem,4.6vw,4.7rem)] font-semibold leading-[1.06] tracking-[-.072em]">
                        Cada hogar tiene <span class="text-[#2F7566]">una historia.</span> Hagamos la tuya.
                    </h1>
                    <p class="mt-5 max-w-[465px] text-[14px] leading-[1.75] text-[#123C35]/65 sm:text-[15px]">
                        Te acompañamos en la compra, venta y financiamiento de tu propiedad, con orientación cercana y cada paso más claro.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-2.5">
                        <a href="#servicios" class="inline-flex min-h-11 items-center justify-center gap-3 rounded-full bg-[#123C35] px-5 py-3 text-[13px] font-semibold text-white transition hover:bg-[#1B594D]">
                            Conoce nuestros servicios <span aria-hidden="true">↗</span>
                        </a>
                        <a href="#consulta" class="inline-flex min-h-11 items-center justify-center rounded-full border border-[#123C35]/15 bg-white/75 px-5 py-3 text-[13px] font-semibold transition hover:bg-white">Ver mi solicitud</a>
                    </div>
                    <div class="mt-7 flex flex-wrap items-center gap-x-3 gap-y-2 border-t border-[#123C35]/10 pt-4 text-[11px] font-medium text-[#123C35]/55 sm:text-xs">
                        <span class="text-[#2F7566]">Compra</span><span class="h-1 w-1 rounded-full bg-[#C8A96B]"></span>
                        <span>Venta</span><span class="h-1 w-1 rounded-full bg-[#C8A96B]"></span>
                        <span>Arriendo</span><span class="h-1 w-1 rounded-full bg-[#C8A96B]"></span>
                        <span>Gestión hipotecaria</span>
                    </div>
                </div>

                <div class="intro-two hero-photo premium-shadow relative min-h-[390px] overflow-hidden rounded-[28px] sm:min-h-[455px]">
                    <!-- Fotografía que ya utiliza el proyecto actual -->
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&amp;fit=crop&amp;w=1400&amp;q=85"
                         alt="Interior contemporáneo y luminoso de una vivienda" class="absolute inset-0 h-full w-full object-cover" fetchpriority="high">
                    <div class="absolute right-5 top-5 z-10 rounded-full border border-white/35 bg-black/15 px-3 py-1.5 text-[10px] font-semibold uppercase tracking-[.17em] text-white backdrop-blur-md">Un nuevo comienzo</div>

                    <div class="absolute bottom-5 left-5 z-10 max-w-[230px] text-white sm:bottom-7 sm:left-7 sm:max-w-[280px]">
                        <span class="text-[10px] font-semibold uppercase tracking-[.18em] text-white/75">Navarro Propiedades</span>
                        <h2 class="mt-1.5 text-[24px] font-semibold leading-[1.17] tracking-[-.045em] sm:text-[29px]">Un lugar para todo lo que viene.</h2>
                    </div>
                </div>
            </div>
        </section>

        <!-- Consulta de RUT protagonista, sin otra página entre medio -->
        <section id="consulta" class="mx-auto max-w-[1240px] scroll-mt-24 px-4 pb-6 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-[26px] bg-[#123C35] p-5 text-white sm:p-6 lg:px-9 lg:py-7">
                <div class="pointer-events-none absolute -right-16 -top-20 h-52 w-52 rounded-full border-[30px] border-white/[.035]"></div>
                <div class="relative grid items-center gap-5 lg:grid-cols-[.8fr_1.2fr] lg:gap-8">
                    <div>
                        <div class="inline-flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[.17em] text-[#DCC494]"><span class="h-1.5 w-1.5 rounded-full bg-[#C8A96B]"></span> Seguimiento en línea</div>
                        <h2 class="mt-2 text-[25px] font-semibold leading-[1.18] tracking-[-.045em] sm:text-[29px]">¿Cómo va tu solicitud?</h2>
                        <p class="mt-2 max-w-[390px] text-[13px] leading-6 text-white/65">Ingresa tu RUT y revisa las etapas de tu trámite.</p>
                    </div>
                    <div>
                        <form action="{{ route('seguimiento.buscar') }}" method="POST" class="grid gap-2 sm:grid-cols-[1fr_auto]" aria-label="Consultar estado de solicitud">
                            @csrf
                            <label for="rut-busqueda" class="sr-only">RUT de la solicitud</label>
                            <input id="rut-busqueda" name="rut" type="text" inputmode="text" autocomplete="off" required maxlength="20"
                                   value="{{ old('rut') }}" placeholder="Ingresa tu RUT · 12.345.678-9"
                                   aria-describedby="rut-help"
                                   class="min-h-[52px] w-full min-w-0 rounded-[15px] border border-white/30 bg-white px-4 text-[13px] font-medium text-[#123C35] outline-none placeholder:text-[#123C35]/40 focus:border-[#C8A96B] focus:ring-2 focus:ring-[#C8A96B]/35">
                            <button class="inline-flex min-h-[52px] items-center justify-center gap-3 rounded-[15px] bg-[#C8A96B] px-5 text-[13px] font-bold text-[#123C35] transition hover:bg-[#E0C184] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white" type="submit">Consultar avance <span aria-hidden="true">→</span></button>
                        </form>
                        <p id="rut-help" class="mt-2.5 text-[11px] leading-5 text-white/55">Solo para clientes con una solicitud registrada. No compartas información privada en el formulario.</p>
                        @if (session('error'))
                            <div role="alert" class="mt-3 rounded-xl border border-red-200/30 bg-red-950/35 px-3 py-2.5 text-xs font-medium text-red-100">{{ session('error') }}</div>
                        @endif
                        @error('rut')
                            <div role="alert" class="mt-3 rounded-xl border border-red-200/30 bg-red-950/35 px-3 py-2.5 text-xs font-medium text-red-100">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </section>

        <!-- Servicios: bento compacto en vez de tarjetas grandes y separadas -->
        <section id="servicios" class="mx-auto max-w-[1240px] scroll-mt-24 px-4 pb-7 pt-4 sm:px-6 lg:px-8 lg:pb-10">
            <div class="mb-5 flex flex-wrap items-end justify-between gap-2">
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-[.2em] text-[#2F7566]">Lo que hacemos</p>
                    <h2 class="mt-1.5 text-[29px] font-semibold tracking-[-.055em] sm:text-[35px]">Tu proyecto, bien acompañado.</h2>
                </div>
                <p class="max-w-[315px] text-[12px] leading-5 text-[#123C35]/60 sm:text-right">Soluciones inmobiliarias conectadas, de la primera conversación al siguiente paso.</p>
            </div>
            <div class="grid gap-3 md:grid-cols-6">
                <article class="smooth-card rounded-[22px] border soft-border bg-[#FFFDF9] p-5 sm:p-6 md:col-span-3">
                    <div class="flex items-start justify-between gap-4">
                        <span class="flex h-10 w-10 items-center justify-center rounded-[14px] bg-[#E6EEE8] text-[#1B594D]"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                        <span class="text-[11px] font-semibold text-[#123C35]/30">01</span>
                    </div>
                    <h3 class="mt-4 text-[17px] font-semibold tracking-[-.035em]">Asesoramiento personalizado</h3>
                    <p class="mt-1.5 max-w-md text-[13px] leading-[1.65] text-[#123C35]/60">Te escuchamos y encontramos alternativas ajustadas a tus objetivos y necesidades.</p>
                </article>
                <article class="smooth-card rounded-[22px] bg-[#1B594D] p-5 text-white sm:p-6 md:col-span-3">
                    <div class="flex items-start justify-between gap-4">
                        <span class="flex h-10 w-10 items-center justify-center rounded-[14px] bg-white/10 text-[#E6D3A8]"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 10h18M5 10v9M10 10v9M14 10v9M19 10v9M3 19h18M2 10l10-7 10 7"/></svg></span>
                        <span class="text-[11px] font-semibold text-white/40">02</span>
                    </div>
                    <h3 class="mt-4 text-[17px] font-semibold tracking-[-.035em]">Gestión hipotecaria</h3>
                    <p class="mt-1.5 max-w-md text-[13px] leading-[1.65] text-white/65">Orientación y acompañamiento durante las distintas etapas de tu financiamiento.</p>
                </article>
                <article class="smooth-card rounded-[22px] border soft-border bg-[#FFFDF9] p-5 md:col-span-2">
                    <div class="flex items-start justify-between gap-3"><span class="flex h-9 w-9 items-center justify-center rounded-[13px] bg-[#E6EEE8] text-[#1B594D]"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 10 9-7 9 7v11H3V10Z"/><path d="M9 21v-7h6v7"/></svg></span><span class="text-[11px] text-[#123C35]/30">03</span></div>
                    <h3 class="mt-3 text-base font-semibold tracking-tight">Venta de propiedades</h3>
                    <p class="mt-1.5 text-xs leading-[1.7] text-[#123C35]/60">Gestionamos la venta con claridad y acompañamiento.</p>
                </article>
                <article class="smooth-card rounded-[22px] border soft-border bg-[#FFFDF9] p-5 md:col-span-2">
                    <div class="flex items-start justify-between gap-3"><span class="flex h-9 w-9 items-center justify-center rounded-[13px] bg-[#E6EEE8] text-[#1B594D]"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="8" cy="15" r="4"/><path d="m10.5 12.5 9-9 2 2-9 9M17 6l2 2"/></svg></span><span class="text-[11px] text-[#123C35]/30">04</span></div>
                    <h3 class="mt-3 text-base font-semibold tracking-tight">Arriendo</h3>
                    <p class="mt-1.5 text-xs leading-[1.7] text-[#123C35]/60">Opciones para encontrar el espacio que necesitas.</p>
                </article>
                <article class="smooth-card rounded-[22px] border border-[#C8A96B]/30 bg-[#EBE2D0] p-5 md:col-span-2">
                    <div class="flex items-start justify-between gap-3"><span class="flex h-9 w-9 items-center justify-center rounded-[13px] bg-[#123C35] text-[#DCC494]"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2v20M17 6.5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></span><span class="text-[11px] text-[#123C35]/40">05</span></div>
                    <h3 class="mt-3 text-base font-semibold tracking-tight">Bono Pie</h3>
                    <p class="mt-1.5 text-xs leading-[1.7] text-[#123C35]/65">Conoce alternativas y recibe orientación para tu compra.</p>
                </article>
            </div>
        </section>

        <!-- Manera de trabajar, compacto y sin estadísticas inventadas -->
        <section id="acompanamiento" class="mx-auto max-w-[1240px] scroll-mt-24 px-4 pb-9 sm:px-6 lg:px-8 lg:pb-12">
            <div class="grid gap-4 rounded-[24px] border border-[#123C35]/10 bg-[#FFFDF9] px-5 py-6 md:grid-cols-[.8fr_1.2fr] md:items-center md:gap-8 md:px-8">
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-[.19em] text-[#2F7566]">Una experiencia más simple</p>
                    <h2 class="mt-2 max-w-sm text-[26px] font-semibold leading-[1.18] tracking-[-.05em] sm:text-[30px]">Cercanía y claridad en cada etapa.</h2>
                </div>
                <div class="grid grid-cols-3 gap-2 sm:gap-4">
                    <div class="border-l border-[#123C35]/12 pl-3 sm:pl-4"><span class="text-[12px] font-bold text-[#2F7566]">01</span><p class="mt-2 text-[12px] font-semibold sm:text-[13px]">Te escuchamos</p><p class="mt-1 text-[10px] leading-4 text-[#123C35]/55 sm:text-xs">Conocemos tu objetivo.</p></div>
                    <div class="border-l border-[#123C35]/12 pl-3 sm:pl-4"><span class="text-[12px] font-bold text-[#2F7566]">02</span><p class="mt-2 text-[12px] font-semibold sm:text-[13px]">Te orientamos</p><p class="mt-1 text-[10px] leading-4 text-[#123C35]/55 sm:text-xs">Exploramos opciones.</p></div>
                    <div class="border-l border-[#123C35]/12 pl-3 sm:pl-4"><span class="text-[12px] font-bold text-[#2F7566]">03</span><p class="mt-2 text-[12px] font-semibold sm:text-[13px]">Te acompañamos</p><p class="mt-1 text-[10px] leading-4 text-[#123C35]/55 sm:text-xs">Avanzamos contigo.</p></div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer breve y útil -->
    <footer id="contacto" class="bg-[#123C35] text-white">
        <div class="mx-auto grid max-w-[1240px] gap-6 px-4 py-7 sm:px-6 md:grid-cols-[1fr_auto] md:items-center lg:px-8">
            <div>
                <div class="text-base font-bold tracking-[-.045em]">Navarro <span class="font-medium text-white/55">Propiedades</span></div>
                <p class="mt-1 text-xs text-white/55">Acompañándote en tu próximo comienzo. Santiago, Chile.</p>
            </div>
            <div class="flex flex-wrap gap-x-5 gap-y-2 text-xs text-white/75">
                <a class="transition hover:text-white" href="mailto:contacto@navarropropiedades.cl">contacto@navarropropiedades.cl</a>
                <a class="transition hover:text-white" href="https://www.instagram.com/propiedadesnavarro3" target="_blank" rel="noopener noreferrer">Instagram ↗</a>
                <a class="transition hover:text-white" href="{{ url('/admin/login') }}">Acceso al equipo ↗</a>
            </div>
        </div>
        <div class="border-t border-white/10 px-4 py-3 text-center text-[10px] text-white/40">© {{ date('Y') }} Navarro Propiedades. Todos los derechos reservados.</div>
    </footer>

    <!-- Cuando el POST regresa con errores, muestra el formulario sin obligar a buscarlo. -->
    @if (session('error') || $errors->has('rut'))
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                const area = document.getElementById('consulta');
                if (area) area.scrollIntoView({ behavior: 'auto', block: 'center' });
            });
        </script>
    @endif
</body>
</html>