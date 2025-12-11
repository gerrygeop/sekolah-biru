<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolProfile>
 */
class SchoolProfileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'school_name' => 'SMP Negeri 1 Nusantara',
            'npsn' => '20500001',
            'vision' => 'Terwujudnya peserta didik yang beriman, bertakwa, berakhlak mulia, berprestasi, berbudaya lingkungan, dan berwawasan global.',
            'mission' => "1. Menanamkan nilai-nilai keimanan dan ketakwaan melalui pengamalan ajaran agama.\n2. Mengembangkan potensi peserta didik secara optimal di bidang akademik dan non-akademik.\n3. Menyelenggarakan pembelajaran aktif, kreatif, efektif, dan menyenangkan.\n4. Membudayakan perilaku disiplin, santun, dan peduli lingkungan.\n5. Mengembangkan kemampuan berbahasa asing dan teknologi informasi.\n6. Menjalin kerjasama dengan berbagai pihak dalam pengembangan pendidikan.",
            'about' => "SMP Negeri 1 Nusantara adalah sekolah menengah pertama yang didirikan pada tahun 1985. Berlokasi strategis di pusat Kota Jakarta, sekolah kami telah menghasilkan ribuan alumni yang berprestasi di berbagai bidang.\n\nDengan tenaga pendidik yang berpengalaman dan fasilitas yang lengkap, kami berkomitmen untuk memberikan pendidikan berkualitas yang mempersiapkan siswa menghadapi tantangan di era global.\n\nSekolah kami telah meraih berbagai prestasi tingkat nasional dan internasional, baik di bidang akademik maupun non-akademik, menjadikan SMPN 1 Nusantara sebagai salah satu sekolah unggulan di Jakarta.",
            'address' => 'Jl. Pendidikan No. 1, Kelurahan Menteng, Kecamatan Menteng, Jakarta Pusat 10310',
            'phone' => '(021) 3145-6789',
            'email' => 'info@smpn1nusantara.sch.id',
            'whatsapp' => '+6281234567890',
            'logo_path' => null,
        ];
    }
}
