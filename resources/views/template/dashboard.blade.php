<!DOCTYPE html>
<html lang="en" class="h-full">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <title>Auladell Joyas</title>
        @vite('resources/css/app.css')
        @vite(['resources/js/app.js'])
    </head>
    <body class="h-full bg-[#060606] text-cwhite-500 font-cinzel overflow-hidden">
        <div class="flex h-full">
            {{-- SIDEBAR --}}
            <aside class="w-[300px] flex-shrink-0 flex flex-col bg-[#060606]">
                <div class="flex-1 flex flex-col min-h-0">
                    {{-- LOGO --}}
                    <div class="flex-shrink-0 flex flex-col items-center px-12 mt-10">
                        <a href="{{ route('home.index') }}" class="w-full flex flex-col gap-3 items-center">
                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-[#006C55]"
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
                            <h2 class="text-xl">Auladell Joyas</h2>
                        </a>
                    </div>

                    {{-- MENU --}}
                    <nav class="flex-1 flex flex-col mt-12">
                        <div class="px-12 text-sm mb-3">Menú</div>
                        <div class="flex-1 flex flex-col">
                            <a href="{{ route('admin.product') }}" class="w-full px-12 pt-5 pb-5 flex items-center gap-4 border-b
                            {{ request()->routeIs('admin.product') ? 'bg-[#0E0E0E] border-l-[3px] border-l-[#006C55]' : 'border-l-[3px] border-l-transparent' }}">
                                <div class="bg-[#006C55] w-8 h-8 flex items-center justify-center rounded-lg">
                                    <svg fill="currentColor" class="h-5 w-5 text-cwhite-500" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 121.75 122.88" xml:space="preserve">
                                        <g><path d="M17.38,19.5c1.66-0.44,3.23-0.82,4.7-1.18c1.71-0.42,3.28-0.8,4.74-1.22c0.27,1.53,0.64,3.03,1.1,4.49 c-1.21,1.19-1.96,2.85-1.96,4.68c0,3.62,2.94,6.56,6.56,6.56c0.46,0,0.9-0.05,1.34-0.14c1.66,2.08,3.56,3.97,5.65,5.62 c-0.12,0.49-0.18,1.01-0.18,1.54c0,3.62,2.94,6.56,6.56,6.56c1.97,0,3.74-0.87,4.94-2.24l-0.06,0.07c1.12,0.35,2.27,0.64,3.44,0.87 L43.86,55.46L42.32,57l18.56,18.56L79.43,57L67.58,45.14c1.17-0.23,2.33-0.51,3.45-0.85c1.2,1.3,2.92,2.12,4.82,2.12 c3.62,0,6.56-2.94,6.56-6.56c0-0.47-0.05-0.93-0.14-1.37c0.24-0.19,0.49-0.38,0.73-0.58c1.88-1.54,3.59-3.27,5.11-5.17 c0.36,0.06,0.73,0.09,1.11,0.09c3.63,0,6.56-2.94,6.56-6.56c0-1.73-0.67-3.3-1.76-4.48c0.42-1.29,0.77-2.61,1.03-3.96 c0.02-0.09,0.03-0.18,0.04-0.27l13.36,3.49c4.07,1.06,5.2,0.87,8.32,3.85c7.64,7.3,4.84,18.77,2.39,28.86 c-0.42,1.71-0.82,3.37-1.17,5.01c-2.33,11.09-5.3,21.92-9.08,32.42c-3.78,10.5-8.38,20.66-13.97,30.38 c-0.48,0.84-1.36,1.31-2.26,1.31v0.01H28.87c-1.03,0-1.93-0.6-2.35-1.47c-3.79-6.56-7.28-13.3-10.4-20.25 c-3.15-7.01-5.92-14.19-8.23-21.58c-1.55-4.93-2.91-10-4.06-15.23c-1.14-5.19-2.07-10.48-2.76-15.9l-0.18-1.37 c-1.24-9.54-2.57-19.76,6.67-24.47C10.26,21.23,14.34,20.31,17.38,19.5L17.38,19.5z M30.99,15.6c4.55-2.08,8.08-5.64,11.76-14.03 c0.43-0.98,1.38-1.57,2.39-1.57V0h31.91c1.19,0,2.2,0.8,2.51,1.89c1.23,3.43,2.69,6.45,4.49,8.92c1.69,2.33,3.68,4.18,6.06,5.44 l0.84,0.22c-0.08,0.16-0.13,0.33-0.17,0.52c-0.19,0.94-0.41,1.86-0.68,2.76c-0.29-0.04-0.58-0.06-0.88-0.06 c-3.62,0-6.56,2.94-6.56,6.56c0,1.65,0.61,3.15,1.61,4.3c-1.21,1.45-2.56,2.78-4.02,3.98c-0.08,0.07-0.17,0.14-0.25,0.21 c-1.13-0.92-2.57-1.47-4.14-1.47c-3.62,0-6.56,2.94-6.56,6.56c0,0.14,0.01,0.28,0.01,0.42c-1.8,0.51-3.66,0.86-5.58,1.03 c-1.91,0.13-3.8,0.09-5.68-0.02c-1.92-0.19-3.8-0.55-5.6-1.08c-0.03,0.65,0.01-0.16,0.01-0.35c0-3.63-2.94-6.56-6.56-6.56 c-1.51,0-2.9,0.51-4.01,1.37l0,0c-1.56-1.27-2.99-2.68-4.28-4.23l-0.01,0.01c0.93-1.13,1.48-2.58,1.48-4.16 c0-3.63-2.94-6.56-6.56-6.56c-0.21,0-0.42,0.01-0.63,0.03l0,0C31.51,18.39,31.2,17.01,30.99,15.6L30.99,15.6L30.99,15.6z M89.22,23.11c1.74,0,3.15,1.41,3.15,3.15c0,1.74-1.41,3.15-3.15,3.15c-1.74,0-3.15-1.41-3.15-3.15 C86.07,24.52,87.48,23.11,89.22,23.11L89.22,23.11z M32.53,23.11c1.74,0,3.15,1.41,3.15,3.15c0,1.74-1.41,3.15-3.15,3.15 c-1.74,0-3.15-1.41-3.15-3.15C29.38,24.52,30.79,23.11,32.53,23.11L32.53,23.11z M45.9,36.69c1.74,0,3.15,1.41,3.15,3.15 c0,1.74-1.41,3.15-3.15,3.15c-1.74,0-3.15-1.41-3.15-3.15C42.75,38.1,44.16,36.69,45.9,36.69L45.9,36.69z M75.86,36.69 c1.74,0,3.15,1.41,3.15,3.15c0,1.74-1.41,3.15-3.15,3.15c-1.74,0-3.15-1.41-3.15-3.15C72.71,38.1,74.12,36.69,75.86,36.69 L75.86,36.69z M60.88,53.27c2.06,0,3.73,1.67,3.73,3.73c0,2.06-1.67,3.73-3.73,3.73c-2.06,0-3.73-1.67-3.73-3.73 C57.14,54.94,58.82,53.27,60.88,53.27L60.88,53.27z M50.22,57l10.66-10.66L71.54,57L60.88,67.66L50.22,57L50.22,57z"/></g>
                                    </svg>
                                </div>
                                Productos</a>
                            <a href="{{ route('admin.order') }}" class="w-full px-12 pt-5 pb-5 flex items-center gap-4 border-b
                            {{ request()->routeIs('admin.order') ? 'bg-[#0E0E0E] border-l-[3px] border-l-[#006C55]' : 'border-l-[3px] border-l-transparent' }}">
                                <div class="bg-[#006C55] w-8 h-8 flex items-center justify-center rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cwhite-500" viewBox="0 0 24 24" width="24" fill="none">
                                        <path d="M12 22C11.1818 22 10.4002 21.6698 8.83693 21.0095C4.94564 19.3657 3 18.5438 3 17.1613C3 16.7742 3 10.0645 3 7M12 22C12.8182 22 13.5998 21.6698 15.1631 21.0095C19.0544 19.3657 21 18.5438 21 17.1613V7M12 22L12 11.3548" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8.32592 9.69138L5.40472 8.27785C3.80157 7.5021 3 7.11423 3 6.5C3 5.88577 3.80157 5.4979 5.40472 4.72215L8.32592 3.30862C10.1288 2.43621 11.0303 2 12 2C12.9697 2 13.8712 2.4362 15.6741 3.30862L18.5953 4.72215C20.1984 5.4979 21 5.88577 21 6.5C21 7.11423 20.1984 7.5021 18.5953 8.27785L15.6741 9.69138C13.8712 10.5638 12.9697 11 12 11C11.0303 11 10.1288 10.5638 8.32592 9.69138Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M6 12L8 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M17 4L7 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                Pedidos</a>
                            <a href="{{ route('admin.materials') }}" class="w-full px-12 pt-5 pb-5 flex items-center gap-4 border-b
                            {{ request()->routeIs('admin.materials') ? 'bg-[#0E0E0E] border-l-[3px] border-l-[#006C55]' : 'border-l-[3px] border-l-transparent' }}">
                                <div class="bg-[#006C55] w-8 h-8 flex items-center justify-center rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6 text-cwhite-500" fill="none">
                                        <path d="M5.78223 4.18192C6.43007 3.68319 6.754 3.43383 7.12788 3.27323C7.29741 3.20041 7.47367 3.14158 7.65459 3.09741C8.0536 3 8.4767 3 9.32289 3H14.6771C15.5233 3 15.9464 3 16.3454 3.09741C16.5263 3.14158 16.7026 3.20041 16.8721 3.27323C17.246 3.43383 17.5699 3.68319 18.2178 4.18192C20.3644 5.83448 21.4378 6.66077 21.8057 7.73078C21.9694 8.20673 22.0305 8.70728 21.9858 9.20461C21.8852 10.3227 21.0379 11.346 19.3433 13.3925L15.3498 18.2153C13.8126 20.0718 13.044 21 12 21C10.956 21 10.1874 20.0718 8.65018 18.2153L4.65671 13.3925C2.96208 11.346 2.11476 10.3227 2.0142 9.20461C1.96947 8.70728 2.03064 8.20673 2.1943 7.73078C2.56224 6.66077 3.63557 5.83448 5.78223 4.18192Z" stroke="currentColor" stroke-width="1.5" />
                                        <path d="M10 8.5H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                Materiales</a>
                            <a href="{{ route('admin.rerpot') }}" class="w-full px-12 pt-5 pb-5 flex items-center gap-4 border-b
                            {{ request()->routeIs('admin.rerpot') ? 'bg-[#0E0E0E] border-l-[3px] border-l-[#006C55]' : 'border-l-[3px] border-l-transparent' }}">
                                <div class="bg-[#006C55] w-8 h-8 flex items-center justify-center rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cwhite-500" viewBox="0 0 24 24" fill="none">
                                        <path d="M7 17L7 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path d="M12 17L12 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path d="M17 17L17 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path d="M2.5 12C2.5 7.52166 2.5 5.28249 3.89124 3.89124C5.28249 2.5 7.52166 2.5 12 2.5C16.4783 2.5 18.7175 2.5 20.1088 3.89124C21.5 5.28249 21.5 7.52166 21.5 12C21.5 16.4783 21.5 18.7175 20.1088 20.1088C18.7175 21.5 16.4783 21.5 12 21.5C7.52166 21.5 5.28249 21.5 3.89124 20.1088C2.5 18.7175 2.5 16.4783 2.5 12Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                Reportes</a>
                        </div>
                    </nav>
                </div>

                <div class="flex-shrink-0 px-12 pt-4 pb-12 border-t border-[#CED4E0]">
                    <div class="relative">
                        <div id="adminDropdownToggle" class="flex items-center justify-between cursor-pointer" onclick="toggleDropdown()">
                            <span>{{ $adminName }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cwhite-500" viewBox="0 0 24 24" fill="none">
                                <path d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
        
                        {{--DROPDOWN MENU--}}
                        <div id="adminDropdownMenu" class="hidden absolute top-full left-0 mt-2 bg-[#0E0E0E] shadow-lg border rounded-md w-full z-50">
                            <form method="POST" action="{{ route('user.logout') }}">
                                @csrf
                                <button type="submit" class="block w-full hover:bg-[#006C55] rounded-md text-left px-4 py-2 text-sm text-cwhite-500">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </aside>

            {{-- MAIN CONTENT --}}
            <main class="flex-1 flex flex-col overflow-hidden bg-[#0E0E0E] rounded-xl">
                @yield('content')
            </main>
        </div>

        @auth
            <script>
                window.userId = {{ auth()->id() }};
            </script>
        @else
            <script>
                window.guestId = "{{ session('guest_id') }}";
            </script>
        @endauth
    </body>

    <script>
        function toggleDropdown() {
            const menu = document.getElementById('adminDropdownMenu');      
            menu.classList.toggle('hidden');
        }
    
        // Cerrar el menú si haces clic fuera de él
        document.addEventListener('click', function(event) {
            const toggle = document.getElementById('adminDropdownToggle');
            const menu = document.getElementById('adminDropdownMenu');
            if (!toggle.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
</html>