
create database if not exists locacar default character set utf8 collate utf8_general_ci;
use locacar;

set foreign_key_checks =0;

-- table departement
drop table if exists departement;
create table departement (
	dep_id int not null auto_increment primary key,
	dep_code varchar(5) not null,
	dep_nom varchar(50) not null 
)engine=innodb;

-- table agence
drop table if exists agence;
create table agence (
	age_id int not null auto_increment primary key,
	age_nom varchar(50) not null, 
	age_departement int not null
)engine=innodb;

-- table vehicule
drop table if exists vehicule;
create table vehicule (
	veh_id int not null auto_increment primary key,
	veh_immatriculation varchar(20) not null,
    veh_model varchar(20) not null,
	veh_site int not null,
	veh_agence int not null,
    veh_categorie int not null
)engine=innodb;

-- table client
drop table if exists utilisateur;
create table utilisateur (
	uti_id int auto_increment primary key,
	uti_nom varchar(50) not null,
	uti_prenom varchar(50) not null,
	uti_mail varchar(50) not null,
	uti_adresse varchar(255) not null,
	uti_username varchar(50) not null,
	uti_passw varchar(255) not null,
	uti_profil int not null,
	uti_agence int
)engine=innodb;


drop table if exists profil;
create table profil (
	pro_id int not null auto_increment primary key,
	pro_nom varchar(20) not null
		
)engine=innodb;


-- table categorie
drop table if exists categorie;
create table categorie (
	cat_id int not null auto_increment primary key,
	cat_nom varchar(20) not null 
)engine=innodb;

-- table options
drop table if exists options;
create table options (
	opt_id int not null auto_increment primary key,
	opt_nom varchar(20) not null, 
    opt_tarif float not null
)engine=innodb;

-- table locations
drop table if exists locations;
create table locations (
	loc_id int not null auto_increment primary key,
   	loc_type varchar(20) not null,
	loc_date_demande datetime,
	loc_date_maj datetime,
	loc_statut varchar(30) not null,
	loc_date_heure_debut datetime,
	loc_date_heure_fin datetime,
	loc_gestionnaire int not null,
    loc_agence_depart int not null,
	loc_agence_arrivee int not null,
	loc_client int not null,
	loc_vehicule int not null
  )engine=innodb;

-- table equiper
drop table if exists equiper;
create table equiper (
	equ_id int not null auto_increment primary key,
	equ_location int not null, 
    equ_option int 
)engine=innodb;



-- table plage horaire
drop table if exists plage_horaire;
create table plage_horaire (
	plg_id int not null auto_increment primary key,
	plg_hmin int not null, 
    plg_hmax int not null
)engine=innodb;

-- table definir
drop table if exists definir;
create table definir (
	def_id int not null auto_increment primary key,
	def_tarif float not null, 
    def_plage_horaire int not null,
	def_categorie int not null
)engine=innodb;

-- contraintes
alter table agence add constraint cs1 foreign key (age_departement) references departement(dep_id) ON DELETE CASCADE;
alter table vehicule add constraint cs2 foreign key (veh_agence) references agence(age_id) ON DELETE CASCADE;
alter table vehicule add constraint cs3 foreign key (veh_site) references agence(age_id) ON DELETE CASCADE;
alter table vehicule add constraint cs4 foreign key (veh_categorie) references categorie(cat_id) ON DELETE CASCADE;
alter table locations add constraint cs5 foreign key (loc_agence_depart) references agence(age_id) ON DELETE CASCADE;
alter table locations add constraint cs6 foreign key (loc_agence_arrivee) references agence(age_id) ON DELETE CASCADE;
alter table locations add constraint cs7 foreign key (loc_client) references utilisateur(uti_id) ON DELETE CASCADE;
alter table locations add constraint cs8 foreign key (loc_gestionnaire) references utilisateur(uti_id) ON DELETE CASCADE;
alter table locations add constraint cs9 foreign key (loc_vehicule) references vehicule(veh_id) ON DELETE CASCADE;
alter table utilisateur add constraint cs11 foreign key (uti_agence) references agence(age_id) ON DELETE CASCADE;
alter table definir add constraint cs12 foreign key (def_plage_horaire) references plage_horaire(plg_id) ON DELETE CASCADE;
alter table definir add constraint cs13 foreign key (def_categorie) references categorie(cat_id) ON DELETE CASCADE;
alter table equiper add constraint cs14 foreign key (equ_location) references locations(loc_id) ON DELETE CASCADE;
alter table equiper add constraint cs15 foreign key (equ_option) references options(opt_id) ON DELETE CASCADE;
alter table utilisateur add constraint cs16 foreign key (uti_profil) references profil(pro_id) ON DELETE CASCADE;

set foreign_key_checks =1;

