
<div class="divtop curvedtot">
    Unités pouvant être entrainées
</div>

<div class="space0">

    <?php if (empty($allowedTypes)):?>
        <div class="space1 curvedtot">
            <div class="space">Vous ne pouvez entrainer aucune unités. Il vous faut d'abord réspecter les prérequis.</div>
        </div>
    <?php else:?>

        <?php foreach ($allowedTypes as $type):
            $datab = current($dataunits[$type]);
            ?>
        <form action="/units/create/<?=$datab['id'];?>" method="post">
            <div class="space1 curvedtot">
                <div class="space">
                    <div class="buildings_1b">
                        <div class="buildings_1b1">
                            <a href="/technos/display/<?=$datab['id'];?>"><?=$datab['name'];?></a>
                        </div>
                        <div class="space">
                            <div><?=$datab['desc'];?></div>
                        </div>
                        <div class="buildings_1b1">
                            Coût à l'unité : <?=ceil($datab['res1']);?> Métal <?=ceil($datab['res2']);?> Cristal <?=ceil($datab['res3']);?> Uranium
                        </div>
                        <div class="space">
                            <input type="text" name="nbUnits"/>
                        </div>
                    </div>
                    <input type="submit" value="Entrainer"/>
                </div>
            </div>
        </form>
        <?php endforeach;?>

            

    <?php endif;?>
</div>



<?php if (!empty($refusedTypes)):?>

<div class="divtop curvedtot">
    Prérequis manquants
</div>

<div class="space0">

<?php foreach ($refusedTypes as $type):?>
    <?php $datab = current($dataunits[$type]);?>

    <div class="space1 curvedtot">
        <div class="space">
            <div>- <a href="/buildings/display/<?=$datab['id'];?>"><?=$datab['name'];?></a> -</div>
            <br/>

            <?php foreach ($datanodesTypes[$type] as $need_type => $need_lvl):?>
                <?php $datab = current($dataunits[$need_type]);?>

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