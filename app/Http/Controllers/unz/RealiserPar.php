<?php

namespace App\Http\Controllers\unz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Titre;
use App\Models\User;

class RealiserPar extends Controller
{

    public function developpersData(){
        $data = [];
        $dev = [];

        //Dr Moustapha BIKIENGA
        $dev = [];
        $dev['nom'] = "BIKIENGA";
        $dev['prenom'] = 'Dr Moustapha';
        $dev['email'] = '----@gmail.com';
        $dev['linkedin'] = null;
        $dev['watsapp'] = '+226 -- -- -- --';
        $dev['image'] = '/assets/img/unz/annonyme.png';
        $dev['description'] = null;
        array_push($data, $dev);

        //Wendpeghdnoma Antonie BELEM
        $dev = [];
        $dev['nom'] = "BELEM";
        $dev['prenom'] = 'Wendpeghdnoma Antonie';
        $dev['email'] = '----@gmail.com';
        $dev['linkedin'] = null;
        $dev['watsapp'] = '+226 -- -- -- --';
        $dev['image'] = '/assets/img/unz/annonyme.png';
        $dev['description'] = null;
        array_push($data, $dev);

        //Olive Zoungrana
        $dev = [];
        $dev['nom'] = "ZOUNGRANA";
        $dev['prenom'] = 'Kiswendsida Olive Freischnel';
        $dev['email'] = 'gofreishz@gmail.com';
        $dev['linkedin'] = 'www.linkedin.com/in/k-olive-freischnel-zoungrana-a04358222';
        $dev['watsapp'] = '+226 77380150';
        $dev['image'] = '/assets/img/unz/Olive.png';
        $dev['description'] = 'Etudiant en Licence 2 promotion 2018';
        array_push($data, $dev);

        //Arsene KABORE
        $dev = [];
        $dev['nom'] = "KABORE";
        $dev['prenom'] = 'Arsène';
        $dev['email'] = 'arsenekabore670@gmail.com';
        $dev['linkedin'] = 'www.linkedin.com/in/ars%C3%A8ne-kabore-52a14b218';
        $dev['watsapp'] = '+226 73250528';
        $dev['image'] = '/assets/img/unz/Arsene.png';
        $dev['description'] = null;
        array_push($data, $dev);

        //Fabrice BATIONO
        $dev = [];
        $dev['nom'] = "BATIONO";
        $dev['prenom'] = 'Fabrice';
        $dev['email'] = 'fabationo2708@gmail.com';
        $dev['linkedin'] = 'www.linkedin.com/in/fabrice-bationo-610623206';
        $dev['watsapp'] = '+226 56881927';
        $dev['image'] = '/assets/img/unz/Fabrice.png';
        $dev['description'] = null;
        array_push($data, $dev);

        //Nebnoma Emmanuel KIEBRE
        $dev = [];
        $dev['nom'] = "KIEBRE";
        $dev['prenom'] = 'Nebnoma Emmanuel';
        $dev['email'] = 'nemmanuelkiebre@gmail.com';
        $dev['linkedin'] = 'www.linkedin.com/in/emmanuel-kiebre-6540621ba';
        $dev['watsapp'] = '+226 64060184';
        $dev['image'] = '/assets/img/unz/Emmanuel.png';
        $dev['description'] = null;
        array_push($data, $dev);


        //Saïdou KAPIOKO
        $dev = [];
        $dev['nom'] = "KAPIOKO";
        $dev['prenom'] = 'Saïdou';
        $dev['email'] = 'kapsai@gmail.com';
        $dev['linkedin'] = null;
        $dev['watsapp'] = '+226 -- -- -- --';
        $dev['image'] = '/assets/img/unz/Saidou.png';
        $dev['description'] = null;
        array_push($data, $dev);

        //Goya Alama Désiré DAO
        $dev = [];
        $dev['nom'] = "DAO";
        $dev['prenom'] = 'Goya Alama Désiré';
        $dev['email'] = 'daoDesi@gmail.com';
        $dev['linkedin'] = null;
        $dev['watsapp'] = '+226 -- -- -- --';
        $dev['image'] = '/assets/img/unz/desire.png';
        $dev['description'] = null;
        array_push($data, $dev);

        //Zenabou OUEDRAOGO
        $dev = [];
        $dev['nom'] = "OUEDRAOGO";
        $dev['prenom'] = 'Zonabo';
        $dev['email'] = 'ZenOUED@gmail.com';
        $dev['linkedin'] = null;
        $dev['watsapp'] = '+226 -- -- -- --';
        $dev['image'] = '/assets/img/unz/Zonabou.png';
        $dev['description'] = null;
        array_push($data, $dev);

        return view('unz_st.acceuil.realiser_par',[
            'devs' => $data
        ]);
    }
}
