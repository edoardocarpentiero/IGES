<?php


use PHPUnit\Framework\TestCase;
require_once(dirname(__DIR__, 2) . '\IGES\Application Layer\GestioneCaricoDidattico\GestioneCaricoDidattico.php');

class UnitTesting extends TestCase
{

    protected $ges;
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->ges=new GestioneCaricoDidattico();
        $_SESSION['presidente']=true;
        syslog(LOG_INFO,"UnitTesting START");
    }

    public function testTC_7_1_1(){
        $this->assertEquals(-1,$this->ges->getInsegnamentiAssociatiAlDocente("-"),"Matricola Specificata");
    }
    public function testTC_7_1_2()
    {
        $this->assertEquals(-1,$this->ges->getInsegnamentiAssociatiAlDocente("201515166201515166"),"STRINGA Numerica non Maggiore di 11");
    }
    public function testTC_7_1_3(){
        $this->assertEquals(-1,$this->ges->getInsegnamentiAssociatiAlDocente("1515d166"),"STRINGA NON ALFANUMERICA");
    }
    public function testTC_7_1_4(){
        $this->assertEquals(-1,$this->ges->getInsegnamentiAssociatiAlDocente("201515100"),"Docente Esitente");
    }
    public function testTC_7_1_5()
    {
        $insegnamenti=$this->ges->getInsegnamentiAssociatiAlDocente("201515166");
        $this->assertNotEmpty($insegnamenti,"Insegnamenti non associati");
    }
    public function testTC_7_1_6()
    {
        $insegnamenti=$this->ges->getInsegnamentiAssociatiAlDocente("201515168");
        $this->assertEmpty($insegnamenti,"Insegnamenti associati");
    }
    public function testTC_7_2_1()
    {
        $insegnamentiDisp=$this->ges->getInsegnamentiDisponibili();
        $this->assertNotEmpty($insegnamentiDisp,"Lista insegnamenti disponibili vuota");
    }
    public function testTC_7_3_1(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(9,2,7,201515166,48,0,"PROPOSTO"));
        $this->assertTrue($proposta,"Insegnamento PROPOSTO");
    }
    public function testTC_7_3_2(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(9,2,7,201515100,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola docente non presente");
    }
    public function testTC_7_3_3(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(9,2,7,"201515aaa",48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola docente alfanumerica");
    }
    public function testTC_7_3_4(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(9,2,7,"-",48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola docente non specificata");
    }
    public function testTC_7_3_5(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(9,2,7,"201515201515",48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola docente maggiore di 11");
    }
    public function testTC_7_3_6(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(10,2,7,201515166,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola Insegnamento presente");
    }
    public function testTC_7_3_7(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(30,2,7,201515166,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola Insegnamento disponibile");
    }
    public function testTC_7_3_8(){
        $proposta=$this->ges->proponiInsegnamento(new Associa("a30",2,7,201515166,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola Insegnamento alfanumerica");
    }
    public function testTC_7_3_9(){
        $proposta=$this->ges->proponiInsegnamento(new Associa("-",2,7,201515166,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola Insegnamento non specificata");
    }
    public function testTC_7_3_10(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(302222222223,2,7,201515166,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Matricola Insegnamento maggiore di 11");
    }
    public function testTC_7_3_11(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(9,0,7,201515166,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Classe inserita minore di 1");
    }
    public function testTC_7_3_12(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(9,4,7,201515166,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Classe inserita maggiore di 3");
    }
    public function testTC_7_3_13(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(9,"abc",7,201515166,48,0,"PROPOSTO"));
        $this->assertFalse($proposta,"Classe inserita non numerica");
    }
    public function testTC_7_3_14(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(9,2,7,201515166,"47",0,"PROPOSTO"));
        $this->assertFalse($proposta,"Ore assegnate Teoria non specificate");
    }
    public function testTC_7_3_15(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(9,2,7,201515166,"-",0,"PROPOSTO"));
        $this->assertFalse($proposta,"Ore assegnate Teoria valida");
    }
    public function testTC_7_3_16(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(9,2,7,201515166,"48a",0,"PROPOSTO"));
        $this->assertFalse($proposta,"Ore assegnate Teoria alfanumerica");
    }
    public function testTC_7_3_17(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(9,2,7,201515166,48,3,"PROPOSTO"));
        $this->assertFalse($proposta,"Ore assegnate Lab valida");
    }
    public function testTC_7_3_18(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(9,2,7,201515166,48,"-","PROPOSTO"));
        $this->assertFalse($proposta,"Ore assegnate Lab specificate");
    }
    public function testTC_7_3_19(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(9,2,7,201515166,48,"0a","PROPOSTO"));
        $this->assertFalse($proposta,"Ore assegnata Lab non alfanumerica");
    }
    public function testTC_7_3_20(){
        $proposta=$this->ges->proponiInsegnamento(new Associa(9,2,7,201515166,48,0,"DOMANDA"));
        $this->assertFalse($proposta,"Status DOMANDA valido");
    }

    //Insegnamento proposto dal Presidente
    public function testTC_7_4_1(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(0,$value,"Stato aggiornato in ACCETTATO");
    }
    //Insegnamento proposto dal Presidente
    public function testTC_7_4_2(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,40,0,"RIFIUTATO"));
        $this->assertEquals(0,$value,"Stato aggiornato in RIFIUTATO");
    }
    //Insegnamento proposto dal Docente
    public function testTC_7_4_3(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,40,0,"ASSEGNATO"));
        $this->assertEquals(0,$value,"Stato aggiornato in ASSEGNATO");
    }
    //Insegnamento proposto dal Docente
    public function testTC_7_4_4(){
        $value=$this->ges->liberaAssociazioneInsegnamento(new Associa(9,1,7,201515172,40,0,"IN ATTESA"));
        $this->assertEquals(0,$value,"Stato IN ATTESA");
    }

    public function testTC_7_4_5(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,2,7,201515167,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola docente non associata all'insegnamento");
    }
    public function testTC_7_4_6(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,2,7,"a201515167",40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola docente alfanumerica");
    }
    public function testTC_7_4_7(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,2,7,"",40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola docente non specificata");
    }
    public function testTC_7_4_8(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,2,7,201515167201515167,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola docente maggiore di 11 caratteri");
    }
    public function testTC_7_4_9(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(12,2,7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola insegnamento non presente nella programmazione didattica");
    }
    public function testTC_7_4_10(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(9,1,7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola insegnamento non associata al docente");
    }
    public function testTC_7_4_11(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa("a8",2,7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola insegnamento alfanumerica");
    }
    public function testTC_7_4_12(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa("-",2,7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola insegnamento non specificata");
    }
    public function testTC_7_4_13(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa("1234567892345",2,7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Matricola insegnamento maggiore di 11 caratteri");
    }
    public function testTC_7_4_14(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,0,7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Classe uguale a 0");
    }

    public function testTC_7_4_15(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,4,7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Classe uguale a 4");
    }
    public function testTC_7_4_16(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,"-",7,201515172,40,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Classe non specificata");
    }
    public function testTC_7_4_17(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,40,0,"CONVALIDATO"));
        $this->assertEquals(-1,$value,"Stato CONVALIDATO");
    }
    public function testTC_7_4_18(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,42,0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Ore teoria valide");
    }
    public function testTC_7_4_19(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,"-",0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Ore teoria specficate");
    }
    public function testTC_7_4_20(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,"40a",0,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Ore teoria non alfanumerica");
    }
    public function testTC_7_4_21(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,40,2,"ACCETTATO"));
        $this->assertEquals(-1,$value,"Ore Lab valide");
    }
    public function testTC_7_4_22(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,40,"-","ACCETTATO"));
        $this->assertEquals(-1,$value,"Ore Lab specficate");
    }
    public function testTC_7_4_23(){
        $value=$this->ges->cambiaStatoAssociazione(new Associa(8,2,7,201515172,40,"0a","ACCETTATO"));
        $this->assertEquals(-1,$value,"Ore Lab non alfanumerica");
    }

    /*public function test7_4_24(){
        //$value=$this->ges->inviaEmail(201515165,201515172,"fferrucci@unisa.it","rzizza@unisa.it","Annullamento proposta Insegnamento","L’insegnamento da lei proposto è stato rifiutato");
        //$this->assertEquals(0,$value,"Email non inoltrata");
    }*/

    public function testTC_7_4_25(){
        $value=$this->ges->inviaEmail(201515165,201515172,"","rzizza@unisa.it","Annullamento proposta Insegnamento","L’insegnamento da lei proposto è stato rifiutato");
        $this->assertEquals(-1,$value,"Email inoltrata");
    }
    public function testTC_7_4_26(){
        $value=$this->ges->inviaEmail(201515165,201515172,"pres@unisa.it","rzizza@unisa.it","Annullamento proposta Insegnamento","L’insegnamento da lei proposto è stato rifiutato");
        $this->assertEquals(-1,$value,"Email inoltrata");
    }
    public function testTC_7_4_27(){
        $value=$this->ges->inviaEmail(201515165,201515172,"fferrucci@unisa.it","","Annullamento proposta Insegnamento","L’insegnamento da lei proposto è stato rifiutato");
        $this->assertEquals(-1,$value,"Email inoltrata");
    }
    public function testTC_7_4_28(){
        $value=$this->ges->inviaEmail(201515165,201515172,"fferrucci@unisa.it","rziz@unisa.it","Annullamento proposta Insegnamento","L’insegnamento da lei proposto è stato rifiutato");
        $this->assertEquals(-1,$value,"Email inoltrata");
    }
    public function testTC_7_4_29(){
        $value=$this->ges->inviaEmail(201515165,201515172,"fferrucci@unisa.it","rzizza@unisa.it","","L’insegnamento da lei proposto è stato rifiutato");
        $this->assertEquals(-1,$value,"Email inoltrata");
    }
    public function testTC_7_4_30(){
        $value=$this->ges->inviaEmail(201515165,201515172,"fferrucci@unisa.it","rzizza@unisa.it","rifiuto","L’insegnamento da lei proposto è stato rifiutato");
        $this->assertEquals(-1,$value,"Email inoltrata");
    }
    public function testTC_7_4_31(){
        $value=$this->ges->inviaEmail(201515165,201515172,"fferrucci@unisa.it","rzizza@unisa.it","Annullamento proposta Insegnamento","Ins. rifiutato");
        $this->assertEquals(-1,$value,"Email inoltrata");
    }
    public function testTC_7_6_1()
    {
        $value=$this->ges->getInfoDocentiInsegnamento("30a",2,7);
        $this->assertFalse($value,"Matricola insegnamento alfanumerica");
    }
    public function testTC_7_6_2()
    {
        $value=$this->ges->getInfoDocentiInsegnamento(13,2,7);
        $this->assertFalse($value,"Matricola insegnamento presente");
    }
    public function testTC_7_6_3()
    {
        $value=$this->ges->getInfoDocentiInsegnamento("-",2,7);
        $this->assertFalse($value,"Matricola insegnamento specificata");
    }
    public function testTC_7_6_4()
    {
        $value=$this->ges->getInfoDocentiInsegnamento(30303030303030,2,7);
        $this->assertFalse($value,"Matricola insegnamento maggiore di 11 caratteri");
    }
    public function testTC_7_6_5()
    {
        $value=$this->ges->getInfoDocentiInsegnamento(30,3,7);
        $this->assertFalse($value,"Classe non associata all'insegnamento");
    }
    public function testTC_7_6_7()
    {
        $value=$this->ges->getInfoDocentiInsegnamento(30,0,7);
        $this->assertFalse($value,"Classe minore di 1");
    }
    public function testTC_7_6_8()
    {
        $value=$this->ges->getInfoDocentiInsegnamento(30,4,7);
        $this->assertFalse($value,"Classe maggiore di 3");
    }
    public function testTC_7_6_9()
    {
        $value=$this->ges->getInfoDocentiInsegnamento(30,"a2",7);
        $this->assertFalse($value,"Classe con valore alfanumerico");
    }
    public function testTC_7_6_10()
    {
        $value=$this->ges->getInfoDocentiInsegnamento(30,2,7);
        $this->assertNotEmpty($value,"Info insegnamenti");
    }

    public function testGetCaricoDidattico(){

        $caricoDidattico=$this->ges->getCaricoDidattico(201515172);
        $this->assertNotEquals(0,strlen($caricoDidattico),"Carico didattico non disponibile");
    }

    public function testGetRuoloDocente(){

        $ruolo=$this->ges->getRuoloDocente("201515166");
        $this->assertNotEmpty($ruolo,"Nessun ruolo");
    }

    public function testGetMonteOre(){

        $monteOre=$this->ges->getMonteOre("201515166");
        $this->assertNotEquals("",$monteOre);

    }

    public function testVisualizzaDocentiProgrammazioneDidattica(){

        $docenti=$this->ges->getDocentiPrD();
        $this->assertNotEmpty($docenti,"Lista docenti vuota");
    }

    public function testInsegnamentiAssociatiUI(){
        $insegnamentiAssociati=$this->ges->getInsegnamentiAssociatiAlDocente(201515172);
        $result=$this->ges->insegnamentiAssociati($insegnamentiAssociati,201515172);
        $this->assertNotEquals(0,strlen($result));
    }

        public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass(); // TODO: Change the autogenerated stub
        $db=new Database();
        $db->connettiDB();
        $db->eseguiQuery("update myprd_testing.Associa set Matricola_Professore=201515200, status='IN ATTESA' where Matricola_Insegnamento=9 AND classe=2 AND ID_ProgDid=7 AND Matricola_Professore=201515166 AND Ore_Teoria=48 AND Ore_Lab=0");
        $db->eseguiQuery("update myprd_testing.Associa set Matricola_Professore=201515172, status='RIFIUTATO' where Matricola_Insegnamento=9 AND classe=1 AND ID_ProgDid=7 AND Matricola_Professore=201515200 AND Ore_Teoria=40 AND Ore_Lab=0");
        $db->chiudiDB();
        syslog(LOG_INFO,"UnitTesting FINISH");
    }
}
