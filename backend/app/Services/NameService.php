<?php

namespace App\Services;

class NameService
{
   
    public function makeImgName($name)
    {
        $name = $this->removePolishCharacters($name);
        $name = strtolower(str_replace(' ', '-', $name));

        return $name . '.png';
    }

    public function normalizeString($string)
    {
        $string = $this->removePolishCharacters($string);
        $string = strtolower($string);
        $string = str_replace(' ', '-', $string);

        return $string;
    }
    
    protected function removePolishCharacters($string)
    {
        $polishCharacters = ['ą', 'ć', 'ę', 'ł', 'ń', 'ó', 'ś', 'ż', 'ź'];
        $replacements = ['a', 'c', 'e', 'l', 'n', 'o', 's', 'z', 'z'];

        return str_replace($polishCharacters, $replacements, $string);
    }
}
