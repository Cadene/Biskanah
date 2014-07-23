<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tamazy
 * Date: 04/07/2014
 * Time: 05:34
 * To change this template use File | Settings | File Templates.
 */

class Factory {

    public static function makeUnit($type)
    {
        $id = $type;
        $name[$id] = 'Robot'.$type;
        $desc[$id] = 'Unité d\'élite ne payant pas de mine.';
        $res1[$id] = 60;
        $res2[$id] = 15;
        $res3[$id] = 0;
        $kind[$id] = 10;
        $att1[$id] = 10;
        $att2[$id] = 10;
        $att3[$id] = 10;
        $attb[$id] = 10;
        $armor[$id] = 10;
        $spy[$id] = 10;
        $speed[$id] = 1;
        $conso[$id] = 1;
        $capacity[$id] = 1000;
        $databuilding_id[$id] = 7;

        return new Unit($id, $name[$type], $desc[$type],
            $res1[$type], $res2[$type], $res3[$type],
            $kind[$type], $att1[$type], $att2[$type], $att3[$type], $attb[$type],
            $armor[$type], $spy[$type], $speed[$type], $conso[$type], $capacity[$type],
            $databuilding_id[$id]
        );
    }

    public static function makeUnits()
    {
        for ($id=1; $id <= 15; $id++)
        {
            $units[$id] = self::makeUnit($id);

            if ($id > 10)
            {
                $units[$id]->set('kind',3);
                $units[$id]->set('databuilding_id',9);
            }
            else if ($id > 5)
            {
                $units[$id]->set('kind',2);
                $units[$id]->set('databuilding_id',8);
            }
        }
        return new Units($units);
    }

