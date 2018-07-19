<?php

namespace App\Entity;


class Molecule
{

    /**
     * @var Atom[]
     */
    private $atoms = [];
    private $name;
    private $type;

    /**
     * Molecule constructor.
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    public function addAtom(Atom $atom)
    {
        $this->atoms[] = $atom;

        return $this; // le return $this est nécessaire ici pour pouvoir chaîner les méthodes : $mol->addAtom()->addAtom()...
    }

    public function getAtoms()
    {
        return $this->atoms;
    }

    public function merge()
    {
        if(count($this->atoms) <2 ) {
            throw new \LogicException('Il n\'y a pas assez d\'atomes dans la molécule !');
        }

       $this->name = '';
       foreach($this->atoms as $atom){
           $this->name .= $atom->getSymbol();
       }
    }

    public function getName()
    {
        if(null === $this->name) {
            $this->merge();
        }

        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }


}