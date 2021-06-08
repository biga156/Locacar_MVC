<h2>vehicule disponible par agence </h2>

<form method="POST" action="<?= hlien("vehicule", "index") ?>">
	<div class="row">
		<div class="col">
			<label for='age_id'>Selectionne ton agence</label>
			<select class="form-control" id='age_id' name='age_id'>
				<?= Entity::HTMLselect("select *from agence where age_id!=1", "age_id", "age_nom", $age_id); ?><br>
			</select>
		</div>
		<div>
			<input class="btn btn-success" type="submit" name="chercher" id="chercher" value="chercher" /><br>
		</div>

	</div>


	<p><a class="btn btn-primary" href="<?= hlien("vehicule", "edit", "id", 0) ?>">Nouveau vehicule</a></p>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>id</th>
				<th>Immatriculation</th>
				<th>Model</th>
				<th>site</th>
				<th>Agence</th>
				<th>Categorie</th>
				<th>modifier</th>
				<th>supprimer</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$a = 0;
			foreach ($result as $cle => $row) {
				extract($row); ?>
				<tr>

					<?php $a++; ?>

					<td><?= mhe($row['veh_id']) ?></td>
					<td><?= mhe($row['veh_immatriculation']) ?></td>
					<td><?= mhe($row['veh_model']) ?></td>
					<td><?= mhe($row['age_nom']) ?></td>
					<td><?= mhe($row['veh_site']) ?></td>
					<td><?= mhe($row['cat_nom']) ?></td>
					<td><a class="btn btn-warning" href="<?= hlien("vehicule", "edit", "id", $row["veh_id"]) ?>">Modifier</a></td>
					<td><a class="btn btn-danger" href="<?= hlien("vehicule", "del", "id", $row["veh_id"]) ?>">Supprimer</a></td>
				</tr>

			<?php  } ?>
			<h2><?= $a . " " . "Vehicule(s) disponible Locacar agence" . " " . mhe($row['dep_nom']) ?> </h2>

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