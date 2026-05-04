<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SimulationTopic;

class SimulationTopicSeeder extends Seeder
{
    public function run(): void
    {
        SimulationTopic::truncate();

        $topics = [
            [
                'slug' => 'pendidikan',
                'title' => 'Pendidikan Gratis untuk Semua',
                'difficulty' => 'easy',
                'is_active' => true,
                'stance_keywords' => [
                    'pro' => ['hak', 'merata', 'investasi', 'akses', 'gratis', 'pemerintah', 'semua'],
                    'kontra' => ['anggaran', 'beban', 'pajak', 'kualitas', 'subsidi', 'mahal', 'biaya']
                ],
                'opponent_arguments' => [
                    'pro' => [
                        1 => "Saya memahami pendapat Anda. Namun, pendidikan gratis sepenuhnya akan membebani APBN secara masif. Dari mana pemerintah akan mendapatkan dana tanpa menaikkan pajak secara drastis?",
                        2 => "Pajak yang tinggi akan membebani kelas menengah ke bawah juga. Subsidi penuh seringkali membuat kualitas fasilitas menurun. Apa solusi Anda untuk menjaga kualitas?",
                        3 => "Di banyak negara, model pendidikan gratis terbukti menurunkan daya saing kampus karena ketergantungan pada dana negara. Pertahankan argumen Anda!",
                        4 => "Baiklah, silakan berikan pernyataan penutup untuk menegaskan kembali posisi Pro Anda secara utuh."
                    ],
                    'kontra' => [
                        1 => "Argumen yang masuk akal terkait biaya. Tetapi, bukankah pendidikan adalah hak asasi manusia dasar? Tanpa pendidikan gratis, kesenjangan sosial akan semakin melebar.",
                        2 => "Meskipun ada masalah anggaran, investasi di pendidikan gratis akan menghasilkan generasi yang lebih produktif di masa depan. Bisakah Anda membantah ini?",
                        3 => "Negara-negara Skandinavia sukses dengan pendidikan gratisnya dan memiliki indeks kebahagiaan serta inovasi yang tinggi. Mengapa ini tidak bisa diterapkan?",
                        4 => "Silakan berikan pernyataan penutup untuk merangkum posisi Kontra Anda secara utuh."
                    ]
                ]
            ],
            [
                'slug' => 'wfh',
                'title' => 'Pekerjaan WFH sebagai Standar Baru',
                'difficulty' => 'medium',
                'is_active' => true,
                'stance_keywords' => [
                    'pro' => ['fleksibel', 'produktif', 'hemat', 'macet', 'keseimbangan', 'rumah', 'efisien'],
                    'kontra' => ['koordinasi', 'isolasi', 'disiplin', 'kantor', 'fisik', 'komunikasi', 'sulit']
                ],
                'opponent_arguments' => [
                    'pro' => [
                        1 => "Fleksibilitas memang baik, namun WFH menghancurkan batasan antara waktu kerja dan istirahat. Banyak pekerja justru mengalami burnout. Bagaimana Anda merespons?",
                        2 => "Koordinasi tim dan inovasi spontan sangat sulit tanpa interaksi tatap muka langsung. Produktivitas jangka panjang bisa terancam. Bantah argumen ini!",
                        3 => "Perusahaan kesulitan memantau kedisiplinan dan keamanan data saat karyawan bekerja dari berbagai lokasi. Solusi apa yang Anda tawarkan?",
                        4 => "Silakan berikan pernyataan penutup untuk menegaskan posisi Pro Anda terkait WFH."
                    ],
                    'kontra' => [
                        1 => "Masalah koordinasi memang ada, tetapi teknologi komunikasi saat ini sudah sangat maju. WFH menghemat waktu berjam-jam yang terbuang untuk komuter. Bagaimana tanggapan Anda?",
                        2 => "Banyak studi menunjukkan pekerja justru lebih produktif di rumah karena terhindar dari gangguan kantor. Bisakah Anda membantah fakta ini?",
                        3 => "WFH memberikan dampak positif bagi lingkungan karena berkurangnya polusi kendaraan. Tidakkah ini pantas dijadikan standar baru?",
                        4 => "Silakan berikan pernyataan penutup untuk merangkum posisi Kontra Anda terkait WFH."
                    ]
                ]
            ],
            [
                'slug' => 'ai',
                'title' => 'Penggunaan AI di Sekolah',
                'difficulty' => 'medium',
                'is_active' => true,
                'stance_keywords' => [
                    'pro' => ['modern', 'cepat', 'bantu', 'alat', 'inovasi', 'teknologi', 'personalisasi'],
                    'kontra' => ['malas', 'plagiat', 'curang', 'kritis', 'gantung', 'etika', 'berpikir']
                ],
                'opponent_arguments' => [
                    'pro' => [
                        1 => "AI memang canggih, tapi penggunaannya di sekolah berisiko membuat siswa malas berpikir mandiri. Bagaimana Anda mengatasi risiko ini?",
                        2 => "Plagiarisme dan kurangnya orisinalitas akan merajalela. Guru akan kesulitan membedakan karya asli siswa. Apa tanggapan Anda?",
                        3 => "Terlalu bergantung pada AI dapat menghilangkan kemampuan berpikir kritis siswa, yang merupakan tujuan utama pendidikan. Pertahankan argumen Anda!",
                        4 => "Silakan berikan pernyataan penutup untuk menegaskan posisi Pro Anda."
                    ],
                    'kontra' => [
                        1 => "Menolak AI sama saja dengan menolak kalkulator di masa lalu. AI adalah alat bantu masa depan yang mempercepat proses belajar. Bagaimana tanggapan Anda?",
                        2 => "Daripada melarang, sekolah seharusnya mengajarkan literasi AI agar siswa tahu cara menggunakannya secara etis. Bantah argumen ini!",
                        3 => "AI dapat membantu guru mengurangi beban administratif, sehingga lebih fokus pada pendampingan karakter siswa. Bukankah ini meningkatkan kualitas pendidikan?",
                        4 => "Silakan berikan pernyataan penutup untuk merangkum posisi Kontra Anda."
                    ]
                ]
            ],
            [
                'slug' => 'medsos',
                'title' => 'Media Sosial Harus Dibatasi untuk Remaja',
                'difficulty' => 'easy',
                'is_active' => true,
                'stance_keywords' => [
                    'pro' => ['kesehatan', 'mental', 'kecanduan', 'lindungi', 'batas', 'anak', 'aman', 'regulasi'],
                    'kontra' => ['kebebasan', 'kreativitas', 'informasi', 'koneksi', 'belajar', 'hak', 'ekspresi']
                ],
                'opponent_arguments' => [
                    'pro' => [
                        1 => "Pembatasan memang terdengar baik, namun media sosial juga menjadi sarana kreativitas dan pembelajaran bagi remaja. Bagaimana Anda menanggapi manfaat positifnya?",
                        2 => "Membatasi akses justru bisa mendorong remaja mencari jalan pintas yang lebih berbahaya. Bukankah edukasi lebih efektif daripada pelarangan?",
                        3 => "Di era digital, membatasi media sosial sama dengan membatasi akses informasi. Pertahankan argumen Anda bahwa pembatasan tetap diperlukan!",
                        4 => "Silakan berikan pernyataan penutup untuk posisi Pro Anda."
                    ],
                    'kontra' => [
                        1 => "Memang ada manfaat, tetapi WHO sudah mengkategorikan kecanduan media sosial sebagai masalah kesehatan mental serius bagi remaja. Bagaimana tanggapan Anda?",
                        2 => "Data menunjukkan bahwa cyberbullying dan depresi di kalangan remaja meningkat tajam seiring penggunaan media sosial. Bisakah Anda membantah ini?",
                        3 => "Otak remaja belum berkembang sempurna untuk mengelola dopamine dari media sosial. Tidakkah ini alasan kuat untuk pembatasan?",
                        4 => "Silakan berikan pernyataan penutup untuk posisi Kontra Anda."
                    ]
                ]
            ],
            [
                'slug' => 'hukuman-mati',
                'title' => 'Hukuman Mati untuk Koruptor',
                'difficulty' => 'hard',
                'is_active' => true,
                'stance_keywords' => [
                    'pro' => ['jera', 'efek', 'tegas', 'rakyat', 'keadilan', 'korupsi', 'hukum', 'berat'],
                    'kontra' => ['HAM', 'rehabilitasi', 'kemanusiaan', 'salah', 'vonis', 'proporsional', 'reformasi']
                ],
                'opponent_arguments' => [
                    'pro' => [
                        1 => "Hukuman mati memang terdengar tegas, tetapi banyak negara dengan hukuman mati justru masih memiliki tingkat korupsi tinggi. Apakah hukuman mati benar-benar efektif?",
                        2 => "Bagaimana jika terjadi kesalahan vonis? Hukuman mati bersifat ireversibel. Bukankah hukuman seumur hidup lebih aman?",
                        3 => "Reformasi sistem hukum dan pencegahan korupsi lebih fundamental daripada sekadar menghukum berat. Pertahankan argumen Anda!",
                        4 => "Silakan berikan pernyataan penutup untuk posisi Pro Anda."
                    ],
                    'kontra' => [
                        1 => "Korupsi merampas hak hidup jutaan rakyat miskin secara tidak langsung. Bukankah ini setara dengan pembunuhan massal? Bagaimana tanggapan Anda?",
                        2 => "Hukuman ringan terbukti tidak memberikan efek jera. Koruptor yang sudah bebas banyak yang kembali melakukan korupsi. Bantah fakta ini!",
                        3 => "Negara seperti China yang menerapkan hukuman mati untuk koruptor berhasil menekan angka korupsi secara signifikan. Mengapa ini tidak bisa diterapkan?",
                        4 => "Silakan berikan pernyataan penutup untuk posisi Kontra Anda."
                    ]
                ]
            ],
            [
                'slug' => 'energi-nuklir',
                'title' => 'Indonesia Perlu Membangun PLTN',
                'difficulty' => 'hard',
                'is_active' => true,
                'stance_keywords' => [
                    'pro' => ['energi', 'bersih', 'efisien', 'kapasitas', 'modern', 'listrik', 'masa depan', 'karbon'],
                    'kontra' => ['radiasi', 'bencana', 'limbah', 'risiko', 'gempa', 'bahaya', 'mahal', 'alternatif']
                ],
                'opponent_arguments' => [
                    'pro' => [
                        1 => "Nuklir memang efisien, tetapi Indonesia berada di Ring of Fire dengan risiko gempa dan tsunami tinggi. Bagaimana Anda menjamin keamanannya?",
                        2 => "Limbah nuklir membutuhkan ribuan tahun untuk terurai. Siapa yang akan bertanggung jawab atas limbah tersebut? Bantah argumen ini!",
                        3 => "Energi surya dan angin sudah semakin murah dan aman. Mengapa harus mengambil risiko dengan nuklir? Pertahankan posisi Anda!",
                        4 => "Silakan berikan pernyataan penutup untuk posisi Pro Anda."
                    ],
                    'kontra' => [
                        1 => "Kebutuhan listrik Indonesia terus meningkat drastis. Energi terbarukan saja tidak cukup memenuhi kebutuhan baseload. Bagaimana solusi Anda?",
                        2 => "Teknologi reaktor generasi terbaru sudah jauh lebih aman. Kecelakaan Chernobyl dan Fukushima terjadi pada teknologi lama. Bisakah Anda membantah ini?",
                        3 => "Nuklir menghasilkan emisi karbon hampir nol saat operasi. Untuk mencapai target net-zero, nuklir adalah pilihan paling realistis. Tanggapi!",
                        4 => "Silakan berikan pernyataan penutup untuk posisi Kontra Anda."
                    ]
                ]
            ],
            [
                'slug' => 'seragam-sekolah',
                'title' => 'Seragam Sekolah Harus Dihapuskan',
                'difficulty' => 'easy',
                'is_active' => true,
                'stance_keywords' => [
                    'pro' => ['bebas', 'ekspresi', 'individu', 'kreativitas', 'nyaman', 'identitas', 'pilihan'],
                    'kontra' => ['disiplin', 'kesetaraan', 'identitas sekolah', 'fokus', 'bullying', 'murah', 'seragam']
                ],
                'opponent_arguments' => [
                    'pro' => [
                        1 => "Kebebasan berpakaian memang baik, tetapi tanpa seragam, perbedaan ekonomi antar siswa akan terlihat jelas dan memicu bullying. Bagaimana tanggapan Anda?",
                        2 => "Seragam membantu siswa fokus pada pembelajaran, bukan penampilan. Riset menunjukkan sekolah berseragam memiliki disiplin lebih baik. Bantah ini!",
                        3 => "Seragam jauh lebih ekonomis dibanding membeli banyak pakaian kasual. Ini meringankan beban orang tua. Pertahankan argumen Anda!",
                        4 => "Silakan berikan pernyataan penutup untuk posisi Pro Anda."
                    ],
                    'kontra' => [
                        1 => "Seragam membuat semua siswa terlihat sama, tetapi bukankah pendidikan seharusnya menghargai keunikan setiap individu? Bagaimana Anda menanggapi?",
                        2 => "Banyak negara maju tanpa kewajiban seragam justru memiliki prestasi pendidikan yang lebih tinggi. Bisakah Anda membantah fakta ini?",
                        3 => "Seragam membatasi ekspresi diri yang penting untuk perkembangan psikologis remaja. Tidakkah ini kontraproduktif dengan tujuan pendidikan?",
                        4 => "Silakan berikan pernyataan penutup untuk posisi Kontra Anda."
                    ]
                ]
            ],
            [
                'slug' => 'ujian-nasional',
                'title' => 'Ujian Nasional Perlu Dikembalikan',
                'difficulty' => 'medium',
                'is_active' => true,
                'stance_keywords' => [
                    'pro' => ['standar', 'kualitas', 'ukuran', 'nasional', 'kompetisi', 'motivasi', 'evaluasi'],
                    'kontra' => ['tekanan', 'stres', 'tidak adil', 'holistik', 'portofolio', 'beragam', 'kontekstual']
                ],
                'opponent_arguments' => [
                    'pro' => [
                        1 => "Standar nasional memang penting, tetapi UN menciptakan tekanan psikologis luar biasa pada siswa. Banyak kasus bunuh diri terkait UN. Bagaimana Anda menanggapi?",
                        2 => "UN hanya mengukur kemampuan kognitif melalui tes tertulis. Bagaimana dengan keterampilan praktis dan karakter siswa? Bantah argumen ini!",
                        3 => "Kualitas pendidikan antar daerah sangat timpang. UN yang seragam justru tidak adil bagi siswa di daerah terpencil. Pertahankan posisi Anda!",
                        4 => "Silakan berikan pernyataan penutup untuk posisi Pro Anda."
                    ],
                    'kontra' => [
                        1 => "Tanpa UN, tidak ada tolak ukur nasional untuk mengukur kualitas pendidikan. Bagaimana kita tahu apakah standar pendidikan membaik atau menurun?",
                        2 => "Sejak UN dihapus, motivasi belajar siswa di banyak sekolah menurun drastis. Guru kesulitan mendorong siswa belajar serius. Bantah ini!",
                        3 => "Asesmen pengganti UN seperti AKM masih belum matang dan banyak kendala teknis. Bukankah lebih baik kembali ke sistem yang sudah terbukti?",
                        4 => "Silakan berikan pernyataan penutup untuk posisi Kontra Anda."
                    ]
                ]
            ],
        ];

        foreach ($topics as $topic) {
            SimulationTopic::create($topic);
        }
    }
}
