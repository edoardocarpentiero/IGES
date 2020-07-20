<?php
/**
 * Created by PhpStorm.
 * User: edoardocarpentiero
 * Date: 2019-03-22
 * Time: 12:08
 */

use PHPUnit\Framework\TestCase;
require_once(dirname(__DIR__,2).'\IGES\Application Layer\GestioneCaricoDidattico\GestioneCaricoDidattico.php');

class Test extends TestCase
{


    public function testVisualizzaInsegnamentiPropostiCorretto()
    {
        $ges=new GestioneCaricoDidattico();
        $this->assertEquals(-1,$ges->getInsegnamentiAssociatiAlDocente("1515d166"),"STRINGA NON ALFANUMERICA");
        $this->assertEquals(-1,$ges->getInsegnamentiAssociatiAlDocente("151523456789"),"STRINGA Numerica non Maggiore di 11");
        $this->assertEquals(-1,$ges->getInsegnamentiAssociatiAlDocente("15152345678888"),"Docente Esitente");
        $this->assertEquals(-1,$ges->getInsegnamentiAssociatiAlDocente("-"),"Matricola Specificata");

        $docentiPrD=$ges->getInsegnamentiAssociatiAlDocente("201515166");
        $this->assertNotEmpty($docentiPrD,"Insegnamenti non proposti");
        $docentiPrD=$ges->getInsegnamentiAssociatiAlDocente("201515168");
        $this->assertEmpty($docentiPrD,"Insegnamenti proposti");
    }

    public function testProponiInsegnamentoDisponibileCorretto()
    {
        $ges=new GestioneCaricoDidattico();
        $proposta=$ges->proponiInsegnamento(new Associa(9,2,7,201515166,48,0,"PROPOSTO"));
        $this->assertTrue($proposta,"Insegnamento PROPOSTO");
    }