-- vue donnant le prix d???une location (hors options sur le v??hicule).
create or replace view loc_duree as 
select loc_id, cat_id, cat_nom, timestampdiff(hour, loc_date_heure_debut, loc_date_heure_fin) duree 
 from locations, vehicule, categorie 
where loc_vehicule=veh_id and veh_categorie=cat_id;

-- vue pour chiffre d???affaire d???une agence donn??e.
create or replace view loc_option as 
select  equ_location, loc_agence_depart, sum(opt_tarif) prixopt 
from options, equiper, locations, vehicule 
where equ_option=opt_id and equ_location=loc_id and veh_id=loc_vehicule
group by loc_id;

-- cr??ation de la vue des prix par location 
create or replace view loc_tarif as 
select loc_id, def_tarif*duree prixsansoptions 
from loc_duree, plage_horaire, definir 
where cat_id=def_categorie  and plg_id=def_plage_horaire and duree between plg_hmin and plg_hmax;


insert into categorie values(1,"petit");
insert into categorie values(2,"moyen");
insert into categorie values(3,"grand");
insert into categorie values(4,"utilitaire");
insert into categorie values(5,"prestige");
insert into categorie values(6,"campig car");

insert into options values(null,'Climatisation', 10);
insert into options values(null,'GPS', 7);
insert into options values(null,'Pneus neige', 23);
insert into options values(null,'Lecteur video', 5);
insert into options values(null,'Minibar', 15);

insert into plage_horaire values(1,1,12) ;
insert into plage_horaire values(2,13,24) ;
insert into plage_horaire values(3,24,720) ;

insert into definir values(1,8,1,1);
insert into definir values(2,7,2,1);
insert into definir values(3,6,3,1);
insert into definir values(4,10,1,2);
insert into definir values(5,9,2,2);
insert into definir values(6,8,3,2);
insert into definir values(7,14,1,3);
insert into definir values(8,12,2,3);
insert into definir values(9,10,3,3);
insert into definir values(10,6,1,4);
insert into definir values(11,5,2,4);
insert into definir values(12,4,3,4);
insert into definir values(13,27,1,5);
insert into definir values(14,24,2,5);
insert into definir values(15,20,3,5);
insert into definir values(16,35,1,6);
insert into definir values(17,34,2,6);
insert into definir values(18,30,3,6);

insert into profil values(1,'Administrateur');
insert into profil values(2,'Gestionnaire SRC');
insert into profil values(3,'Gestionnaire Agence');
insert into profil values(4,'Utilisateur');



