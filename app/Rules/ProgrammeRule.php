<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ProgrammeRule implements Rule
{
    private $fields;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct( $champ )
    {
        $this->fields = $champ;
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
      //  dd($this->fields);
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
