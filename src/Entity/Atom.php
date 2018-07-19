<?php

namespace App\Entity;


class Atom
{
    private $name;
    private $symbol;

    /**
     * Atom constructor.
     * @param $name
     * @param $symbol
     */
    public function __construct($name, $symbol)
    {
        if(strlen($symbol) > 2) {
            throw new \LengthException(sprintf(
                'Le symbole "%s" n\'est pas valide',
                $symbol
            ));
        }

        $this->name = $name;
        $this->symbol = $symbol;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

}