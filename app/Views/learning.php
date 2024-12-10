<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penentuan Gaya Belajar Siswa</title>
    <!-- Menyertakan Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Penentuan Gaya Belajar Siswa Berdasarkan Gamifikasi</h1>

        <!-- Form untuk memilih siswa -->
        <div class="mb-3">
            <label for="student" class="form-label">Pilih Siswa:</label>
            <select id="student" class="form-select">
                <option value="">Pilih Siswa</option>
                <?php if (!empty($students) && is_array($students)): ?>
                    <?php foreach ($students as $student): ?>
                        <option value="<?php echo esc($student['npm']); ?>"><?php echo esc($student['nama']); ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">Tidak ada siswa tersedia</option>
                <?php endif; ?>
            </select>
        </div>

        <!-- Menampilkan hasil gaya belajar -->
        <div id="style-result" class="alert alert-info" style="display:none;">
            <h3>Gaya Belajar: <span id="learning-style"></span></h3>
        </div>
    </div>

    <!-- Menyertakan Bootstrap dan jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Event listener ketika memilih siswa
            $('#student').change(function() {
                var studentId = $(this).val();

                if (studentId) {
                    // Mengambil data gaya belajar siswa dari backend
                    $.getJSON('<?= site_url('Learning/getLearningStyle') ?>/' + studentId, function(data) {
                        // Menampilkan gaya belajar
                        if (data.learningStyle) {
                            $('#style-result').show();
                            $('#learning-style').text(data.learningStyle);
                        } else {
                            $('#style-result').hide();
                            alert(data.error || 'Terjadi kesalahan saat mengambil data.');
                        }
                    }).fail(function() {
                        $('#style-result').hide();
                        alert('Terjadi kesalahan saat menghubungi server.');
                    });
                } else {
                    $('#style-result').hide();
                }
            });
        });
    </script>
</body>

</html>