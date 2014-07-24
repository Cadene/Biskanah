
<?php $this->extend('display');

$this->start('specialize');?>

<div class="camp info">

    <div class="divtop curvedtot">
        Unités à disposition dans votre batiment
    </div>

    <?php //debug($allowedTechnos); debug($dttechnos); ?>

    <div class="space0">

        <table style="margin: 0px auto;">
            <thead>
                <tr>
                <?php for ($i=1; $i<=5; $i++):?>
                    <th><?= current($data['Dataunits'][$i])['name'];?></th>
                <?php endfor;?>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php for ($i=1; $i<=5; $i++):?>
                    <?php if (isset($data['UnitsCamps'][$i])) {
                        $num = current($data['UnitsCamps'][$i])['num'];
                    } else {
                        $num = 0;
                    }?>
                    <td><?= $num; ?></td>
                <?php endfor;?>
                </tr>
            </tbody>
        </table>

        <br>

        <div class="space1 curvedtot">
            <div class="space"><?= $this->Html->link('Entrainer de nouvelles unités', '/units/trainable/7');?></div>
        </div>
    </div>

    <?php if (!empty($data['Dtunits'])): ?>

        <br>
        <div class="divtop curvedtot">Unités en cours d'entrainement</div>
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
                            <?= $dtt['num'].' '.$datat['name'].' finiront dans '.$datetime; ?>
                        <?php endif;?>
                    </div>
                </div>
            <?php endfor;?>
        </div>

    <?php endif;?>

</div>

<?php $this->end('specialize');



