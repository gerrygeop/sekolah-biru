<?php

namespace Database\Factories;

use App\Models\ContactInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactInfo>
 */
class ContactInfoFactory extends Factory
{
    protected $model = ContactInfo::class;

    public function definition(): array
    {
        return [
            'address' => 'Jl. Pendidikan No. 1, Kelurahan Menteng, Kecamatan Menteng, Jakarta Pusat 10310',
            'phone' => '(021) 3145-6789',
            'whatsapp' => '+6281234567890',
            'email' => 'info@smpn1nusantara.sch.id',
            'facebook_url' => 'https://facebook.com/smpn1nusantara',
            'instagram_url' => 'https://instagram.com/smpn1nusantara',
            'youtube_url' => 'https://youtube.com/@smpn1nusantara',
            'twitter_url' => 'https://twitter.com/smpn1nusantara',
            'google_maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.82496631476894!3d-6.194741395493371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2ad6e1e0e9bcc8!2sJakarta%2C%20Indonesia!5e0!3m2!1sen!2sus!4v1620000000000!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'latitude' => '-6.1944',
            'longitude' => '106.8229',
        ];
    }
}
