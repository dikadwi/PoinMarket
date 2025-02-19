<?= $this->extend('LandingPage/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<!-- Custom CSS for animations and effects -->
<style>
    .custom-card {
        transition: all 0.3s ease;
    }
    .custom-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .social-icon {
        transition: all 0.3s ease;
    }
    .social-icon:hover {
        transform: scale(1.2);
    }
    .faq-item {
        transition: all 0.3s ease;
    }
    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }
    .faq-item.active .faq-answer {
        max-height: 500px;
    }
</style>

<main class="p-10">
    <!-- Hero Section -->
    <section class="text-center mb-16">
        <h2 class="text-4xl font-bold text-purple-600 mb-4">Hubungi Kami</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Kami siap membantu Anda! Pilih cara yang paling nyaman untuk menghubungi tim kami.</p>
    </section>

    <!-- Contact Cards Section -->
    <section class="mb-16">
        <div class="flex flex-col md:flex-row justify-center items-stretch space-y-4 md:space-y-0 md:space-x-8">
            <div class="bg-white shadow-lg rounded-lg p-6 w-full md:w-72 custom-card">
                <div class="text-center text-purple-600 mb-4">
                    <i class="fas fa-envelope fa-3x fa-beat"></i>
                </div>
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">Email</h3>
                    <p class="text-gray-600">info@pointmarket.com</p>
                    <a href="mailto:info@pointmarket.com" class="inline-block mt-4 px-6 py-2 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition duration-300">
                        Kirim Email
                    </a>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6 w-full md:w-72 custom-card">
                <div class="text-center text-purple-600 mb-4">
                    <i class="fas fa-phone fa-3x fa-beat"></i>
                </div>
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">Telepon</h3>
                    <p class="text-gray-600">+62 123 456 789</p>
                    <a href="tel:+62123456789" class="inline-block mt-4 px-6 py-2 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition duration-300">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6 w-full md:w-72 custom-card">
                <div class="text-center text-purple-600 mb-4">
                    <i class="fas fa-map-pin fa-3x fa-beat"></i>
                </div>
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">Alamat</h3>
                    <p class="text-gray-600">Bandung, Indonesia</p>
                    <a href="https://maps.google.com/?q=Bandung,Indonesia" target="_blank" class="inline-block mt-4 px-6 py-2 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition duration-300">
                        Lihat Peta
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Google Maps Section -->
    <section class="mb-16">
        <div class="w-full h-96 rounded-lg overflow-hidden shadow-lg">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.56347862248!2d107.57311687144541!3d-6.903444341687889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1708308540000!5m2!1sen!2sid"
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="mb-16">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <h3 class="text-2xl font-bold text-purple-600 mb-6 text-center">Kirim Pesan</h3>
            <form id="contactForm" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 mb-2" for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-600" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2" for="email">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-600" required>
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2" for="subject">Subjek</label>
                    <input type="text" id="subject" name="subject" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-600" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2" for="message">Pesan</label>
                    <textarea id="message" name="message" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-600" required></textarea>
                </div>
                <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition duration-300">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </section>

    <!-- Social Media Section -->
    <section class="mb-16">
        <h3 class="text-2xl font-bold text-purple-600 mb-6 text-center">Ikuti Kami</h3>
        <div class="flex justify-center space-x-6">
            <a href="#" class="social-icon text-purple-600 hover:text-purple-700">
                <i class="fab fa-facebook fa-2x"></i>
            </a>
            <a href="#" class="social-icon text-purple-600 hover:text-purple-700">
                <i class="fab fa-twitter fa-2x"></i>
            </a>
            <a href="#" class="social-icon text-purple-600 hover:text-purple-700">
                <i class="fab fa-instagram fa-2x"></i>
            </a>
            <a href="#" class="social-icon text-purple-600 hover:text-purple-700">
                <i class="fab fa-linkedin fa-2x"></i>
            </a>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="mb-16">
        <h3 class="text-2xl font-bold text-purple-600 mb-6 text-center">Pertanyaan Umum</h3>
        <div class="max-w-2xl mx-auto space-y-4">
            <div class="faq-item bg-white rounded-lg shadow-lg overflow-hidden">
                <button class="w-full px-6 py-4 text-left focus:outline-none">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold">Apa itu PointMarket?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </button>
                <div class="faq-answer px-6 pb-4">
                    <p class="text-gray-600">PointMarket adalah platform yang memungkinkan mahasiswa untuk menukarkan poin mereka dengan berbagai produk dan layanan yang bermanfaat.</p>
                </div>
            </div>
            <div class="faq-item bg-white rounded-lg shadow-lg overflow-hidden">
                <button class="w-full px-6 py-4 text-left focus:outline-none">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold">Bagaimana cara mendapatkan poin?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </button>
                <div class="faq-answer px-6 pb-4">
                    <p class="text-gray-600">Poin dapat diperoleh melalui berbagai aktivitas akademik dan non-akademik di kampus.</p>
                </div>
            </div>
            <div class="faq-item bg-white rounded-lg shadow-lg overflow-hidden">
                <button class="w-full px-6 py-4 text-left focus:outline-none">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold">Berapa lama proses penukaran poin?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </button>
                <div class="faq-answer px-6 pb-4">
                    <p class="text-gray-600">Proses penukaran poin biasanya memakan waktu 1-2 hari kerja setelah permintaan disetujui.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Live Chat Button -->
    <div class="fixed bottom-8 right-8">
        <button id="liveChatBtn" class="bg-purple-600 text-white p-4 rounded-full shadow-lg hover:bg-purple-700 transition duration-300">
            <i class="fas fa-comments fa-lg"></i>
        </button>
    </div>
</main>

<!-- JavaScript for Interactions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Contact Form Validation and Submission
    const contactForm = document.getElementById('contactForm');
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Add your form submission logic here
        alert('Terima kasih! Pesan Anda telah terkirim.');
        contactForm.reset();
    });

    // FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const button = item.querySelector('button');
        button.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            // Close all FAQ items
            faqItems.forEach(faqItem => {
                faqItem.classList.remove('active');
            });
            // Open clicked item if it wasn't active
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });

    // Live Chat Button
    const liveChatBtn = document.getElementById('liveChatBtn');
    liveChatBtn.addEventListener('click', function() {
        alert('Fitur live chat akan segera hadir!');
    });
});
</script>

<?= $this->endsection(); ?>