
<?php $this->extend('view');

$this->start('specialize');?>

<?php debug($allowedTechnos); ?>

<div class="technos form">
    <?php echo $this->Form->create('Techno', array('action' => 'upgrade')); ?>
    <fieldset>
        <legend><?php echo __('Upgrade Techno'); ?></legend>
        <?php
        echo $this->Form->input('id', array('type'=>'text','value' => ''));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>

<div class="technos form">
    <?php echo $this->Form->create('Techno', array('action' => 'create')); ?>
    <fieldset>
        <legend><?php echo __('Create Techno'); ?></legend>
        <?php
        echo $this->Form->input('type', array('type'=>'text'));
        echo $this->Form->input('building_id', array('type'=>'hidden','value' => $data['Building']['id']));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>

<?php $this->end(); ?>


