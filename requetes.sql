-
--	Chiffre d’affaire d’une agence donnée.
select age_id, age_nom, count(loc_id) nb, sum(prixsansoptions + prixopt) total
from loc_option, loc_tarif, agence 
where equ_location=loc_id and age_id=loc_agence_depart and age_id=15

--Requête donnant le montant total des options attachées à chaque véhicule.
select  equ_location, ve_immatriculation, ve_model, sum(opt_tarif) prixopt 
from options, equiper, locations, vehicule 
where equ_option=opt_id and equ_location=loc_id and ve_id=loc_vehicule
group by ve_id
