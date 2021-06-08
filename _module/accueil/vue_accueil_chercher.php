<form method="post" action="<?= hlien("accueil", "chercher") ?>">
    <div class="row">
        <div class="col">
            <label for='cat_id'>Selectionne une categorie</label>
            <select class="form-control" id='cat_id' name='cat_id'>
                <?= Entity::HTMLselect("select cat_id,cat_nom from categorie", "cat_id", "cat_nom", $_SESSION['cat_id']); ?>
            </select>
        </div>
        <div class="col">
            <label for='dep_id'>Selectionne ton departement</label>
            <select class="form-control" id='dep_id' name='dep_id'>
                <?= Entity::HTMLselect("select distinct dep_id,dep_nom from departement, agence where age_departement=dep_id", "dep_id", "dep_nom", $_SESSION['dept'] ); ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for='age_id_depart'>Agence de départ</label>
            <select class="form-control" id='age_id_depart' name='age_id_depart'>
                <?= Entity::HTMLselect("select age_id, age_nom from agence", "age_id", "age_nom", $_SESSION['age_depart']); ?>
            </select>
        </div>
        <div class="col">
            <label for='age_id_arrivee'>Agence d'arrivée</label>

            <select class="form-control" id='age_id_arrivee' name='age_id_arrivee'>
                <?= Entity::HTMLselect("select age_id,age_nom from agence", "age_id", "age_nom", $_SESSION['age_arrive']); ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for='loc_date_heure_debut'>Date depart</label>
            <input id='loc_date_heure_debut' name='loc_date_heure_debut' type='date' size='50' value='<?= $_SESSION['loc_date_heure_debut'] ?>' class='form-control' />
        </div>
        <div class="col">
            <label for="heureDebut">Heure de début</label>
            <input type="time" name="heureDebut" id="heureDebut" value="<?= $_SESSION["heueDebut"] ?>" >
        </div>
        <div class="col">
            <label for='loc_date_heure_fin'>Date retour</label>
            <input id='loc_date_heure_fin' name='loc_date_heure_fin' type='date' size='50' value='<?= $_SESSION['loc_date_heure_fin'] ?>' class='form-control' />
        </div>
        <div class="col">
            <label for="heureFin">Heure de fin</label>
            <input type="time" name="heureFin" id="heureFin" value="<?= $_SESSION["heureFin"] ?>" >
        </div>
    </div>

    <input class="btn btn-success" type="submit" name="chercher" id="chercher" value="Chercher" />

</form>


<h2>vehicules disponibles</h2>

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>

            <th></th>
            <th>Marque</th>
            <th>Tarif</th>
            <th>Reserver</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($result as $row) {
            extract($row); ?>
            <tr>

                <td>image</td>
                <td><?= mhe($row['veh_model']) ?></td>
                <td>a partir de: <br> <?= mhe($row['prix']) ?> €</td>
                <?php if (isset($_SESSION["uti_id"])) { ?>
                    <td><a class="btn btn-danger" href="<?= hlien("accueil", "reservation", "id", $row["veh_id"]) ?>">Reserver</a></td>
                <?php } else { ?>
                    <td><a class="btn btn-danger" href="<?= hlien("authentification", "connexion", "id", $row["veh_id"]) ?>">Se connecter</a></td>
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
    //select : liste des départements
    let selectDept = document.getElementById("dep_id");
    selectDept.addEventListener("change", initVille);

    let dateDebut = document.getElementById("loc_date_heure_debut");
    dateDebut.addEventListener("input", initDateFin);
    let dateFin = document.getElementById("loc_date_heure_fin");

    //select : liste des villes du département sélectionné
    let selectVille = document.getElementById("age_id_depart");


    //appel ajax pour lister les villes qui commencent par la saisie
    function initVille() {
        let xmlhttp = new XMLHttpRequest();
        let url = "<?= hlien('accueil', 'ville') ?>&dept=" + selectDept.value;
        console.log(url);
        xmlhttp.open("GET", url, true);
        xmlhttp.onreadystatechange = mafonction;
        xmlhttp.send();

        function mafonction() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                selectVille.innerHTML = xmlhttp.responseText;
                //console.log(xmlhttp.responseText); 
            }
        }
    }

    function initDateFin() {
        dateFin.min = dateDebut.value;
    }
</script>
