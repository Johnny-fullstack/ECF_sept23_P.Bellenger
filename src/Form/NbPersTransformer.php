<?php

namespace App\Form;

use Symfony\Component\Form\DataTransformerInterface;

class NbPersTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
       
        switch ($value) {
            case 1:
                return '1pers';
            case 2:
                return '2pers';
            case 3:
                return '3pers';
            case 4:
                return '4pers';
            case 5:
                return '5pers';
            case 6:
                return '6pers';
            default:
                return null;
        }
    }

    public function reverseTransform($value)
    {
        
        switch ($value) {
            case '1pers':
                return 1;
            case '2pers':
                return 2;
            case '3pers':
                return 3;
            case '4pers':
                return 4;
            case '5pers':
                return 5;
            case '6pers':
                return 6;
            default:
                return null;
        }
    }
}
