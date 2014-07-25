<?php

class LGRequisitFactory {

    public static function makeAll($buildings, $technos, $units)
    {
        $b = $buildings;
        $t = $technos;
        $u = $units;

        $requisitsArray = array(
            'b' => array(
                1 => array(
                    'b' => array(16 => 1)
                ),
                2 => array(
                    'b' => array(1 => 1)
                ),
                3 => array(
                    'b' => array(1 => 3, 2 => 2)
                ),
                4 => array(
                    'b' => array(10 => 2)
                ),
                5 => array(
                    'b' => array(10 => 2)
                ),
                6 => array(
                    'b' => array(10 => 2)
                ),
                7 => array(
                    'b' => array(10 => 3)
                ),
                8 => array(
                    'b' => array(10 => 5)
                ),
                9 => array(
                    'b' => array(10 => 7)
                ),
                10 => array(
                    'b' => array(16 => 1)
                ),
                11 => array(
                    'b' => array(10 => 3)
                ),
                12 => array(
                    'b' => array(10 => 5)
                ),
                13 => array(
                    'b' => array(10 => 6)
                ),
                14 => array(
                    'b' => array(10 => 3)
                ),
                15 => array(
                    'b' => array(10 => 1)
                ),
                17 => array(
                    'b' => array(10 => 2)
                ),
                18 => array(
                    'b' => array(10 => 5)
                ),
                19 => array(
                    'b' => array(10 => 7)
                )
            )
        );

        $requisits = array();

        foreach ($requisitsArray as $to_kind => $requisit)
        {
            foreach ($requisit as $to_type => $n33ds)
            {
                foreach ($n33ds as $from_kind => $nodes)
                {
                    foreach ($nodes as $from_type => $from_lvl)
                    {
                        $needs = array();
                        $needs[] = new Node(
                            $from_kind->get($from_type),
                            $from_lvl
                        );
                    }

                    $requisits[] = new Requisit(
                        new Node(
                            $to_kind->get($to_type),
                            1
                        ),
                        $needs
                    );
                }
            }
        }

        return new LGRequisits($requisits);
    }




}