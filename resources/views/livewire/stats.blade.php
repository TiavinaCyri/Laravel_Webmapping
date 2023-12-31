<div class="grid grid-cols-1 gap-2">
    <div class="shadow-sm flex items-center justify-between px-4 py-2 rounded-2xl">
        <div class="flex justify-center">
            <svg class="w-8 stroke-current" viewBox="0 0 24 24" fill="none">
                <path d="M5 9.77746V16.2C5 17.8802 5 18.7203 5.32698 19.362C5.6146 19.9265 6.07354 20.3854 6.63803 20.673C7.27976 21 8.11984 21 9.8 21H14.2C15.8802 21 16.7202 21 17.362 20.673C17.9265 20.3854 18.3854 19.9265 18.673 19.362C19 18.7203 19 17.8802 19 16.2V5.00002M21 12L15.5668 5.96399C14.3311 4.59122 13.7133 3.90484 12.9856 3.65144C12.3466 3.42888 11.651 3.42893 11.0119 3.65159C10.2843 3.90509 9.66661 4.59157 8.43114 5.96452L3 12M14 21V15H10V21" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <div>
            <div class="flex justify-end">
                <span class="text-xl">{{ $bati->count() }} maisons</span>
            </div>
            <div class="flex justify-end">
                <span class="text-xl">{{ $bati_area }} m²</span>
            </div>
        </div>
    </div>
    <div class="shadow-sm flex items-center justify-between px-4 py-2 rounded-2xl">
        <div class="flex justify-center">
            <svg class="w-8" viewBox="0 0 512 512">
                <g>
                    <path class="st0" d="M346.483,226.653c-58.176-75.765-90.498-181.813-90.498-181.813s-32.318,106.048-90.505,181.813
                    c0,0,26.66,16.09,41.21,7.569c0,0-14.55,65.341-79.995,151.514c58.176,18.923,101.81-12.328,101.81-12.328v93.75h21.025h12.916
                    h21.021v-93.75c0,0,43.642,31.25,101.817,12.328c-65.457-86.174-79.995-151.514-79.995-151.514
                    C319.826,242.743,346.483,226.653,346.483,226.653z" />
                    <path class="st0" d="M160.886,307.087c-19.185-35.761-24.363-59.015-24.363-59.015c8.768,5.141,23.33-1.454,29.058-4.376
                    c1.522-0.84,2.417-1.379,2.417-1.379c-5.313-6.985-10.353-14.276-15.186-21.718c-34.855-54.482-53.972-117.26-53.972-117.26
                    s-24.711,81.041-69.23,138.977c0,0,20.361,12.283,31.542,5.756c0,0-11.181,49.956-61.151,115.88
                    c44.451,14.426,77.788-9.443,77.788-9.443v71.674h42.034v-71.674c0,0,3.035,2.151,8.415,4.759
                    C141.633,340.391,152.332,322.817,160.886,307.087z" />
                    <path class="st0" d="M450.849,248.071c11.121,6.527,31.474-5.756,31.474-5.756c-44.454-57.936-69.155-138.977-69.155-138.977
                    s-19.125,62.778-54.05,117.26c-4.766,7.441-9.803,14.733-15.123,21.718c0,0,0.906,0.54,2.428,1.379
                    c5.725,2.922,20.29,9.517,29.058,4.376c0,0-5.178,23.328-24.442,59.09c8.566,15.655,19.331,33.303,32.723,52.106
                    c5.381-2.608,8.423-4.759,8.423-4.759v71.674h41.967v-71.674c0,0,33.394,23.869,77.848,9.443
                    C461.97,298.027,450.849,248.071,450.849,248.071z" />
                </g>
            </svg>
        </div>
        <div>
            <div class="flex justify-end">
                <span class="text-xl">{{ $foret->count() }} forêts</span>
            </div>
            <div class="flex justify-end">
                <span class="text-xl">{{ $foret_area }} m²</span>
            </div>
        </div>
    </div>
    <div class="shadow-sm flex items-center justify-between px-4 py-2 rounded-2xl">
        <div class="flex justify-center">
            <svg class="w-8" viewBox="0 0 512 512">
                <g>
                    <path class="st0" d="M311.508,354.916l5.72-11.034c1.816-3.546,3.506-7.029,5.096-10.582c3.117-7.076,5.666-14.261,7.271-21.36
                    c3.265-14.331,1.566-27.476-7.146-37.21c-8.712-9.928-23.097-16.591-37.966-21.235c-31.654-9.11-64.024-19.248-95.343-31.139
                    c-7.862-2.985-15.686-6.086-23.479-9.39c-7.676-3.226-15.998-6.997-23.612-12.102c-7.527-5.088-15.421-11.868-19.496-22.263
                    c-2.019-5.112-2.549-10.894-1.87-16.147c0.685-5.267,2.4-10.06,4.528-14.331c4.426-8.751,9.857-15.063,14.751-21.835l15.235-19.871
                    l30.789-39.322l52.421-65.949L198.445,0c0,0-91.026,83.709-131.657,136.535c-35.324,45.914-16.03,86.483,47.87,113.772
                    c53.933,23.043,104.414,40.88,104.414,40.88c8.697,4.504,14.884,12.398,16.941,21.609c2.057,9.219-0.218,18.812-6.242,26.3
                    L90.719,512h138.733l59.006-112.868L311.508,354.916z" />
                    <path class="st0" d="M444.973,261.023c-19.365-32.394-52.515-55.242-90.917-62.669l-136.052-28.684
                    c-5.673-1.091-10.442-4.691-12.85-9.694c-2.408-4.995-2.151-10.786,0.678-15.578l90.442-141.6l-44.052-1.262l-55.694,73.672
                    l-29.752,39.96l-14.627,20.082c-4.707,6.756-9.897,13.435-12.757,19.684c-3.046,6.46-3.81,12.617-1.612,17.728
                    c2.119,5.237,7.301,10.107,13.551,14.02c6.328,4.005,13.287,7.02,21.002,10.044c7.59,3,15.289,5.845,23.043,8.572
                    c31.155,10.948,62.536,19.956,95,28.459c16.645,4.956,34.264,11.595,48.299,26.402c6.842,7.41,11.946,17.143,13.886,27.219
                    c1.995,10.084,1.341,20.012-0.405,29.191c-1.839,9.172-4.714,17.791-8.089,26.004c-1.706,4.083-3.546,8.128-5.431,12.024
                    l-5.486,11.245l-21.983,44.8L261.284,512h140.626l53.192-144.646C468.031,332.178,464.337,293.416,444.973,261.023z" />
                </g>
            </svg>
        </div>
        <div>
            <div class="flex justify-center">
                <span class="text-xl">{{ $route->count() }} routes</span>
            </div>
        </div>
    </div>
</div>
