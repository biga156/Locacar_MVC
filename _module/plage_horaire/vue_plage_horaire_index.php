    <h2>plage_horaire</h2>
    <p><a class="btn btn-primary" href="<?=hlien("plage_horaire","edit","id",0)?>">Nouveau plage_horaire</a></p>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				
			<th>Id</th>
			<th>Hmin</th>
			<th>Hmax</th>
			<th>modifier</th>
			<th>supprimer</th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ( $result as $row) { 
			extract($row); ?>
		<tr>
			
			<td><?=mhe($row['plg_id'])?></td>
			<td><?=mhe($row['plg_hmin'])?></td>
			<td><?=mhe($row['plg_hmax'])?></td>
			<td><a class="btn btn-warning" href="<?=hlien("plage_horaire","edit","id",$row["plg_id"])?>">Modifier</a></td>
			<td><a class="btn btn-danger" href="<?=hlien("plage_horaire","del","id",$row["plg_id"])?>">Supprimer</a></td>
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