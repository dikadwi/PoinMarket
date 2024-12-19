<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Poin Market
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>/fafavicon.ico">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .fade-out {
            animation: fade-out 3s;
        }

        @keyframes fade-out {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.50;
            }

            100% {
                opacity: 0;
            }
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="flex flex-col md:flex-row bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Pesan -->
        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 mt-10">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div id="pesan" class="mb-4 text-white bg-red-500 text-center rounded-full py-2 font-bold">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
                <script>
                    setTimeout(function() {
                        document.getElementById("pesan").classList.add("fade-out");
                        setTimeout(function() {
                            document.getElementById("pesan").remove();
                        }, 3000); // 1000 miliseconds = 1 detik
                    }, 6000); // 2000 miliseconds = 2 detik
                </script>
            <?php endif; ?>
        </div>
        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 mt-10">
            <div id="message-block" class="mb-4 text-white bg-red-500 text-center rounded-full py-2 font-bold">
                <?= view('Myth\Auth\Views\_message_block') ?>
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById("message-block").classList.add("fade-out");
                    setTimeout(function() {
                        document.getElementById("message-block").remove();
                    }, 3000); // 1000 miliseconds = 1 detik
                }, 6000); // 2000 miliseconds = 2 detik
            </script>
        </div>

        <!-- Left Side -->
        <div class="bg-orange-400 p-8 flex flex-col justify-center items-center w-full md:w-1/2">
            <h2 class="text-white text-3xl font-bold mb-6">
                WELCOME
            </h2>
            <form class="w-full max-w-sm" action="/Login/process" method="post">
                <div class="mb-4">
                    <input class="w-full px-4 py-2 rounded-full text-center text-black" placeholder="Username / Npm" type="text" name="npm_or_username" value="" />
                </div>
                <div class="mb-4">
                    <input class="w-full px-4 py-2 rounded-full text-center text-black" placeholder="Password" type="password" name="password" value="" />
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center text-white">
                        <input class="form-checkbox" type="checkbox" />
                        <span class="ml-2">
                            Remember
                        </span>
                    </label>
                    <a class="text-white" href="#">
                        Forgot Password?
                    </a>
                </div>
                <button class="w-full bg-green-500 text-white py-2 rounded-full font-bold">
                    SUBMIT
                </button>
            </form>
        </div>
        <!-- Right Side -->
        <div class="bg-white p-8 flex justify-center items-center w-full md:w-1/2">
            <img alt="Illustration of a woman pointing at a large mobile phone screen and a man sitting with a laptop" height="400" src="https://storage.googleapis.com/a1aa/image/mbF73hot3hoxK90ZHuua0ybpea2ybzJBT2RDdSTSMfdKZC5TA.jpg" width="400" />
        </div>
    </div>
</body>
<script>
    window.onload = function() {
        document.querySelector('input[name="npm_or_username"]').value = '';
        document.querySelector('input[name="password"]').value = '';
    };
</script>

</html>