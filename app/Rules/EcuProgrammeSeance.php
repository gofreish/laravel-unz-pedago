<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use Illuminate\Support\Facades\DB;

class EcuProgrammeSeance implements Rule
{
    private $date;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($date)
    {
    
        $this->date=$date;
    }
    private function requete(){
        $programmedate= DB::table('programmes')
        ->join('e_c_u_s','e_c_u_s.id','=','programmes.e_c_u_id')
        
                        ->where('dateDebut','<=',$this->date)
                        ->where('dateFin','>=',$this->date)
                        ->get();
                       // dd($programmedate);


        return $programmedate;

        /*->join('seances','e_c_u_s.id','=','seances.e_c_u_id')*/
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute,$value)
    {
        
       if ($this->requete()->isNotEmpty()) {
         if(is_null($value)){
            return false;
          
             }else{
                
               return true;
               
             }

       }else{
        //dd('pas  de programme pour ctte date');
           return false; 
       }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La date de la seance doit être comprise entre les dates de début et de fin du programme.';
    }
}
