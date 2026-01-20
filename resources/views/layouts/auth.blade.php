<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Ikan Bakar Nusantara') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .glass-target {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .bg-auth {
            background-image: url('/images/auth_bg.png');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8 bg-auth relative">
    <!-- Overlay for better readability -->
    <div class="absolute inset-0 bg-black/40 z-0"></div>

    <div
        class="relative z-10 w-full {{ $width ?? 'max-w-5xl' }} flex flex-col md:flex-row shadow-2xl rounded-3xl overflow-hidden bg-white/10 backdrop-blur-md">
        <!-- Brand/Left Side -->
        @if (!isset($single_panel) || !$single_panel)
            <div
                class="hidden md:flex md:w-5/12 bg-orange-600/20 items-center justify-center p-8 lg:p-12 text-white border-r border-white/10 relative overflow-hidden">
                @if (isset($left_image))
                    <img src="{{ $left_image }}" class="absolute inset-0 w-full h-full object-cover opacity-60 z-0"
                        alt="Branding">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10"></div>
                @endif

                <div class="text-center relative z-20">
                    <h1 class="text-4xl lg:text-5xl font-bold mb-4 tracking-tight">Ikan Bakar Nusantara</h1>
                    <p class="text-lg text-orange-50/80 max-w-xs mx-auto">Cita rasa autentik rempah pilihan yang
                        terpanggang
                        sempurna.</p>

                    <div class="mt-12 flex justify-center space-x-4">
                        <div class="h-1 w-12 bg-orange-400 rounded-full"></div>
                        <div class="h-1 w-4 bg-orange-400/50 rounded-full"></div>
                        <div class="h-1 w-4 bg-orange-400/50 rounded-full"></div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form/Right Side -->
        <div
            class="w-full {{ !isset($single_panel) || !$single_panel ? 'md:w-7/12' : '' }} bg-white p-6 sm:p-10 lg:p-12">
            <div class="mb-8 text-center md:text-left">
                <a href="/" class="inline-block text-xl font-bold text-orange-600 mb-6 lg:mb-8">IkanBakar<span
                        class="text-gray-900">.</span></a>
                @yield('form_header')
            </div>

            @yield('content')

            @yield('form_footer')
        </div>
    </div>
</body>

</html>
