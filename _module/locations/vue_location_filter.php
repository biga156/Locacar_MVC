<h2>locations</h2>
	<?php if (isset($_SESSION["profil"]) and $_SESSION["profil"]  <= 2) { ?>
	<form method="post" action="<?= hlien("locations", "filter") ?>">
    <div class="row">
        <div class="col">
            <label for='type'>Filtrer par type</label>
            <select class="form-control" id='loc_type' name='loc_type'>
			<?= Locations:: listeType($loc_type) ?>	
			 </select>
			 <input class="btn btn-success" type="submit" name="type" id="type" value="Ok" />
        </div>
        <div class="col">
            <label for='statut'>Filtrer par statut</label>
            <select class="form-control" id='loc_statut' name='loc_statut'>
			<?= Locations:: listeStatut($loc_statut) ?>
			</select>
			<input class="btn btn-success" type="submit" name="statut" id="statut" value="Ok" />
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for='loc_gestionnaire'>Filtrer by gestionnaire</label>
            <select class="form-control" id='loc_gestionnaire' name='loc_gestionnaire'>
			<?=Locations::listeGest($loc_gestionnaire);	?>
			</select>
			<input class="btn btn-success" type="submit" name="gest" id="gest" value="Ok" />
		</div>
		
        <div class="col">
            <label for='loc_client'>Filtrer par client</label>

            <select class="form-control" id='loc_client' name='loc_client'>
			<?=Locations::listeClient($loc_client);	?>
			</select>
			<input class="btn btn-success" type="submit" name="client" id="client" value="Ok" />
		</div>
	</div>
	<div class="row">
		<div class="col">
            <label for='loc_agence_depart'>Filtrer par agence depart</label>

            <select class="form-control" id='loc_agence_depart' name='loc_agence_depart'>
			<?=Locations::listeAgeDep($loc_agence_depart);	?>
			</select>
			<input class="btn btn-success" type="submit" name="agedep" id="agedep" value="Ok" />
        </div>
	</div>
	
	<div class="col">
            <label for='loc_agence_arrivee'>Filtrer par agence arrivee</label>

            <select class="form-control" id='loc_agence_arrivee' name='loc_agence_arrivee'>
			<?=Locations::listeAgeArr($loc_agence_arrivee);	?>
			</select>
			<input class="btn btn-success" type="submit" name="agearr" id="agearr" value="Ok" />
        </div>
    </div>
  
</form>
<br>

	<?php } ?>
<!--******************************** -->
   
	<p><a class="btn btn-primary" href="<?= hlien("locations", "edit", "id", 0) ?>">Nouveau locations</a></p>
	
	<table class="table table-striped table-bordered table-hover">
	<thead>
    		<tr>
    			<th>Id</th>
    			<th>Type</th>
    			<th>Date_demande</th>
    			<th>Date_maj</th>
    			<th>Statut</th>
    			<th>Date_heure_debut</th>
    			<th>Date_heure_fin</th>
    			<th>Agence_depart</th>
    			<th>Agence_arrivee</th>
    			<?php if (isset($_SESSION["profil"]) and $_SESSION["profil"]  <= 2) { ?>
					<th>Client</th>
					<th>Gestionnaire</th>
    				<th>Vehicule</th>
    				<th>modifier</th>
					<th>Annuler</th>
    			<?php } ?>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($result as $row) {
				extract($row); ?>
    			<tr>
    				<td><?= mhe($row['loc_id']) ?></td>
    				<td><?= mhe($row['loc_type']) ?></td>
    				<td><?= mhe($row['loc_date_demande']) ?></td>
    				<td><?= mhe($row['loc_date_maj']) ?></td>
    				<td><?= mhe($row['loc_statut']) ?></td>
    				<td><?= mhe($row['loc_date_heure_debut']) ?></td>
    				<td><?= mhe($row['loc_date_heure_fin']) ?></td>
    				<td><?= mhe($row['agedepart']) ?></td>
    				<td><?= mhe($row['agefin']) ?></td>
    				<?php if (isset($_SESSION["profil"]) and $_SESSION["profil"]  <= 2) { ?>
						<td><?= mhe($row['client']) ?></td>
						<td><?= mhe($row['gestionnaire']) ?></td>
    					<td><?= mhe($row['veh_immatriculation']) ?></td>
						
    					<td><a class="btn btn-warning" href="<?= hlien("locations", "edit", "id", $row["loc_id"]) ?>">Modifier</a></td>
    					<td><a class="btn btn-danger" href="<?= hlien("locations", "del", "id", $row["loc_id"]) ?>">Annuler</a></td>
    				<?php } ?>
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