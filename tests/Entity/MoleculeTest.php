<?php

namespace App\Tests\Entity;

use App\Entity\Atom;
use App\Entity\Molecule;
use PHPUnit\Framework\TestCase;


/**
 * $molecule = new Molecule('glucide');
 * $molecule->addAtom(new Atom('Carbon', 'C'))
 *          ->addAtom(new Atom('Oxygen', 'O'));
 * $molecule->getAtoms(); // retourne un tableau d'atomes
 * $molecule->merge(); // Réaliser la fusion si au moins 2 atomes
 * $molecule->getName(); // Renvoie 'CO'
 * $molecule->getType(); // renvoie 'glucide'
 */
class MoleculeTest extends TestCase
{

    public function testMoleculeCanBeInstancied()
    {
        $this->assertInstanceOf(Molecule::class, new Molecule('glucide'));
    }

    public function testAtomCanBeAddedInMolecule()
    {
        /** @var Atom $atom */
        $atom = $this->createMock(Atom::class); // mock = instance fake d'une classe, utile pour les tests
        $molecule = new Molecule('glucide');

        $this->assertSame($molecule, $molecule->addAtom($atom)); // on s'assure que addAtom() retourne bien une molecule (return $this)
        $this->assertContainsOnlyInstancesOf(Atom::class, $molecule->getAtoms());
    }

    public function testMoleculeCannotContainOnlyOneAtom()
    {
        $this->expectException(\LogicException::class);
        /** @var Atom $atom */
        // $atom = $this->createMock(Atom::class); // les mocks n'ont pas de propriétés et leurs méthodes retournent null.
        // on va devoir faire un getMockBuilder pour lui injecter ce qu'on veut que notre mock possède
        $atom = $this->getMockBuilder(Atom::class) // on génère notre propre constructeur de mock
            ->disableOriginalConstructor() // on désactive le constructor par défaut
            ->setMethods(['getSymbol']) // on lui ajoute une méthode getSymbol, le mock est alors appelé stubs
            ->getMock(); // on créé le stubs
        $atom->method('getSymbol')->willReturn('C'); // willReturn simule ce que la méthode du stubs va nous retourner
        $molecule = new Molecule('glucide');
        $molecule->addAtom($atom);
        $molecule->getName();
    }

    public function testFirstMoleculeCanBeMerged()
    {
        $carbon = $this->createConfiguredMock(Atom::class, [
            'getSymbol' => 'C'
        ]); // méthode de fabrication de mock perso plus rapide que ligne 42 ;)
        $oxygen = $this->createConfiguredMock(Atom::class, [
            'getSymbol' => 'O'
        ]);
        $molecule = new Molecule('glucide');
        $molecule->addAtom($carbon)
                ->addAtom($oxygen);
        $molecule->merge();
        $this->assertEquals('CO', $molecule->getName());
    }

    public function testCanRetrievedMoleculeType()
    {
        $molecule = new Molecule('glucide');
        $this->assertEquals('glucide', $molecule->getType());
    }

}