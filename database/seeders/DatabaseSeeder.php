<?php

namespace Database\Seeders;

use App\Models\{Client, GalleryPhoto, Project, Service, TeamMember, User};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email' => env('ADMIN_EMAIL', 'admin@epis.rw')], [
            'name' => 'EPIS Admin',
            'password' => env('ADMIN_PASSWORD', 'ChangeMe!2026'),
        ]);

        if (Service::count()) {
            $this->seedPhotos();

            return;
        }

        foreach ([
            ['Electrical, plumbing and HVAC installation', 'Professional MEP installation for construction projects, from first fix to final connection.', 'bolt'],
            ['MV and LV line installation', 'Medium and low voltage lines for reliable power distribution to industrial and commercial sites, built to the highest safety standards.', 'lines'],
            ['Audit, testing and commissioning', 'Thorough audits, testing and commissioning of MEP installations to confirm they work, comply and run safely with minimal downtime.', 'clipboard'],
        ] as $i => [$t, $d, $icon]) {
            Service::create(['title' => $t, 'description' => $d, 'icon' => $icon, 'sort_order' => $i]);
        }

        foreach ([
            ['Tuyishimire Theoneste', 'Managing Director'], ['Srinivasan Ramalingam', 'Electrical Manager'],
            ['Kayitesi Joselyne', 'Finance Manager'], ['Epaphrodite Hakizimana', 'Electrical Engineer'],
            ['Habihirwe Themistocles', 'Foreman Engineer'], ['Pacifique Isingizwe', 'Mechanical Engineer'],
        ] as $i => [$n, $r]) {
            TeamMember::create(['name' => $n, 'role' => $r, 'sort_order' => $i]);
        }

        foreach ([
            ['Rusumo Hydro Power Plant', 'With CGCOC Group', 'Subcontracted for the installation of the earthing and transformer systems.', 'wide', 'linear-gradient(160deg,#6b8fb8,#3d5a3a)'],
            ['Kigali Green Complex and Parkland', 'With Shelter Group', null, 'narrow', 'linear-gradient(170deg,#7c8bd8,#2c3a6a)'],
            ['RICA Solar Power Plant', 'RICA', 'Contractor for earthing installation and cable string installation.', 'mid', 'linear-gradient(170deg,#c7dcd9,#27402b)'],
            ['RICA soccer pitch lighting', 'RICA', 'Floodlighting masts installed and commissioned for night play.', 'mid', 'linear-gradient(170deg,#2a2f3a,#0d1220)'],
            ['Kweza Brewery Project', 'Kweza Craft Brewery', 'Technical assessment and supervision of electrical and mechanical works, to specification and safety standards.', 'mid', 'linear-gradient(170deg,#8c9199,#3a3f48)'],
            ['Umva Muhazi Project', 'With CLESOL', 'Relocation of the medium voltage line.', 'mid', 'linear-gradient(175deg,#5a6290,#e9a35d 60%,#1d2433)'],
            ['Nasho backup system', 'With ENERTECH', 'Collaboration on the backup power system for the Nasho project.', 'mid', 'linear-gradient(170deg,#3b4a7a,#16153f)'],
        ] as $i => [$t, $p, $d, $s, $g]) {
            Project::create(['title' => $t, 'partner' => $p, 'description' => $d, 'size' => $s, 'gradient' => $g, 'sort_order' => $i]);
        }

        foreach ([
            ['Tesolanz', null], ['CGCOC Group', null], ['Kumvi Insights', null], ['PowerSystems Rwanda Ltd', null],
            ['RICA', 'Rwanda Institute for Conservation Agriculture'], ['Kweza', 'Craft Brewery'],
        ] as $i => [$n, $s]) {
            Client::create(['name' => $n, 'subtitle' => $s, 'sort_order' => $i]);
        }

        $this->seedPhotos();
    }

    /** Bundled site photos: gallery plus project cover images. Safe to run repeatedly. */
    private function seedPhotos(): void
    {
        foreach ([
            ['Switchboard room, fully installed and labelled', 'switchgear-room.jpg'],
            ['Main incomer breakers and cable terminations', 'incomer-breakers.jpg'],
            ['Cable tray routing into the distribution cabinet', 'cable-tray-cabinet.jpg'],
            ['Floodlight mast going up', 'floodlight-mast-install.jpg'],
            ['Floodlight mast with access ladder', 'floodlight-mast.jpg'],
            ['Pitch lit for night play', 'pitch-lighting-night.jpg'],
            ['Voltage regulator cabinet in position', 'avr-dvr-cabinet.jpg'],
            ['Generator delivered to site', 'generator-delivery-1.jpg'],
            ['Crane lift of the generator set', 'generator-delivery-2.jpg'],
        ] as $i => [$caption, $file]) {
            GalleryPhoto::firstOrCreate(['image' => 'images/site/'.$file], ['caption' => $caption, 'sort_order' => $i]);
        }

        foreach ([
            'RICA soccer pitch lighting' => 'pitch-lighting-night.jpg',
            'Nasho backup system' => 'avr-dvr-cabinet.jpg',
        ] as $title => $file) {
            Project::where('title', $title)->whereNull('image')->update(['image' => 'images/site/'.$file]);
        }

        // Photos taken from the company profile PDF.
        foreach ([
            'Rusumo Hydro Power Plant' => 'rusumo-hydro.jpg',
            'Kigali Green Complex and Parkland' => 'kigali-green-tower.jpg',
            'RICA Solar Power Plant' => 'rica-solar.jpg',
            'Kweza Brewery Project' => 'kweza-brewery.jpg',
            'Umva Muhazi Project' => 'umva-muhazi.jpg',
        ] as $title => $file) {
            Project::where('title', $title)->whereNull('image')->update(['image' => 'images/site/projects/'.$file]);
        }

        foreach ([
            'Tuyishimire Theoneste' => 'tuyishimire', 'Srinivasan Ramalingam' => 'srinivasan',
            'Kayitesi Joselyne' => 'kayitesi', 'Epaphrodite Hakizimana' => 'epaphrodite',
            'Habihirwe Themistocles' => 'habihirwe', 'Pacifique Isingizwe' => 'pacifique',
        ] as $name => $file) {
            TeamMember::where('name', $name)->whereNull('photo')->update(['photo' => 'images/site/team/'.$file.'.jpg']);
        }

        foreach ([
            'Tesolanz' => 'tesolanz', 'CGCOC Group' => 'cgcoc', 'Kumvi Insights' => 'kumva',
            'PowerSystems Rwanda Ltd' => 'powersystems', 'RICA' => 'rica', 'Kweza' => 'kweza',
        ] as $name => $file) {
            Client::where('name', $name)->whereNull('logo')->update(['logo' => 'images/site/clients/'.$file.'.png']);
        }
    }
}
