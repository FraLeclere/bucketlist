<?php

namespace App\TextValidation ;

use Doctrine\ORM\EntityManagerInterface;

class Censurator
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function purify($string)
    {
        $forbiddenWords = file(dirname(__FILE__). '/../../public/CensorWord/Filtre_mot_censurator.txt',FILE_IGNORE_NEW_LINES);

        foreach ($forbiddenWords as $word)
        {
            $replace = str_repeat('*', mb_strlen($word));
            $string = str_ireplace($word,$replace,$string);
        }

        return $string;

    }

}