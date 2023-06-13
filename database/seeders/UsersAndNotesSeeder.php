<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\RoleHierarchy;

class UsersAndNotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfUsers = 10;
        $numberOfNotes = 100;
        $usersIds = array();
        $statusIds = array();
        $faker = Faker::create();
        /* Create roles*/
        $adminRole = Role::create(['name' => 'admin']);
        RoleHierarchy::create([
            'role_id' => $adminRole->id,
            'hierarchy' => 1,
        ]);
        $csafRole = Role::create(['name' => 'csaf']);
        RoleHierarchy::create([
            'role_id' => $csafRole->id,
            'hierarchy' => 2,
        ]);
        $coordonateurRole = Role::create(['name' => 'coordonateur']);
        RoleHierarchy::create([
            'role_id' => $coordonateurRole->id,
            'hierarchy' => 3,
        ]);
        $enseignantRole = Role::create(['name' => 'enseignant']);
        RoleHierarchy::create([
            'role_id' => $enseignantRole->id,
            'hierarchy' => 4,
        ]);
        $scolariteRole = Role::create(['name' => 'scolarite']);
        RoleHierarchy::create([
            'role_id' => $scolariteRole->id,
            'hierarchy' => 5,
        ]);
        $delegueRole = Role::create(['name' => 'delegue']);
        RoleHierarchy::create([
            'role_id' => $delegueRole->id,
            'hierarchy' => 6,
        ]);
        $userRole = Role::create(['name' => 'user']);
        RoleHierarchy::create([
            'role_id' => $userRole->id,
            'hierarchy' =>7,
        ]);
        $guestRole = Role::create(['name' => 'guest']);
        RoleHierarchy::create([
            'role_id' => $guestRole->id,
            'hierarchy' => 8,
        ]);

        /*  insert status  */
        DB::table('status')->insert([
            'name' => 'ongoing',
            'class' => 'badge badge-pill badge-primary',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        DB::table('status')->insert([
            'name' => 'stopped',
            'class' => 'badge badge-pill badge-secondary',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        DB::table('status')->insert([
            'name' => 'completed',
            'class' => 'badge badge-pill badge-success',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        DB::table('status')->insert([
            'name' => 'expired',
            'class' => 'badge badge-pill badge-warning',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        /*  insert users*/
        $user = User::create([
            'name' => 'admin',
            'prenom' => 'UNZ',
            'telephone' => '(+226)-- -- -- --',
            'titre_id' => 1,
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,admin'
        ]);
        $user->assignRole('admin');
        $user->assignRole('user');

        $user = User::create([
            'name' => 'BOUGOUMA',
            'prenom' => 'Moussa',
            'telephone' => '(+226)68 35 24 21 (+226)63 14 62 56',
            'titre_id' => 4,
            'email' => 'bmoussaraphael@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');

        $user = User::create([
            'name' => 'GNABAHOU',
            'prenom' => 'D. Allain',
            'telephone' => '(+226)70 28 61 83',
            'titre_id' => 4,
            'email' => 'gnabahou@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');

        $user = User::create([
            'name' => 'ZOUNDI',
            'prenom' => 'Christian',
            'telephone' => '(+226)78 22 22 95',
            'titre_id' => 4,
            'email' => 'zounchr@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant,coordonateur'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');

        $user = User::create([
            'name' => 'BIKIENGA',
            'prenom' => 'Moustapha',
            'telephone' => '(+226)67 31 49 58',
            'titre_id' => 4,
            'email' => 'bmoustaph@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant,coordonateur'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');
        $user->assignRole('coordonateur');

        $user = User::create([
            'name' => 'DIANDA',
            'prenom' => 'Abdoul Aziz Kalifa',
            'telephone' => '(+226)70 59 17 35 (+226)76 47 47 94',
            'titre_id' => 1,
            'email' => 'douaziz01@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant,coordonateur'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');
        $user->assignRole('coordonateur');

        $user = User::create([
            'name' => 'WANGRAWA',
            'prenom' => 'Wendgida Dimitri',
            'telephone' => '(+226)71 88 27 07 (+226)63 40 38 18',
            'titre_id' => 4,
            'email' => 'dimwang56@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');

        $user = User::create([
            'name' => 'OUATTARA',
            'prenom' => 'Frédéric',
            'telephone' => '(+226)76 62 75 55',
            'titre_id' => 5,
            'email' => 'fojals@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');

        $user = User::create([
            'name' => 'CONSEIBO',
            'prenom' => 'André',
            'telephone' => '(+226)70 33 54 61',
            'titre_id' => 4,
            'email' => 'andreconsebo@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'NZIHOU',
            'prenom' => 'Jean Fidèle',
            'telephone' => '(+226)76 65 18 86',
            'titre_id' => 4,
            'email' => 'jean_fidele@hotmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'SOUGOTI/GUISSOU',
            'prenom' => 'Marie Laure',
            'telephone' => '(+226)70 27 81 18',
            'titre_id' => 5,
            'email' => 'guissoulaure@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'DIENDERE/KIENTEGA',
            'prenom' => 'N. Françoise',
            'telephone' => '(+226)70 36 15 39',
            'titre_id' => 4,
            'email' => 'user1@user.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'OUEDRAOGO',
            'prenom' => 'T. Frédéric',
            'telephone' => '(+226)76 65 46 06',
            'titre_id' => 4,
            'email' => 'ouedraogo.tounwendyam@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');

        $user = User::create([
            'name' => 'COMPAORE',
            'prenom' => 'Mikaïlou',
            'telephone' => '(+226)78 83 77 88',
            'titre_id' => 4,
            'email' => 'mikailou.compaore@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'OUEDRAOGO',
            'prenom' => 'Arouna',
            'telephone' => '(+226)68 04 90 70',
            'titre_id' => 4,
            'email' => 'arounaoued2002@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'SOME',
            'prenom' => 'Kounhinir',
            'telephone' => '(+226)71 22 88 87',
            'titre_id' => 4,
            'email' => 'sokous11@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'SOUDRE',
            'prenom' => 'Albert',
            'telephone' => '(+226)78 78 57 52',
            'titre_id' => 4,
            'email' => 'asoudre@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'TRAORE',
            'prenom' => 'Lassina',
            'telephone' => '(+226)78 35 64 64',
            'titre_id' => 4,
            'email' => 'nassilatraore@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'BAYALA',
            'prenom' => 'Bagora',
            'telephone' => '(+226)76 69 61 66 (+226)70 69 53 23',
            'titre_id' => 4,
            'email' => 'bagora.bayala@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'COULIDIATI',
            'prenom' => 'Tangbadioa Hervé',
            'telephone' => '(+226)71 29 13 80 (+226)76 40 16 33',
            'titre_id' => 4,
            'email' => 'coulidiati_herv@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'COULIBALY',
            'prenom' => 'Yacouba Ahmed',
            'telephone' => '(+226)76 69 88 02',
            'titre_id' => 4,
            'email' => 'coulahmede@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');

        $user = User::create([
            'name' => 'YOUGBARE',
            'prenom' => 'W. Jacob',
            'telephone' => '(+226)70 51 70 46 (+226)69 64 89 07',
            'titre_id' => 4,
            'email' => 'user2@user.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'SANOU/SORE',
            'prenom' => 'Safiatou',
            'telephone' => '(+226)70 26 02 50',
            'titre_id' => 2,
            'email' => 'sore_safiatou@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'BAGRE',
            'prenom' => 'Remi Guillaume',
            'telephone' => '(+226)70 97 99 81',
            'titre_id' => 4,
            'email' => 'baremgui@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'DEMBEGA',
            'prenom' => 'Abdoulaye',
            'telephone' => '(+226)76 62 39 30',
            'titre_id' => 4,
            'email' => 'doulaydem@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'OUEDRAOGO',
            'prenom' => 'O. Jean Etienne',
            'telephone' => '(+226)70 74 73 23',
            'titre_id' => 4,
            'email' => 'ouedraogoetienne@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'SAVADOGO',
            'prenom' => 'Souleymane',
            'telephone' => '(+226)78 22 73 53',
            'titre_id' => 4,
            'email' => 'sara01souley@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'COMPAORE',
            'prenom' => 'Abdoulaye',
            'telephone' => '(+226)76 36 17 99 (+226)78 25 95 63',
            'titre_id' => 4,
            'email' => 'ab.compaore1@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'DERRA',
            'prenom' => 'Moumouni',
            'telephone' => '(+226)71 85 50 84',
            'titre_id' => 4,
            'email' => 'derrmoune@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'GNANOU',
            'prenom' => 'Inza',
            'telephone' => '(+226)76 69 66 39 (+226)72 58 38 48 (+226)78 59 40 12',
            'titre_id' => 1,
            'email' => 'gnanouinza@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'YAMEOGO',
            'prenom' => 'Adama Ouédraogo',
            'telephone' => '(+226)72 47 32 92 (+226)78 82 37 36',
            'titre_id' => 4,
            'email' => 'ayameogofr@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'ZANGO/OTOIDOBIGA',
            'prenom' => 'Cécile Harmonie',
            'telephone' => '(+226)76 17 51 25 (+226)72 10 08 87',
            'titre_id' => 4,
            'email' => 'oharmonie@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'KABORE/OUEDRAOGO',
            'prenom' => 'Wendlassida Pauline',
            'telephone' => '(+226)71 53 79 19 (+226)78 66 63 64',
            'titre_id' => 4,
            'email' => 'kw.pauline@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant,coordonateur'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');
        $user->assignRole('coordonateur');


        $user = User::create([
            'name' => 'IMBGA',
            'prenom' => 'Bouto Kossi',
            'telephone' => '(+226)70 84 33 77 (+226)76 07 44 30',
            'titre_id' => 4,
            'email' => 'kossiimbga@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'OUEDRAOGO',
            'prenom' => 'Boukaré',
            'telephone' => '(+226)70 61 50 64 (+226)79 54 02 08',
            'titre_id' => 4,
            'email' => 'boubakont2015@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'KABORE ',
            'prenom' => 'Boureima',
            'telephone' => '(+226)75 52 58 08 (+226)72 33 34 94',
            'titre_id' => 4,
            'email' => 'kaboureim@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'TRAORE ',
            'prenom' => 'Kuan Abdoulaye',
            'telephone' => '(+226)78 88 16 31 (+226)76 76 23 08 (+226)71 60 35 71',
            'titre_id' => 4,
            'email' => 'kuabtraore@live.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'KARANGA ',
            'prenom' => 'Yssouf',
            'telephone' => '(+226)70 54 06 47 (+226)76 42 71 57',
            'titre_id' => 4,
            'email' => 'ykaranga@yahoo.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'SOURABIE ',
            'prenom' => 'Idrissa',
            'telephone' => '(+226)70 70 98 20 (+226)78 48 34 86',
            'titre_id' => 4,
            'email' => 'user3@user.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'DA ',
            'prenom' => 'Filkpièrè Léonard',
            'telephone' => '(+226)70 01 32 68 (+226)79 56 57 37',
            'titre_id' => 4,
            'email' => 'user4@user.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');



        $user = User::create([
            'name' => 'GYEBRE ',
            'prenom' => 'Aristide Marie Frédéric',
            'telephone' => '(+226)71 30 37 27',
            'titre_id' => 4,
            'email' => 'user5@user.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        $user = User::create([
            'name' => 'KABORE ',
            'prenom' => 'Salfo',
            'telephone' => '(+226)70 11 84 83',
            'titre_id' => 4,
            'email' => 'user6@user.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'user,enseignant'
        ]);
        $user->assignRole('user');
        $user->assignRole('enseignant');


        /*for($i = 0; $i<$numberOfUsers; $i++){
            $user = User::create([
                'name' => $faker->lastName(),
                'prenom' => $faker->firstName(),
                'telephone' => $faker->e164PhoneNumber(),
                'titre_id' => $faker->numberBetween(1,5) ,
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'menuroles' => 'user'
            ]);
            $user->assignRole('user');
            array_push($usersIds, $user->id);
        }*/
        /*  insert notes
        for($i = 0; $i<$numberOfNotes; $i++){
            $noteType = $faker->word();
            if(random_int(0,1)){
                $noteType .= ' ' . $faker->word();
            }
            DB::table('notes')->insert([
                'title'         => $faker->sentence(4,true),
                'content'       => $faker->paragraph(3,true),
                'status_id'     => $statusIds[random_int(0,count($statusIds) - 1)],
                'note_type'     => $noteType,
                'applies_to_date' => $faker->date(),
                'users_id'      => $usersIds[random_int(0,$numberOfUsers-1)]
            ]);
        }*/
    }
}