    public function testProponiInsegnamentoDisponibileMatricolaDocenteErrata(){
        $ges=new GestioneCaricoDidattico();
        $proposta=$ges->proponiInsegnamento(new Associa(9,2,7,201515100,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola docente non presente");
        $proposta=$ges->proponiInsegnamento(new Associa(9,2,7,"201515aaa",48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola docente alfanumerica");
        $proposta=$ges->proponiInsegnamento(new Associa(9,2,7,"-",48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola docente non specificata");
        $proposta=$ges->proponiInsegnamento(new Associa(9,2,7,"201515201515",48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola docente maggiore di 11");
    }

    public function testProponiInsegnamentoDisponibileMatricolaInsegnamentoErrata(){
        $ges=new GestioneCaricoDidattico();
        $proposta=$ges->proponiInsegnamento(new Associa(10,2,7,201515166,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola Insegnamento presente");
        $proposta=$ges->proponiInsegnamento(new Associa(30,2,7,201515166,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola Insegnamento disponibile");
        $proposta=$ges->proponiInsegnamento(new Associa("a30",2,7,201515166,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola Insegnamento alfanumerica");
        $proposta=$ges->proponiInsegnamento(new Associa("-",2,7,201515166,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola Insegnamento non specificata");
        $proposta=$ges->proponiInsegnamento(new Associa(302222222223,2,7,201515166,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola Insegnamento maggiore di 11");
    }

    public function testProponiInsegnamentoDisponibileClasseErrata()
    {
        $ges=new GestioneCaricoDidattico();
        $proposta=$ges->proponiInsegnamento(new Associa(9,0,7,201515166,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Classe inserita minore di 1");
        $proposta=$ges->proponiInsegnamento(new Associa(9,4,7,201515166,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Classe inserita maggiore di 3");
        $proposta=$ges->proponiInsegnamento(new Associa(9,"abc",7,201515166,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Classe inserita non numerica");
    }

    public function testProponiInsegnamentoDisponibileOreTeoriaErrato()
    {
        $ges=new GestioneCaricoDidattico();
        $proposta=$ges->proponiInsegnamento(new Associa(9,2,7,201515166,"-",0,"PROPOSTO"));
        $this->assertFalse($proposta,"Ore assegnate Teoria non specificate");
        $proposta=$ges->proponiInsegnamento(new Associa(9,2,7,201515166,"48a",0,"PROPOSTO"));
        $this->assertFalse($proposta,"Ore assegnate Teoria alfanumerica");
    }
    public function testProponiInsegnamentoDisponibileOreLabErrato()
    {
        $ges=new GestioneCaricoDidattico();
        $proposta=$ges->proponiInsegnamento(new Associa(9,2,7,201515166,48,"-","PROPOSTO"));
        $this->assertFalse($proposta,"Ore assegnate Lab non specificate");
        $proposta=$ges->proponiInsegnamento(new Associa(9,2,7,201515166,48,"0a","PROPOSTO"));
        $this->assertFalse($proposta,"Ore assegnata Lab alfanumerica");
    }

    public function testProponiInsegnamentoDisponibileStatoErrato()
    {
        $ges=new GestioneCaricoDidattico();
        $proposta=$ges->proponiInsegnamento(new Associa(9,2,7,201515166,48,0,"DOMANDA"));
        $this->assertFalse($proposta,"Proposta di un insegnamento non disponibile");
    }




    public function testCambiaStatoInsegnamentoPropostoDalPresidenteCorretto()
    {
        $ges=new GestioneCaricoDidattico();
        $value=$ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(0,$value,"Stato aggiornato in ACCETTATO");
        $value=$ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,40,0,"RIFIUTATO"));
        $this->assertEquals(0,$value,"Stato aggiornato in RIFIUTATO");

    }

    public function testCambiaStatoInsegnamentoPropostoDalDocenteCorretto()
    {
        $ges=new GestioneCaricoDidattico();
        $value=$ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,40,0,"ASSEGNATO"));
        $this->assertEquals(0,$value,"Stato aggiornato in ASSEGNATO");
        $value=$ges->liberaAssociazioneInsegnamento(new Associa(9,1,7,201515172,40,0,"IN ATTESA"));
        $this->assertEquals(0,$value,"Stato IN ATTESA");
        $value=$ges->inviaEmail(201515165,201515172,"fferrucci@unisa.it","rzizza@unisa.it","Annullamento proposta Insegnamento","L’insegnamento da lei proposto è stato rifiutato");
        $this->assertEquals(0,$value,"Email inoltrata");
    }

    public function testInoltraEmailErrato()
    {
        $ges=new GestioneCaricoDidattico();
        $value=$ges->inviaEmail(201515165,201515172,"-","rzizza@unisa.it","Annullamento proposta Insegnamento","L’insegnamento da lei proposto è stato rifiutato");
        $this->assertEquals(-1,$value,"Email non inoltrata");
        $value=$ges->inviaEmail(201515165,201515172,"pres@unisa.it","rzizza@unisa.it","Annullamento proposta Insegnamento","L’insegnamento da lei proposto è stato rifiutato");
        $this->assertEquals(-1,$value,"Email non inoltrata");
        $value=$ges->inviaEmail(201515165,201515172,"fferrucci@unisa.it","-","Annullamento proposta Insegnamento","L’insegnamento da lei proposto è stato rifiutato");
        $this->assertEquals(-1,$value,"Email non inoltrata");
        $value=$ges->inviaEmail(201515165,201515172,"fferrucci@unisa.it","rziza@unisa.it","Annullamento proposta Insegnamento","L’insegnamento da lei proposto è stato rifiutato");
        $this->assertEquals(-1,$value,"Email non inoltrata");
        $value=$ges->inviaEmail(201515165,201515172,"fferrucci@unisa.it","rzizza@unisa.it","-","L’insegnamento da lei proposto è stato rifiutato");
        $this->assertEquals(-1,$value,"Email non inoltrata");
        $value=$ges->inviaEmail(201515165,201515172,"fferrucci@unisa.it","rzizza@unisa.it","rifiuto","L’insegnamento da lei proposto è stato rifiutato");
        $this->assertEquals(-1,$value,"Email non inoltrata");
        $value=$ges->inviaEmail(201515165,201515172,"fferrucci@unisa.it","rzizza@unisa.it","Annullamento proposta Insegnamento","-");
        $this->assertEquals(-1,$value,"Email non inoltrata");
        $value=$ges->inviaEmail(201515165,201515172,"fferrucci@unisa.it","rzizza@unisa.it","Annullamento proposta Insegnamento","Ins. rifiutato");
        $this->assertEquals(-1,$value,"Email non inoltrata");
    }


    public function testCambiaStatoInsegnamentoPropostoMatricolaDocenteErrato()
    {
        $ges=new GestioneCaricoDidattico();
        $value=$ges->cambiaStatoAssociazione(new Associa(8,2,7,201515167,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola docente non associata all'insegnamento");
        $value=$ges->cambiaStatoAssociazione(new Associa(8,2,7,"a201515167",40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola docente alfanumerica");
        $value=$ges->cambiaStatoAssociazione(new Associa(8,2,7,"",40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola docente non specificata");
        $value=$ges->cambiaStatoAssociazione(new Associa(8,2,7,201515167201515167,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola docente maggiore di 11 caratteri");
    }

    public function testCambiaStatoInsegnamentoPropostoMatricolaInsegnamentoErrato()
    {
        $ges=new GestioneCaricoDidattico();
        $value=$ges->cambiaStatoAssociazione(new Associa(12,2,7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola insegnamento non presente nella programmazione didattica");
        $value=$ges->cambiaStatoAssociazione(new Associa(9,1,7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola insegnamento non associata al docente");
        $value=$ges->cambiaStatoAssociazione(new Associa("a8",2,7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola insegnamento alfanumerica");
        $value=$ges->cambiaStatoAssociazione(new Associa("-",2,7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola insegnamento non specificata");
        $value=$ges->cambiaStatoAssociazione(new Associa("1234567892345",2,7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola insegnamento maggiore di 11 caratteri");
    }

    public function testCambiaStatoInsegnamentoPropostoClasseErrato()
    {
        $ges=new GestioneCaricoDidattico();
        $value=$ges->cambiaStatoAssociazione(new Associa(8,0,7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Classe uguale a 0");
        $value=$ges->cambiaStatoAssociazione(new Associa(8,4,7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Classe uguale a 4");
        $value=$ges->cambiaStatoAssociazione(new Associa(8,"-",7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Classe uguale a 4");
    }

    public function testCambiaStatoInsegnamentoPropostoStatoErrato()
    {
        $ges=new GestioneCaricoDidattico();
        $value=$ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,40,0,"CONVALIDATO"));
        $this->assertEquals(-1,$value,"Stato CONVALIDATO");
    }

    public function testCambiaStatoInsegnamentoPropostoOreTeoriaErrato()
    {
        $ges=new GestioneCaricoDidattico();
        $value=$ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,"-",0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Ore teoria non specficate");
        $value=$ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,"40a",0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Ore teoria non specficate");

    }

    public function testCambiaStatoInsegnamentoPropostoOreLabErrato()
    {
        $ges=new GestioneCaricoDidattico();
        $value=$ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,40,"-","ACCETTATO"));
        $this->assertEquals(-1,$value,"Ore teoria non specficate");
        $value=$ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,40,"0a","ACCETTATO"));
        $this->assertEquals(-1,$value,"Ore teoria non specficate");

    }

    public function testVisualizzaInfoInsegnamentoDisponibileCorretto()
    {
        $ges=new GestioneCaricoDidattico();
        $value=$ges->getInfoDocentiInsegnamento(30,2,7);
        $this->assertNotEmpty($value,"Info insegnamenti");
    }

    public function testVisualizzaInfoInsegnamentoDisponibileMatricolaInsegnamentoErrato(){
        $ges=new GestioneCaricoDidattico();
        $value=$ges->getInfoDocentiInsegnamento("30a",2,7);
        $this->assertFalse($value,"Matricola insegnamento alfanumerica");
        $value=$ges->getInfoDocentiInsegnamento(13,2,7);
        $this->assertFalse($value,"Matricola insegnamento alfanumerica");
        $value=$ges->getInfoDocentiInsegnamento("-",2,7);
        $this->assertFalse($value,"Matricola insegnamento non specificata");
        $value=$ges->getInfoDocentiInsegnamento(30303030303030,2,7);
        $this->assertFalse($value,"Matricola insegnamento maggiore di 11 caratteri");
    }

    public function testVisualizzaInfoInsegnamentoDisponibileClasseErrato(){
        $ges=new GestioneCaricoDidattico();
        $value=$ges->getInfoDocentiInsegnamento(30,3,7);
        $this->assertFalse($value,"Classe non associata all'insegnamento");
        $value=$ges->getInfoDocentiInsegnamento(30,0,7);
        $this->assertFalse($value,"Classe minore di 1");
        $value=$ges->getInfoDocentiInsegnamento(30,4,7);
        $this->assertFalse($value,"Classe maggiore di 3");
        $value=$ges->getInfoDocentiInsegnamento(30,"a2",7);
        $this->assertFalse($value,"Classe con valore alfanumerico");
    }
}
