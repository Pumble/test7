<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test 7 - @yield('title')</title>
        <link 
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" 
            rel="stylesheet" 
            integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" 
            crossorigin="anonymous">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
                <div class="container-fluid">
                    <router-link class="navbar-brand" to="/">Test7</router-link>
                    <button 
                        class="navbar-toggler" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#internalNavbar" 
                        aria-controls="internalNavbar" 
                        aria-expanded="false" 
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="internalNavbar">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @foreach ($Menu->items as $item)
                                @if(count($item->allChildrenItems) > 0)
                                    <li class="nav-item dropdown">
                                        <router-link 
                                            class="nav-link dropdown-toggle" 
                                            to="{{ $item->route }}" 
                                            id="internalNavbar-dropDown-{{ $loop->index }}" 
                                            role="button" 
                                            data-bs-toggle="dropdown" 
                                            aria-expanded="false">
                                            {{ $item->name }}
                                        </router-link>
                                        <ul class="dropdown-menu" aria-labelledby="internalNavbar-dropDown-{{ $loop->index }}">
                                            @foreach ($item->all_children_items as $subItem)
                                                <li>
                                                    <router-link class="dropdown-item" to="{{ $subItem->route }}">{{ $subItem->name }}</router-link>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <router-link 
                                            class="nav-link" 
                                            to="{{ $item->route }}"
                                            :class="{ 'active': routePath == '{{ $item->route }}' }">
                                            {{ $item->name }}
                                        </router-link>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
                <router-view></router-view>
            </div>
        </div>

        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" 
            crossorigin="anonymous">
        </script>

        <script 
            src="js/app.js"
            type="text/javascript" async>
        </script>
    </body>
</html>