    public static function makeBuilding($type)
    {
        $id = 1;
        $name[$id] = 'Extracteur de métal';
        $desc1[$id] = 'Produit constamment des ressources primaires pour votre base.';
        $desc2[$id] = 'Plus le niveau augmente, plus la production augmente.';
        $res1[$id] = 60;
        $res2[$id] = 15;
        $res3[$id] = 0;
        $stru[$id] = 10;

        $id = 2;
        $name[$id] = 'Extracteur de silicium';
        $desc1[$id] = 'Produit constamment des ressources secondaires pour votre base.';
        $desc2[$id] = $desc2[1];
        $res1[$id] = 48;
        $res2[$id] = 24;
        $res3[$id] = 0;
        $stru[$id] = 10;

        $id = 3;
        $name[$id] = 'Extracteur d\'uranium';
        $desc1[$id] = 'Produit constamment des ressources tertiaires pour votre base.';
        $desc2[$id] = $desc2[1];
        $res1[$id] = 225;
        $res2[$id] = 75;
        $res3[$id] = 0;
        $stru[$id] = 10;

        $id = 4;
        $name[$id] = 'Hangar de métal';
        $desc1[$id] = 'Augmente la quantité de ressources primaires que votre base peut stocker.';
        $desc2[$id] = 'Plus le niveau augmente, plus la quanitié augmente.';
        $res1[$id] = 40;
        $res2[$id] = 10;
        $res3[$id] = 0;
        $stru[$id] = 10;

        $id = 5;
        $name[$id] = 'Hangar de silicium';
        $desc1[$id] = 'Augmente la quantité de ressources secondaires que votre base peut stocker.';
        $desc2[$id] = $desc2[4];
        $res1[$id] = 10;
        $res2[$id] = 40;
        $res3[$id] = 0;
        $stru[$id] = 10;

        $id = 6;
        $name[$id] = 'Hangar d\'uranium';
        $desc1[$id] = 'Augmente la quantité de ressources tertiaires que votre base peut stocker.';
        $desc2[$id] = $desc2[4];
        $res1[$id] = 10;
        $res2[$id] = 10;
        $res3[$id] = 40;
        $stru[$id] = 10;

        $id = 7;
        $name[$id] = 'Usine de soldats machines';
        $desc1[$id] = 'Produit des unités non véhiculées qui pourront être envoyer sur d\'autres cases de la planète.';
        $desc2[$id] = 'Plus le niveau augmente, plus la production augmente, et plus vous aurez accès à de nouveaux soldats.';
        $res1[$id] = '60';
        $res2[$id] = '15';
        $res3[$id] = '0';
        $stru[$id] = 10;

        $id = 8;
        $name[$id] = 'Usine de véhicules terrestres';
        $desc1[$id] = 'Produit des unités véhiculées terrestres qui pourront être envoyer sur d\'autres cases de la planète.';
        $desc2[$id] = $desc2[7];
        $res1[$id] = '60';
        $res2[$id] = '15';
        $res3[$id] = '0';
        $stru[$id] = 10;

        $id = 9;
        $name[$id] = 'Usine de véhicules aériens';
        $desc1[$id] = 'Produit des unités véhiculées aériennes qui pourront être envoyer sur d\'autres cases de la planète.';
        $desc2[$id] = $desc2[7];
        $res1[$id] = '60';
        $res2[$id] = '15';
        $res3[$id] = '0';
        $stru[$id] = 10;

        $id = 10;
        $name[$id] = 'Quartier général';
        $desc1[$id] = 'Renforce les capacités défensives de votre ville en cas de capture par un adversaire.';
        $desc2[$id] = 'Plus le niveau augmente, plus la capacité augmente.';
        $res1[$id] = '60';
        $res2[$id] = '15';
        $res3[$id] = '0';
        $stru[$id] = 10;

        $id = 11;
        $name[$id] = 'Laboratoire de recherches';
        $desc1[$id] = 'Permet de dévélopper des technologies servant à améliorer toutes vos bases.';
        $desc2[$id] = 'Plus le niveau augmente, plus la vitesse de développement augmente.';
        $res1[$id] = '60';
        $res2[$id] = '15';
        $res3[$id] = '0';
        $stru[$id] = 10;

        $id = 12;
        $name[$id] = 'Laboratoire d\'armements';
        $desc1[$id] = 'Permet de développer des technologies servant à améliorer vos unités de toutes vos bases.';
        $desc2[$id] = 'Plus le niveau augmente, plus la vitesse de développement augmente.';
        $res1[$id] = '60';
        $res2[$id] = '15';
        $res3[$id] = '0';
        $stru[$id] = 10;

        $id = 13;
        $name[$id] = 'Téléporteur énergitique';
        $desc1[$id] = 'Permet de téléporter un pourcentage de la production actuelle de ressources de votre camp vers un de vos camps à portés.';
        $desc2[$id] = 'Plus le niveau augmente, plus le pourcentage augmente.';
        $res1[$id] = '60';
        $res2[$id] = '15';
        $res3[$id] = '0';
        $stru[$id] = 10;

        $id = 14;
        $name[$id] = 'Dématerialisateur';
        $desc1[$id] = 'Permet une fois par heure de téléporter instantanément un groupe d\'unités de votre camp vers un de vos camps à portés.';
        $desc2[$id] = 'Plus le niveau augmente, plus le groupe augmente.';
        $res1[$id] = '60';
        $res2[$id] = '15';
        $res3[$id] = '0';
        $stru[$id] = 10;

        $id = 15;
        $name[$id] = 'Relais marchand';
        $desc1[$id] = 'Permet instantanément de vendre et d\'acheter un type de ressources contre un autre avec des inconnus aux taux du marché.';
        $desc2[$id] = 'Plus le niveau augmente, plus le nombre de ressources échangeables augmente.';
        $res1[$id] = '60';
        $res2[$id] = '15';
        $res3[$id] = '0';
        $stru[$id] = 10;

        $id = 16;
        $name[$id] = 'Terraformeur';
        $desc1[$id] = 'Augmente le nombre de bâtiments que votre base peut contenir.';
        $desc2[$id] = 'Vous gagnez 10 cases par niveau, et chaque construction ou amélioration de bâtiment vous prend une case.';
        $res1[$id] = '60';
        $res2[$id] = '15';
        $res3[$id] = '0';
        $stru[$id] = 10;

        $id = 17;
        $name[$id] = 'Bunker';
        $desc1[$id] = 'Augmente le nombre de ressources conservables en cas de pillages ennemis.';
        $desc2[$id] = 'Plus le niveau augmente, plus le nombre augmente.';
        $res1[$id] = '60';
        $res2[$id] = '15';
        $res3[$id] = '0';
        $stru[$id] = 10;

        $id = 18;
        $name[$id] = 'Bouclier d\'energie';
        $desc1[$id] = 'Augmente la capacité défensive des unités actuellement sur votre base en cas d\'attaques de vos ennemis.';
        $desc2[$id] = 'Plus le niveau augmente, plus la capacité augmente.';
        $res1[$id] = '60';
        $res2[$id] = '15';
        $res3[$id] = '0';
        $stru[$id] = 10;

        $id = 19;
        $name[$id] = 'Bouclier structurel';
        $desc1[$id] = 'Augmente la capacité des bâtiments actuellement sur votre base en cas d\'assauts de vos ennemis';
        $desc2[$id] = 'Plus le niveau augmente, plus la capacité augmente.';
        $res1[$id] = '60';
        $res2[$id] = '15';
        $res3[$id] = '0';
        $stru[$id] = 10;

        return new Building(
            $type, $name[$type], $desc1[$type], $desc2[$type],
            $res1[$type], $res2[$type], $res3[$type], $stru[$type]
        );

    }

