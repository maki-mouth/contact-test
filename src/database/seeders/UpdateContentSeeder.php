<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class UpdateContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::all()->each(function ($contact) {
            $contact->upbate([
                'content' => fake()->realText(120),
            ]);
        });
    }
}
