<?php
$datab = $data['Databuilding'];
$databs = $data['Databuildings'];
array_shift($databs);
?>


<div class="divtop curvedtot">Affichage du batiment</div>

<div class="space0 curvedtot ">

    <div class="space1 curvedtot">

        <div class="space0"><?= $datab['name'].' (niveau '.$datab['lvl'].')';?></div>

        <div class="space0"><?=$datab['desc1'];?></div>

        <div class="space0"><?=$datab['desc2'];?></div>

    </div>

    <div class="space1 curvedtot">
        <?php if ($datab['lvl'] > 0):?>
            <div class="space"><?= $this->Html->link('Upgrade','/buildings/create/'.$datab['id']);?></div>
        <?php else:?>
            <div class="space"><?= $this->Html->link('Construire', '/buildings/create/'.$datab['id']);?></div>
        <?php endif;?>
    </div>

    <div class="space1 curvedtot">

        <table style="margin: 0px auto;">
            <thead>
                <tr>
                    <th>Niveau</th>
                    <th>Coût en métal</th>
                    <th>Coût en silicium</th>
                    <th>Coût en uranium</th>
                    <th>Durée de construction</th>
                    <th>Valeur de structure</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($databs as $d): ?>
                <tr>
                    <td><?=$d['lvl'];?></td>
                    <td><?=$d['res1'];?></td>
                    <td><?=$d['res2'];?></td>
                    <td><?=$d['res3'];?></td>
                    <td><?=gmdate("H:i:s", round($d['time']));?></td>
                    <td><?=$d['struct'];?></td>
                </tr>  
            <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <br>

    <?php echo $this->fetch('specialize'); ?>

</div>
