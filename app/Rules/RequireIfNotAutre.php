<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RequireIfNotAutre implements Rule
{

    private $type;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct( $type )
    {
        $this->type = $type;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //Si ce n'est pas autre
        if( $this->type != '3' ){
            //Si le champ est null
            if( is_null($value) ){ 
                return false; 
            }
            //Sinon
            else{ 
                return true;
            }
        }
        //Si c'est un examen
        else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Les champs sont requis pour le type COURS ou EXAMEN ';
    }
}
