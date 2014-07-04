<?php debug($data);?>

<?php echo $this->fetch('specialize'); ?>

<div class="buildings form">
    <?php echo $this->Form->create('Building', array('action' => 'upgrade')); ?>
    <fieldset>
        <legend><?php echo __('Upgrade Building'); ?></legend>
        <?php
        echo $this->Form->input('id', array('type'=>'hidden','value'=>$data['Building']['id']));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>