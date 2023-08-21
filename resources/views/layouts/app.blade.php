<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel WebMapping M2</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @stack('styles')
    @stack('scripts')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased overflow-y-hidden px-[5%]">
    <div>
        <div class="p-3 space-y-3">
            <h1 class="text-right text-5xl text-sky-500 first-letter:text-7xl font-extrabold">Region Ambatoloana</h1>
            <div class="flex justify-between items-center">
                <div class="space-y-1">
                    <div class="flex w-32 justify-between items-center">
                        <svg class="w-8 stroke-current" viewBox="0 0 24 24" fill="none">
                            <path d="M13 14L17 9L22 18H2.84444C2.46441 18 2.2233 17.5928 2.40603 17.2596L10.0509 3.31896C10.2429 2.96885 10.7476 2.97394 10.9325 3.32786L15.122 11.3476" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="font-bold">1 380 m</span>
                    </div>
                    <div class="flex w-32 justify-between items-center">
                        <svg class="w-8 fill-current" viewBox="0 0 24 24">
                            <path d="M20 17h-16c-.552 0-1-.447-1-1v-3c0-.68.234-1.346.658-1.874l4-5c.98-1.226 2.885-1.469 4.143-.524l1.674 1.254 2.185-2.729c.57-.717 1.424-1.127 2.341-1.127.679 0 1.343.232 1.873.657.716.572 1.126 1.426 1.126 2.343v10c0 .553-.448 1-1 1zm-15-2h14v-9c0-.307-.137-.59-.375-.779-.227-.183-.465-.221-.624-.221-.306 0-.591.137-.782.376l-2.789 3.485c-.337.423-.949.5-1.381.176l-2.449-1.837c-.422-.316-1.055-.233-1.381.176l-4 5c-.181.228-.219.464-.219.624v2zM20 21h-16c-.552 0-1-.447-1-1s.448-1 1-1h16c.552 0 1 .447 1 1s-.448 1-1 1z" />
                        </svg>
                        <span class="font-bold">120 km²</span>
                    </div>
                    <div class="flex w-32 justify-between items-center">
                        <svg class="w-8 stroke-current" viewBox="0 0 24 24" fill="none">
                            <path d="M12 21C15.5 17.4 19 14.1764 19 10.2C19 6.22355 15.866 3 12 3C8.13401 3 5 6.22355 5 10.2C5 14.1764 8.5 17.4 12 21Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="font-bold">116</span>
                    </div>
                    <div class="flex w-32 justify-between items-center">
                        <svg class="w-8 fill-current" viewBox="0 0 256 256">
                            <path d="M192.498,124.8c9.278,0,16.8,7.522,16.8,16.8s-7.522,16.8-16.8,16.8s-16.8-7.522-16.8-16.8S183.22,124.8,192.498,124.8z
                            M171.798,166.6c9.278,0,16.8,7.522,16.8,16.8s-7.522,16.8-16.8,16.8s-16.8-7.522-16.8-16.8S162.52,166.6,171.798,166.6z
                            M144.998,203.3h-18.9h-18.9c-11.5,0-18.7,9.5-18.7,21.4V254h12.9v-25.9c0-1.2,1-2,2-2c1.2,0,2,0.8,2,2v25.8h41.5v-25.8
                            c0-1.2,1-2,2-2c1.2,0,2,1,2,2v25.8h12.9v-29.1C163.998,212.8,156.698,203.3,144.998,203.3z M149.698,124.8
                            c9.278,0,16.8,7.522,16.8,16.8s-7.522,16.8-16.8,16.8s-16.8-7.522-16.8-16.8S140.42,124.8,149.698,124.8z M199.098,183.4
                            c0,9.3,7.5,16.8,16.8,16.8s16.8-7.5,16.8-16.8s-7.5-16.8-16.8-16.8S199.098,174.1,199.098,183.4z M197.398,203.3
                            c-11.5,0-18.7,9.5-18.7,21.4V254h12.9v-25.9c0-1.2,1-2,2-2c1.2,0,2,0.8,2,2v25.8h41.5v-25.8c0-1.2,1-2,2-2c1.2,0,2,1,2,2v25.8h12.9
                            v-29.1c0.2-12.1-7.1-21.6-18.7-21.6h-18.9h-19V203.3z M39.798,166.6c9.278,0,16.8,7.522,16.8,16.8s-7.522,16.8-16.8,16.8
                            s-16.8-7.522-16.8-16.8S30.52,166.6,39.798,166.6z M14.798,253.9v-25.8c0-1.2,1-2,2-2c1.2,0,2,0.8,2,2v25.8h41.5v-25.8
                            c0-1.2,1-2,2-2c1.2,0,2,1,2,2v25.8h12.9v-29.1c0.2-12.1-7.1-21.6-18.7-21.6h-18.9h-18.9c-11.5,0-18.7,9.5-18.7,21.4v29.3
                            L14.798,253.9L14.798,253.9z M109.298,183.4c0,9.3,7.5,16.8,16.8,16.8c9.3,0,16.8-7.5,16.8-16.8s-7.5-16.8-16.8-16.8
                            S109.298,174.1,109.298,183.4z M61.298,124.8c9.278,0,16.8,7.522,16.8,16.8s-7.522,16.8-16.8,16.8s-16.8-7.522-16.8-16.8
                            S52.02,124.8,61.298,124.8z M106.698,124.8c9.278,0,16.8,7.522,16.8,16.8s-7.522,16.8-16.8,16.8s-16.8-7.522-16.8-16.8
                            S97.42,124.8,106.698,124.8z M84.098,166.6c9.278,0,16.8,7.522,16.8,16.8s-7.522,16.8-16.8,16.8s-16.8-7.522-16.8-16.8
                            S74.82,166.6,84.098,166.6z M173.352,93.441V9.166h-16.96v84.275h-5.685V27.798h-16.96v65.643h-5.733V59.855h-16.96v33.586h-5.685
                            V76.338h-16.96v17.103h-9.603V2h-6.43v98h111.248v-6.43v-0.129H173.352z" />
                        </svg>
                        <span class="font-bold">5 000</span>
                    </div>
                </div>
                <p class="w-[40%] text-right">Ambatolaona est une commune rurale de Madagascar. Elle appartient au district de <b>Manjakandriana</b>, qui fait partie de la <b>région Analamanga</b>. La population de la commune a été estimée à environ <b>5 000 habitants</b> lors du recensement communal de 2001. Seule l'école primaire est disponible</p>
            </div>
        </div>
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>
