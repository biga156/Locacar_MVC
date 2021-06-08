<h2>Reservation</h2>
<?php
foreach ($result as $row) {
    extract($row);
    $prix=mhe($row['prix']);
    $_SESSION["prix"]=$prix;
    $_SESSION["vehicule"]=$_GET["id"];
} ?>

<div>
    image
    <ul>
        <li>Model: <?= mhe($row['veh_model']) ?></li>
        <li>Categorie: <?= mhe($row['cat_nom']) ?></li>
        <li>Agence depart: <?= mhe($row['age_nom']) ?></li>
        <li>Agence arrive: <?= mhe($row['age_nom']) ?></li>
        <li>Date depart: <?= mhe($_SESSION['loc_date_heure_debut']) ?></li>
        <li>Date arrive: <?= mhe($_SESSION['loc_date_heure_fin']) ?></li>
    </ul>
    <h3>prix (sans option): <?= $prix ?></h3>
</div>
<form method="post" action="<?= hlien("accueil", "edit") ?>">
<?php
foreach ($options as $row) {
    extract($row); ?>

     <p>
        <label for='<?= mhe($row["opt_nom"]) ?>'><?= mhe($row["opt_nom"]) ?> Prix: <?= mhe($row["opt_tarif"]) ?> €</label>
        <input type='checkbox' name='<?= mhe($row["opt_nom"]) ?>' id='<?= mhe($row["opt_nom"]) ?>' value='<?= mhe($row["opt_tarif"]) ?>' />
    </p>

<?php  } ?>

<h3>Prix options</h3>
<h3 id='prixopt'>0</h3> 
<h2>Prix total: </h2>
<h3 id='prixtotal'><?=$prix?></h3> 

    <div class="row mb-3"></div>
    <input class="btn btn-warning" type="submit" name="annuler" id="annuler" value="Annuler" />
    <input class="btn btn-success" type="submit" name="valider" id="valider" value="valider" />
</form>

<script  type="text/javascript">
    //checkbox
    let listeInput = document.querySelectorAll("input[type=checkbox]");
    let montanttotal=document.getElementById("prixtotal");
    let prixtotal= parseInt(<?php echo json_encode($prix); ?>);
    let prixopt=document.getElementById("prixopt");
    let p=0;
    listeInput.forEach(elt => {

        elt.addEventListener("change", function() {
           
              if(elt.checked){
                prixtotal+=parseInt(elt.value);
                p+=parseInt(elt.value);
                prixopt.innerHTML=p;
              } 
              if(!elt.checked) {
                prixtotal-=parseInt(elt.value);
                p-=parseInt(elt.value);
                prixopt.innerHTML=p;
                
              }           
              montanttotal.innerHTML=prixtotal;
            
             
              console.log(prixtotal);
               
        });

    });
  

</script>
