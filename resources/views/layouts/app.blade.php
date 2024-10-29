<!DOCTYPE html>
<html lang="en-US">
    @php
        $request = app('request');
        $routes = app()->router->getRoutes();
    @endphp
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>The Lost Asura</title>
    <link rel="stylesheet" href="{{ ASURA_PLUGIN_URL . 'public/css/app.css' }}">
    <link rel="icon" href="{{ASURA_PLUGIN_URL}}public/img/japanese-lamp.svg">
</head>

<body>
    <div id="app" :class="darkMode ? 'dark' : ''">
        <div class="h-screen flex overflow-hidden bg-white">
            <!-- Static sidebar for desktop -->
            <div class="hidden lg:flex lg:flex-shrink-0">
                <div class="flex flex-col w-64 border-r border-gray-200 pt-5 pb-4 bg-gray-100">
                    <div class="flex items-center flex-shrink-0 px-6">
                        <img class="h-8 w-auto" src="{{ASURA_PLUGIN_URL}}public/img/japanese-lamp.svg" alt="Asura">
                        <a href="https://thelostasura.com/?utm_source=asura" class="pl-2 text-2xl font-bold text-black w-full text-center">
                          Asura <span class="text-sm font-normal">v{{ THELOSTASURA }}</span>
                        </a>
                    </div>
                    <!-- Sidebar component, swap this element with another sidebar if you like -->
                    <div class="h-0 flex-1 flex flex-col overflow-y-auto">
                        <!-- User account dropdown -->
                        <div class="px-3 mt-6 relative inline-block text-left">
                            <!-- Dropdown menu toggle, controlling the show/hide state of dropdown menu. -->
                            <div>
                                <button type="button" class="group w-full bg-gray-100 rounded-md px-3.5 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-purple-500"  aria-haspopup="true" aria-expanded="true">
                                    <div class="flex w-full justify-between items-center">
                                        <div class="flex min-w-0 items-center justify-between space-x-3">
                                            <img class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0" src="{{ get_avatar_url('mail@thelostasura.com', 256) }}" alt="">
                                            <div class="flex-1 min-w-0">
                                                <h2 class="text-gray-900 text-sm leading-5 font-medium truncate">{{ wp_get_current_user()->display_name }}</h2>
                                                <p class="text-gray-500 text-sm leading-5 truncate">{{ '@'.wp_get_current_user()->user_login }}</p>
                                            </div>
                                        </div>
                                        <!-- Heroicon name: selector -->
                                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <!-- Navigation -->
                        <nav class="px-3 mt-6">
                            <div class="space-y-1">

                                <a 
                                    href="{{ admin_url() }}" 
                                    :class="false ? 'text-gray-900 bg-gray-200' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-50' " 
                                    class="group flex items-center px-2 py-2 text-sm leading-5 font-medium rounded-md focus:outline-none focus:bg-gray-50"
                                >
                                    <!-- Heroicon name: home -->
                                    <svg :class="false ? 'text-gray-500' : 'text-gray-400' " class="mr-3 h-6 w-6 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{-- Home  --}}
                                    {{ get_bloginfo('name') }}
                                </a>

                                <a 
                                    href="{{ route('admin.apis.index') }}" 
                                    :class="{{ $request->routeIs('admin.apis.index') ? 'true' : 'false' }} ? 'text-gray-900 bg-gray-200' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-50'" 
                                    class="group flex items-center px-2 py-2 text-sm leading-5 font-medium rounded-md focus:outline-none focus:bg-gray-50"
                                >
                                    <!-- Heroicon name: view-list -->
                                    <svg 
                                        :class="{{ $request->routeIs('admin.apis.index') ? 'true' : 'false' }} ? 'text-gray-500' : 'text-gray-400'"
                                        class="mr-3 h-6 w-6 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                    </svg>
                                    APIs
                                </a>

                                <a 
                                    href="{{ route('admin.licenses.index') }}" 
                                    :class="{{ $request->routeIs('admin.licenses.index') ? 'true' : 'false' }} ? 'text-gray-900 bg-gray-200' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-50'" 
                                    class="group flex items-center px-2 py-2 text-sm leading-5 font-medium rounded-md focus:outline-none focus:bg-gray-50"
                                >
                                    <!-- Heroicon name: view-list -->
                                    <svg 
                                        :class="{{ $request->routeIs('admin.licenses.index') ? 'true' : 'false' }} ? 'text-gray-500' : 'text-gray-400'"
                                        class="mr-3 h-6 w-6 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                    </svg>
                                    Licenses
                                </a>

                                <a 
                                    href="https://thelostasura.com/?utm_source=asura"
                                    target="_blank" 
                                    :class="false ? 'text-gray-900 bg-gray-200' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-50'" 
                                    class="group flex items-center px-2 py-2 text-sm leading-5 font-medium rounded-md focus:outline-none focus:bg-gray-50"
                                >
                                    <!-- Heroicon name: duplicate -->
                                    <svg 
                                        :class="false ? 'text-gray-500' : 'text-gray-400'"
                                        class="mr-3 h-6 w-6 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    Generators [Pro]
                                </a>

                                <a 
                                    href="https://thelostasura.com/?utm_source=asura"
                                    target="_blank" 
                                    :class="false ? 'text-gray-900 bg-gray-200' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-50'" 
                                    class="group flex items-center px-2 py-2 text-sm leading-5 font-medium rounded-md focus:outline-none focus:bg-gray-50"
                                >
                                    <!-- Heroicon name: cube-transparent -->
                                    <svg 
                                        :class="false ? 'text-gray-500' : 'text-gray-400'"
                                        class="mr-3 h-6 w-6 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                                    </svg>
                                    Remotes [Pro]
                                </a>

                            </div>
                            <div class="mt-8">
                                <!-- Secondary navigation -->
                                <h3 class="px-3 text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider" id="teams-headline">
                                    Resources
                                </h3>
                                <div class="mt-1 space-y-1" role="group" aria-labelledby="teams-headline">
                                    <a href="https://thelostasura.com/documentation?utm_source=asura" target="_blank" class="group flex items-center px-3 py-2 text-sm leading-5 font-medium text-gray-700 rounded-md hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
                                        <span class="w-2.5 h-2.5 mr-4 bg-indigo-500 rounded-full"></span>
                                        <span class="truncate">
                                            Documentation
                                        </span>
                                    </a>

                                    <a href="https://community.thelostasura.com/" target="_blank" class="group flex items-center px-3 py-2 text-sm leading-5 font-medium text-gray-700 rounded-md hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
                                        <span class="w-2.5 h-2.5 mr-4 bg-green-500 rounded-full"></span>
                                        <span class="truncate">
                                            Community
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Main column -->
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                
                <main class="flex-1 z-0 overflow-y-auto focus:outline-none" tabindex="0">
                        
                    @yield('content')
                    @yield('aftercontent')

                </main>
            </div>
        </div>
    </div>
    @yield('script')

    @php
        use Illuminate\Support\Str;
        use TheLostAsura\Skynet\MultiSite;

        $url = MultiSite::isMultiSite() ? ( 
            is_ssl() ? 'https://' : 'http://'
        ) . MultiSite::blog()->domain : rtrim( site_url(), '/' ) ;

        $ziggy = [
            'url' => $url,
            'port' => parse_url($url)['port'] ?? null,
            'defaults' => method_exists(app('url'), 'getDefaultParameters')
                ? app('url')->getDefaultParameters()
                : [],
        ];

        foreach ($routes as $route) {
            if (!empty($route['action']['as'])) {
                $ziggy['routes'][$route['action']['as']] = [
                    'uri' => Str::length($route['uri']) < 2 ? $route['uri'] : (string) Str::of($route['uri'])->ltrim('/'),
                    'methods' => $route['method'] === 'GET' ? ['HEAD','GET'] : [$route['method']],
                ];
            }
        }

    @endphp

    <script type="text/javascript">
        const Ziggy = @json($ziggy);
    </script>
    <script src="https://cdn.jsdelivr.net/gh/tighten/ziggy/dist/index.js"></script>
    <script src="{{ ASURA_PLUGIN_URL . 'public/js/manifest.js' }}"></script>
    <script src="{{ ASURA_PLUGIN_URL . 'public/js/vendor.js' }}"></script>
    <script src="{{ ASURA_PLUGIN_URL . 'public/js/app.js' }}"></script>
</body>
</html>