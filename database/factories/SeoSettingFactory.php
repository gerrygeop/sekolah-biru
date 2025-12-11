<?php

namespace Database\Factories;

use App\Models\SeoSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeoSetting>
 */
class SeoSettingFactory extends Factory
{
    protected $model = SeoSetting::class;

    public function definition(): array
    {
        return [
            'page_name' => 'home',
            'meta_title' => 'SMP Negeri 1 Nusantara - Sekolah Menengah Pertama Unggulan',
            'meta_description' => 'Website resmi SMP Negeri 1 Nusantara - Sekolah Menengah Pertama unggulan di Jakarta dengan prestasi akademik dan non-akademik tingkat nasional.',
            'meta_keywords' => 'SMP, sekolah menengah pertama, pendidikan, Jakarta, sekolah unggulan, SMPN 1',
        ];
    }
}
