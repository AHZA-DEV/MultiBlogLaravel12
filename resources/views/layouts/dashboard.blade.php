<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg">
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-900">{{ config('app.name') }}</h2>
                <p class="text-sm text-gray-600 mt-1">Welcome, {{ Auth::user()->name }}!</p>
                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mt-2">
                    {{ ucfirst(Auth::user()->role) }}
                </span>
            </div>
            
            <nav class="mt-6">
                <div class="px-6 py-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700' : 'hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        </svg>
                        Dashboard
                    </a>
                </div>

                @if(Auth::user()->role === 'admin')
                <div class="px-6 py-2">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Admin</h3>
                    <div class="mt-2 space-y-1">
                        <a href="{{ route('dashboard.users') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg {{ request()->routeIs('dashboard.users') ? 'bg-blue-100 text-blue-700' : 'hover:bg-gray-100' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Users
                        </a>
                        <a href="{{ route('dashboard.categories') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg {{ request()->routeIs('dashboard.categories') ? 'bg-blue-100 text-blue-700' : 'hover:bg-gray-100' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-7H3a2 2 0 00-2 2v14a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2z"></path>
                            </svg>
                            Categories
                        </a>
                    </div>
                </div>
                @endif

                <div class="px-6 py-2 mt-4">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Content</h3>
                    <div class="mt-2 space-y-1">
                        <a href="{{ route('dashboard.posts') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg {{ request()->routeIs('dashboard.posts*') ? 'bg-blue-100 text-blue-700' : 'hover:bg-gray-100' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Posts
                        </a>
                        <a href="{{ route('dashboard.tags') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg {{ request()->routeIs('dashboard.tags*') ? 'bg-blue-100 text-blue-700' : 'hover:bg-gray-100' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Tags
                        </a>
                    </div>
                </div>

                <div class="px-6 py-2 mt-8 border-t pt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 w-full text-left">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>