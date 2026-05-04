<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\LearningModule;

class LearningModuleSeeder extends Seeder
{
    public function run(): void
    {
        LearningModule::truncate();

        // MODULE 1
        LearningModule::create([
            'title' => 'Dasar Debat',
            'description' => 'Memahami esensi debat sebagai alat berpikir kritis dan komunikasi yang terstruktur.',
            'badge_icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
            'badge_color' => 'bg-blue-50 text-blue-600',
            'sections' => [
                ['type'=>'concept','title'=>'Apa Itu Debat?','icon'=>'brain',
                 'content'=>'Debat bukan sekadar adu pendapat. Debat adalah proses pertukaran argumen yang terstruktur, di mana setiap pihak harus mampu mempertahankan posisinya menggunakan logika, data, dan penalaran yang kuat.',
                 'revelations'=>[
                     ['title'=>'Tujuan Utama','desc'=>'Tujuan debat bukan untuk "menang", melainkan untuk menguji kekuatan sebuah ide melalui tantangan logis dari pihak lawan.'],
                     ['title'=>'Keterampilan Inti','desc'=>'Debat melatih kemampuan berpikir kritis, berbicara terstruktur, dan mendengarkan secara aktif.'],
                     ['title'=>'Bukan Pertengkaran','desc'=>'Berbeda dengan bertengkar, debat memiliki aturan, moderator, dan batas waktu yang jelas.'],
                     ['title'=>'Aplikasi Nyata','desc'=>'Keterampilan debat digunakan di sidang parlemen, ruang pengadilan, hingga presentasi bisnis sehari-hari.']
                 ],
                 'insight'=>'Debat yang baik selalu dibangun di atas fondasi logika, bukan emosi.',
                 'detail'=>'Dalam sejarah, debat telah menjadi pilar demokrasi sejak zaman Yunani Kuno. Sokrates menggunakan metode dialektika untuk menguji kebenaran melalui pertanyaan-pertanyaan tajam. Di era modern, kemampuan berdebat menjadi salah satu soft skill yang paling dicari oleh perusahaan dan institusi pendidikan.'],
                ['type'=>'comparison','title'=>'Logika vs Emosi','icon'=>'layers',
                 'left'=>['icon'=>'😤','label'=>'Berbasis Emosi','content'=>'Kamu tidak tahu apa-apa! Pokoknya pendidikan harus gratis karena kasihan orang miskin!','why'=>'Argumen ini menyerang pribadi (Ad Hominem) dan menggunakan rasa kasihan (Appeal to Pity). Tidak ada data atau alasan logis yang mendukung klaim tersebut.'],
                 'right'=>['icon'=>'🧠','label'=>'Berbasis Logika','content'=>'Data BPS menunjukkan 12% anak putus sekolah karena biaya. Subsidi pendidikan terbukti menurunkan angka ini di 15 negara.','why'=>'Argumen ini didukung oleh data statistik dan studi komparatif, membuatnya sulit untuk dibantah tanpa data tandingan.'],
                 'insight'=>'Argumen logis selalu lebih kuat karena bisa diverifikasi dan diuji kebenarannya.',
                 'detail'=>'Dalam teori argumentasi, ada beberapa jenis kesalahan logika (logical fallacy) yang sering terjadi: Ad Hominem (menyerang pribadi), Straw Man (mendistorsi argumen lawan), Appeal to Authority (menggunakan otoritas tanpa relevansi), dan Red Herring (mengalihkan topik).'],
                ['type'=>'check','title'=>'Uji Pemahaman','icon'=>'search',
                 'question'=>'Manakah yang merupakan contoh argumen berbasis logika?',
                 'options'=>[
                     ['text'=>'Semua orang setuju bahwa ini benar, jadi pasti benar.','correct'=>false,'feedback'=>'Ini adalah kesalahan logika "Bandwagon Fallacy" — kebenaran tidak ditentukan oleh jumlah orang yang setuju.'],
                     ['text'=>'Menurut data WHO 2023, vaksinasi menurunkan mortalitas anak sebesar 40%.','correct'=>true,'feedback'=>'Tepat! Argumen ini menggunakan data dari sumber terpercaya sebagai bukti.'],
                     ['text'=>'Kalau kamu tidak setuju, berarti kamu tidak peduli dengan rakyat.','correct'=>false,'feedback'=>'Ini adalah "False Dilemma" — menyederhanakan pilihan menjadi hanya dua opsi yang ekstrem.']
                 ],
                 'insight'=>'Kemampuan membedakan argumen logis dan emosional adalah fondasi utama seorang debater.']
            ]
        ]);

        // MODULE 2
        LearningModule::create([
            'title' => 'Struktur Argumen',
            'description' => 'Pelajari cara menyusun argumen yang logis dan meyakinkan dengan metode A-R-E.',
            'badge_icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
            'badge_color' => 'bg-red-50 text-primary-red',
            'sections' => [
                ['type'=>'concept','title'=>'Metode A-R-E','icon'=>'brain',
                 'content'=>'Setiap argumen yang kuat terdiri dari tiga komponen utama: Assertion (Klaim), Reasoning (Alasan), dan Evidence (Bukti). Tanpa ketiga elemen ini, argumen Anda akan mudah diruntuhkan.',
                 'revelations'=>[
                     ['title'=>'Assertion (Klaim)','desc'=>'Pernyataan utama yang ingin Anda buktikan kebenarannya. Harus spesifik dan dapat diperdebatkan.'],
                     ['title'=>'Reasoning (Alasan)','desc'=>'Penjelasan logis MENGAPA klaim Anda benar. Gunakan kata hubung "karena", "sebab", atau "dikarenakan".'],
                     ['title'=>'Evidence (Bukti)','desc'=>'Data, statistik, atau contoh nyata yang mendukung alasan Anda. Semakin kredibel sumbernya, semakin kuat argumen Anda.'],
                     ['title'=>'Hubungan Ketiganya','desc'=>'A-R-E bekerja seperti bangunan: Klaim adalah atap, Alasan adalah tiang, dan Bukti adalah fondasi.']
                 ],
                 'insight'=>'Tanpa struktur A-R-E, argumen hanyalah opini tanpa dasar.',
                 'detail'=>'Metode A-R-E (Assertion-Reasoning-Evidence) adalah kerangka argumentasi yang digunakan secara luas di dunia akademik dan profesional. Dalam kompetisi debat internasional seperti WSDC, setiap argumen dinilai berdasarkan kelengkapan ketiga elemen ini.'],
                ['type'=>'flow','title'=>'Alur Membangun Argumen','icon'=>'layers',
                 'steps'=>[
                     ['label'=>'Assertion','desc'=>'Nyatakan klaim utama Anda secara jelas dan tegas.'],
                     ['label'=>'Reasoning','desc'=>'Jelaskan alasan logis mengapa klaim tersebut benar.'],
                     ['label'=>'Evidence','desc'=>'Dukung dengan data, fakta, atau contoh nyata.']
                 ],
                 'insight'=>'Urutan A-R-E memastikan argumen Anda mengalir secara natural dan mudah dipahami audiens.',
                 'detail'=>'Contoh penerapan A-R-E: (A) Pendidikan gratis harus diterapkan. (R) Karena akses pendidikan yang merata akan mengurangi kesenjangan sosial. (E) Data BPS 2023 menunjukkan bahwa 12% anak usia sekolah di Indonesia putus sekolah karena faktor biaya.'],
                ['type'=>'stack','title'=>'Komponen Argumen Kuat','icon'=>'search',
                 'items'=>[
                     ['label'=>'Fondasi','content'=>'Evidence: Data, statistik, dan contoh dari sumber terpercaya.'],
                     ['label'=>'Struktur','content'=>'Reasoning: Penjelasan logis yang menghubungkan bukti dengan klaim.'],
                     ['label'=>'Puncak','content'=>'Assertion: Pernyataan utama yang kuat, spesifik, dan dapat diperdebatkan.']
                 ],
                 'insight'=>'Argumen tanpa bukti adalah opini. Argumen tanpa alasan adalah asumsi. Keduanya mudah diruntuhkan.'],
                ['type'=>'check','title'=>'Uji Pemahaman','icon'=>'search',
                 'question'=>'Dalam metode A-R-E, apa fungsi utama dari "Reasoning"?',
                 'options'=>[
                     ['text'=>'Memberikan data statistik untuk mendukung klaim.','correct'=>false,'feedback'=>'Itu adalah fungsi Evidence (Bukti), bukan Reasoning.'],
                     ['text'=>'Menjelaskan MENGAPA klaim tersebut benar secara logis.','correct'=>true,'feedback'=>'Benar! Reasoning adalah jembatan logis antara klaim Anda dan bukti pendukungnya.'],
                     ['text'=>'Menyatakan pendapat utama yang ingin dibuktikan.','correct'=>false,'feedback'=>'Itu adalah fungsi Assertion (Klaim).']
                 ],
                 'insight'=>'Reasoning adalah elemen yang paling sering dilupakan oleh debater pemula.']
            ]
        ]);

        // MODULE 3
        LearningModule::create([
            'title' => 'Teknik Sanggahan',
            'description' => 'Mempelajari cara membedah dan meruntuhkan logika lawan dengan cara yang elegan.',
            'badge_icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
            'badge_color' => 'bg-orange-50 text-orange-600',
            'sections' => [
                ['type'=>'concept','title'=>'Seni Membantah','icon'=>'brain',
                 'content'=>'Sanggahan yang efektif bukan sekadar berkata "Anda salah". Anda harus menunjukkan DIMANA letak kesalahan logika lawan, MENGAPA itu salah, dan APA alternatif yang lebih tepat.',
                 'revelations'=>[
                     ['title'=>'Identifikasi Kelemahan','desc'=>'Temukan titik lemah dalam argumen lawan: apakah datanya tidak valid, logikanya cacat, atau kesimpulannya terlalu luas.'],
                     ['title'=>'Serang Argumen, Bukan Orangnya','desc'=>'Fokus pada isi argumen, bukan karakter atau latar belakang lawan bicara Anda.'],
                     ['title'=>'Berikan Alternatif','desc'=>'Setelah meruntuhkan argumen lawan, tawarkan perspektif atau solusi yang lebih baik.'],
                     ['title'=>'Tetap Sopan dan Terstruktur','desc'=>'Sanggahan yang disampaikan dengan tenang dan terstruktur jauh lebih meyakinkan daripada yang emosional.']
                 ],
                 'insight'=>'Debater terbaik bukan yang paling keras berteriak, tapi yang paling tajam menganalisis.',
                 'detail'=>'Ada beberapa teknik sanggahan yang umum digunakan: Direct Rebuttal (membantah langsung premis lawan), Turn (menunjukkan argumen lawan justru mendukung posisi Anda), dan Even If (mengakui poin lawan tetapi menunjukkan bahwa kesimpulannya tetap salah).'],
                ['type'=>'comparison','title'=>'Sanggahan Lemah vs Kuat','icon'=>'layers',
                 'left'=>['icon'=>'❌','label'=>'Sanggahan Lemah','content'=>'Saya tidak setuju dengan pendapat Anda karena menurut saya itu salah dan tidak masuk akal.','why'=>'Tidak ada alasan spesifik atau bukti. Hanya mengulang ketidaksetujuan tanpa substansi.'],
                 'right'=>['icon'=>'✅','label'=>'Sanggahan Kuat','content'=>'Data yang Anda gunakan berasal dari tahun 2010. Penelitian terbaru tahun 2023 justru menunjukkan tren yang berlawanan.','why'=>'Menyerang validitas bukti lawan dengan data yang lebih baru dan relevan. Ini adalah teknik "Source Challenge".'],
                 'insight'=>'Sanggahan yang kuat selalu menyerang substansi argumen, bukan sekadar menyatakan ketidaksetujuan.'],
                ['type'=>'check','title'=>'Uji Pemahaman','icon'=>'search',
                 'question'=>'Teknik "Even If" dalam sanggahan berarti:',
                 'options'=>[
                     ['text'=>'Menolak semua premis lawan secara total.','correct'=>false,'feedback'=>'Itu adalah Direct Rebuttal. Even If justru mengakui sebagian poin lawan.'],
                     ['text'=>'Mengakui poin lawan, tetapi menunjukkan kesimpulannya tetap salah.','correct'=>true,'feedback'=>'Tepat! Even If adalah strategi elegan yang menunjukkan bahwa meskipun fakta lawan benar, kesimpulan akhirnya tetap tidak valid.'],
                     ['text'=>'Mengabaikan argumen lawan dan mengalihkan topik.','correct'=>false,'feedback'=>'Itu adalah Red Herring, sebuah kesalahan logika yang harus dihindari.']
                 ],
                 'insight'=>'Even If adalah salah satu teknik sanggahan paling kuat karena menunjukkan kedalaman analisis Anda.']
            ]
        ]);

        // MODULE 4
        LearningModule::create([
            'title' => 'Etika Berdebat',
            'description' => 'Memahami prinsip-prinsip etika dalam berdebat agar diskusi tetap sehat dan produktif.',
            'badge_icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
            'badge_color' => 'bg-green-50 text-green-600',
            'sections' => [
                ['type'=>'concept','title'=>'Mengapa Etika Penting?','icon'=>'brain',
                 'content'=>'Debat tanpa etika hanyalah pertengkaran. Etika memastikan bahwa debat tetap menjadi alat untuk mencari kebenaran, bukan sekadar ajang ego. Tanpa etika, tidak ada pihak yang belajar.',
                 'revelations'=>[
                     ['title'=>'Hormat pada Lawan','desc'=>'Lawan debat adalah partner berpikir, bukan musuh. Hormati hak mereka untuk menyampaikan pendapat.'],
                     ['title'=>'Jujur pada Fakta','desc'=>'Jangan pernah memanipulasi data atau mengutip sumber secara tidak akurat demi memenangkan debat.'],
                     ['title'=>'Akui Kelemahan','desc'=>'Debater yang baik berani mengakui ketika argumen mereka ternyata kurang kuat pada suatu poin.'],
                     ['title'=>'Dengarkan Aktif','desc'=>'Mendengarkan argumen lawan dengan seksama adalah kunci untuk memberikan sanggahan yang tepat sasaran.']
                 ],
                 'insight'=>'Kemenangan sejati dalam debat adalah ketika semua pihak keluar dengan pemahaman yang lebih baik.'],
                ['type'=>'comparison','title'=>'Debat Etis vs Tidak Etis','icon'=>'layers',
                 'left'=>['icon'=>'🚫','label'=>'Tidak Etis','content'=>'Memotong pembicaraan lawan, menggunakan data palsu, dan menyerang karakter pribadi lawan.','why'=>'Perilaku ini merusak integritas debat dan tidak menghasilkan diskusi yang produktif. Ini disebut juga sebagai "toxic debate culture".'],
                 'right'=>['icon'=>'✨','label'=>'Etis','content'=>'Mendengarkan dengan saksama, merespons substansi argumen, dan mengakui poin valid dari lawan.','why'=>'Debat etis membangun rasa saling hormat dan menghasilkan kesimpulan yang lebih berimbang dan berkualitas.'],
                 'insight'=>'Debater profesional selalu memenangkan argumen, bukan pertengkaran.'],
                ['type'=>'check','title'=>'Uji Pemahaman','icon'=>'search',
                 'question'=>'Apa yang sebaiknya dilakukan ketika lawan debat membuat poin yang valid?',
                 'options'=>[
                     ['text'=>'Mengabaikannya dan mengalihkan ke topik lain.','correct'=>false,'feedback'=>'Ini adalah taktik Red Herring dan tidak etis dalam debat.'],
                     ['text'=>'Mengakui poin tersebut, lalu tunjukkan mengapa posisi Anda tetap lebih kuat secara keseluruhan.','correct'=>true,'feedback'=>'Benar! Ini menunjukkan integritas intelektual dan justru memperkuat kredibilitas Anda di mata audiens.'],
                     ['text'=>'Menyerang kredibilitas lawan agar poinnya tidak diperhatikan.','correct'=>false,'feedback'=>'Ini adalah kesalahan logika Ad Hominem dan sangat tidak etis.']
                 ],
                 'insight'=>'Mengakui kelemahan justru menunjukkan kekuatan intelektual seorang debater.']
            ]
        ]);

        // MODULE 5
        LearningModule::create([
            'title' => 'Mengenali Logical Fallacy',
            'description' => 'Belajar mengidentifikasi kesalahan logika yang sering muncul dalam argumen sehari-hari.',
            'badge_icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z',
            'badge_color' => 'bg-yellow-50 text-yellow-600',
            'sections' => [
                ['type'=>'concept','title'=>'Apa Itu Logical Fallacy?','icon'=>'brain',
                 'content'=>'Logical Fallacy adalah kesalahan dalam penalaran yang membuat argumen terlihat meyakinkan padahal sebenarnya cacat secara logika. Mengenali fallacy adalah senjata utama seorang debater.',
                 'revelations'=>[
                     ['title'=>'Ad Hominem','desc'=>'Menyerang karakter atau pribadi lawan, bukan argumennya. Contoh: "Kamu bukan ahli, jadi pendapatmu tidak valid."'],
                     ['title'=>'Straw Man','desc'=>'Mendistorsi argumen lawan menjadi versi yang lebih lemah agar mudah diserang. Ini sangat tidak fair dan sering tidak disadari.'],
                     ['title'=>'False Dilemma','desc'=>'Menyajikan hanya dua pilihan seolah tidak ada opsi lain. Contoh: "Kalau tidak setuju, berarti kamu mendukung korupsi."'],
                     ['title'=>'Appeal to Popularity','desc'=>'Mengklaim sesuatu benar hanya karena banyak orang mempercayainya. Popularitas bukan bukti kebenaran.']
                 ],
                 'insight'=>'Debater yang cerdas tidak hanya membangun argumen kuat, tetapi juga mampu mendeteksi kelemahan logika lawan.'],
                ['type'=>'stack','title'=>'Jenis-Jenis Fallacy Umum','icon'=>'layers',
                 'items'=>[
                     ['label'=>'Level 1','content'=>'Ad Hominem: Menyerang orangnya, bukan argumennya.'],
                     ['label'=>'Level 2','content'=>'Straw Man: Mendistorsi argumen lawan agar lebih mudah diserang.'],
                     ['label'=>'Level 3','content'=>'Red Herring: Mengalihkan topik pembicaraan ke hal yang tidak relevan.'],
                     ['label'=>'Level 4','content'=>'Slippery Slope: Mengklaim satu tindakan kecil pasti mengarah ke konsekuensi ekstrem.'],
                     ['label'=>'Level 5','content'=>'Circular Reasoning: Menggunakan kesimpulan sebagai premis. Berputar-putar tanpa bukti.']
                 ],
                 'insight'=>'Semakin banyak fallacy yang Anda kenali, semakin sulit argumen Anda untuk diruntuhkan.'],
                ['type'=>'check','title'=>'Uji Pemahaman','icon'=>'search',
                 'question'=>'"Semua orang sudah setuju, jadi pasti ini keputusan yang benar." Ini adalah contoh fallacy:',
                 'options'=>[
                     ['text'=>'Ad Hominem','correct'=>false,'feedback'=>'Ad Hominem menyerang pribadi, bukan menggunakan popularitas sebagai bukti.'],
                     ['text'=>'Appeal to Popularity (Bandwagon)','correct'=>true,'feedback'=>'Tepat! Hanya karena banyak orang setuju, tidak berarti sesuatu itu benar secara logis.'],
                     ['text'=>'Straw Man','correct'=>false,'feedback'=>'Straw Man mendistorsi argumen lawan. Ini bukan kasus distorsi argumen.']
                 ],
                 'insight'=>'Banyak argumen dalam kehidupan sehari-hari yang terdengar meyakinkan tetapi sebenarnya mengandung fallacy.']
            ]
        ]);

        // MODULE 6
        LearningModule::create([
            'title' => 'Seni Closing Statement',
            'description' => 'Kuasai teknik membuat pernyataan penutup yang kuat dan meninggalkan kesan mendalam.',
            'badge_icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z',
            'badge_color' => 'bg-purple-50 text-purple-600',
            'sections' => [
                ['type'=>'concept','title'=>'Kekuatan Closing Statement','icon'=>'brain',
                 'content'=>'Closing Statement adalah momen terakhir Anda untuk meninggalkan kesan di benak audiens dan juri. Penutup yang kuat bisa mengubah keseluruhan persepsi tentang debat Anda.',
                 'revelations'=>[
                     ['title'=>'Rangkum Poin Terkuat','desc'=>'Pilih 2-3 argumen terbaik Anda dan rangkum secara padat. Jangan memperkenalkan argumen baru di sini.'],
                     ['title'=>'Tunjukkan Clash','desc'=>'Jelaskan mengapa argumen Anda lebih unggul dibanding lawan. Tunjukkan di mana lawan gagal meyakinkan.'],
                     ['title'=>'Akhiri dengan Impact','desc'=>'Hubungkan argumen Anda dengan dampak nyata yang lebih besar. Buat audiens merasakan pentingnya posisi Anda.'],
                     ['title'=>'Gunakan Kalimat Memorable','desc'=>'Penutup yang baik sering menggunakan kalimat yang ringkas, kuat, dan mudah diingat.']
                 ],
                 'insight'=>'Closing yang baik bukan sekadar merangkum, tetapi menegaskan MENGAPA Anda layak memenangkan debat ini.'],
                ['type'=>'comparison','title'=>'Closing Lemah vs Kuat','icon'=>'layers',
                 'left'=>['icon'=>'😐','label'=>'Closing Lemah','content'=>'Ya, jadi itulah pendapat saya. Saya rasa pendidikan gratis itu penting. Terima kasih.','why'=>'Tidak ada rangkuman argumen, tidak ada penekanan pada keunggulan posisi, dan terkesan ragu-ragu.'],
                 'right'=>['icon'=>'🎯','label'=>'Closing Kuat','content'=>'Kami telah membuktikan tiga hal: pendidikan gratis menurunkan angka putus sekolah, meningkatkan produktivitas nasional, dan memperkuat fondasi demokrasi. Lawan tidak mampu membantah data yang kami sajikan.','why'=>'Merangkum poin terkuat secara padat, menegaskan kelemahan lawan, dan menggunakan bahasa yang percaya diri.'],
                 'insight'=>'Audiens dan juri paling mengingat bagian pembuka dan penutup. Jangan sia-siakan momen ini.'],
                ['type'=>'check','title'=>'Uji Pemahaman','icon'=>'search',
                 'question'=>'Apa yang TIDAK boleh dilakukan dalam Closing Statement?',
                 'options'=>[
                     ['text'=>'Memperkenalkan argumen baru yang belum pernah dibahas.','correct'=>true,'feedback'=>'Tepat! Closing bukan tempat untuk argumen baru. Argumen baru di penutup tidak bisa dibantah lawan dan dianggap unfair.'],
                     ['text'=>'Merangkum poin-poin terkuat dari keseluruhan debat.','correct'=>false,'feedback'=>'Justru ini adalah fungsi utama Closing Statement.'],
                     ['text'=>'Menunjukkan di mana argumen lawan gagal.','correct'=>false,'feedback'=>'Ini adalah strategi yang sangat baik untuk closing.']
                 ],
                 'insight'=>'Closing Statement terbaik membuat audiens merasa bahwa posisi Anda adalah satu-satunya kesimpulan yang logis.']
            ]
        ]);
    }
}