    public static function makeBuildings()
    {
        for ($id=1; $id <= 19; $id++)
        {
            $buildings[$id] = self::makeBuilding($id);
        }
        return new Buildings($buildings);
    }


    public static function makeTechno($type)
    {
        $id = 1;
        $name[$id] = 'Alliance';
        $desc1[$id] = 'Augmente le nombre de joueurs avec qui vous pouvez vous allier.';
        $desc2[$id] = 'Plus le niveau augmente, plus le nombre augmente.';
        $res1[$id] = 60;
        $res2[$id] = 15;
        $res3[$id] = 0;

        $id = 2;
        $name[$id] = 'Forage profond';
        $desc1[$id] = 'Augmente le nombre de puits de ressources que vous pouvez posséder.';
        $desc2[$id] = 'Plus le niveau augmente, plus le nombre augmente.';
        $res1[$id] = 60;
        $res2[$id] = 15;
        $res3[$id] = 0;

        $id = 3;
        $name[$id] = 'Aménagement du territoire';
        $desc1[$id] = 'Augmente le nombre de bases que vous pouvez posséder.';
        $desc2[$id] = 'Plus le niveau augmente, plus le nombre augmente.';
        $res1[$id] = 60;
        $res2[$id] = 15;
        $res3[$id] = 0;

        $id = 4;
        $name[$id] = 'Teleportation énergitique';
        $desc1[$id] = 'Augmente la portée de tous vos téléporteurs énergitiques.';
        $desc2[$id] = 'Plus le niveau augmente, plus la portée augmente.';
        $res1[$id] = 60;
        $res2[$id] = 15;
        $res3[$id] = 0;

        $id = 5;
        $name[$id] = 'Dématerialisation';
        $desc1[$id] = 'Augmente la portée de tous vos dématerialisateurs.';
        $desc2[$id] = 'Plus le niveau augmente, plus la portée augmente.';
        $res1[$id] = 60;
        $res2[$id] = 15;
        $res3[$id] = 0;

        $id = 6;
        $name[$id] = 'Espionnage tactique';
        $desc1[$id] = 'Augmente la capacité d\'espionnage et de contre-espionnage de vos unités et de vos bases.';
        $desc2[$id] = 'Plus le niveau augmente, plus la capacité augmente.';
        $res1[$id] = 60;
        $res2[$id] = 15;
        $res3[$id] = 0;

        $id = 7;
        $name[$id] = 'Réseau de transmetteurs';
        $desc1[$id] = 'Augmente le nombre de groupes d\'unités que vous pouvez commander.';
        $desc2[$id] = 'Plus le niveau augmente, plus le nombre augmente.';
        $res1[$id] = 60;
        $res2[$id] = 15;
        $res3[$id] = 0;

        $id = 8;
        $name[$id] = 'Réseau intranet';
        $desc1[$id] = 'Augmente la vitesse de recherche des technologies dans tous vos laboratoires.';
        $desc2[$id] = 'Plus le niveau augmente, plus la vitesse augmente.';
        $res1[$id] = 60;
        $res2[$id] = 15;
        $res3[$id] = 0;

        $id = 9;
        $name[$id] = 'Rendements d\'échelle';
        $desc1[$id] = 'Augmente la vitesse de construction de vos unités et bâtiments.';
        $desc2[$id] = 'Plus le niveau augmente, plus la vitesse augmente.';
        $res1[$id] = 60;
        $res2[$id] = 15;
        $res3[$id] = 0;

        $id = 10;
        $name[$id] = 'Transmissions';
        $desc1[$id] = 'Augmente la capacité d\'échange totale de vos relais marchand.';
        $desc2[$id] = 'Plus le niveau augmente, plus la capacité augmente.';
        $res1[$id] = 60;
        $res2[$id] = 15;
        $res3[$id] = 0;
        
        $id = 11;
        $name[$id] = 'Attaque groupée';
        $desc1[$id] = 'Produit constamment des ressources primaires pour votre base.';
        $desc2[$id] = 'Plus le niveau augmente, plus la production augmente.';
        $res1[$id] = 60;
        $res2[$id] = 15;
        $res3[$id] = 0;

        if ($type > 11)
        {
            $id = $type;
            $name[$id] = 'Armerie';
            $desc1[$id] = 'Augmente les capacités de vos unités.';
            $desc2[$id] = 'Plus le niveau augmente, plus la production augmente.';
            $res1[$id] = 60;
            $res2[$id] = 15;
            $res3[$id] = 0;

            $databuilding_id = 12;

            return new Techno(
                $type, $databuilding_id, $name[$type], $desc1[$type], $desc2[$type],
                $res1[$type], $res2[$type], $res3[$type]
            );
        }

        $databuilding_id = 11;

        return new Techno(
            $type, $databuilding_id, $name[$type], $desc1[$type], $desc2[$type],
            $res1[$type], $res2[$type], $res3[$type]
        );
    }

