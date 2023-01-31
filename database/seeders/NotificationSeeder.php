<?php

namespace Database\Seeders;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notification_1 = Notification::create([
            'title' => 'Bienvenue sur le site de ta moto !',
            'content' => 'Merci de t\'être inscrit sur le site de ta moto. Tu peux dès à présent consulter les annonces de motos et de pièces détachées. Tu peux aussi créer tes propres annonces. N\'hésite pas à nous contacter si tu as des questions.',
            'expired_at' => Carbon::now()->addDays(5000),
            'user_id' => null,
        ]);

        $notification_2 = Notification::create([
            'title' => 'Des promos !',
            'content' => 'Tu peux dès à présent consulter les promos de pièces détachées. N\'hésite pas à nous contacter si tu as des questions.',
            'expired_at' => Carbon::now()->addDays(5000),
            'user_id' => null,
        ]);

        $notification_3 = Notification::create([
            'title' => 'Des annonces !',
            'content' => 'Tu peux dès à présent consulter les annonces de motos et de pièces détachées. N\'hésite pas à nous contacter si tu as des questions.',
            'expired_at' => Carbon::now()->addDays(50),
            'user_id' => null,
        ]);
    }
}
