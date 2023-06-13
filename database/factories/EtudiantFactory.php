<?php

namespace Database\Factories;

use App\Models\Etudiant;
use App\Models\Promotion;
use App\Models\Filiere;
use App\Models\Cycle;
use App\Models\Semestre;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtudiantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Etudiant::class;

    /**
     * La variable de la promotion
     * @var Promotion
    */
    protected $promotion = null;
    
    /**
     * La variable du cycle
     * @var Cycle
    */
    protected $cycle = null;
    
    /**
     * La variable de la promotion
     * @var Semestre
    */
    protected $semestre = null;

    /**
     * precision de la promotion
    */
    public function setData(int $anneEntrer, string $filiere, string $cycle, string $semestre){
        $filiere = Filiere::where('name', $filiere)->first();
        $this->promotion = Promotion::where('filiere_id', $filiere->id)->first();
        $this->cycle = Cycle::where('cycle', $cycle)->first();
        $this->semestre = Semestre::where('intitule', $semestre)->first();
        return $this;
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $genre = $this->faker->randomElement($array = array('masculin','feminin'));
        $regEx = '';
        if($genre == 'feminin'){
            $regEx = 'N[0-1]{2}[0-9]{4}'.$this->promotion->annee_entrer.'2';
        }else{
            $regEx = 'N[0-1]{2}[0-9]{4}'.$this->promotion->annee_entrer.'1';
        }

        return [
            'ine'=> $this->faker->unique()->regexify($regEx),
            'genre'=> $genre,
            'nom'=> $this->faker->lastName($genre),
            'prenom'=> $this->faker->firstName($genre),
            'nee_le'=> $this->faker->dateTimeBetween('-23 years', '-18 years')->format('d-m-Y'),
            'promotion_id' => $this->promotion->id,
            'cycle_id' => $this->cycle->id,
            'semestre_id' => $this->semestre->id
        ];
    }
}
