<?php


namespace App\Tests\Entity;

use App\Entity\Atom;
use PHPUnit\Framework\TestCase;

/**
 * $atom = new Atom('Carbone', 'C'); // le symbole doit faire 2 caractères max
 * $atom->getName(); // doit retourner le nom de l'atome
 * $atom->getSymbol(); // doit retourner le symbole
 */
class AtomTest extends TestCase
{
    public function testAtomCanBeCreated()
    {
        $atom = new Atom('Carbone', 'C');
        $this->assertInstanceOf(Atom::class, $atom);
    }

    public function testAtomHasAName()
    {
        $atom = new Atom('Carbone', 'C');
        $this->assertEquals('Carbone', $atom->getName());

        $atom2 = new Atom('Oxygene', 'O');
        $this->assertEquals('Oxygene', $atom2->getName());
    }

    public function testAtomHasASymbol()
    {
        $atom = new Atom('Carbone', 'C');
        $this->assertEquals('C', $atom->getSymbol());

        $atom2 = new Atom('Oxygene', 'O');
        $this->assertEquals('O', $atom2->getSymbol());
    }

    public function testAtomCannotHaveSymbolMoreThanTwoCharacters()
    {
        $this->expectException(\LengthException::class); // on vérifie que le code nous renvoit bien un message d'erreur
        $atom = new Atom('Carbone', 'Ccc');
    }

    public function testAtomCannotBeCreatedWithoutNameAndSymbol()
    {
        $this->expectException(\ArgumentCountError::class); // on vérifie que le code nous renvoit bien un message d'erreur
        $atom = new Atom();
    }
}