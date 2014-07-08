<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
    <link rel="shortcut icon" href="/img/favicon.ico">

    <!-- Menu -->

    <?php echo $this->Html->css('Game/leftmenu');?>
    <?php echo $this->Html->css('Game/rightmenu');?>
    <script type="text/javascript"
            language="javascript" src="http://static.spaceswars.com/fichiers.1.2/scripts/jquery.js"></script>
    <script type="text/javascript"
            language="javascript" src="http://static.spaceswars.com/fichiers.1.2/scripts/lm-1383010249.js"></script>

    <!-- Overview -->

    <?php echo $this->Html->css('Game/middle');?>
    <script type="text/javascript"
            language="javascript" src="http://static.spaceswars.com/fichiers.1.2/scripts/overview-1384296989.js"></script>
    <script language="JavaScript" type="text/javascript"> var orefresh = 0;</script>
    <script type="text/javascript"
            language="javascript" src="http://static.spaceswars.com/fichiers.1.2/scripts/tooltips.js"></script>
    <script type="text/javascript"
            language="javascript" src="http://static.spaceswars.com/fichiers.1.2/scripts/topnav.js"></script>


</head>
<body>

    <div id="wrapper">

        <?php echo $this->element('leftmenu'); ?>

        <?php echo $this->element('overview'); ?>

        <?php echo $this->element('rightmenu'); ?>

    </div>

	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
		</div>

        <?php echo $this->element('resources',array(
            'data' => $resources
        )); ?>

        <?php echo $this->element('camps',array(
            'data' => $camps
        )); ?>


		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>


		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
