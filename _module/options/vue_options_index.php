    <h2>options</h2>
    <p><a class="btn btn-primary" href="<?=hlien("options","edit","id",0)?>">Nouveau options</a></p>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				
			<th>Id</th>
			<th>Nom</th>
			<th>Tarif</th><th>modifier</th>
				<th>supprimer</th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ( $result as $row) { 
			extract($row); ?>
		<tr>
			
			<td><?=mhe($row['opt_id'])?></td>
			<td><?=mhe($row['opt_nom'])?></td>
			<td><?=mhe($row['opt_tarif'])?></td><td><a class="btn btn-warning" href="<?=hlien("options","edit","id",$row["opt_id"])?>">Modifier</a></td>
			<td><a class="btn btn-danger" href="<?=hlien("options","del","id",$row["opt_id"])?>">Supprimer</a></td>
		</tr>
		<?php } ?>
		</tbody>
	</table>
	<script>
		//order by
		const compare = (ids, asc) => (row1, row2) => {
        const tdValue = (row, ids) => row.children[ids].textContent;
        const tri = (v1, v2) => v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2);
        return tri(tdValue(asc ? row1 : row2, ids), tdValue(asc ? row2 : row1, ids));
    };

    const tbody = document.querySelector('tbody');
    const thx = document.querySelectorAll('th');
    const trxb = tbody.querySelectorAll('tr');
    thx.forEach(th => th.addEventListener('click', () => {
        let classe = Array.from(trxb).sort(compare(Array.from(thx).indexOf(th), this.asc = !this.asc));
        classe.forEach(tr => tbody.appendChild(tr));
    }));
	</script>