    public static function makeTechnos()
    {
        // Laboratoire
        for ($id=1; $id <= 11; $id++)
        {
            $technos[$id] = self::makeTechno($id);
        }
        // Armurerie
        for ($id=12; $id <= 3*9+12-1; $id++)
        {
            $technos[$id] = self::makeTechno($id);
        }
        return new Technos($technos);
    }

    public static function makeWorld()
    {
        return new World(100);
    }

    public static function makeBiskanah()
    {
        $buildings = self::makeBuildings();
        $technos = self::makeTechnos();
        $units = self::makeUnits();
        $world = self::makeWorld();
        $datanodes = self::makeDatanodes();

        return new Biskanah($world,$buildings,$technos,$units,$datanodes);
    }

    public static function makeDatanodes()
    {
        $datanodes = array(
            '1' => array(
                '1' => array('16'=>'1'),
                '2' => array('1'=>'1'),
                '3' => array('1'=>'3','2'=>'2'),
                '4' => array('10'=>'2'),
                '5' => array('10'=>'2'),
                '6' => array('10'=>'2'),
                '7' => array('10'=>'3'),
                '8' => array('10'=>'5'),
                '9' => array('10'=>'7'),
                '10' => array('16'=>'1'),
                '11' => array('10'=>'3'),
                '12' => array('10'=>'5'),
                '13' => array('10'=>'6'),
                '14' => array('10'=>'3'),
                '15' => array('10'=>'1'),
                '17' => array('10'=>'2'),
                '18' => array('10'=>'5'),
                '19' => array('10'=>'7'),
            )
        );

        return new Datanodes($datanodes);
    }
}