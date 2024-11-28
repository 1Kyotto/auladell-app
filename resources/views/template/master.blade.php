<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Auladell Joyas</title>
        @vite('resources/css/app.css')
        @vite('resources/css/custom.css')
    </head>
    <body class="bg-cwhite-500 grid xl:grid-rows-[auto_1fr_auto] xl:min-h-dvh">
        <header class="w-full bg-white text-accents-900 px-4 md:px-20 xl:px-8 flex justify-between font-cinzel">
            {{--HAMBURGER--}}
            <div class="flex flex-col justify-center cursor-pointer w-[33%] xl:relative xl:hidden order-1" id="hamburger">
                <div class="w-8 h-[3px] mb-1 rounded bg-cblack-500"></div>
                <div class="w-8 h-[3px] mb-1 rounded bg-cblack-500"></div>
                <div class="w-8 h-[3px] mb-1 rounded bg-cblack-500"></div>
            </div>
            {{--HAMBURGER--}}

            {{--LOGO--}}
            <a href="{{ route('home.index') }}" class="col-span-1 py-3 w-[33%] flex flex-col items-center justify-end gap-4 order-3 xl:flex-row xl:order-1 xl:justify-start">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-accents-800"
                    viewBox="0 0 300.000000 390.000000"
                    preserveAspectRatio="xMidYMid meet">
                    <g transform="translate(0.000000,390.000000) scale(0.050000,-0.050000)"
                    fill="currentColor" stroke="none">
                    <path d="M2120 7498 c-249 -48 -558 -267 -656 -464 -102 -205 -348 -248 -484
                    -84 -115 138 -179 -55 -67 -202 61 -81 63 -73 -59 -226 -201 -250 -427 -592
                    -530 -802 -19 -38 -39 -74 -46 -80 -32 -26 -98 -264 -98 -353 0 -120 39 -165
                    155 -181 79 -10 94 -5 269 100 315 188 647 351 943 462 237 89 501 254 527
                    329 7 18 25 48 42 67 21 26 29 85 29 222 l-1 187 108 37 c238 81 152 170 -214
                    221 -174 24 -174 61 1 172 105 67 173 71 286 17 45 -22 90 -40 99 -40 145 0
                    415 -393 341 -497 -133 -184 -135 -217 -26 -305 73 -58 80 -71 76 -151 -3 -80
                    4 -95 81 -165 86 -79 106 -122 55 -122 -45 0 -57 -74 -22 -143 42 -85 39 -143
                    -9 -187 -27 -25 -40 -62 -40 -117 0 -44 -18 -145 -40 -224 -37 -132 -38 -149
                    -10 -229 28 -80 28 -89 -10 -150 -48 -78 -49 -95 -9 -180 29 -61 29 -72 -1
                    -129 -38 -75 -27 -120 53 -211 l59 -68 -46 -84 c-25 -46 -57 -102 -71 -126
                    -42 -71 -28 -143 48 -255 69 -102 73 -115 76 -287 5 -262 147 -491 369 -597
                    94 -45 156 -127 121 -162 -20 -20 -218 76 -334 163 -163 121 -421 538 -469
                    756 -45 207 -34 927 20 1240 133 788 88 1185 -164 1445 -56 57 -120 105 -141
                    105 -32 0 -22 -18 49 -90 203 -207 225 -755 60 -1540 -230 -1093 131 -1954
                    1000 -2388 146 -73 186 -104 287 -228 64 -79 211 -240 327 -357 194 -195 210
                    -218 198 -270 -8 -31 -23 -97 -34 -147 -70 -304 67 -660 400 -1044 40 -46 102
                    -76 102 -50 0 4 9 58 21 121 31 168 -6 460 -81 636 -72 170 -54 187 121 108
                    261 -117 679 -116 679 2 0 84 -330 352 -544 442 -111 46 -151 52 -339 50
                    l-212 -2 -163 119 c-89 65 -162 127 -162 136 0 10 -39 61 -86 115 -197 221
                    -178 267 101 253 714 -36 1390 430 1517 1046 109 524 -223 693 -717 364 -96
                    -64 -184 -116 -196 -116 -25 0 72 177 121 221 19 17 51 62 70 100 19 38 48 84
                    64 103 60 68 -44 204 -171 226 -259 43 -992 -551 -1193 -967 -94 -196 -139
                    -206 -302 -72 -221 181 -237 555 -18 436 255 -139 658 91 562 321 -68 162
                    -182 167 -470 21 -310 -159 -425 -138 -331 59 45 96 148 169 268 192 106 20
                    271 87 290 118 6 10 81 34 166 53 392 86 565 167 739 345 70 72 125 145 122
                    162 -10 49 -70 49 -131 2 -412 -319 -704 -412 -870 -278 l-85 68 -266 -5 -267
                    -4 7 53 c7 59 107 93 442 148 178 29 209 52 178 133 -12 30 -27 89 -33 130
                    -21 121 -246 235 -406 205 -109 -20 -166 95 -77 155 32 21 161 18 183 -4 32
                    -32 560 -126 871 -155 153 -14 478 61 549 127 89 82 63 145 -91 221 -240 118
                    -941 132 -1250 26 -136 -47 -197 -50 -227 -13 -52 62 104 128 342 147 162 12
                    275 60 275 116 0 53 -76 64 -389 54 -329 -10 -371 2 -340 98 13 43 17 44 308
                    32 308 -13 381 2 381 78 0 43 -68 61 -293 76 -559 37 -707 116 -441 234 139
                    63 578 77 897 30 582 -87 829 -10 914 284 51 174 -121 440 -307 475 -228 43
                    -456 -191 -372 -380 80 -182 327 -195 370 -20 21 80 -14 103 -79 52 -149 -117
                    -291 9 -157 139 191 185 542 15 479 -233 -30 -122 -233 -249 -398 -249 -136 0
                    -509 153 -604 248 -16 16 -89 68 -164 117 -74 48 -161 105 -193 126 -571 384
                    -971 405 -1409 74 -95 -72 -182 -131 -193 -131 -124 -2 -133 18 -66 145 65
                    121 194 244 329 312 129 65 751 91 869 37 26 -13 98 -44 158 -69 94 -40 375
                    -194 540 -297 86 -53 178 -97 229 -110 82 -20 77 24 -7 67 -44 22 -85 50 -92
                    61 -7 11 -28 20 -48 20 -19 0 -56 23 -82 50 -26 28 -58 50 -72 50 -14 0 -50
                    21 -81 47 -32 25 -88 63 -127 84 -38 21 -88 54 -110 72 -187 159 -694 244
                    -1050 175z m740 -507 c289 -112 849 -449 811 -487 -4 -3 -146 -9 -317 -13
                    -353 -9 -338 -15 -443 179 -68 123 -92 151 -235 271 -62 52 -109 99 -104 104
                    13 14 207 -23 288 -54z m-1795 -153 c55 -67 44 -98 -34 -98 -74 0 -131 55
                    -131 127 0 51 115 31 165 -29z m626 -88 c126 -59 172 -70 288 -70 266 0 328
                    -92 110 -165 -66 -22 -78 -34 -75 -75 34 -378 -80 -536 -504 -700 -22 -9 -161
                    -62 -310 -119 -306 -118 -489 -219 -620 -341 -332 -310 -460 -28 -171 377 37
                    51 93 147 125 213 383 788 753 1070 1157 880z m2638 -1329 c134 -23 195 -65
                    154 -106 -65 -64 -992 -21 -1035 49 -51 82 514 118 881 57z m-992 -446 c65
                    -31 77 -107 28 -170 -76 -97 -383 -50 -413 62 -32 125 208 193 385 108z m60
                    -637 c183 -64 -54 -194 -317 -175 -88 7 -90 9 -90 75 0 105 230 162 407 100z
                    m1311 -490 c47 -18 39 -56 -37 -176 -112 -174 -550 -544 -884 -744 -171 -104
                    -187 -84 -89 108 134 262 688 751 912 805 33 8 62 16 63 17 2 1 18 -3 35 -10z
                    m-1157 -189 c20 -33 -51 -99 -108 -99 l-50 0 57 60 c62 65 80 72 101 39z
                    m1777 -298 c35 -36 37 -49 14 -185 -63 -390 -341 -680 -773 -808 -135 -40
                    -630 -54 -642 -18 -29 83 621 734 959 961 166 111 359 133 442 50z m-1168
                    -477 c0 -28 -441 -504 -467 -504 -107 0 -161 228 -60 252 83 20 222 94 347
                    186 102 75 180 104 180 66z"/>
                    <path d="M1438 6388 c-15 -19 -37 -62 -48 -96 -16 -51 -47 -75 -165 -131 -165
                    -78 -180 -101 -64 -101 163 0 367 166 355 288 -7 70 -39 86 -78 40z"/>
                    <path d="M1695 5558 c-30 -23 -55 -51 -55 -62 0 -11 -21 -46 -47 -76 -428
                    -508 -517 -1570 -165 -1960 25 -27 67 -81 93 -120 68 -100 155 -185 177 -171
                    23 14 -4 121 -41 165 -76 91 -197 352 -219 472 -55 299 -46 462 46 782 22 76
                    42 152 46 170 8 37 98 240 211 475 131 272 107 439 -46 325z"/>
                    </g>
                </svg>
                <h2 class="hidden xl:flex xl:text-accents-900">Auladell Joyas</h2>
            </a>
            {{--LOGO--}}

            {{--NAVBAR--}}
            <nav class="absolute inset-x-0 top-[80px] w-full bg-white h-0 overflow-hidden duration-300 transition-all xl:relative xl:h-auto xl:flex xl:top-0 xl:overflow-visible xl:order-2 xl:w-1/2 2xl:w-[33%]" id="navbar">
                <ul class="block w-full mt-[80px] mr-auto mb-0 ml-auto text-center opacity-0 duration-500 xl:flex xl:w-full xl:justify-between xl:items-center xl:opacity-100 xl:mt-0 xl:mr-0 xl:ml-0">
                    <li class="mb-4 xl:mb-0">
                        <a href="{{ route('jewelry.index', ['type' => 'all-products']) }}" class="hover:text-accents-600 transition-colors duration-150">Todas las Joyas</a>
                    </li>
                    <li class="mb-4 xl:mb-0">
                        <a href="{{ route('jewelry.index', ['type' => 'earrings']) }}" class="hover:text-accents-600 transition-colors duration-150">Aros</a>
                    </li>
                    <li class="mb-4 xl:mb-0">
                        <a href="{{ route('jewelry.index', ['type' => 'rings']) }}" class="hover:text-accents-600 transition-colors duration-150">Anillos</a>
                    </li>
                    <li class="mb-4 xl:mb-0">
                        <a href="{{ route('jewelry.index', ['type' => 'bracelets']) }}" class="hover:text-accents-600 transition-colors duration-150">Brazaletes</a>
                    </li>
                    <li class="mb-4 xl:mb-0">
                        <a href="{{ route('jewelry.index', ['type' => 'necklaces']) }}" class="hover:text-accents-600 transition-colors duration-150">Collares</a>
                    </li>
                </ul>
            </nav>
            {{--NAVBAR--}}

            {{--SEARCH Y BOTONES--}}
            <div class="flex items-center justify-end w-[33%] order-3 gap-4 sm:gap-6 md:gap-7 xl:order-3 xl:justify-end xl:gap-8">
                {{--SEARCH--}}
                <div class="xl:flex xl:items-center xl:gap-1 xl:w-[55%] xl:bg-gray-200 xl:border xl:rounded-xl xl:px-2 xl:py-1 xl:ml-4 2xl:ml-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-[22px] w-[22px] text-accents-900 hover:text-accents-600 transition-colors duration-150" viewBox="0 0 24 24" fill="none">
                        <path d="M17.5 17.5L22 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                    </svg>
                    <input type="text" placeholder="Buscar..." class="hidden xl:block xl:bg-gray-200 xl:outline-none xl:w-[95%]">
                </div>
                {{--SEARCH--}}

                {{--CARRITO--}}
                <a href="{{route('cart.index')}}" class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accents-900 hover:text-accents-600 transition-colors duration-150" viewBox="0 0 24 24" fill="none">
                        <path d="M3.87289 17.0194L2.66933 9.83981C2.48735 8.75428 2.39637 8.21152 2.68773 7.85576C2.9791 7.5 3.51461 7.5 4.58564 7.5H19.4144C20.4854 7.5 21.0209 7.5 21.3123 7.85576C21.6036 8.21152 21.5126 8.75428 21.3307 9.83981L20.1271 17.0194C19.7282 19.3991 19.5287 20.5889 18.7143 21.2945C17.9 22 16.726 22 14.3782 22H9.62182C7.27396 22 6.10003 22 5.28565 21.2945C4.47127 20.5889 4.27181 19.3991 3.87289 17.0194Z" stroke="currentColor" stroke-width="1.5" />
                        <path d="M17.5 7.5C17.5 4.46243 15.0376 2 12 2C8.96243 2 6.5 4.46243 6.5 7.5" stroke="currentColor" stroke-width="1.5" />
                    </svg>
                </a>
                {{--CARRITO--}}

                {{--LOGIN--}}
                @guest
                <a href="{{ route('user.login') }}" class="">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accents-900 hover:text-accents-600 transition-colors duration-150" viewBox="0 0 24 24" fill="none">
                        <path d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="currentColor" stroke-width="1.5" />
                        <path d="M14.75 9.5C14.75 11.0188 13.5188 12.25 12 12.25C10.4812 12.25 9.25 11.0188 9.25 9.5C9.25 7.98122 10.4812 6.75 12 6.75C13.5188 6.75 14.75 7.98122 14.75 9.5Z" stroke="currentColor" stroke-width="1.5" />
                        <path d="M5.49994 19.0001L6.06034 18.0194C6.95055 16.4616 8.60727 15.5001 10.4016 15.5001H13.5983C15.3926 15.5001 17.0493 16.4616 17.9395 18.0194L18.4999 19.0001" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
                @endguest
                {{--LOGIN--}}

                {{--LOGOUT--}}
                @auth
                    @if (auth()->user()->role === 'C')
                    <a href="{{ route('home.index') }}" class="">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accents-900 hover:text-accents-600 transition-colors duration-150" viewBox="0 0 24 24" fill="none">
                            <path d="M19.4626 3.99415C16.7809 2.34923 14.4404 3.01211 13.0344 4.06801C12.4578 4.50096 12.1696 4.71743 12 4.71743C11.8304 4.71743 11.5422 4.50096 10.9656 4.06801C9.55962 3.01211 7.21909 2.34923 4.53744 3.99415C1.01807 6.15294 0.221721 13.2749 8.33953 19.2834C9.88572 20.4278 10.6588 21 12 21C13.3412 21 14.1143 20.4278 15.6605 19.2834C23.7783 13.2749 22.9819 6.15294 19.4626 3.99415Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </a>
                    @endif

                    @if (auth()->user()->role === 'A')
                        <a href="{{ route('admin.dashboard') }}" class="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accents-900 hover:text-accents-600 transition-colors duration-150" viewBox="0 0 24 24" fill="none">
                                <path d="M2 18C2 16.4596 2 15.6893 2.34673 15.1235C2.54074 14.8069 2.80693 14.5407 3.12353 14.3467C3.68934 14 4.45956 14 6 14C7.54044 14 8.31066 14 8.87647 14.3467C9.19307 14.5407 9.45926 14.8069 9.65327 15.1235C10 15.6893 10 16.4596 10 18C10 19.5404 10 20.3107 9.65327 20.8765C9.45926 21.1931 9.19307 21.4593 8.87647 21.6533C8.31066 22 7.54044 22 6 22C4.45956 22 3.68934 22 3.12353 21.6533C2.80693 21.4593 2.54074 21.1931 2.34673 20.8765C2 20.3107 2 19.5404 2 18Z" stroke="currentColor" stroke-width="1.5" />
                                <path d="M14 18C14 16.4596 14 15.6893 14.3467 15.1235C14.5407 14.8069 14.8069 14.5407 15.1235 14.3467C15.6893 14 16.4596 14 18 14C19.5404 14 20.3107 14 20.8765 14.3467C21.1931 14.5407 21.4593 14.8069 21.6533 15.1235C22 15.6893 22 16.4596 22 18C22 19.5404 22 20.3107 21.6533 20.8765C21.4593 21.1931 21.1931 21.4593 20.8765 21.6533C20.3107 22 19.5404 22 18 22C16.4596 22 15.6893 22 15.1235 21.6533C14.8069 21.4593 14.5407 21.1931 14.3467 20.8765C14 20.3107 14 19.5404 14 18Z" stroke="currentColor" stroke-width="1.5" />
                                <path d="M2 6C2 4.45956 2 3.68934 2.34673 3.12353C2.54074 2.80693 2.80693 2.54074 3.12353 2.34673C3.68934 2 4.45956 2 6 2C7.54044 2 8.31066 2 8.87647 2.34673C9.19307 2.54074 9.45926 2.80693 9.65327 3.12353C10 3.68934 10 4.45956 10 6C10 7.54044 10 8.31066 9.65327 8.87647C9.45926 9.19307 9.19307 9.45926 8.87647 9.65327C8.31066 10 7.54044 10 6 10C4.45956 10 3.68934 10 3.12353 9.65327C2.80693 9.45926 2.54074 9.19307 2.34673 8.87647C2 8.31066 2 7.54044 2 6Z" stroke="currentColor" stroke-width="1.5" />
                                <path d="M14 6C14 4.45956 14 3.68934 14.3467 3.12353C14.5407 2.80693 14.8069 2.54074 15.1235 2.34673C15.6893 2 16.4596 2 18 2C19.5404 2 20.3107 2 20.8765 2.34673C21.1931 2.54074 21.4593 2.80693 21.6533 3.12353C22 3.68934 22 4.45956 22 6C22 7.54044 22 8.31066 21.6533 8.87647C21.4593 9.19307 21.1931 9.45926 20.8765 9.65327C20.3107 10 19.5404 10 18 10C16.4596 10 15.6893 10 15.1235 9.65327C14.8069 9.45926 14.5407 9.19307 14.3467 8.87647C14 8.31066 14 7.54044 14 6Z" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                    @endif
                    <form method="POST" action="{{ route('user.logout') }}" class="flex items-center">
                        @csrf
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accents-900 hover:text-accents-600 transition-colors duration-150" viewBox="0 0 24 24" fill="none">
                                <path d="M15 17.625C14.9264 19.4769 13.3831 21.0494 11.3156 20.9988C10.8346 20.987 10.2401 20.8194 9.05112 20.484C6.18961 19.6768 3.70555 18.3203 3.10956 15.2815C3 14.723 3 14.0944 3 12.8373L3 11.1627C3 9.90561 3 9.27705 3.10956 8.71846C3.70555 5.67965 6.18961 4.32316 9.05112 3.51603C10.2401 3.18064 10.8346 3.01295 11.3156 3.00119C13.3831 2.95061 14.9264 4.52307 15 6.37501" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M21 12H10M21 12C21 11.2998 19.0057 9.99153 18.5 9.5M21 12C21 12.7002 19.0057 14.0085 18.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </form>
                @endauth
                {{--LOGOUT--}}
            </div>
            {{--SEARCH Y BOTONES--}}
        </header>

        <main class="">
            @yield('content')
        </main>

        <footer class="w-full bg-gradient-to-bl from-sec-900 via-sec-800 to-sec-900 font-montserrat">
            {{--LOGO--}}
            <div class="py-6 flex flex-col items-center justify-center xl:flex-row">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-cwhite-500"
                    viewBox="0 0 300.000000 390.000000"
                    preserveAspectRatio="xMidYMid meet">
                    <g transform="translate(0.000000,390.000000) scale(0.050000,-0.050000)"
                    fill="currentColor" stroke="none">
                    <path d="M2120 7498 c-249 -48 -558 -267 -656 -464 -102 -205 -348 -248 -484
                    -84 -115 138 -179 -55 -67 -202 61 -81 63 -73 -59 -226 -201 -250 -427 -592
                    -530 -802 -19 -38 -39 -74 -46 -80 -32 -26 -98 -264 -98 -353 0 -120 39 -165
                    155 -181 79 -10 94 -5 269 100 315 188 647 351 943 462 237 89 501 254 527
                    329 7 18 25 48 42 67 21 26 29 85 29 222 l-1 187 108 37 c238 81 152 170 -214
                    221 -174 24 -174 61 1 172 105 67 173 71 286 17 45 -22 90 -40 99 -40 145 0
                    415 -393 341 -497 -133 -184 -135 -217 -26 -305 73 -58 80 -71 76 -151 -3 -80
                    4 -95 81 -165 86 -79 106 -122 55 -122 -45 0 -57 -74 -22 -143 42 -85 39 -143
                    -9 -187 -27 -25 -40 -62 -40 -117 0 -44 -18 -145 -40 -224 -37 -132 -38 -149
                    -10 -229 28 -80 28 -89 -10 -150 -48 -78 -49 -95 -9 -180 29 -61 29 -72 -1
                    -129 -38 -75 -27 -120 53 -211 l59 -68 -46 -84 c-25 -46 -57 -102 -71 -126
                    -42 -71 -28 -143 48 -255 69 -102 73 -115 76 -287 5 -262 147 -491 369 -597
                    94 -45 156 -127 121 -162 -20 -20 -218 76 -334 163 -163 121 -421 538 -469
                    756 -45 207 -34 927 20 1240 133 788 88 1185 -164 1445 -56 57 -120 105 -141
                    105 -32 0 -22 -18 49 -90 203 -207 225 -755 60 -1540 -230 -1093 131 -1954
                    1000 -2388 146 -73 186 -104 287 -228 64 -79 211 -240 327 -357 194 -195 210
                    -218 198 -270 -8 -31 -23 -97 -34 -147 -70 -304 67 -660 400 -1044 40 -46 102
                    -76 102 -50 0 4 9 58 21 121 31 168 -6 460 -81 636 -72 170 -54 187 121 108
                    261 -117 679 -116 679 2 0 84 -330 352 -544 442 -111 46 -151 52 -339 50
                    l-212 -2 -163 119 c-89 65 -162 127 -162 136 0 10 -39 61 -86 115 -197 221
                    -178 267 101 253 714 -36 1390 430 1517 1046 109 524 -223 693 -717 364 -96
                    -64 -184 -116 -196 -116 -25 0 72 177 121 221 19 17 51 62 70 100 19 38 48 84
                    64 103 60 68 -44 204 -171 226 -259 43 -992 -551 -1193 -967 -94 -196 -139
                    -206 -302 -72 -221 181 -237 555 -18 436 255 -139 658 91 562 321 -68 162
                    -182 167 -470 21 -310 -159 -425 -138 -331 59 45 96 148 169 268 192 106 20
                    271 87 290 118 6 10 81 34 166 53 392 86 565 167 739 345 70 72 125 145 122
                    162 -10 49 -70 49 -131 2 -412 -319 -704 -412 -870 -278 l-85 68 -266 -5 -267
                    -4 7 53 c7 59 107 93 442 148 178 29 209 52 178 133 -12 30 -27 89 -33 130
                    -21 121 -246 235 -406 205 -109 -20 -166 95 -77 155 32 21 161 18 183 -4 32
                    -32 560 -126 871 -155 153 -14 478 61 549 127 89 82 63 145 -91 221 -240 118
                    -941 132 -1250 26 -136 -47 -197 -50 -227 -13 -52 62 104 128 342 147 162 12
                    275 60 275 116 0 53 -76 64 -389 54 -329 -10 -371 2 -340 98 13 43 17 44 308
                    32 308 -13 381 2 381 78 0 43 -68 61 -293 76 -559 37 -707 116 -441 234 139
                    63 578 77 897 30 582 -87 829 -10 914 284 51 174 -121 440 -307 475 -228 43
                    -456 -191 -372 -380 80 -182 327 -195 370 -20 21 80 -14 103 -79 52 -149 -117
                    -291 9 -157 139 191 185 542 15 479 -233 -30 -122 -233 -249 -398 -249 -136 0
                    -509 153 -604 248 -16 16 -89 68 -164 117 -74 48 -161 105 -193 126 -571 384
                    -971 405 -1409 74 -95 -72 -182 -131 -193 -131 -124 -2 -133 18 -66 145 65
                    121 194 244 329 312 129 65 751 91 869 37 26 -13 98 -44 158 -69 94 -40 375
                    -194 540 -297 86 -53 178 -97 229 -110 82 -20 77 24 -7 67 -44 22 -85 50 -92
                    61 -7 11 -28 20 -48 20 -19 0 -56 23 -82 50 -26 28 -58 50 -72 50 -14 0 -50
                    21 -81 47 -32 25 -88 63 -127 84 -38 21 -88 54 -110 72 -187 159 -694 244
                    -1050 175z m740 -507 c289 -112 849 -449 811 -487 -4 -3 -146 -9 -317 -13
                    -353 -9 -338 -15 -443 179 -68 123 -92 151 -235 271 -62 52 -109 99 -104 104
                    13 14 207 -23 288 -54z m-1795 -153 c55 -67 44 -98 -34 -98 -74 0 -131 55
                    -131 127 0 51 115 31 165 -29z m626 -88 c126 -59 172 -70 288 -70 266 0 328
                    -92 110 -165 -66 -22 -78 -34 -75 -75 34 -378 -80 -536 -504 -700 -22 -9 -161
                    -62 -310 -119 -306 -118 -489 -219 -620 -341 -332 -310 -460 -28 -171 377 37
                    51 93 147 125 213 383 788 753 1070 1157 880z m2638 -1329 c134 -23 195 -65
                    154 -106 -65 -64 -992 -21 -1035 49 -51 82 514 118 881 57z m-992 -446 c65
                    -31 77 -107 28 -170 -76 -97 -383 -50 -413 62 -32 125 208 193 385 108z m60
                    -637 c183 -64 -54 -194 -317 -175 -88 7 -90 9 -90 75 0 105 230 162 407 100z
                    m1311 -490 c47 -18 39 -56 -37 -176 -112 -174 -550 -544 -884 -744 -171 -104
                    -187 -84 -89 108 134 262 688 751 912 805 33 8 62 16 63 17 2 1 18 -3 35 -10z
                    m-1157 -189 c20 -33 -51 -99 -108 -99 l-50 0 57 60 c62 65 80 72 101 39z
                    m1777 -298 c35 -36 37 -49 14 -185 -63 -390 -341 -680 -773 -808 -135 -40
                    -630 -54 -642 -18 -29 83 621 734 959 961 166 111 359 133 442 50z m-1168
                    -477 c0 -28 -441 -504 -467 -504 -107 0 -161 228 -60 252 83 20 222 94 347
                    186 102 75 180 104 180 66z"/>
                    <path d="M1438 6388 c-15 -19 -37 -62 -48 -96 -16 -51 -47 -75 -165 -131 -165
                    -78 -180 -101 -64 -101 163 0 367 166 355 288 -7 70 -39 86 -78 40z"/>
                    <path d="M1695 5558 c-30 -23 -55 -51 -55 -62 0 -11 -21 -46 -47 -76 -428
                    -508 -517 -1570 -165 -1960 25 -27 67 -81 93 -120 68 -100 155 -185 177 -171
                    23 14 -4 121 -41 165 -76 91 -197 352 -219 472 -55 299 -46 462 46 782 22 76
                    42 152 46 170 8 37 98 240 211 475 131 272 107 439 -46 325z"/>
                    </g>
                </svg>
                <h2 class="text-cwhite-500 font-cinzel">Auladell Joyas</h2>
            </div>
            {{--LOGO--}}

            <div class="border-b border-cwhite-500 col-span-6"></div>

            {{--CONTENT--}}
            <div class="flex flex-col items-center text-cwhite-500 xl:flex-row xl:items-start xl:justify-between xl:py-8 xl:px-8">
                <div class="order-2 flex flex-col w-[70%] items-start pb-6 md:pb-8 xl:w-fit xl:pb-0">
                    <h4 class="pb-1 font-bold">Categorías</h4>
                    <a href="{{ route('jewelry.index', ['type' => 'earrings']) }}" class="hover:text-accents-600 transition-colors duration-150">Aros</a>
                    <a href="{{ route('jewelry.index', ['type' => 'rings']) }}" class="hover:text-accents-600 transition-colors duration-150">Anillos</a>
                    <a href="{{ route('jewelry.index', ['type' => 'bracelets']) }}" class="hover:text-accents-600 transition-colors duration-150">Brazaletes</a>
                    <a href="{{ route('jewelry.index', ['type' => 'necklaces']) }}" class="hover:text-accents-600 transition-colors duration-150">Collares</a>
                    <a href="" class="hover:text-accents-600 transition-colors duration-150">Joya Personalizada</a>
                    <a href="{{ route('jewelry.index', ['type' => 'all-products']) }}" class="hover:text-accents-600 transition-colors duration-150">Todas las colecciones</a>
                </div>

                <div class="flex flex-col text-start order-3 w-[70%] pb-6 md:pb-8 xl:w-fit xl:pb-0">
                    <h4 class="pb-1 font-bold">Información</h4>
                    <a href="" class="hover:text-accents-600 transition-colors duration-150">Acerca de Auladell</a>
                    <a href="" class="hover:text-accents-600 transition-colors duration-150">Política de privacidad</a>
                    <a href="" class="hover:text-accents-600 transition-colors duration-150">Mantención de joyas</a>
                </div>

                <div class="flex flex-col text-start order-4 w-[70%] pb-6 md:pb-8 xl:w-fit xl:pb-0">
                    <h4 class="pb-1 font-bold">Servicio al cliente</h4>
                    <a href="" class="hover:text-accents-600 transition-colors duration-150">Preguntas frecuentes</a>
                    <a href="{{route('services.order-status')}}" class="hover:text-accents-600 transition-colors duration-150">Seguimiento de pedido</a>
                    <a href="" class="hover:text-accents-600 transition-colors duration-150">Cambios, devoluciones y garantía</a>
                </div>

                <div class="order-1 py-6 w-[70%] md:py-8 xl:w-fit xl:py-0 xl:order-5">
                    <h4 class="pb-1 font-bold">Contacto</h4>
                    <div class="flex gap-6 pb-2">
                        <a href="{{route('services.contact-us')}}" class="flex hover:text-accents-600 transition-colors duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " viewBox="0 0 24 24" fill="none">
                                <path d="M2 6L8.91302 9.91697C11.4616 11.361 12.5384 11.361 15.087 9.91697L22 6" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                <path d="M2.01577 13.4756C2.08114 16.5412 2.11383 18.0739 3.24496 19.2094C4.37608 20.3448 5.95033 20.3843 9.09883 20.4634C11.0393 20.5122 12.9607 20.5122 14.9012 20.4634C18.0497 20.3843 19.6239 20.3448 20.7551 19.2094C21.8862 18.0739 21.9189 16.5412 21.9842 13.4756C22.0053 12.4899 22.0053 11.5101 21.9842 10.5244C21.9189 7.45886 21.8862 5.92609 20.7551 4.79066C19.6239 3.65523 18.0497 3.61568 14.9012 3.53657C12.9607 3.48781 11.0393 3.48781 9.09882 3.53656C5.95033 3.61566 4.37608 3.65521 3.24495 4.79065C2.11382 5.92608 2.08114 7.45885 2.01576 10.5244C1.99474 11.5101 1.99475 12.4899 2.01577 13.4756Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                            </svg>
                            <span class="ml-2">contacto@auladelljoyas.cl</span>
                        </a>
                        
                    </div>
                    <div class="flex gap-6">
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-accents-600 transition-colors duration-150" viewBox="0 0 24 24" fill="none">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 13.3789 2.27907 14.6926 2.78382 15.8877C3.06278 16.5481 3.20226 16.8784 3.21953 17.128C3.2368 17.3776 3.16334 17.6521 3.01642 18.2012L2 22L5.79877 20.9836C6.34788 20.8367 6.62244 20.7632 6.87202 20.7805C7.12161 20.7977 7.45185 20.9372 8.11235 21.2162C9.30745 21.7209 10.6211 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                <path d="M8.58815 12.3773L9.45909 11.2956C9.82616 10.8397 10.2799 10.4153 10.3155 9.80826C10.3244 9.65494 10.2166 8.96657 10.0008 7.58986C9.91601 7.04881 9.41086 7 8.97332 7C8.40314 7 8.11805 7 7.83495 7.12931C7.47714 7.29275 7.10979 7.75231 7.02917 8.13733C6.96539 8.44196 7.01279 8.65187 7.10759 9.07169C7.51023 10.8548 8.45481 12.6158 9.91948 14.0805C11.3842 15.5452 13.1452 16.4898 14.9283 16.8924C15.3481 16.9872 15.558 17.0346 15.8627 16.9708C16.2477 16.8902 16.7072 16.5229 16.8707 16.165C17 15.8819 17 15.5969 17 15.0267C17 14.5891 16.9512 14.084 16.4101 13.9992C15.0334 13.7834 14.3451 13.6756 14.1917 13.6845C13.5847 13.7201 13.1603 14.1738 12.7044 14.5409L11.6227 15.4118" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-accents-600 transition-colors duration-150" viewBox="0 0 24 24" fill="none">
                                <path d="M2.5 12C2.5 7.52166 2.5 5.28249 3.89124 3.89124C5.28249 2.5 7.52166 2.5 12 2.5C16.4783 2.5 18.7175 2.5 20.1088 3.89124C21.5 5.28249 21.5 7.52166 21.5 12C21.5 16.4783 21.5 18.7175 20.1088 20.1088C18.7175 21.5 16.4783 21.5 12 21.5C7.52166 21.5 5.28249 21.5 3.89124 20.1088C2.5 18.7175 2.5 16.4783 2.5 12Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                <path d="M16.5 12C16.5 14.4853 14.4853 16.5 12 16.5C9.51472 16.5 7.5 14.4853 7.5 12C7.5 9.51472 9.51472 7.5 12 7.5C14.4853 7.5 16.5 9.51472 16.5 12Z" stroke="currentColor" stroke-width="1.5" />
                                <path d="M17.5078 6.5L17.4988 6.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-accents-600 transition-colors duration-150" viewBox="0 0 24 24" fill="none">
                                <path d="M2.5 12C2.5 7.52166 2.5 5.28249 3.89124 3.89124C5.28249 2.5 7.52166 2.5 12 2.5C16.4783 2.5 18.7175 2.5 20.1088 3.89124C21.5 5.28249 21.5 7.52166 21.5 12C21.5 16.4783 21.5 18.7175 20.1088 20.1088C18.7175 21.5 16.4783 21.5 12 21.5C7.52166 21.5 5.28249 21.5 3.89124 20.1088C2.5 18.7175 2.5 16.4783 2.5 12Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                <path d="M16.9265 8.02637H13.9816C12.9378 8.02637 12.0894 8.86847 12.0817 9.91229L11.9964 21.4268M10.082 14.0017H14.8847" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            {{--CONTENT--}}
        </footer>


        <script>
            hamburguer = document.querySelector('#hamburger');
            hamburguer.onclick = function() {
                navbar = document.querySelector('#navbar');
                navbar.classList.toggle('active');
            }
        </script>
    </body>
</html>