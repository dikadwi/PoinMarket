<header class="bg-gradient-to-r from-purple-500 to-pink-500 p-6 flex justify-between items-center fixed top-0 left-0 right-0 z-50">
    <div class="text-white text-2xl font-bold flex items-center">
        <img src="/img/PointMarket.png" alt="" width="50px">
        <span>POINT MARKET</span>
    </div>
    <nav class="hidden md:flex space-x-6 text-white items-center">
        <a class="hover:text-gray-300" href="/page">HOME</a>
        <a class="hover:text-gray-300" href="/page/gamifikasi">GAMIFIKASI</a>
        <a class="hover:text-gray-300" href="/page/gaya_belajar">GAYA BELAJAR</a>
        <a class="hover:text-gray-300" href="#/page/about">ABOUT</a>
        <a class="hover:text-gray-300" href="#/page/contact">CONTACT</a>
        <a href="/login">
            <button class="bg-white text-purple-600 px-4 py-2 rounded-full hover:bg-gray-200">ADMIN</button>
        </a>
        <a href="/loginMhs">
            <button class="bg-white text-purple-600 px-4 py-2 rounded-full hover:bg-gray-200">SIGN IN</button>
        </a>
    </nav>
    <div class="md:hidden">
        <input type="checkbox" id="menu-toggle" class="hidden">
        <label for="menu-toggle" class="text-white cursor-pointer">
            <i class="fas fa-bars"></i> <!-- Hamburger icon -->
        </label>
        <nav class="absolute top-16 left-0 right-0 bg-white text-purple-600 hidden" id="mobile-menu">
            <a class="block px-4 py-2 hover:bg-gray-200" href="/page">HOME</a>
            <a class="block px-4 py-2 hover:bg-gray-200" href="/page/gamifikasi">GAMIFIKASI</a>
            <a class="block px-4 py-2 hover:bg-gray-200" href="/page/gaya_belajar">GAYA BELAJAR</a>
            <a class="block px-4 py-2 hover:bg-gray-200" href="#/page/about">ABOUT</a>
            <a class="block px-4 py-2 hover:bg-gray-200" href="#/page/contact">CONTACT</a>
            <a href="/login">
                <button class="block w-full text-left bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">ADMIN</button>
            </a>
            <a href="/loginMhs">
                <button class="block w-full text-left bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">SIGN IN</button>
            </a>
        </nav>
    </div>
</header>