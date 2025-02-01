    @extends('layouts.app')

    @section('head')
    @endsection

    @section('content')
        <main class="max-w-screen-xl mx-auto p-4 bg-white min-h-screen font-roboto rounded-lg mt-20 pt-12">
            <div class="w-full relative mb-16">
                <img src="{{ asset('img/placeholderImg/1535x600.png') }}" alt="">
                <h1 class="text-5xl font-semibold  text-center font-monserrat">
                    Pantai
                </h1>
            </div>

            <section class="">
                <div class="flex items-center justify-between mb-16">
                    <div class="relative">
                        <input type="text"
                            class="rounded-lg pl-10 pr-4 py-2 border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            placeholder="Search...">
                        <i class="fas fa-search absolute left-3 top-[50%] transform -translate-y-1/2 text-gray-600 text-xl"></i>
                    </div>
                    <div class="relative">
                        <button id="dropdown2"
                            class="border border-black rounded-md px-8 py-1 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg font-medium">
                            Filter
                            <span>
                                <i id="chevron2" class="fas fa-chevron-up text-sm duration-200"></i>
                            </span>
                        </button>
                        <ul id="dropdown-item2"
                            class="absolute hidden -left-16 mt-1 w-48 bg-white border border-gray-300 rounded-md shadow-lg z-10">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-200">Termahal</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-200">Termurah</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="grid grid-cols-4 gap-9 mb-9">
                    @for ($i = 1; $i <= 8; $i++)
                        <a href="{{ route('user.detail') }}"
                class=" rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200">
                <img src="{{ asset('assets/img/placeholderImg/350x250.png') }}" alt=""
                    class="rounded-t-lg w-full">
                <div class="p-4 flex flex-col gap-4">
                    <div class="space-y-2">
                        <h4 class="font-medium text-gray-500 text-xs tracking-widest uppercase">Mojokerto</h4>
                        <h1 class="font-bold text-[#484753] text-xl font-monserrat">Gunung Bromo</h1>
                        <p class="line-clamp-2 text-sm text-gray-600">
                            Gunung Bromo, bagian dari Taman Nasional Bromo Tengger Semeru, terkenal dengan panorama
                            matahari terbit yang memukau. Dengan ketinggian 2.329 meter, gunung berapi aktif ini
                            menawarkan pemandangan kawah yang spektakuler dan lanskap yang menakjubkan. </p>
                    </div>
                    <div class="flex items-end justify-between">
                        <div class="flex items-center gap-1 text-sm">
                            <img src="{{ asset('assets/img/star.png') }}" alt="" class="w-4 h-4">
                            <span class="font-medium">5</span>
                            <span class="text-gray-500">(1)</span>
                        </div>
                        <div class="text-right">
                            <h5 class="text-sm text-gray-500">Mulai</h5>
                            <span class="text-xl font-semibold text-[#e02e4c]">Rp 120.000</span>
                        </div>
                    </div>
                </div>
            </a>
                    @endfor
                </div>
                <div class="flex justify-end mt-6">
                    <nav aria-label="Page navigation">
                        <ul class="inline-flex -space-x-px">
                            <li>
                                <a href="#"
                                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100"
                                    aria-label="Previous">
                                    <span>&laquo;</span> <!-- Simbol untuk previous -->
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-100">1</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-100">2</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-100">3</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-100">4</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-100">5</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100"
                                    aria-label="Next">
                                    <span>&raquo;</span> <!-- Simbol untuk next -->
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </section>
        </main>
    @endsection

    @section('script')
        <script src="{{ asset('js/app.js') }}"></script>
    @endsection
