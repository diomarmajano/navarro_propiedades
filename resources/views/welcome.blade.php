<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Navarro Propiedades</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#F5F0E7',
                        creamDark: '#E9E0D1',
                        emeraldDark: '#123C35',
                        emerald: '#1B594D',
                        emeraldLight: '#2F7566',
                        gold: '#C8A96B',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        .title-font {
            font-family: 'Playfair Display', serif;
        }

        .soft-shadow {
            box-shadow: 0 20px 60px rgba(18, 60, 53, 0.08);
        }

        .service-card {
            transition: all .3s ease;
        }

        .service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(18, 60, 53, 0.12);
        }

        .hero-pattern {
            background-image:
                radial-gradient(circle at 10% 20%,
                    rgba(200, 169, 107, .10) 0,
                    transparent 30%),
                radial-gradient(circle at 90% 80%,
                    rgba(27, 89, 77, .10) 0,
                    transparent 30%);
        }
    </style>
</head>

<body class="bg-cream text-emeraldDark">

    {{-- NAVBAR --}}
    <header class="absolute top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <nav class="flex items-center justify-between h-24">

                {{-- LOGO --}}
                <a href="/" class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-emeraldDark flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M3 10.5L12 3l9 7.5M5 9.5V21h14V9.5M9 21v-6h6v6" />
                        </svg>
                    </div>

                    <div>
                        <span class="block font-bold text-lg tracking-tight">
                            Navarro
                        </span>
                        <span class="block text-xs text-emerald/60 tracking-wider uppercase">
                            Propiedades
                        </span>
                    </div>
                </a>

                {{-- MENU --}}
                <div class="hidden md:flex items-center gap-8 text-sm font-medium">
                    <a href="#servicios" class="hover:text-emeraldLight transition">
                        Servicios
                    </a>

                    <a href="#nosotros" class="hover:text-emeraldLight transition">
                        Nosotros
                    </a>

                    <a href="#contacto" class="hover:text-emeraldLight transition">
                        Contacto
                    </a>
                </div>

                {{-- LOGIN --}}
                <a href="/admin"
                    class="hidden sm:inline-flex items-center px-5 py-2.5 rounded-full
                           border border-emeraldDark/20 hover:bg-emeraldDark hover:text-white
                           transition text-sm font-semibold">
                    Ingresar
                </a>

            </nav>
        </div>
    </header>


    {{-- HERO --}}
    <main>

        <section class="relative min-h-screen flex items-center overflow-hidden hero-pattern">

            {{-- DECORATION --}}
            <div
                class="absolute -top-32 -right-32 w-96 h-96 rounded-full
                        bg-emeraldDark/5 blur-3xl">
            </div>

            <div class="absolute bottom-0 -left-40 w-96 h-96 rounded-full
                        bg-gold/10 blur-3xl">
            </div>

            <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full pt-28 pb-20">

                <div class="grid lg:grid-cols-2 gap-16 items-center">

                    {{-- HERO TEXT --}}
                    <div class="max-w-xl">

                        <div
                            class="inline-flex items-center gap-2 px-4 py-2
                                    rounded-full bg-white/70 border border-emeraldDark/10
                                    text-sm font-medium mb-7">

                            <span class="w-2 h-2 rounded-full bg-gold"></span>

                            Tu próximo hogar comienza aquí
                        </div>

                        <h1
                            class="title-font text-5xl md:text-6xl lg:text-7xl
                                   leading-[1.05] font-semibold mb-7">

                            Encontramos el
                            <span class="text-emeraldLight">
                                lugar
                            </span>

                            <br>

                            que quieres llamar hogar.
                        </h1>

                        <p class="text-lg leading-8 text-emeraldDark/65 max-w-lg mb-9">
                            Te acompañamos durante todo el proceso, desde la búsqueda
                            de tu propiedad hasta la gestión de tu financiamiento.
                        </p>

                        {{-- BOTON PRINCIPAL --}}
                        <a href="#seguimiento"
                            class="group inline-flex items-center gap-4
                                   bg-emeraldDark text-white
                                   px-7 py-4 rounded-2xl
                                   font-semibold
                                   hover:bg-emerald
                                   transition-all duration-300
                                   shadow-xl shadow-emeraldDark/15">

                            <span>
                                Ver avance de mi solicitud
                            </span>

                            <span
                                class="w-9 h-9 rounded-xl bg-white/10
                                       flex items-center justify-center
                                       group-hover:translate-x-1 transition">
                                →
                            </span>

                        </a>

                        <p class="mt-4 text-sm text-emeraldDark/50">
                            Consulta el estado de tu solicitud en cualquier momento.
                        </p>

                    </div>


                    {{-- HERO CARD --}}
                    <div class="relative hidden lg:block">

                        <div
                            class="absolute -top-8 -right-8 w-24 h-24
                                    bg-gold/20 rounded-full blur-2xl">
                        </div>

                        <div class="bg-white rounded-[2rem] p-4 soft-shadow">

                            <div
                                class="relative overflow-hidden rounded-[1.5rem]
                                        h-[530px] bg-emeraldDark">

                                {{-- Imagen de propiedad --}}
                                <div class="absolute inset-0 bg-cover bg-center opacity-75"
                                    style="
                                        background-image:
                                        linear-gradient(
                                            to bottom,
                                            rgba(18,60,53,.05),
                                            rgba(18,60,53,.75)
                                        ),
                                        url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=85');
                                    ">
                                </div>

                                <div class="absolute inset-x-0 bottom-0 p-8 text-white">

                                    <div
                                        class="inline-flex px-3 py-1 rounded-full
                                                bg-white/15 backdrop-blur-md
                                                text-xs mb-4">
                                        Propiedades seleccionadas
                                    </div>

                                    <h2 class="title-font text-3xl mb-2">
                                        Tu nuevo comienzo
                                    </h2>

                                    <p class="text-white/70 text-sm max-w-sm">
                                        Asesoría personalizada para ayudarte a encontrar
                                        la propiedad que necesitas.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </section>


        {{-- SERVICIOS --}}
        <section id="servicios" class="bg-white py-24">

            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                <div class="max-w-2xl mb-14">

                    <span
                        class="text-sm font-semibold text-emeraldLight uppercase
                                 tracking-[.2em]">
                        Nuestros servicios
                    </span>

                    <h2 class="title-font text-4xl md:text-5xl mt-4 mb-5">
                        Todo lo que necesitas,
                        <span class="text-emeraldLight">
                            en un solo lugar.
                        </span>
                    </h2>

                    <p class="text-emeraldDark/60 leading-7">
                        Te acompañamos con soluciones inmobiliarias pensadas
                        para hacer más simple cada etapa de tu proceso.
                    </p>

                </div>


                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">

                    {{-- CARD --}}
                    <div class="service-card bg-cream rounded-3xl p-7">

                        <div
                            class="w-12 h-12 rounded-2xl bg-emeraldDark
                                    text-white flex items-center justify-center mb-6">

                            <x-heroicon-o-user-group class="w-6 h-6" />

                        </div>

                        <h3 class="text-xl font-bold mb-3">
                            Asesoramiento Personalizado
                        </h3>

                        <p class="text-sm leading-6 text-emeraldDark/60">
                            Te orientamos de manera cercana para encontrar
                            la alternativa que mejor se adapte a tus necesidades.
                        </p>

                    </div>


                    {{-- CARD --}}
                    <div class="service-card bg-cream rounded-3xl p-7">

                        <div
                            class="w-12 h-12 rounded-2xl bg-emeraldDark
                                    text-white flex items-center justify-center mb-6">

                            <x-heroicon-o-building-library class="w-6 h-6" />

                        </div>

                        <h3 class="text-xl font-bold mb-3">
                            Gestión Hipotecaria
                        </h3>

                        <p class="text-sm leading-6 text-emeraldDark/60">
                            Te acompañamos en el proceso de financiamiento
                            para que puedas avanzar con mayor tranquilidad.
                        </p>

                    </div>


                    {{-- CARD --}}
                    <div class="service-card bg-cream rounded-3xl p-7">

                        <div
                            class="w-12 h-12 rounded-2xl bg-emeraldDark
                                    text-white flex items-center justify-center mb-6">

                            <x-heroicon-o-home-modern class="w-6 h-6" />

                        </div>

                        <h3 class="text-xl font-bold mb-3">
                            Venta
                        </h3>

                        <p class="text-sm leading-6 text-emeraldDark/60">
                            Gestionamos la venta de tu propiedad buscando
                            que todo el proceso sea claro y eficiente.
                        </p>

                    </div>


                    {{-- CARD --}}
                    <div class="service-card bg-cream rounded-3xl p-7">

                        <div
                            class="w-12 h-12 rounded-2xl bg-emeraldDark
                                    text-white flex items-center justify-center mb-6">

                            <x-heroicon-o-key class="w-6 h-6" />

                        </div>

                        <h3 class="text-xl font-bold mb-3">
                            Arriendo
                        </h3>

                        <p class="text-sm leading-6 text-emeraldDark/60">
                            Encuentra una propiedad para arrendar con
                            acompañamiento durante todo el proceso.
                        </p>

                    </div>


                    {{-- CARD --}}
                    <div
                        class="service-card bg-emeraldDark text-white
                                rounded-3xl p-7 lg:col-span-2">

                        <div
                            class="flex flex-col md:flex-row
                                    md:items-center md:justify-between gap-8">

                            <div>

                                <div
                                    class="w-12 h-12 rounded-2xl
                                            bg-white/10
                                            flex items-center justify-center mb-6">

                                    <x-heroicon-o-sparkles class="w-6 h-6" />

                                </div>

                                <h3 class="text-2xl font-bold mb-3">
                                    Bono Pie
                                </h3>

                                <p class="text-sm leading-6 text-white/60 max-w-lg">
                                    Conoce alternativas y opciones relacionadas
                                    al Bono Pie y recibe orientación durante
                                    tu proceso de compra.
                                </p>

                            </div>

                            <div class="text-6xl opacity-10">
                                %
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- SEGUIMIENTO --}}
        <section id="seguimiento" class="py-24 bg-cream">

            <div class="max-w-5xl mx-auto px-6 lg:px-8">

                <div
                    class="relative overflow-hidden rounded-[2rem]
                            bg-emeraldDark text-white p-8 md:p-14">

                    <div
                        class="absolute -right-20 -top-20
                                w-72 h-72 rounded-full
                                border-[40px] border-white/5">
                    </div>

                    <div class="relative grid md:grid-cols-2 gap-10 items-center">

                        <div>

                            <span
                                class="inline-flex px-3 py-1 rounded-full
                                         bg-white/10 text-xs font-medium mb-5">
                                Seguimiento
                            </span>

                            <h2 class="title-font text-4xl md:text-5xl mb-5">
                                ¿Quieres saber cómo va tu solicitud?
                            </h2>

                            <p class="text-white/65 leading-7">
                                Revisa de forma rápida y sencilla el avance
                                de tu solicitud y mantente informado de cada etapa.
                            </p>

                        </div>


                        {{-- FORMULARIO --}}
                        <div class="bg-white/10 backdrop-blur-sm
                                    rounded-3xl p-6">

                            <form method="post" class="space-y-4" action="{{ route('seguimiento.buscar') }}">

                                <div>

                                    <label for="codigo"
                                        class="block text-sm font-medium
                                               text-white/80 mb-2">
                                        Código de solicitud
                                    </label>

                                    <input id="rut" name="rut" type="text"
                                        placeholder="Ej: 12.345.678-9" required
                                        class="w-full rounded-2xl
                                               bg-white/10 border border-white/15
                                               px-4 py-3.5
                                               text-white placeholder:text-white/30
                                               outline-none
                                               focus:border-white/50
                                               focus:ring-2
                                               focus:ring-white/10">

                                </div>

                                <button type="submit"
                                    class="w-full bg-white text-emeraldDark
                                           rounded-2xl py-3.5
                                           font-bold
                                           hover:bg-cream
                                           transition">
                                    Consultar mi solicitud →
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- NOSOTROS --}}
        <section id="nosotros" class="bg-white py-24">

            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                <div class="grid lg:grid-cols-2 gap-16 items-center">

                    <div>

                        <span
                            class="text-sm font-semibold text-emeraldLight
                                     uppercase tracking-[.2em]">
                            Estamos para ayudarte
                        </span>

                        <h2 class="title-font text-4xl md:text-5xl mt-4 mb-6">
                            Una experiencia inmobiliaria
                            <span class="text-emeraldLight">
                                más simple.
                            </span>
                        </h2>

                        <p class="text-emeraldDark/60 leading-8 mb-7">
                            Creemos que comprar, vender o arrendar una propiedad
                            no debería ser un proceso complicado. Por eso,
                            combinamos asesoría personalizada, tecnología y
                            acompañamiento durante todo el camino.
                        </p>

                        <a href="#contacto"
                            class="inline-flex items-center gap-3
                                   font-bold text-emeraldDark
                                   hover:text-emeraldLight transition">
                            Hablemos de tu proyecto
                            <span>→</span>
                        </a>

                    </div>


                    <div class="grid grid-cols-2 gap-4">

                        <div
                            class="bg-cream rounded-3xl p-7 h-48
                                    flex flex-col justify-end">

                            <span class="text-4xl font-bold text-emeraldDark">
                                01
                            </span>

                            <span class="mt-2 text-sm text-emeraldDark/60">
                                Te escuchamos
                            </span>

                        </div>

                        <div
                            class="bg-emeraldDark text-white rounded-3xl p-7 h-48
                                    flex flex-col justify-end">

                            <span class="text-4xl font-bold">
                                02
                            </span>

                            <span class="mt-2 text-sm text-white/60">
                                Te asesoramos
                            </span>

                        </div>

                        <div
                            class="bg-emeraldDark text-white rounded-3xl p-7 h-48
                                    flex flex-col justify-end">

                            <span class="text-4xl font-bold">
                                03
                            </span>

                            <span class="mt-2 text-sm text-white/60">
                                Te acompañamos
                            </span>

                        </div>

                        <div
                            class="bg-cream rounded-3xl p-7 h-48
                                    flex flex-col justify-end">

                            <span class="text-4xl font-bold text-emeraldDark">
                                04
                            </span>

                            <span class="mt-2 text-sm text-emeraldDark/60">
                                Llegamos juntos
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>


    {{-- FOOTER --}}
    <footer id="contacto" class="bg-emeraldDark text-white">

        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-14">

            <div class="grid md:grid-cols-3 gap-10">

                <div>

                    <div class="flex items-center gap-3 mb-5">

                        <div
                            class="w-10 h-10 rounded-xl bg-white/10
                                    flex items-center justify-center">
                            <x-heroicon-o-home-modern class="w-6 h-6" />
                        </div>

                        <div>
                            <span class="block font-bold">
                                Navarro
                            </span>

                            <span class="text-xs text-white/40">
                                PROPIEDADES
                            </span>
                        </div>

                    </div>

                    <p class="text-sm text-white/50 leading-6 max-w-sm">
                        Soluciones inmobiliarias pensadas para acompañarte
                        en cada etapa de tu proyecto.
                    </p>

                </div>


                <div>

                    <h4 class="font-bold mb-5">
                        Servicios
                    </h4>

                    <ul class="space-y-3 text-sm text-white/50">

                        <li>
                            Asesoramiento Personalizado
                        </li>

                        <li>
                            Gestión Hipotecaria
                        </li>

                        <li>
                            Venta
                        </li>

                        <li>
                            Arriendo
                        </li>

                        <li>
                            Bono Pie
                        </li>

                    </ul>

                </div>


                <div>

                    <h4 class="font-bold mb-5">
                        Contacto
                    </h4>

                    <div class="space-y-3 text-sm text-white/50">

                        <p>
                            contacto@navarropropiedades.cl
                        </p>

                        <p>
                            Santiago, Chile
                        </p>

                        <a href="https://www.instagram.com/propiedadesnavarro3" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 transition-colors
                            hover:text-white">

                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round">

                                <rect width="20" height="20" x="2" y="2" rx="5" />
                                <circle cx="12" cy="12" r="4" />
                                <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none" />

                            </svg>

                            <span>Instagram</span>

                        </a>

                    </div>

                </div>

            </div>


            <div
                class="border-t border-white/10 mt-12 pt-7
                        flex flex-col md:flex-row
                        justify-between gap-3
                        text-xs text-white/30">

                <span>
                    © {{ date('Y') }} Navarro Propiedades.
                </span>

                <span>
                    Todos los derechos reservados.
                </span>

            </div>

        </div>

    </footer>

</body>

</html>
