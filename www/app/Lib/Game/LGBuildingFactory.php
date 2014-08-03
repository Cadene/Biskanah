<?php

App::uses('LGBuilding','Lib/Game');
App::uses('LGBuildings','Lib/Game');

class LGBuildingFactory {

    public static function make($type)
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

        return new LGBuilding(
            $type, $name[$type], $desc1[$type], $desc2[$type],
            $res1[$type], $res2[$type], $res3[$type], $stru[$type]
        );

    }

    public static function makeAll()
    {
        for ($id=1; $id <= 19; $id++)
        {
            $buildings[$id] = self::make($id);
        }
        return new LGBuildings($buildings);
    }


}