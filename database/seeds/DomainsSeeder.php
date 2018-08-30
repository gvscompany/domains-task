<?php

use Illuminate\Database\Seeder;
use App\Domain;

class DomainsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Domain::create(['name' => 'google.com']);
        Domain::create(['name' => 'yahoo.com']);
        Domain::create(['name' => 'yandex.com']);
        Domain::create(['name' => 'facebook.com']);
        Domain::create(['name' => 'linkedin.com']);
        Domain::create(['name' => 'twitter.com']);
        Domain::create(['name' => 'armenianwings.com']);
        Domain::create(['name' => 'habrahabr.ru']);
        Domain::create(['name' => 'rambler.ru']);
        Domain::create(['name' => 'laravel.com']);
        Domain::create(['name' => 'laracasts.com']);
        Domain::create(['name' => 'lessons.com']);
        Domain::create(['name' => 'fontawesome.ru']);
        Domain::create(['name' => 'gplus.com']);
        Domain::create(['name' => 'code.com']);
        Domain::create(['name' => 'youtube.com']);
        Domain::create(['name' => 'translate.com']);
        Domain::create(['name' => 'gonet.am']);
    }
}
