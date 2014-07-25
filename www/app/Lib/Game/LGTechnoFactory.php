<?php

class LGTechnoFactory {

    public static function make($type)
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

            return new LGTechno(
                $type, $databuilding_id, $name[$type], $desc1[$type], $desc2[$type],
                $res1[$type], $res2[$type], $res3[$type]
            );
        }

        $databuilding_id = 11;

        return new LGTechno(
            $type, $databuilding_id, $name[$type], $desc1[$type], $desc2[$type],
            $res1[$type], $res2[$type], $res3[$type]
        );
    }

    public static function makeAll()
    {
        // Laboratoire
        for ($id=1; $id <= 11; $id++)
        {
            $technos[$id] = self::make($id);
        }
        // Armurerie
        for ($id=12; $id <= 3*9+12-1; $id++)
        {
            $technos[$id] = self::make($id);
        }
        return new LGTechnos($technos);
    }
}