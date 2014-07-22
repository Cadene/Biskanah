<div class="divtop curvedtot">
    Classement des joueurs en fonction des points
</div>

<div class="space0">

	<table style="margin: 0px auto;">
		<thead>
			<tr>
				<th>Rang</th>
				<th>Joueur</th>
				<th>Points</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach (array_reverse($datas,true) as $d):?>
			<tr>
				<td><?=$d[0]['rank'];?></td>
				<td><?=$d['uo']['username'];?></td>
				<td><?=floor($d['uo']['rank_pts']/1000);?></td>
			</tr>	
			<?php endforeach;?>
		</tbody>
	</table>

</div>


