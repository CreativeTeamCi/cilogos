<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BusinessLogo;
use Illuminate\Support\Str;

class BusinessLogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // - Ajouter Cretive Team
        $businees_logo = BusinessLogo::create([
            'name'                  =>'Sana Michael Yves',
            'email'                 =>'sana.michael120@gmail.com',
            'business_name'         =>'Creative Team',
            'business_name_slug'    =>Str::slug('Creative Team'),
            'activity_areas_id'     =>2,
            'url'                   =>'http://creative-team.ci/',
            'logo_png'              =>'storage/uploads/logos/png/agence-ssii/creative-team.png',
            'logo_svg'              =>'',
            'status'                =>'valide',
        ]);

        // - Généré 30 donnée
        BusinessLogo::factory(30)->create();

    }
}
