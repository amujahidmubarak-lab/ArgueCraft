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
                ],
                'example_arguments' => [
                    'pro' => [
                        1 => "Pendidikan gratis sangat penting karena setiap warga negara berhak atas akses ilmu tanpa terhalang biaya. Ini akan menciptakan pemerataan kesempatan belajar.",
                        2 => "Pemerintah bisa merealokasi anggaran dari sektor lain atau menarik pajak dari perusahaan besar untuk mensubsidi pendidikan, sehingga masyarakat tidak terbebani.",
                        3 => "Kualitas pendidikan tetap bisa terjaga jika pemerintah menerapkan standar pengawasan ketat, alih-alih mengandalkan dana dari masyarakat secara langsung.",
                        4 => "Kesimpulannya, pendidikan gratis adalah kewajiban negara untuk mencerdaskan bangsa dan menghapus kesenjangan sosial di masa depan.",
                        5 => "Sebagai penutup, akses pendidikan tanpa biaya adalah investasi jangka panjang yang akan meningkatkan daya saing bangsa di kancah internasional."
                    ],
                    'kontra' => [
                        1 => "Pendidikan gratis secara total kurang realistis karena akan membebani APBN secara signifikan, yang ujung-ujungnya dibebankan kembali ke rakyat melalui pajak.",
                        2 => "Daripada menggratiskan secara total, pemerintah lebih baik memberikan beasiswa atau subsidi silang yang tepat sasaran agar anggaran lebih efisien.",
                        3 => "Pendidikan yang sepenuhnya dibiayai negara seringkali mengalami birokrasi yang lambat, sehingga inovasi sekolah terhambat dibanding swasta mandiri.",
                        4 => "Sebagai kesimpulan, pendidikan tidak perlu digratiskan total, melainkan diberikan keringanan bersyarat agar kualitas dan fasilitas tetap terjamin.",
                        5 => "Pernyataan penutup saya adalah kemandirian finansial institusi pendidikan tetap diperlukan untuk menjaga fleksibilitas dan standar kualitas yang tinggi."
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
                ],
                'example_arguments' => [
                    'pro' => [
                        1 => "WFH memberikan fleksibilitas waktu yang memungkinkan karyawan menyeimbangkan kehidupan pribadi dan pekerjaan secara optimal.",
                        2 => "Dengan bekerja dari rumah, karyawan dapat menghemat biaya transportasi dan waktu yang biasanya terbuang karena kemacetan di jalan.",
                        3 => "Teknologi kolaborasi digital modern memungkinkan koordinasi tim tetap berjalan efektif meskipun dilakukan secara jarak jauh dari berbagai lokasi.",
                        4 => "Keseimbangan waktu yang lebih baik terbukti meningkatkan kesehatan mental karyawan, yang berdampak positif pada produktivitas jangka panjang.",
                        5 => "Kesimpulannya, WFH adalah evolusi dunia kerja yang mendukung efisiensi operasional sekaligus kesejahteraan karyawan di era digital."
                    ],
                    'kontra' => [
                        1 => "Bekerja dari kantor tetap diperlukan untuk menjaga koordinasi tim yang cepat dan memfasilitasi komunikasi tatap muka yang lebih kaya.",
                        2 => "Interaksi fisik di kantor menciptakan budaya organisasi yang kuat dan memicu inovasi spontan yang sulit terjadi melalui pertemuan daring.",
                        3 => "Tanpa pengawasan langsung, kedisiplinan kerja berisiko menurun dan keamanan data perusahaan lebih sulit dikontrol di luar kantor.",
                        4 => "Isolasi sosial akibat WFH jangka panjang dapat berdampak negatif pada kesehatan psikologis dan rasa kebersamaan antar rekan kerja.",
                        5 => "Pernyataan penutup saya adalah kantor fisik tetap menjadi fondasi penting bagi profesionalisme, kolaborasi kreatif, dan stabilitas operasional."
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
                ],
                'example_arguments' => [
                    'pro' => [
                        1 => "Penggunaan AI di sekolah adalah inovasi teknologi yang membantu siswa mendapatkan materi pembelajaran yang lebih personal dan cepat.",
                        2 => "AI dapat berfungsi sebagai alat bantu yang modern untuk mempermudah riset dan memberikan penjelasan tambahan bagi topik yang sulit dipahami.",
                        3 => "Integrasi AI memungkinkan sistem pendidikan beradaptasi dengan kemajuan teknologi dunia nyata, mempersiapkan siswa menghadapi masa depan digital.",
                        4 => "Dengan bantuan AI, guru dapat menciptakan metode pengajaran yang lebih kreatif dan efisien dalam memantau perkembangan setiap individu.",
                        5 => "Sebagai penutup, AI harus dipandang sebagai mitra teknologi yang mampu meningkatkan kualitas dan kecepatan akses ilmu pengetahuan di sekolah."
                    ],
                    'kontra' => [
                        1 => "Ketergantungan pada AI berisiko membuat siswa menjadi malas dan menurunkan kemampuan mereka untuk berpikir kritis serta mandiri.",
                        2 => "Maraknya penggunaan AI memudahkan praktik plagiarisme dan kecurangan, yang merusak nilai etika dan integritas dalam dunia pendidikan.",
                        3 => "Pendidikan seharusnya fokus pada pengembangan proses berpikir manusia, bukan sekadar memberikan jawaban instan melalui algoritma komputer.",
                        4 => "Tanpa pengawasan ketat, penggunaan AI akan menghilangkan interaksi intelektual yang mendalam antara guru dan murid di dalam kelas.",
                        5 => "Kesimpulannya, sekolah harus membatasi AI untuk melindungi kemampuan dasar berpikir kritis dan orisinalitas karya akademik siswa."
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
                ],
                'example_arguments' => [
                    'pro' => [
                        1 => "Pembatasan media sosial sangat penting untuk melindungi kesehatan mental remaja dari risiko kecanduan dan paparan konten negatif.",
                        2 => "Regulasi durasi penggunaan dapat membantu remaja fokus pada aktivitas fisik dan belajar, sehingga menciptakan keseimbangan hidup yang lebih sehat.",
                        3 => "Remaja membutuhkan batas yang jelas untuk mencegah dampak buruk cyberbullying dan tekanan sosial yang sering terjadi di dunia digital.",
                        4 => "Keamanan anak-anak di internet harus menjadi prioritas utama pemerintah melalui aturan pembatasan usia dan konten yang lebih ketat.",
                        5 => "Sebagai kesimpulan, membatasi akses media sosial bagi remaja adalah langkah preventif yang aman untuk menjamin tumbuh kembang mereka yang optimal."
                    ],
                    'kontra' => [
                        1 => "Media sosial adalah platform penting bagi remaja untuk mengekspresikan kreativitas dan membangun koneksi sosial di era modern ini.",
                        2 => "Membatasi akses media sosial sama saja dengan merampas hak remaja untuk mendapatkan informasi dan sarana belajar yang beragam secara gratis.",
                        3 => "Daripada membatasi, kita seharusnya memberikan edukasi literasi digital agar remaja mampu menggunakan media sosial secara bijak dan bertanggung jawab.",
                        4 => "Kebebasan berekspresi di dunia digital memungkinkan remaja menemukan komunitas yang mendukung minat dan bakat unik mereka.",
                        5 => "Pernyataan penutup saya adalah media sosial harus tetap terbuka bagi remaja sebagai alat pemberdayaan diri dan akses informasi tanpa batas."
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
                ],
                'example_arguments' => [
                    'pro' => [
                        1 => "Penerapan hukuman mati bagi koruptor sangat diperlukan untuk memberikan efek jera yang maksimal dan tegas terhadap kejahatan luar biasa.",
                        2 => "Korupsi adalah tindakan yang merampas kesejahteraan rakyat, sehingga hukuman yang paling berat adalah bentuk keadilan nyata bagi masyarakat.",
                        3 => "Ketegasan hukum melalui hukuman mati akan mengirimkan pesan kuat bahwa negara tidak mentoleransi pengkhianatan terhadap kepercayaan publik.",
                        4 => "Efek jera dari hukuman ini diharapkan mampu menekan angka korupsi secara signifikan dan menyelamatkan keuangan negara untuk masa depan.",
                        5 => "Sebagai penutup, hukuman mati adalah instrumen hukum yang diperlukan untuk membersihkan negara dari praktik korupsi yang sudah mengakar."
                    ],
                    'kontra' => [
                        1 => "Hukuman mati bertentangan dengan prinsip Hak Asasi Manusia (HAM) dan nilai kemanusiaan yang menjunjung tinggi hak hidup setiap orang.",
                        2 => "Sistem hukum yang belum sempurna berisiko menimbulkan kesalahan vonis yang tidak dapat diperbaiki jika hukuman mati sudah dilaksanakan.",
                        3 => "Lebih baik fokus pada reformasi sistem pencegahan dan rehabilitasi pelaku agar mereka dapat menebus kesalahan tanpa harus menghilangkan nyawa.",
                        4 => "Hukuman yang proporsional seperti penyitaan aset dan penjara seumur hidup jauh lebih manusiawi namun tetap mampu memberikan sanksi yang berat.",
                        5 => "Pernyataan penutup saya adalah keadilan sejati tidak dicapai dengan kematian, melainkan dengan perbaikan sistem hukum yang adil dan transparan."
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
                ],
                'example_arguments' => [
                    'pro' => [
                        1 => "Pembangunan PLTN adalah solusi energi bersih masa depan untuk memenuhi kebutuhan listrik nasional yang terus meningkat dengan emisi karbon rendah.",
                        2 => "Energi nuklir sangat efisien karena mampu menghasilkan daya besar secara konsisten dibandingkan sumber energi terbarukan lainnya yang bergantung cuaca.",
                        3 => "Dengan teknologi modern, keamanan reaktor nuklir dapat dijamin untuk mendukung kemandirian energi dan stabilitas ekonomi jangka panjang Indonesia.",
                        4 => "Transisi ke energi nuklir akan membantu Indonesia mencapai target net-zero emission lebih cepat sambil menjaga harga listrik tetap terjangkau.",
                        5 => "Sebagai penutup, PLTN adalah investasi strategis untuk menjamin kedaulatan energi nasional dan mendorong inovasi teknologi di tanah air."
                    ],
                    'kontra' => [
                        1 => "Risiko bencana alam seperti gempa dan tsunami di Indonesia menjadikan pembangunan PLTN sebagai ancaman bahaya radiasi yang sangat tinggi.",
                        2 => "Masalah pengelolaan limbah nuklir yang beracun dan membutuhkan biaya mahal akan menjadi beban lingkungan bagi generasi mendatang.",
                        3 => "Indonesia sebaiknya fokus pada pengembangan energi terbarukan yang lebih aman seperti tenaga surya, angin, dan panas bumi yang melimpah.",
                        4 => "Biaya pembangunan dan pemeliharaan PLTN yang sangat mahal dapat dialokasikan untuk sektor lain yang lebih mendesak dan minim risiko bencana.",
                        5 => "Kesimpulannya, risiko keamanan dan dampak lingkungan dari nuklir jauh lebih besar dibandingkan manfaat energi yang dihasilkannya bagi Indonesia."
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
                ],
                'example_arguments' => [
                    'pro' => [
                        1 => "Penghapusan seragam sekolah akan memberikan kebebasan bagi siswa untuk mengekspresikan identitas diri dan kreativitas mereka melalui pakaian.",
                        2 => "Siswa akan merasa lebih nyaman belajar jika diizinkan mengenakan pakaian pilihan sendiri yang sesuai dengan kepribadian dan kebutuhan individu mereka.",
                        3 => "Menghilangkan kewajiban seragam dapat mengurangi beban biaya rutin bagi orang tua yang seringkali harus membeli seragam baru setiap tahun.",
                        4 => "Kemandirian dalam memilih pakaian mendidik siswa untuk bertanggung jawab atas penampilan mereka sendiri sejak usia dini di sekolah.",
                        5 => "Sebagai penutup, pendidikan seharusnya fokus pada pengembangan karakter individu, bukan pada penyeragaman penampilan fisik yang membatasi ekspresi."
                    ],
                    'kontra' => [
                        1 => "Seragam sekolah sangat penting untuk menciptakan kesetaraan sosial di antara siswa tanpa memandang latar belakang ekonomi keluarga mereka.",
                        2 => "Penggunaan seragam membantu menjaga disiplin dan fokus siswa agar lebih berkonsentrasi pada pelajaran daripada bersaing dalam hal penampilan.",
                        3 => "Seragam berfungsi sebagai identitas sekolah yang kuat dan mempermudah pengawasan terhadap keamanan siswa di lingkungan institusi pendidikan.",
                        4 => "Dengan seragam, risiko bullying akibat perbedaan status sosial yang terlihat dari pakaian mahal dapat ditekan secara signifikan di sekolah.",
                        5 => "Pernyataan penutup saya adalah seragam merupakan simbol persatuan dan kesederhanaan yang mendukung lingkungan belajar yang kondusif dan adil."
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
                ],
                'example_arguments' => [
                    'pro' => [
                        1 => "Pengembalian Ujian Nasional (UN) diperlukan sebagai tolak ukur standar kualitas pendidikan yang merata di seluruh wilayah Indonesia.",
                        2 => "UN menciptakan motivasi belajar bagi siswa dan semangat kompetisi sehat untuk mencapai hasil akademik yang terbaik secara nasional.",
                        3 => "Sistem evaluasi yang seragam melalui UN memudahkan pemerintah dalam memetakan masalah pendidikan dan melakukan perbaikan yang tepat sasaran.",
                        4 => "Tanpa UN, kelulusan siswa menjadi kurang terstandarisasi, yang dapat menyulitkan proses seleksi masuk ke jenjang pendidikan yang lebih tinggi.",
                        5 => "Sebagai kesimpulan, UN adalah instrumen penting untuk menjaga mutu dan disiplin akademik dalam sistem pendidikan nasional kita."
                    ],
                    'kontra' => [
                        1 => "Ujian Nasional hanya menciptakan tekanan psikologis dan stres yang berlebihan bagi siswa tanpa mencerminkan kemampuan mereka yang sebenarnya.",
                        2 => "Evaluasi pendidikan seharusnya bersifat holistik dan beragam, mencakup karakter serta keterampilan praktis, bukan hanya tes kognitif tertulis.",
                        3 => "UN sangat tidak adil bagi siswa di daerah terpencil karena adanya ketimpangan fasilitas pendidikan yang sangat jauh dibanding kota besar.",
                        4 => "Sistem penilaian berbasis portofolio dan asesmen kelas lebih kontekstual dalam mengukur perkembangan unik setiap siswa secara mendalam.",
                        5 => "Pernyataan penutup saya adalah pendidikan harus memanusiakan siswa, bukan sekadar menjadikan mereka angka dalam statistik standar nasional."
                    ]
                ]
            ],
        ];

        foreach ($topics as $topic) {
            SimulationTopic::create($topic);
        }
    }
}
