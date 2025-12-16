<?php

namespace Database\Seeders;

use App\Models\Ide;
use App\Models\Kategori;
use App\Models\IdeKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IdeKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat akun admin
        DB::table('users')->insert([
            'name' => 'Giero',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin12'),
            'role' => 'admin',
        ]);

        // Membuat akun user biasa
        DB::table('users')->insert([
            'name' => 'User Demo',
            'email' => 'user@user.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);

        // Membuat 10 kategori yang relevan
        $kategoriData = [
            ['name' => 'Olahraga', 'description' => 'Aktivitas fisik untuk kesehatan'],
            ['name' => 'Kreatif', 'description' => 'Kegiatan seni dan kreativitas'],
            ['name' => 'Belajar', 'description' => 'Pengembangan diri dan pengetahuan'],
            ['name' => 'Hiburan', 'description' => 'Kegiatan untuk bersenang-senang'],
            ['name' => 'Produktif', 'description' => 'Aktivitas menghasilkan sesuatu'],
            ['name' => 'Sosial', 'description' => 'Interaksi dengan orang lain'],
            ['name' => 'Relaksasi', 'description' => 'Kegiatan untuk menenangkan pikiran'],
            ['name' => 'Hobi', 'description' => 'Kegemaran di waktu luang'],
            ['name' => 'Kuliner', 'description' => 'Aktivitas memasak dan makanan'],
            ['name' => 'Teknologi', 'description' => 'Kegiatan berbasis digital'],
        ];

        $kategoris = [];
        foreach ($kategoriData as $data) {
            $kategoris[] = Kategori::create($data);
        }

        // 50 ide konkret yang relevan
        $ideData = [
            ['title' => 'Jogging pagi di taman', 'categories' => ['Olahraga']],
            ['title' => 'Yoga di rumah', 'categories' => ['Olahraga', 'Relaksasi']],
            ['title' => 'Bersepeda keliling komplek', 'categories' => ['Olahraga']],
            ['title' => 'Push up dan sit up', 'categories' => ['Olahraga']],
            ['title' => 'Menggambar atau sketsa', 'categories' => ['Kreatif', 'Hobi']],
            ['title' => 'Menulis diary atau jurnal', 'categories' => ['Kreatif', 'Relaksasi']],
            ['title' => 'Membuat origami', 'categories' => ['Kreatif']],
            ['title' => 'Melukis dengan cat air', 'categories' => ['Kreatif', 'Hobi']],
            ['title' => 'Membaca buku favorit', 'categories' => ['Belajar', 'Hiburan']],
            ['title' => 'Belajar bahasa asing', 'categories' => ['Belajar', 'Produktif']],
            ['title' => 'Menonton tutorial online', 'categories' => ['Belajar', 'Teknologi']],
            ['title' => 'Membaca artikel ilmiah', 'categories' => ['Belajar']],
            ['title' => 'Nonton film atau series', 'categories' => ['Hiburan']],
            ['title' => 'Bermain game', 'categories' => ['Hiburan', 'Teknologi']],
            ['title' => 'Mendengarkan podcast', 'categories' => ['Hiburan', 'Belajar']],
            ['title' => 'Karaoke di rumah', 'categories' => ['Hiburan']],
            ['title' => 'Memasak resep baru', 'categories' => ['Produktif', 'Kuliner']],
            ['title' => 'Membersihkan kamar', 'categories' => ['Produktif']],
            ['title' => 'Merapikan lemari', 'categories' => ['Produktif']],
            ['title' => 'Menanam tanaman hias', 'categories' => ['Produktif', 'Hobi']],
            ['title' => 'Video call teman atau keluarga', 'categories' => ['Sosial', 'Teknologi']],
            ['title' => 'Main board game bersama', 'categories' => ['Sosial', 'Hiburan']],
            ['title' => 'Ngobrol santai dengan tetangga', 'categories' => ['Sosial']],
            ['title' => 'Ikut komunitas online', 'categories' => ['Sosial', 'Teknologi']],
            ['title' => 'Meditasi 10 menit', 'categories' => ['Relaksasi']],
            ['title' => 'Tidur siang sejenak', 'categories' => ['Relaksasi']],
            ['title' => 'Mandi air hangat', 'categories' => ['Relaksasi']],
            ['title' => 'Mendengarkan musik klasik', 'categories' => ['Relaksasi', 'Hiburan']],
            ['title' => 'Fotografi keliling rumah', 'categories' => ['Kreatif', 'Hobi']],
            ['title' => 'Bermain alat musik', 'categories' => ['Kreatif', 'Hobi']],
            ['title' => 'Menyulam atau merajut', 'categories' => ['Kreatif', 'Hobi']],
            ['title' => 'Mengoleksi perangko/koin', 'categories' => ['Hobi']],
            ['title' => 'Membuat kue atau cookies', 'categories' => ['Kuliner', 'Produktif']],
            ['title' => 'Eksperimen resep minuman', 'categories' => ['Kuliner']],
            ['title' => 'Food photography', 'categories' => ['Kuliner', 'Kreatif']],
            ['title' => 'Meal prep untuk minggu depan', 'categories' => ['Kuliner', 'Produktif']],
            ['title' => 'Belajar coding dasar', 'categories' => ['Teknologi', 'Belajar']],
            ['title' => 'Edit foto atau video', 'categories' => ['Teknologi', 'Kreatif']],
            ['title' => 'Membuat blog atau vlog', 'categories' => ['Teknologi', 'Kreatif']],
            ['title' => 'Bermain puzzle online', 'categories' => ['Teknologi', 'Hiburan']],
            ['title' => 'Stretching ringan', 'categories' => ['Olahraga', 'Relaksasi']],
            ['title' => 'Bermain dengan hewan peliharaan', 'categories' => ['Hiburan', 'Relaksasi']],
            ['title' => 'Menulis puisi atau cerita pendek', 'categories' => ['Kreatif', 'Produktif']],
            ['title' => 'Mendengarkan audiobook', 'categories' => ['Belajar', 'Hiburan']],
            ['title' => 'Bermain puzzle fisik', 'categories' => ['Hobi', 'Hiburan']],
            ['title' => 'Belajar kalligraphy', 'categories' => ['Kreatif', 'Belajar']],
            ['title' => 'Menata ulang furniture', 'categories' => ['Produktif', 'Kreatif']],
            ['title' => 'Membuat DIY craft', 'categories' => ['Kreatif', 'Produktif']],
            ['title' => 'Window shopping online', 'categories' => ['Hiburan', 'Teknologi']],
            ['title' => 'Planning goals dan target', 'categories' => ['Produktif', 'Belajar']],
        ];

        foreach ($ideData as $index => $data) {
            $ide = Ide::create([
                'title' => $data['title'],
                'description' => 'Kegiatan menarik untuk mengisi waktu luang',
                'is_favorite' => $index < 10 // 10 ide pertama jadi favorit
            ]);

            foreach ($data['categories'] as $categoryName) {
                $kategori = collect($kategoris)->firstWhere('name', $categoryName);
                if ($kategori) {
                    IdeKategori::create([
                        'idea_id' => $ide->id,
                        'category_id' => $kategori->id,
                    ]);
                }
            }
        }
    }
}
