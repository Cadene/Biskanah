<div class="camp info">

    <div class="divtop curvedtot">Bâtiments construits sur votre camp</div>

    <div class="space0">

        <?php foreach ($data['Buildings'] as $building):
            $building = current($building);
            $type = $building['databuilding_id'];
            $datab = $data['Databuildings']->get($type);
            ?>
            <div class="space1 curvedtot">
                <div class="space">
                    <div><a href="<?= $this->Html->url('/buildings/display/'.$datab->get('id'));?>">
                        <?=$datab->get('name');?> </a> (Niveau <?=$building['lvl'];?>)
                        </a>
                    </div>
                    <div>
                        Coût pour le niveau <?=($building['lvl']+1);?> : <?=floor($datab->get('res1'));?> Métal <?=floor($datab->get('res2'));?> Cristal <?=floor($datab->get('res3'));?> Uranium
                    </div>
                    <div>
                        Durée de construction : <?=gmdate("H:i:s", round($datab->get('time')));?>
                    </div>
                    <div><?= $this->Html->link('Upgrade','/buildings/create/'.$type);?></div>
                </div>
            </div>
        <?php endforeach;?>

    </div>

    <div class="divtop curvedtot">Bâtiments à construire</div>

    <div class="space0">

        <?php foreach ($data['Buildables'] as $typeb => $allowed):
            $datab = $data['Databuildings']->get($typeb);
            ?>
            <div class="space1 curvedtot">
                <div class="space">
                    <div><a href="<?= $this->Html->url('/buildings/display/'.$datab->get('id'));?>">
                            <?=$datab->get('name');?> </a>
                        </a>
                    </div>
                    <div>
                        Coût pour la construction : <?=floor($datab->get('res1'));?> Métal <?=floor($datab->get('res2'));?> Cristal <?=floor($datab->get('res3'));?> Uranium
                    </div>
                    <div>
                        Durée de construction : <?=gmdate("H:i:s", round($datab->getTime(1,$data['Buildings'],$data['Technos'])));?>
                    </div>
                    <div><?= $this->Html->link('Construire','/buildings/create/'.$datab->get('id'));?></div>
                </div>
            </div>
        <?php endforeach;?>

        <br>

        <div class="space1 curvedtot">
            <div class="space"><?= $this->Html->link('Prérequis pour futurs bâtiments', '/buildings/buildable');?></div>
        </div>

    </div>



    <?php if (!empty($data['Dtbuildings'])): ?>

        <br>

        <div class="divtop curvedtot">Bâtiments en cours de construction</div>

        <div class="space0">
            <?php for ($i=count($data['Dtbuildings'])-1; $i >= 0; $i--):
                $dtbuilding = current($data['Dtbuildings'][$i]);
                $type = $dtbuilding['databuilding_id'];
                $datab = $data['Databuildings']->get($type);
                $timeLeft = $dtbuilding['finish'] - time();
                $datetime = gmdate("H:i:s", $timeLeft);
                ?>
                <div class="space1 curvedtot">
                    <div time="<?=$timeLeft;?>" class="space">
                        <?= $datab->get('name').' de niveau '.$dtbuilding['lvl'];?>
                        <?php if ($timeLeft <= 0):?>
                            <?= ' terminé.';?>
                        <?php else:?>
                            <?= ' finira dans '.$datetime; ?>
                        <?php endif;?>
                    </div>
                </div>
            <?php endfor;?>
        </div>

    <?php endif;?>

</div>






