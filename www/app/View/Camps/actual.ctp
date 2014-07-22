<div class="camp info">

    <div class="divtop curvedtot">
        Bâtiments construit sur votre camp
    </div>

    <div class="space0">

        <?php foreach ($data['Buildings'] as $building):
            $building = current($building);
            $type = $building['databuilding_id'];
            $databuilding = current($data['Databuildings'][$type]);
        ?>
        <div class="space1 curvedtot">
            <div class="space">
                <div class="buildings_1b">
                    <div class="buildings_1b1">
                        <a href="infos.php?gid=1&amp;token=c0fd0f9969c2e147f11d807d4037d85b"
                           class="buildings_a"
                           title="Cliquer sur ce lien pour avoir de plus amples informations">
                           <?=$databuilding['name'];?> </a> (Niveau <?=$building['lvl'];?>)
                        </a>
                    </div>
                    <div class="buildings_1b1">
                        Coût pour le niveau <?=($building['lvl']+1);?> : <?=floor($databuilding['res1']);?> Métal <?=floor($databuilding['res2']);?> Cristal <?=floor($databuilding['res3']);?> Uranium
                    </div>
                    <div class="buildings_1b1">
                        Durée de construction : <?=gmdate("H:i:s", round($databuilding['time']));?>
                    </div>
                    <div><?= $this->Html->link('Upgrade','/buildings/upgrade/'.$type);?></div>
                </div>
            </div>
        </div>
        <?php endforeach;?>

        <br>

        <div class="space1 curvedtot">
            <div class="space"><?= $this->Html->link('Construire bâtiment', '/buildings/create');?></div>
        </div>
    </div>

    <?php if (!empty($data['Dtbuildings'])): ?>

    <br>

    <div class="divtop curvedtot">
        Bâtiments en cours de construction
    </div>

    <div class="space0">
        <?php for ($i=count($data['Dtbuildings'])-1; $i >= 0; $i--):
            $dtbuilding = current($data['Dtbuildings'][$i]);
            $type = $dtbuilding['databuilding_id'];
            $databuilding = current($data['Databuildings'][$type]);
            $timeLeft = $dtbuilding['finish'] - time();
            $datetime = gmdate("H:i:s", $timeLeft);
            ?>
        <div class="space1 curvedtot">
            <div class="space">
                <?php if ($timeLeft <= 0):?>
                <?= $databuilding['name'].' est fini.';?>
                <?php else:?>
                <?= $databuilding['name'].' finira dans '.$datetime; ?>
                <?php endif;?>
            </div>
        </div>
        <?php endfor;?>
    </div>

    <?php endif;?>

</div>






