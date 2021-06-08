<form method="post" action="<?= hlien("accueil", "index") ?>">
    <div class="row">
        <div class="col">
            <label for='cat_id'>Selectionne une categorie</label>
            <select class="form-control" id='cat_id' name='cat_id'>
                <?= Entity::HTMLselect("select cat_id,cat_nom from categorie", "cat_id", "cat_nom", $cat_nom); ?>
            </select>
        </div>
        <div class="col">
            <label for='dep_id'>Selectionne ton departement</label>
            <select class="form-control" id='dep_id' name='dep_id'>
                <?= Entity::HTMLselect("select distinct dep_id,dep_nom from departement, agence where age_departement=dep_id", "dep_id", "dep_nom", $dep_nom); ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for='age_id_depart'>Agence de départ</label>
            <select class="form-control" id='age_id_depart' name='age_id_depart'>
                <?= Entity::HTMLselect("select * from agence", "age_id", "age_nom", $age_id); ?>
            </select>
        </div>
        <div class="col">
            <label for='age_id_arrivee'>Agence d'arrivée</label>

            <select class="form-control" id='age_id_arrivee' name='age_id_arrivee'>
                <?= Entity::HTMLselect("select age_id,age_nom from agence", "age_id", "age_nom", $age_nom); ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for='loc_date_heure_debut'>Date depart</label>
            <input id='loc_date_heure_debut' name='loc_date_heure_debut' type='date' size='50' value='<?php echo date('Y-m-d'); ?>' class='form-control' />
        </div>
        <div class="col">
            <label for="heureDebut">Heure de début</label>
            <input type="time" name="heureDebut" id="heureDebut">
        </div>
        <div class="col">
            <label for='loc_date_heure_fin'>Date retour</label>
            <input id='loc_date_heure_fin' name='loc_date_heure_fin' type='date' size='50' value='<?php echo date('Y-m-d'); ?>' class='form-control' />
        </div>
        <div class="col">
            <label for="heureFin">Heure de fin</label>
            <input type="time" name="heureFin" id="heureFin">
        </div>
    </div>
    <div>
        <input class="btn btn-success" type="submit" name="chercher" id="chercher" value="chercher" />
    </div>


</form>

<script>
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
