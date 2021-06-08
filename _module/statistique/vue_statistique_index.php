<h2>Nos statistiques</h2>
    <p><a class="btn btn-primary" href="<?= hlien("statistique", "edit", "id", 0) ?>">Nouveau statistique</a></p>
    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>

    			<th>Id</th>
    			<th>Agence</th>
    			<th>CA N-1</th>
    			<th>CA N</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			$totaux = 0;
			foreach ($result as $row) {
				extract($row);
				$totaux += $row["total"] ?>
    			<tr>

    				<td><?= mhe($row['age_id']) ?></td>
    				<td><?= mhe($row['age_nom']) ?></td>
    				<td><?= mhe($row['total']) ?></td>
    			</tr>
    			<tr>
    				<td>Le total général du CA : <?= $totaux ?></td>

    			</tr>
    		<?php } ?>
    	</tbody>
    </table>