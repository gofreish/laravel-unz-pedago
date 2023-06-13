<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    /**
     * Clé primaire associée au model Etudiant
     * @var string
    */
    protected $primaryKey = 'ine';
    public $incrementing = false;
    public $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ine', 'genre', 'nom', 'prenom', 'nee_le', 'promotion_id', 'cycle_id', 'historique'
    ];

    /**
     * Get the promotion that owns the student.
     */
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    /**
     * Get the cycle that owns the student.
     */
    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }

    public function historiqueToArray(){
        $historiqueData = [];
        $cycle = "";
        for ($i=0; $i < strlen($this->historique); $i++) { 
            switch ($this->historique[$i]) {
                case '{':
                    $cycle = $this->historique[$i-1];
                    $historiqueData[$cycle] = array();
                    break;
                case '(':
                    $historiqueData[$cycle][$this->historique[$i-1]] = array('result'=>$this->historique[$i+1], 'times'=>$this->historique[$i+3]);
                    break;
                default:
                    # code...
                    break;
            }
        }
        return $historiqueData;
    }


    private function historiqueArrayToString( $historiqueArray ){
        $histo = "";
        foreach ($historiqueArray as $cycle => $dataCycle) {
            $histo = $histo.$cycle.'{';
            foreach ($dataCycle as $semestre => $dataSem) {
                $histo = $histo.$semestre.'('.$dataSem['result'].':'.$dataSem['times'].');';
            }
            $histo = $histo."}|";
        }
        return $histo;
    }

    //Pour verifier les donnes avant edition
    private function validEditData($cycle, $semestre, $resultat){
        $cycles = ['l', 'm', 'd'];
        $resultats = ['v', 'a', 'n'];
        if(
            in_array($cycle,$cycles,true) && 
            in_array($resultat, $resultats, true)
        ){
            switch ($cycle) {
                case 'l':
                    return intval($semestre) < 6;
                case 'm':
                    return intval($semestre) < 4;
                
                default:
                    return intval($semestre) > 0;
            }
        }else{
            return false;
        }
    }

    //init Historique
    public function initHistorique(){
        $historiqueArray = [
            'l' => [ 
                '1' => ['result'=>'n', 'times'=>0], 
                '2' => ['result'=>'n', 'times'=>0], 
                '3' => ['result'=>'n', 'times'=>0], 
                '4' => ['result'=>'n', 'times'=>0], 
                '5' => ['result'=>'n', 'times'=>0], 
                '6' => ['result'=>'n', 'times'=>0]
            ],
            'm' => [
                '1' => ['result'=>'n', 'times'=>0],
                '2' => ['result'=>'n', 'times'=>0],
                '3' => ['result'=>'n', 'times'=>0],
                '4' => ['result'=>'n', 'times'=>0]
            ],
            'd' => [
                '1'=>['result' => 'false', 'times' => 0]
            ]
        ];
        $this->historique = $this->historiqueArrayToString($historiqueArray);
    }

    /*
        Pour editer l historique d un etudiant
    */
    public function semestreValider( $cycle, $semestre ){
        $historiqueArray = $this->historiqueToArray();
        //Si les données sont valid
        if( $this->validEditData($cycle, $semestre, 'v') ){
            $historiqueArray[$cycle][$semestre]['result'] = 'v'; 
            $this->historique = $this->historiqueArrayToString( $historiqueArray );
        }
    }
    public function semestreAjourner( $cycle, $semestre ){
        $historiqueArray = $this->historiqueToArray();
        //Si les données sont valid
        if( $this->validEditData($cycle, $semestre, 'a') ){
            $historiqueArray[$cycle][$semestre]['result'] = 'a'; 
            $historiqueArray[$cycle][$semestre]['times']++;
            $this->historique = $this->historiqueArrayToString( $historiqueArray );
        }
    }
    
    public function editHistorique($cycle, $semestre, $resultat, $times){
        $historiqueArray = $this->historiqueToArray();
        //Si les données sont valid
        if( $this->validEditData($cycle, $semestre, $resultat) && intval($times) >= 0 ){
            $historiqueArray[$cycle][$semestre]['result'] = $resultat; 
            $historiqueArray[$cycle][$semestre]['times'] = $times;
            $this->historique = $this->historiqueArrayToString( $historiqueArray );
        }
    }

}
