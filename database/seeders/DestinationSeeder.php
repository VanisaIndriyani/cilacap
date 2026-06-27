<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\DestinationCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        // Get or create categories
        $catPantai = DestinationCategory::query()->firstOrCreate(
            ['slug' => 'pantai'],
            ['name' => 'Pantai', 'sort_order' => 1, 'is_active' => true]
        );
        
        $catAlam = DestinationCategory::query()->firstOrCreate(
            ['slug' => 'alam'],
            ['name' => 'Alam', 'sort_order' => 2, 'is_active' => true]
        );
        
        $catBudaya = DestinationCategory::query()->firstOrCreate(
            ['slug' => 'budaya'],
            ['name' => 'Budaya', 'sort_order' => 3, 'is_active' => true]
        );

        $destinations = [
            [
                'category_id' => $catPantai->id,
                'name' => 'Pantai Teluk Penyu',
                'short_description' => 'Ikon pariwisata melegenda di pusat Kabupaten Cilacap yang menghadap langsung ke Samudra Hindia.',
                'description' => 'Pantai Teluk Penyu merupakan ikon pariwisata melegenda di pusat Kabupaten Cilacap yang menghadap langsung ke Samudra Hindia. Nama pantai ini merujuk pada masa lampau ketika kawasan pesisir ini menjadi habitat alami dan tempat persinggahan favorit bagi ribuan penyu liar untuk mendarat dan bertelur secara berkala. Seiring berkembangnya jalur pelayaran industri dan aktivitas Pelabuhan Tanjung Intan, kawanan penyu tersebut kini berpindah ke wilayah konservasi yang lebih terisolasi di pesisir selatan Pulau Nusakambangan. Meskipun penyu sudah jarang dijumpai di area wisata utama, pantai ini tetap mempertahankan nilai budaya yang sangat kental melalui upacara adat Sedekah Laut yang digelar rutin setiap bulan Sura.',
                'opening_hours' => 'Buka setiap hari 24 jam penuh. Aktivitas wisata, persewaan perahu, dan operasional warung efektif berlangsung pukul 05.00 - 19.00 WIB.',
                'ticket_price' => 10000,
                'address' => 'Kabupaten Cilacap, Jawa Tengah',
                'location_zone' => 'cilacap-selatan',
                'is_featured' => true,
                'is_published' => true,
                'facilities' => ['Area parkir luas', 'Toilet umum', 'Kamar bilas air tawar', 'Mushola', 'Gazebo pantai', 'Kios cinderamata', 'Pasar ikan segar', 'Rumah makan seafood', 'Dermaga kapal wisata'],
                'images' => ['img/Wisata/Teluk Penyu.jpg'],
            ],
            [
                'category_id' => $catPantai->id,
                'name' => 'Pantai Indah Widarapayung',
                'short_description' => 'Pantai dengan garis pantai panjang dan landai, dikenal sebagai spot surfing terbaik di Jawa Tengah.',
                'description' => 'Terletak di Kecamatan Binangun, Pantai Indah Widarapayung terkenal dengan garis pantainya yang sangat panjang, landai, serta dipenuhi oleh ribuan pohon kelapa yang memberikan suasana rindang. Pantai ini memegang peranan penting dalam sejarah pertahanan pesisir selatan Jawa dan kearifan lokal masyarakat agraris setempat yang bersinergi dengan alam maritim. Gelombang ombak di Widarapayung terkenal cukup besar dan konsisten, menjadikannya salah satu titik selancar (surfing) terbaik di Jawa Tengah yang diakui komunitas nasional.',
                'opening_hours' => 'Buka setiap hari mulai pukul 06.00 - 18.00 WIB.',
                'ticket_price' => 7500,
                'address' => 'Kecamatan Binangun, Kabupaten Cilacap, Jawa Tengah',
                'location_zone' => 'binangun',
                'is_featured' => true,
                'is_published' => true,
                'facilities' => ['Area parkir kendaraan', 'Toilet umum', 'Kamar bilas', 'Mushola', 'Menara pengawas lifeguard', 'Persewaan papan selancar', 'Arena berkuda', 'Gazebo', 'Warung kuliner tradisional', 'Kolam renang anak'],
                'images' => ['img/Wisata/Widarapayung.jpg'],
            ],
            [
                'category_id' => $catPantai->id,
                'name' => 'Pantai Kemiren',
                'short_description' => 'Pantai yang lebih sunyi dan asri, dikelilingi vegetasi pandan laut dan cemara yang lebat.',
                'description' => 'Pantai Kemiren terletak di wilayah administratif Kecamatan Cilacap Selatan, menawarkan suasana pantai yang cenderung lebih sunyi, asri, dan alami dibandingkan tetangganya Teluk Penyu. Kawasan ini memiliki latar belakang sejarah sebagai area pertahanan pesisir dan wilayah tangkap nelayan tradisional berskala kecil yang menetap di pinggiran kota Cilacap. Pantai ini dikelilingi oleh vegetasi pandan laut dan cemara yang lebat, menciptakan suasana teduh yang menenangkan bagi pengunjung yang mencari ketenangan.',
                'opening_hours' => 'Buka setiap hari selama 24 jam penuh (disarankan berkunjung antara pukul 06.00 - 17.30 WIB).',
                'ticket_price' => 5000,
                'address' => 'Kecamatan Cilacap Selatan, Kabupaten Cilacap, Jawa Tengah',
                'location_zone' => 'cilacap-selatan',
                'is_featured' => false,
                'is_published' => true,
                'facilities' => ['Area parkir kendaraan roda dua dan roda empat', 'Warung makan sederhana', 'Toilet umum', 'Mushola', 'Bangku santai kayu'],
                'images' => ['img/Wisata/Kemiren.jpg'],
            ],
            [
                'category_id' => $catPantai->id,
                'name' => 'Pantai Jetis',
                'short_description' => 'Pantai dengan pemecah gelombang beton panjang yang menjadi atraksi utama.',
                'description' => 'Pantai Jetis berada di ujung timur Kabupaten Cilacap, tepatnya di Kecamatan Nusawungu, dan berbatasan langsung dengan Kabupaten Kebumen yang dipisahkan oleh muara Sungai Bodo. Sejarah perkembangan Jetis berawal dari pelabuhan pendaratan ikan tradisional yang secara swadaya dikembangkan oleh kelompok nelayan lokal menjadi destinasi agrowisata pantai terpadu. Daya tarik utama yang membedakannya dari pantai lain adalah keberadaan pemecah gelombang (breakwater) beton panjang yang menjorok ke tengah laut untuk melindungi muara sungai dan kapal nelayan dari ombak besar.',
                'opening_hours' => 'Buka setiap hari mulai pukul 06.00 - 18.00 WIB.',
                'ticket_price' => 5000,
                'address' => 'Kecamatan Nusawungu, Kabupaten Cilacap, Jawa Tengah',
                'location_zone' => 'nusawungu',
                'is_featured' => false,
                'is_published' => true,
                'facilities' => ['Area parkir terpadu', 'Tempat Pelelangan Ikan (TPI) Jetis', 'Pasar buah semangka dan melon', 'Warung makan seafood', 'Toilet', 'Mushola', 'Spot foto di atas beton breakwater', 'Penyewaan ATV', 'Area bermain anak'],
                'images' => ['img/Wisata/Jetis.jpg'],
            ],
            [
                'category_id' => $catPantai->id,
                'name' => 'Pantai Sodong',
                'short_description' => 'Pantai dengan pasir hitam vulkanik, dikelilingi pohon cemara udang dan tebing Gunung Selok.',
                'description' => 'Pantai Sodong terletak di Kecamatan Adipala, berada tepat di kaki perbukitan sakral Gunung Selok yang penuh dengan kisah spiritual dan sejarah mistis Jawa. Nama \'Sodong\' merujuk pada keberadaan gua-gua kecil atau celah bebatuan purba di tebing buatan alam yang berada di sekitar area pantai tersebut. Kombinasi panorama alam di Pantai Sodong sangat unik dan fotogenik, karena memadukan bentangan pasir hitam vulkanik, jajaran pohon cemara udang yang rimbun membentuk terowongan hijau, serta dinding tebing batu kapur Gunung Selok yang kokoh berdiri menjulang di sisi barat pantai.',
                'opening_hours' => 'Buka setiap hari mulai pukul 06.00 - 18.00 WIB.',
                'ticket_price' => 8000,
                'address' => 'Kecamatan Adipala, Kabupaten Cilacap, Jawa Tengah',
                'location_zone' => 'adipala',
                'is_featured' => true,
                'is_published' => true,
                'facilities' => ['Lahan parkir luas berbayang cemara', 'Warung kuliner kelapa muda', 'Toilet umum', 'Kamar mandi bilas', 'Mushola', 'Persewaan motor ATV', 'Area bermain anak', 'Akses setapak menuju gua spiritual'],
                'images' => ['img/Wisata/Pantai sodong.webp'],
            ],
            [
                'category_id' => $catBudaya->id,
                'name' => 'Benteng Pendem',
                'short_description' => 'Situs cagar budaya pertahanan militer kolonial Hindia Belanda yang dibangun di bawah tanah.',
                'description' => 'Benteng Pendem Cilacap, dengan nama asli Kustbatterij op de Landtong te Tjilatjap, adalah markas pertahanan militer kolonial Hindia Belanda yang dibangun bertahap dari tahun 1861 hingga 1879 di ujung semenanjung pelabuhan Cilacap. Disebut \'Pendem\' (bahasa Jawa yang berarti terpendam atau tertimbun) karena seluruh arsitektur bangunan ini sengaja dirancang di bawah permukaan tanah dan dilapisi bukit pasir buatan. Situs cagar budaya seluas 6,5 hektare ini menjadi saksi bisu transisi kekuasaan yang kejam di Indonesia, mulai dari masa keemasan kolonial Belanda, beralih ke pendudukan tentara Jepang pada Perang Dunia II, hingga digunakan sebagai basis latihan pasukan khusus TNI setelah kemerdekaan.',
                'opening_hours' => 'Buka setiap hari mulai pukul 08.00 - 18.00 WIB.',
                'ticket_price' => 10000,
                'address' => 'Kecamatan Cilacap Selatan, Kabupaten Cilacap, Jawa Tengah',
                'location_zone' => 'cilacap-selatan',
                'is_featured' => true,
                'is_published' => true,
                'facilities' => ['Toilet umum bersih', 'Mushola', 'Pusat informasi sejarah', 'Jasa pemandu wisata bersertifikat', 'Jalan setapak pedestrian berpaving', 'Taman bermain anak', 'Bangku taman', 'Habitat kawanan rusa jinak'],
                'images' => ['img/Wisata/Benteng pendem_.jpg'],
            ],
            [
                'category_id' => $catBudaya->id,
                'name' => 'Benteng Karangbolong',
                'short_description' => 'Situs pertahanan militer abad ke-19 peninggalan Hindia Belanda di Pulau Nusakambangan.',
                'description' => 'Benteng Karangbolong merupakan situs pertahanan militer abad ke-19 peninggalan Hindia Belanda yang terletak di ujung timur Pulau Nusakambangan. Benteng ini dibangun hampir bersamaan dengan Benteng Pendem, berfungsi sebagai lapis pertama pertahanan artileri pantai (kustbatterij) untuk mengontrol dan menghancurkan kapal musuh sebelum memasuki Selat Nusakambangan menuju Pelabuhan Cilacap. Kondisi benteng ini menyatu secara dramatis dengan alam sekitarnya; akar-akar pohon beringin raksasa tua tumbuh menjalar mencengkeram dinding-dinding bata tebal benteng yang terkelupas, menciptakan atmosfer petualangan kuno ala Indiana Jones.',
                'opening_hours' => 'Buka setiap hari pukul 07.00 - 16.30 WIB (menyesuaikan jadwal kapal penyeberangan).',
                'ticket_price' => 5000,
                'address' => 'Pulau Nusakambangan, Kabupaten Cilacap, Jawa Tengah',
                'location_zone' => 'nusakambangan',
                'is_featured' => true,
                'is_published' => true,
                'facilities' => ['Pos penjagaan', 'Papan informasi situs sejarah', 'Toilet darurat', 'Jalan setapak hutan yang menantang', 'Bangku istirahat alami', 'Warung kecil milik warga'],
                'images' => ['img/Wisata/Benteng Karang bolong.jpg'],
            ],
            [
                'category_id' => $catBudaya->id,
                'name' => 'Titik Nol Kilometer Cilacap',
                'short_description' => 'Landmark kota yang menandai pusat geografis historis awal pembangunan Cilacap.',
                'description' => 'Titik Nol Kilometer Cilacap menandai pusat geografis historis awal mula pembangunan infrastruktur modern kota Cilacap pada era kolonial abad ke-19. Secara historis, patok atau monumen nol kilometer ini digunakan oleh jawatan pekerjaan umum Hindia Belanda sebagai acuan dasar pengukuran jarak jalan raya pos dan jaringan kereta api logistik di wilayah kadipaten. Saat ini, lokasi tersebut telah direvitalisasi oleh pemerintah daerah menjadi landmark kota yang estetik dengan pembangunan tugu ikonik yang melambangkan identitas Cilacap sebagai kota industri sekaligus kota maritim yang dinamis.',
                'opening_hours' => 'Buka setiap hari 24 jam bebas untuk umum.',
                'ticket_price' => 0,
                'address' => 'Pusat Kota Kabupaten Cilacap, Jawa Tengah',
                'location_zone' => 'cilacap-tengah',
                'is_featured' => false,
                'is_published' => true,
                'facilities' => ['Trotoar pedestrian ramah disabilitas', 'Pencahayaan lampu kota dekoratif', 'Bangku taman besi', 'Taman bunga vertikal', 'Akses ke pusat kuliner kota'],
                'images' => ['img/Wisata/Titik 0_.jpg'],
            ],
            [
                'category_id' => $catAlam->id,
                'name' => 'Gunung Selok',
                'short_description' => 'Kawasan perbukitan karst yang dikenal sebagai pusat spiritualitas Jawa kuno dan spot selfie.',
                'description' => 'Gunung Selok merupakan kawasan perbukitan karst yang berbatasan langsung dengan laut di Kecamatan Adipala. Secara kultural dan sejarah, tempat ini dikenal sebagai salah satu pusat spiritualitas Jawa kuno terpenting, tempat bertapa para raja nusantara terdahulu dan dipercaya sebagai tempat peristirahatan para dewa dalam mitologi lokal. Selain memiliki nilai mistis-religi yang kuat, Gunung Selok kini bertransformasi menjadi objek wisata alam yang menakjubkan dengan pengembangan gardu pandang selfie. Pengunjung dapat melihat keindahan bentangan sawah hijau yang luas berpadu dengan garis pantai selatan Cilacap dari atas ketinggian bukit.',
                'opening_hours' => 'Buka setiap hari mulai pukul 07.00 - 17.00 WIB.',
                'ticket_price' => 8000,
                'address' => 'Kecamatan Adipala, Kabupaten Cilacap, Jawa Tengah',
                'location_zone' => 'adipala',
                'is_featured' => true,
                'is_published' => true,
                'facilities' => ['Area parkir kendaraan di puncak bukit', 'Toilet umum', 'Mushola', 'Deretan warung kelapa muda', 'Spot foto selfie ekstrem', 'Gazebo istirahat', 'Jalan akses beraspal mulus'],
                'images' => ['img/Wisata/Wisata Gunung selok.jpg'],
            ],
            [
                'category_id' => $catAlam->id,
                'name' => 'Gunung Srandil',
                'short_description' => 'Bukit karang soliter yang legendaris sebagai petilasan tokoh gaib Semar.',
                'description' => 'Gunung Srandil berlokasi di Desa Glempangpasir, Kecamatan Adipala, berupa sebuah bukit karang soliter yang dikelilingi pepohonan rimbun dekat pantai. Tempat ini legendaris dalam khazanah spiritual Nusantara karena dipercaya sebagai petilasan tokoh gaib Semar (Kaki Semar Amboro Garbopo Surodilopo) serta para leluhur tanah Jawa kuno. Banyak tokoh sejarah, budayawan, dan peziarah dari berbagai daerah di Indonesia mendatangi tempat ini untuk meditasi mencari ketenangan batin. Di samping sisi spiritualnya, bukit ini menawarkan keasrian alam vegetasi hutan lindung mini yang masih dihuni satwa lokal seperti monyet ekor panjang.',
                'opening_hours' => 'Buka setiap hari selama 24 jam penuh untuk peziarah ritual spiritual.',
                'ticket_price' => 5000,
                'address' => 'Kecamatan Adipala, Kabupaten Cilacap, Jawa Tengah',
                'location_zone' => 'adipala',
                'is_featured' => true,
                'is_published' => true,
                'facilities' => ['Area parkir motor/mobil teratur', 'Warung suvenir dan bunga sesaji', 'Toilet umum', 'Pendopo pemandian batin', 'Mushola luas', 'Jalan tangga beton'],
                'images' => ['img/Wisata/Srandil.jpg'],
            ],
            [
                'category_id' => $catAlam->id,
                'name' => 'Leuit Hills',
                'short_description' => 'Destinasi wisata perbukitan dengan spot swafoto berlatar belakang sawah berundak.',
                'description' => 'Leuit Hills adalah destinasi wisata perbukitan yang terletak di wilayah perbatasan Cilacap utara. Nama \'Leuit\' berasal dari bahasa Sunda yang berarti lumbung padi tradisional, merujuk pada latar belakang wilayah sekitar pariwisata yang didominasi kebudayaan agraris Sunda-Jawa yang harmonis. Tempat ini sengaja dikembangkan untuk pariwisata alam lanskap pegunungan dengan menyediakan spot swafoto modern berlatar belakang hamparan sawah berundak-undak (terasering) dan lekukan aliran sungai purba di bawah bukit yang memanjakan mata pengunjung.',
                'opening_hours' => 'Buka setiap hari mulai pukul 08.00 - 17.00 WIB.',
                'ticket_price' => 10000,
                'address' => 'Kecamatan Jeruklegi, Kabupaten Cilacap, Jawa Tengah',
                'location_zone' => 'jeruklegi',
                'is_featured' => false,
                'is_published' => true,
                'facilities' => ['Area parkir aman', 'Toilet', 'Mushola', 'Kafe outdoor bernuansa alam', 'Gazebo bambu hias', 'Spot foto instagramable', 'Taman bunga mini'],
                'images' => ['img/Wisata/Leuit hills.jpg'],
            ],
            [
                'category_id' => $catAlam->id,
                'name' => 'Havana Hills',
                'short_description' => 'Destinasi wisata buatan modern dengan panorama 360 derajat dan sunset romantis.',
                'description' => 'Havana Hills merupakan salah satu pelopor destinasi wisata buatan berbasis alam modern (modern nature tourism) di kawasan perbukitan hijau Kecamatan Jeruklegi, Cilacap. Dikembangkan untuk menjawab kebutuhan rekreasi keluarga urban dengan memadukan keindahan lanskap perbukitan asri dan konsep kekinian. Sebelum disulap menjadi taman rekreasi modern populer seperti sekarang, kawasan ini awalnya berupa perbukitan biasa yang dipenuhi vegetasi liar. Mengusung konsep utama pemandangan panorama 360 derajat, daya tarik utama terletak pada momen sore menuju malam hari. Wisatawan dapat menyaksikan keindahan matahari terbenam (sunset) yang romantis di balik bukit, yang kemudian disusul oleh gemerlap lampu kota (city light) Kabupaten Cilacap dari ketinggian.',
                'opening_hours' => 'Buka setiap hari mulai pukul 10.00 - 22.00 WIB.',
                'ticket_price' => 15000,
                'address' => 'Kecamatan Jeruklegi, Kabupaten Cilacap, Jawa Tengah',
                'location_zone' => 'jeruklegi',
                'is_featured' => true,
                'is_published' => true,
                'facilities' => ['Area parkir luas berkeamanan', 'Toilet modern', 'Mushola estetik', 'Restoran besar', 'Food court kuliner', 'Spot foto (balon udara, jembatan kaca, replika pelangi)', 'Wahana Rainbow Slide raksasa', 'Camping ground', 'Panggung live music akhir pekan'],
                'images' => ['img/Wisata/Havana hills.jpg'],
            ],
            [
                'category_id' => $catAlam->id,
                'name' => 'Curug Cimandaway',
                'short_description' => 'Air terjun indah dengan suasana alami di kawasan Cilacap.',
                'description' => 'Curug Cimandaway adalah air terjun yang menawarkan keindahan alam dengan suasana alami dan sejuk di Kabupaten Cilacap. Air terjun ini menjadi tempat favorit untuk bersantai dan menikmati keindahan alam.',
                'opening_hours' => 'Buka setiap hari mulai pukul 07.00 - 17.00 WIB.',
                'ticket_price' => 5000,
                'address' => 'Kabupaten Cilacap, Jawa Tengah',
                'location_zone' => 'dayeuhluhur',
                'is_featured' => false,
                'is_published' => true,
                'facilities' => ['Area parkir', 'Toilet', 'Mushola', 'Warung makan', 'Spot foto'],
                'images' => ['img/Wisata/Curug cimandaway.jpg'],
            ],
        ];

        foreach ($destinations as $data) {
            Destination::firstOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'destination_category_id' => $data['category_id'],
                    'name' => $data['name'],
                    'short_description' => $data['short_description'],
                    'description' => $data['description'],
                    'opening_hours' => $data['opening_hours'],
                    'ticket_price' => $data['ticket_price'],
                    'address' => $data['address'],
                    'location_zone' => $data['location_zone'],
                    'is_featured' => $data['is_featured'],
                    'is_published' => $data['is_published'],
                    'facilities' => $data['facilities'],
                    'images' => $data['images'],
                    'published_at' => now(),
                    'meta_title' => $data['name'] . ' - Wisata Cilacap',
                    'meta_description' => $data['short_description'],
                ]
            );
        }
    }
}
