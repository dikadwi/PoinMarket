<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Betting Slip Showcase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Set minimum height to 100% of the viewport height */
        }

        main {
            flex: 1;
            /* Allow main to grow and fill the available space */
        }
    </style>
</head>

<body class="bg-yellow-400 relative">
    <header class="bg-white py-4 border border-gray-300 rounded-full mx-4 mt-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div class="flex items-center">
                <div class="bg-blue-600 text-white font-bold text-lg px-4 py-2 rounded-full">
                    Logo
                </div>
            </div>
            <nav class="flex space-x-8">
                <a class="text-gray-700 hover:text-blue-600 py-2 px-4 border-b-2 border-transparent hover:border-blue-600" href="#">Home</a>
                <a class="text-gray-700 hover:text-blue-600 py-2 px-4 border-b-2 border-transparent hover:border-blue-600" href="#">About Us</a>
                <a class="text-gray-700 hover:text-blue-600 py-2 px-4 border-b-2 border-transparent hover:border-blue-600" href="#">Content</a>
                <a class="text-gray-700 hover:text-blue-600 py-2 px-4 border-b-2 border-transparent hover:border-blue-600" href="#">Contact</a>
            </nav>
            <div class="flex space-x-4">
                <button class="border border-gray-300 rounded-full py-2 px-4 text-gray-700 hover:text-blue-600">Sign In</button>
                <button class="border border-gray-300 rounded-full py-2 px-4 text-gray-700 hover:text-blue-600">Register</button>
            </div>
        </div>
    </header>
    <main class="flex flex-col md:flex-row mt-16">
        <section class="bg-yellow-400 text-blue-900 p-8 md:w-1/2">
            <h1 class="text-5xl font-bold">Betting</h1>
            <h2 class="text-4xl font-light">Slip Showcase</h2>
            <p class="mt-4 text-lg">Share Your Winning Betting Slips and Inspire Others to Make Profitable Choices</p>
            <p class="mt-4 text-gray-700">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
            </p>
            <div class="mt-6 flex items-center">
                <input class="border border-gray-300 rounded-full py-2 px-4 w-full" placeholder="Email Address" type="email" />
                <button class="bg-red-500 text-white rounded-full py-2 px-6 ml-4">Submit</button>
            </div>
        </section>
        <section class="p-8 md:w-1/2 relative">
            <div class="absolute inset-0 flex items-center justify-center p-4 pr-8">
                <img alt="Illustration of a hand pointing at a betting slip on a mobile device surrounded by sports equipment like soccer balls, poker chips, and a trophy" class="w-full h-full object-cover rounded-lg" src="https://cdn.getmidnight.com/786bdf0b68846bffb04d4307ff13198f/2022/06/mobile-app-gamification-tips-niches.jpg" />
            </div>
        </section>
    </main>
    <footer class="bg-white py-4 border border-gray-300 rounded-full mx-4 mb-4 mt-8 text-center">
        <div class="container mx-auto">
            <p class="text-gray-700">Copyright: 2024</p>
        </div>
    </footer>
</body>

</html>