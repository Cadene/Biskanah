
<?php $this->extend('display');

$this->start('specialize');?>

<div class="camp info">

    <div class="divtop curvedtot">
        Technologies recherchés dans votre laboratoire
    </div>

    <?php //debug($allowedTechnos); debug($dttechnos); ?>

    <div class="space0">

        <?php foreach ($data['Technos'] as $tech):
            $tech = current($tech);
            $type = $tech['datatechno_id'];
            $datat = current($data['Datatechnos'][$type]);
            ?>
            <div class="space1 curvedtot">
                <div class="space">
                    <div><a href="<?= $this->Html->url('/technos/display/'.$datat['id']);?>">
                            <?=$datat['name'];?> </a> (Niveau <?=$tech['lvl'];?>)
                        </a>
                    </div>
                    <div>
                        Coût pour le niveau <?=($tech['lvl']+1);?> : <?=floor($datat['res1']);?> Métal <?=floor($datat['res2']);?> Cristal <?=floor($datat['res3']);?> Uranium
                    </div>
                    <div>
                        Durée de construction : <?=gmdate("H:i:s", round($datat['time']));?>
                    </div>
                    <div><?= $this->Html->link('Upgrade','/technos/create/'.$type);?></div>
                </div>
            </div>
        <?php endforeach;?>

        <br>

        <div class="space1 curvedtot">
            <div class="space"><?= $this->Html->link('Rechercher une nouvelle technologie', '/technos/searchable/12');?></div>
        </div>
    </div>

    <?php if (!empty($data['Dttechnos'])): ?>

        <br>
        <div class="divtop curvedtot">Technologie en cours de recherche</div>
        <div class="space0">
            <?php for ($i=0; $i < count($data['Dttechnos']); $i++):
                $dtt = current($data['Dttechnos'][$i]);
                $type = $dtt['datatechno_id'];
                $datat = current($data['Datatechnos'][$type]);
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



