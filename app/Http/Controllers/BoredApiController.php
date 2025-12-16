<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BoredApiController extends Controller
{
    // Mapping kategori ke bahasa Indonesia
    private $typeTranslations = [
        'education' => 'Pendidikan',
        'recreational' => 'Rekreasi',
        'social' => 'Sosial',
        'diy' => 'DIY/Kreatif',
        'charity' => 'Amal',
        'cooking' => 'Memasak',
        'relaxation' => 'Relaksasi',
        'music' => 'Musik',
        'busywork' => 'Pekerjaan'
    ];

    public function getMultipleIdeas()
    {
        try {
            $ideas = [];

            // Fetch 5 ide dari Bored API
            for ($i = 0; $i < 5; $i++) {
                try {
                    $url = 'https://bored-api.appbrewery.com/random';
                    $jsonData = @file_get_contents($url);

                    if ($jsonData !== false) {
                        $data = json_decode($jsonData, true);

                        if ($data && isset($data['activity'])) {
                            // Translate activity ke bahasa Indonesia
                            $data['activity_id'] = $this->translateActivity($data['activity']);
                            $data['type_id'] = $this->typeTranslations[$data['type']] ?? ucfirst($data['type']);

                            $ideas[] = $data;
                        }
                    }
                } catch (\Exception $e) {
                    continue;
                }
            }

            if (empty($ideas)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengambil ide dari Bored API'
                ], 500);
            }

            return response()->json([
                'success' => true,
                'ideas' => $ideas
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    private function translateActivity($text)
    {
        // Mapping kata-kata umum dari Bored API ke bahasa Indonesia
        $translations = [
            'Learn' => 'Belajar',
            'Go for a' => 'Pergi',
            'Start a' => 'Mulai',
            'Take a' => 'Ambil',
            'Make a' => 'Membuat',
            'Create a' => 'Membuat',
            'Try a' => 'Coba',
            'Visit a' => 'Kunjungi',
            'Read a' => 'Membaca',
            'Write a' => 'Menulis',
            'Draw' => 'Menggambar',
            'Paint' => 'Melukis',
            'Cook' => 'Memasak',
            'Bake' => 'Memanggang',
            'Watch' => 'Menonton',
            'Listen to' => 'Mendengarkan',
            'Play' => 'Bermain',
            'Exercise' => 'Olahraga',
            'Meditate' => 'Meditasi',
            'Clean' => 'Membersihkan',
            'Organize' => 'Mengatur',
            'Call' => 'Menelepon',
            'Text' => 'Mengirim pesan',
            'Email' => 'Email',
            'Volunteer' => 'Menjadi relawan',
            'Donate' => 'Berdonasi',
            'Plant' => 'Menanam',
            'new' => 'baru',
            'old' => 'lama',
            'friend' => 'teman',
            'family' => 'keluarga',
            'museum' => 'museum',
            'park' => 'taman',
            'walk' => 'jalan',
            'run' => 'lari',
            'bike ride' => 'naik sepeda',
            'book' => 'buku',
            'movie' => 'film',
            'documentary' => 'dokumenter',
            'podcast' => 'podcast',
            'music' => 'musik',
            'song' => 'lagu',
            'instrument' => 'alat musik',
            'language' => 'bahasa',
            'skill' => 'keterampilan',
            'hobby' => 'hobi',
            'recipe' => 'resep',
            'meal' => 'makanan',
            'your room' => 'kamarmu',
            'your house' => 'rumahmu',
            'journal' => 'jurnal',
            'letter' => 'surat',
            'poem' => 'puisi',
            'story' => 'cerita',
            'blog' => 'blog',
            'picture' => 'gambar',
            'sketch' => 'sketsa',
            'workout' => 'latihan',
            'yoga' => 'yoga',
            'stretch' => 'peregangan'
        ];

        $translatedText = $text;

        foreach ($translations as $english => $indonesian) {
            $translatedText = str_ireplace($english, $indonesian, $translatedText);
        }

        return $translatedText;
    }
}
