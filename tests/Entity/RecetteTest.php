<?php

namespace App\Tests\Entity;

use App\Entity\Recette;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;

class RecetteTest extends TestCase
{
    /**
     * @var Recette
     */
    private $rec;

    public function setUp()
    {
        $this->rec = new Recette();
    }

    public function testDefaultAffRecet()
    {
        $this->assertEquals('oui', $this->rec->getAffRecet());
    }

    public function testDefaultEtoiles()
    {
        $this->assertEquals(0, $this->rec->getEtoiles());
    }

    public function testDefaultDatRecet()
    {
        $today = new \DateTime();
        $this->assertEquals($today, $this->rec->getDatRecet());
    }

    public function testDefaultEtaStee()
    {
        $this->assertEquals("STEEP", $this->rec->getEtaStee());
    }

    public function testDefaultComMember()
    {
        $this->assertEquals("Sans commentaires", $this->rec->getComMember());
    }

    public function testAromeRecettesIsArrayCollection()
    {
        $this->assertInstanceOf(
            ArrayCollection::class,
            $this->rec->getAromeRecettes()
        );
    }
}
