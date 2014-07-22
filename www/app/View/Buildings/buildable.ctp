
<div class="divtop curvedtot">
    Bâtiments pouvant être construit
</div>

<div class="space0">

    <?php if (empty($allowedTypes)):?>
        <div class="space1 curvedtot">
            <div class="space">Vous ne pouvez construire aucun bâtiment. Améliorez vos précédents.</div>
        </div>
    <?php else:?>

        <?php foreach ($allowedTypes as $type):
            $datab = current($databuildings[$type]);
            ?>
            <div class="space1 curvedtot">
                <div class="space">
                    <div class="buildings_1b">
                        <div class="buildings_1b1">
                            <a href="/buildings/display/<?=$datab['id'];?>"><?=$datab['name'];?></a>
                        </div>
                        <div class="space">
                            <div><?=$datab['desc1'];?></div>
                            <div><?=$datab['desc2'];?></div>
                        </div>
                        <div class="buildings_1b1">
                            Coût pour le niveau 1 : <?=ceil($datab['res1']);?> Métal <?=ceil($datab['res2']);?> Cristal <?=ceil($datab['res3']);?> Uranium
                        </div>
                        <div class="space">
                            <?= $this->Html->link('Construire', array(
                                'controller' => 'buildings',
                                'action' => 'create',
                                $type)
                            );?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    <?php endif;?>
</div>



<?php if (!empty($refusedTypes)):?>

<div class="divtop curvedtot">
    Prérequis manquants
</div>

<div class="space0">

<?php foreach ($refusedTypes as $type):?>
    <?php $datab = current($databuildings[$type]);?>

    <div class="space1 curvedtot">
        <div class="space">
            <div>- <a href="/buildings/display/<?=$datab['id'];?>"><?=$datab['name'];?></a> -</div>
            <br/>

            <?php foreach ($datanodesTypes[$type] as $need_type => $need_lvl):?>
                <?php $datab = current($databuildings[$need_type]);?>

                <span>[ <a href="/buildings/display/<?=$datab['id'];?>">
                    <?=$datab['name'];?>
                </a>
                <?=' lvl '.$need_lvl.' ';?>
                ] </span>
            <?php endforeach;?>

        </div>
    </div>
<?php endforeach;?>

</div>

<?php endif;?>