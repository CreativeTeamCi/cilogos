<?php

namespace Database\Seeders;

use App\Models\ActivityArea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ActivityAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data=[
            'Aéronautique & aérospatiale',
            'Agence & SSII',
            'Agroalimentaire',
            'Architecture & urbanisme',
            'Arts & artisanat',
            'Associatif et syndical',
            'Automobile',
            'Banque & assurances',
            'Biotechnologies',
            'BTP & construction',
            'Centres de recherche',
            'Chimie',
            'Cinéma & audiovisuel',
            'Commerce de détail',
            'Conseil & audit',
            'Culture',
            'Défense & armée',
            'Divertissements & loisirs',
            'E-commerce',
            'Edition',
            'Education & e-learning',
            'Edition de logiciels',
            'Energie',
            'Environnement',
            'Grande distribution',
            'High tech',
            'Hôtellerie',
            'Immobilier',
            'Import & export',
            'Ingénierie mécanique',
            'Industrie matières premières',
            'Industrie pharmaceutique',
            'Jeux vidéo & animation',
            'Luxe',
            'Mode & cosmétiques',
            'Nanotechnologies',
            'Internet des objets',
            'Presse & médias',
            'Réseaux sociaux',
            'Ressources humaines',
            'Restauration',
            'Santé & bien-être',
            'Secteur médical',
            'Secteur public & collectivités',
            'Sécurité civile',
            'Sport',
            'Télécommunications',
            'Transports',
            'Logistique & Supply Chain',
            'Voyage & tourisme',
            'Vins & Spiritueux'
        ];
        //Uploading in Database
        foreach ($data as $activity) {
            ActivityArea::create([
                'label'   =>$activity,
                'slug'      =>Str::slug($activity)
            ]);
        }
    }
}
