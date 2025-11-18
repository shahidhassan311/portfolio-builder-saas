<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio Builder - Create Your Portfolio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-indigo-600">Portfolio Builder</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600">Dashboard</a>
                            @if(auth()->user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-indigo-600">Admin</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-indigo-600">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600">Login</a>
                            <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Sign Up</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="bg-indigo-600 text-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-bold mb-4">Create Your Professional Portfolio</h2>
                <p class="text-xl mb-8">Choose a theme and start building your portfolio in minutes</p>
            </div>
        </div>

        <!-- Themes Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h3 class="text-3xl font-bold text-center mb-12">Choose Your Theme</h3>

            <div class="grid md:grid-cols-2 gap-8">
                @forelse($themes as $theme)

                    @php
                        $preview = $theme->preview_image;
                        if ($preview) {
                            $isUrl = filter_var($preview, FILTER_VALIDATE_URL);
                            $previewUrl = $isUrl ? $preview : asset('storage/' . $preview);
                        } else {
                            $previewUrl = 'https://colorlib.com/wp/wp-content/uploads/sites/2/rezume-free-template-353x278.jpg.avif';
                        }
                    @endphp
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="h-64 bg-gray-200 flex items-center justify-center">
                                <img src="{{$previewUrl}}" alt="{{ $theme->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-bold mb-2">{{ $theme->name }}</h4>
                            <p class="text-gray-600 mb-4">{{ $theme->description ?? 'A beautiful portfolio theme' }}</p>
                            <div class="flex space-x-4">
                                <a href="{{ route('preview.theme', $theme->id) }}" target="_blank" class="flex-1 bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 text-center">
                                    Preview
                                </a>
                                @auth
                                    <form method="GET" action="{{ route('select.theme', $theme->id) }}" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                            Use This Theme
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('select.theme', $theme->id) }}" class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-center">
                                        Get Started
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-12">
                        <p class="text-gray-600">No themes available yet. Please check back later.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>

