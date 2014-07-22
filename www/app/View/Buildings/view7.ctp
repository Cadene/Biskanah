
<?php $this->extend('display');

$this->start('specialize');?>

<div class="camp info">

    <div class="divtop curvedtot">
        Technologies recherchés dans votre laboratoire
    </div>

    <?php //debug($allowedTechnos); debug($dttechnos); ?>

    <div class="space0">

        <?php foreach ($data['UnitsCamps'] as $in):
            $tech = current($tech);
            $type = $tech['dataunit_id'];
            $datat = current($data['Dataunits'][$type]);
            ?>
            <div class="space1 curvedtot">
                <div class="space">
                    <div><a href="<?= $this->Html->url('/technos/display/'.$datat['id']);?>">
                            <?=$datat['name'];?> </a> (Niveau <?=$tech['lvl'];?>)
                        </a>
                    </div>
                    <div>
                        Coût par unité : <?=($tech['lvl']+1);?> : <?=floor($datat['res1']);?> Métal <?=floor($datat['res2']);?> Cristal <?=floor($datat['res3']);?> Uranium
                    </div>
                    <div>
                        Durée de construction : <?=gmdate("H:i:s", round($datat['time']));?>
                    </div>
                </div>
            </div>
        <?php endforeach;?>

        <br>

        <div class="space1 curvedtot">
            <div class="space"><?= $this->Html->link('Entrainer de nouvelles unités', '/units/trainable/7');?></div>
        </div>
    </div>

    <?php if (!empty($data['Dtunits'])): ?>

        <br>
        <div class="divtop curvedtot">Technologie en cours de recherche</div>
        <div class="space0">
            <?php for ($i=0; $i < count($data['Dtunits']); $i++):
                $dtt = current($data['Dtunits'][$i]);
                $type = $dtt['dataunit_id'];
                $datat = current($data['Dataunits'][$type]);
                $timeLeft = $dtt['finish'] - time();
                $datetime = gmdate("H:i:s", $timeLeft);
                ?>
                <div class="space1 curvedtot">
                    <div class="space">
                        <?php if ($timeLeft <= 0):?>
                            <?= $datat['name'].' est fini.';?>
                        <?php else:?>
                            <?= $datat['name'].' finira dans '.$datetime; ?>
                        <?php endif;?>
                    </div>
                </div>
            <?php endfor;?>
        </div>

    <?php endif;?>

</div>

<?php $this->end('specialize');