insert into departement values(null,'01','Ain' );
insert into departement values(null,'02','Aisne' );
insert into departement values(null,'03','Allier' );
insert into departement values(null,'04','Alpes-de-Haute-Provence' );
insert into departement values(null,'05','Hautes-alpes' );
insert into departement values(null,'06','Alpes-maritimes' );
insert into departement values(null,'07','Ard??che' );
INSERT INTO departement VALUES (null,'08', 'Ardennes');
INSERT INTO departement VALUES (null,'09', 'Ari??ge');
INSERT INTO departement VALUES (null,'10', 'Aube');
INSERT INTO departement VALUES (null,'11', 'Aude');
INSERT INTO departement VALUES (null,'12', 'Aveyron');
INSERT INTO departement VALUES (null,'13', 'Bouches-du-Rh??ne');
INSERT INTO departement VALUES (null,'14', 'Calvados');
INSERT INTO departement VALUES (null,'15', 'Cantal');
INSERT INTO departement VALUES (null,'16', 'Charente');
INSERT INTO departement VALUES (null,'17', 'Charente-Maritime');
INSERT INTO departement VALUES (null,'18', 'Cher');
INSERT INTO departement VALUES (null,'19', 'Corr??ze');
INSERT INTO departement VALUES (null,'2A', 'Corse-du-Sud');
INSERT INTO departement VALUES (null,'2B', 'Haute-Corse');
INSERT INTO departement VALUES (null,'21', 'C??te-dOr');
INSERT INTO departement VALUES (null,'22', 'C??tes-dArmor');
INSERT INTO departement VALUES (null,'23', 'Creuse');
INSERT INTO departement VALUES (null,'24', 'Dordogne');
INSERT INTO departement VALUES (null,'25', 'Doubs');
INSERT INTO departement VALUES (null,'26', 'Dr??me');
INSERT INTO departement VALUES (null,'27', 'Eure');
INSERT INTO departement VALUES (null,'28', 'Eure-et-Loir');
INSERT INTO departement VALUES (null,'29', 'Finist??re');
INSERT INTO departement VALUES (null,'30', 'Gard');
INSERT INTO departement VALUES (null,'31', 'Haute-Garonne');
INSERT INTO departement VALUES (null,'32', 'Gers');
INSERT INTO departement VALUES (null,'33', 'Gironde');
INSERT INTO departement VALUES (null,'34', 'H??rault');
INSERT INTO departement VALUES (null,'35', 'Ille-et-Vilaine');
INSERT INTO departement VALUES (null,'36', 'Indre');
INSERT INTO departement VALUES (null,'37', 'Indre-et-Loire');
INSERT INTO departement VALUES (null,'38', 'Is??re');
INSERT INTO departement VALUES (null,'39', 'Jura');
INSERT INTO departement VALUES (null,'40', 'Landes');
INSERT INTO departement VALUES (null,'41', 'Loir-et-Cher');
INSERT INTO departement VALUES (null,'42', 'Loire');
INSERT INTO departement VALUES (null,'43', 'Haute-Loire');
INSERT INTO departement VALUES (null,'44', 'Loire-Atlantique');
INSERT INTO departement VALUES (null,'45', 'Loiret');
INSERT INTO departement VALUES (null,'46', 'Lot');
INSERT INTO departement VALUES (null,'47', 'Lot-et-Garonne');
INSERT INTO departement VALUES (null,'48', 'Loz??re');
INSERT INTO departement VALUES (null,'49', 'Maine-et-Loire');
INSERT INTO departement VALUES (null,'50', 'Manche');
INSERT INTO departement VALUES (null,'51', 'Marne');
INSERT INTO departement VALUES (null,'52', 'Haute-Marne');
INSERT INTO departement VALUES (null,'53', 'Mayenne');
INSERT INTO departement VALUES (null,'54', 'Meurthe-et-Moselle');
INSERT INTO departement VALUES (null,'55', 'Meuse');
INSERT INTO departement VALUES (null,'56', 'Morbihan');
INSERT INTO departement VALUES (null,'57', 'Moselle');
INSERT INTO departement VALUES (null,'58', 'Ni??vre');
INSERT INTO departement VALUES (null,'59', 'Nord');
INSERT INTO departement VALUES (null,'60', 'Oise');
INSERT INTO departement VALUES (null,'61', 'Orne');
INSERT INTO departement VALUES (null,'62', 'Pas-de-Calais');
INSERT INTO departement VALUES (null,'63', 'Puy-de-D??me');
INSERT INTO departement VALUES (null,'64', 'Pyr??n??es-Atlantiques');
INSERT INTO departement VALUES (null,'65', 'Hautes-Pyr??n??es');
INSERT INTO departement VALUES (null,'66', 'Pyr??n??es-Orientales');
INSERT INTO departement VALUES (null,'67', 'Bas-Rhin');
INSERT INTO departement VALUES (null,'68', 'Haut-Rhin');
INSERT INTO departement VALUES (null,'69', 'Rh??ne');
INSERT INTO departement VALUES (null,'70', 'Haute-Sa??ne');
INSERT INTO departement VALUES (null,'71', 'Sa??ne-et-Loire');
INSERT INTO departement VALUES (null,'72', 'Sarthe');
INSERT INTO departement VALUES (null,'73', 'Savoie');
INSERT INTO departement VALUES (null,'74', 'Haute-Savoie');
INSERT INTO departement VALUES (null, '75','Paris');
INSERT INTO departement VALUES (null,'76', 'Seine-Maritime');
INSERT INTO departement VALUES (null,'77', 'Seine-et-Marne');
INSERT INTO departement VALUES (null,'78', 'Yvelines');
INSERT INTO departement VALUES (null,'79', 'Deux-S??vres');
INSERT INTO departement VALUES (null,'80', 'Somme');
INSERT INTO departement VALUES (null,'81', 'Tarn');
INSERT INTO departement VALUES (null,'82', 'Tarn-et-Garonne');
INSERT INTO departement VALUES (null,'83', 'Var');
INSERT INTO departement VALUES (null,'84', 'Vaucluse');
INSERT INTO departement VALUES (null,'85', 'Vend??e');
INSERT INTO departement VALUES (null,'86', 'Vienne');
INSERT INTO departement VALUES (null,'87', 'Haute-Vienne');
INSERT INTO departement VALUES (null,'88', 'Vosges');
INSERT INTO departement VALUES (null,'89', 'Yonne');
INSERT INTO departement VALUES (null,'90', 'Territoire de Belfort');
INSERT INTO departement VALUES (null,'91', 'Essonne');
INSERT INTO departement VALUES (null,'92', 'Hauts-de-Seine');
INSERT INTO departement VALUES (null,'93', 'Seine-Saint-Denis');
INSERT INTO departement VALUES (null,'94', 'Val-de-Marne');
INSERT INTO departement VALUES (null,'95', 'Val-dOise');



