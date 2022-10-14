<?php


try {
    $bdd = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$bdd->exec(<<<END
create table agence  (
    code_ag varchar(10),
  nomresp varchar(30) not null,
  numtel varchar(12) not null,
  rue varchar(40),
  ville varchar(25),
  codpostal varchar(5),
  pays  varchar(20),
  primary key (code_ag)
  );

create table categorie  (
    code_categ varchar(3),
  libelle varchar(30) not null,
  nbpers int(2) not null,
  type_permis varchar(2) not null,
  code_tarif varchar(3),
  primary key (code_categ)
  );

create table client  (
    code_cli varchar(8),
  nom  varchar(40) not null,
  rue varchar(40) not null,
  ville varchar(25) not null,
  codpostal varchar(5) not null,
  primary key (code_cli)
  );

create table dossier  (
    no_dossier int(6),
  date_retrait date not null,
  date_retour date not null,
  date_effect date,
  kil_retrait int(6),
  kil_retour int(6),
  type_tarif varchar(5),
  assur char(1),
  nbjour_fact int(3),
  nbsem_fact int(3),
  remise decimal(4,2),
  code_cli varchar(8),
  no_imm varchar(10),
  ag_retrait varchar(10),
  ag_retour varchar(10),
  ag_reserve varchar(10),
  primary key (no_dossier)
  );

create table tarif (
    code_tarif varchar(3),
  tarif_jour decimal(6,2) not null,
  tarif_hebdo decimal(6,2) not null,
  tarif_kil decimal(4,2) not null,
  tarif_w500 decimal(6,2) not null,
  tarif_w800 decimal(6,2) not null,
  tarif_asur decimal(6,2) not null,
  primary key (code_tarif) );

create table vehicule (
    no_imm varchar(10),
  marque varchar(20) not null,
  modele varchar(20) not null,
  couleur varchar(20),
  date_achat date,
  kilometres int(6),
  code_categ varchar(3),
  code_ag varchar(10),
  primary key (no_imm) );

create table calendrier
( no_imm varchar(10),
datejour date,
paslibre char(1),
primary key (no_imm,datejour)
);

-- INSERTION DES DONNEES --
insert into agence values('Nancy','Louvois Marc','0383911234','10, rue de la gare','Nancy','54000','France');
insert into agence values('Metz','Loubard Jean','0387231111','25, avenue gambetta','Metz', '57000','France');
insert into agence values('Strasbourg','Meyer Paul','0329211111','8, rue des tanneurs','Strasbourg','67000','France');

insert into calendrier values('1234ya54',str_to_date('1-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1234ya54',str_to_date('2-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1234ya54',str_to_date('3-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1234ya54',str_to_date('4-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1234ya54',str_to_date('5-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1234ya54',str_to_date('6-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1234ya54',str_to_date('7-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1234ya54',str_to_date('8-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1234ya54',str_to_date('9-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1234ya54',str_to_date('10-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1234ya54',str_to_date('11-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1234ya54',str_to_date('12-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1234ya54',str_to_date('13-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1234ya54',str_to_date('14-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1234ya54',str_to_date('15-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1234ya54',str_to_date('16-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1234ya54',str_to_date('17-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1234ya54',str_to_date('18-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1234ya54',str_to_date('19-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1234ya54',str_to_date('20-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1234ya54',str_to_date('21-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1234ya54',str_to_date('22-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1234ya54',str_to_date('23-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1234ya54',str_to_date('24-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1234ya54',str_to_date('25-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1234ya54',str_to_date('26-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1234ya54',str_to_date('27-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1234ya54',str_to_date('28-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1234ya54',str_to_date('29-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1234ya54',str_to_date('30-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1234ya54',str_to_date('31-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('1-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('2-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('3-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('4-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('5-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('6-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('7418yc54',str_to_date('7-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('7418yc54',str_to_date('8-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('9-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('10-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('11-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('12-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('13-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('7418yc54',str_to_date('14-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('7418yc54',str_to_date('15-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('16-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('17-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('18-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('19-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('20-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('21-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('22-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('23-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('24-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('25-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('26-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('27-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('28-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('29-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('30-10-2015','%d-%m-%Y'),null);
insert into calendrier values('7418yc54',str_to_date('31-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('1-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('2-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('3-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('4-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('5-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('6-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('7-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('8-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('9-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('10-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('11-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('12-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('13-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('14-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('15-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('16-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('17-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('18-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('19-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('20-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('21-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('22-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('23-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('24-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('25-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('26-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('27-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('28-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('29-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('30-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5698yd54',str_to_date('31-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('1-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('2-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('3-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('4-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('5-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('6-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('7-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('8-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('9-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('10-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('6213yd54',str_to_date('11-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('6213yd54',str_to_date('12-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('6213yd54',str_to_date('13-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('6213yd54',str_to_date('14-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('6213yd54',str_to_date('15-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('6213yd54',str_to_date('16-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('17-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('18-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('19-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('20-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('21-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('22-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('23-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('24-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('25-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('26-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('27-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('28-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('29-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('30-10-2015','%d-%m-%Y'),null);
insert into calendrier values('6213yd54',str_to_date('31-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('1-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('2-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1789xv54',str_to_date('3-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1789xv54',str_to_date('4-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1789xv54',str_to_date('5-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1789xv54',str_to_date('6-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1789xv54',str_to_date('7-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1789xv54',str_to_date('8-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1789xv54',str_to_date('9-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1789xv54',str_to_date('10-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('1789xv54',str_to_date('11-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('12-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('13-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('14-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('15-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('16-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('17-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('18-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('19-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('20-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('21-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('22-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('23-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('24-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('25-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('26-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('27-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('28-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('29-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('30-10-2015','%d-%m-%Y'),null);
insert into calendrier values('1789xv54',str_to_date('31-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('1-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('2569yp54',str_to_date('2-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('2569yp54',str_to_date('3-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('2569yp54',str_to_date('4-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('2569yp54',str_to_date('5-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('2569yp54',str_to_date('6-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('7-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('8-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('9-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('10-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('11-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('12-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('13-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('14-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('15-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('16-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('17-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('18-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('19-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('20-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('21-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('22-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('23-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('24-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('25-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('26-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('27-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('28-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('29-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('30-10-2015','%d-%m-%Y'),null);
insert into calendrier values('2569yp54',str_to_date('31-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('1-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('2-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('5213ye54',str_to_date('3-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('5213ye54',str_to_date('4-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('5213ye54',str_to_date('5-10-2015','%d-%m-%Y'),'x');
insert into calendrier values('5213ye54',str_to_date('6-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('7-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('8-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('9-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('10-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('11-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('12-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('13-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('14-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('15-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('16-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('17-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('18-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('19-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('20-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('21-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('22-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('23-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('24-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('25-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('26-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('27-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('28-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('29-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('30-10-2015','%d-%m-%Y'),null);
insert into calendrier values('5213ye54',str_to_date('31-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('1-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('2-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('3-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('4-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('5-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('6-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('7-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('8-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('9-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('10-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('11-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('12-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('13-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('14-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('15-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('16-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('17-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('18-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('19-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('20-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('21-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('22-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('23-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('24-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('25-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('26-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('27-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('28-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('29-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('30-10-2015','%d-%m-%Y'),null);
insert into calendrier values('4577yp54',str_to_date('31-10-2015','%d-%m-%Y'),null);

insert into vehicule values('1234ya54','citroen','xantia2.0','blanche',str_to_date('12-09-2014','%d-%m-%Y'),35000,'c3','Nancy');
insert into vehicule values('7418yc54','citroen','saxo1.1','Noire',str_to_date('15-08-2014','%d-%m-%Y'),23000,'c1','Nancy');
insert into vehicule values('5698yd54','peugeot','106xr1.1','Grise',str_to_date('15-09-2014','%d-%m-%Y'),26000,'c1','Nancy');
insert into vehicule values('6213yd54','renault','twingo','Verte',str_to_date('20-09-2014','%d-%m-%Y'),20350,'c1','Nancy');
insert into vehicule values('1789xv54','citroen','xsara1.4sx','Bleue',str_to_date('15-05-2013','%d-%m-%Y'),98500,'c2','Nancy');
insert into vehicule values('2569yp54','peugeot','206hdi','Blanche',str_to_date('26-06-2014','%d-%m-%Y'),12000,'c2','Nancy');
insert into vehicule values('5213ye54','renault','laguna1.8d','Noire',str_to_date('14-09-2014','%d-%m-%Y'),62000,'c3','Nancy');
insert into vehicule values('4577yp54','peugeot','406sr2.0','Noire',str_to_date('15-03-2015','%d-%m-%Y'),28000,'c3','Nancy');

insert into tarif values('t1',120.00,600.00,1.50,650.00,850.00,25.00);
insert into tarif values('t2',170.00,750.00,1.80,800.00,1100.00,30.00);
insert into tarif values('t3',210.00,900.00,2.10,1100.00,1500.00,40.00);

insert into dossier values(1,str_to_date('1-10-2015','%d-%m-%Y'),str_to_date('5-10-2015','%d-%m-%Y'),null,null,null,'t1','x',null,null,null,'duvig001','7418yc54','Nancy','Nancy','Nancy');
insert into dossier values(2,str_to_date('1-10-2015','%d-%m-%Y'),str_to_date('5-10-2015','%d-%m-%Y'),null,null,null,'t1',null,null,null,null,'dumon001','2569yp54','Nancy','Nancy','Nancy');
insert into dossier values(3,str_to_date('2-10-2015','%d-%m-%Y'),str_to_date('10-10-2015','%d-%m-%Y'),null,null,null,'t1','x',null,null,null,'delar001','1789xv54','Nancy','Nancy','Nancy');
insert into dossier values(4,str_to_date('2-10-2015','%d-%m-%Y'),str_to_date('5-10-2015','%d-%m-%Y'),null,null,null,'t1',null,null,null,null,'delam001','5213ye54','Nancy','Nancy','Nancy');
insert into dossier values(5,str_to_date('6-10-2015','%d-%m-%Y'),str_to_date('7-10-2015','%d-%m-%Y'),null,null,null,'t2','x',null,null,null,'roule001','7418yc54','Nancy','Nancy','Nancy');
insert into dossier values(6,str_to_date('10-10-2015','%d-%m-%Y'),str_to_date('15-10-2015','%d-%m-%Y'),null,null,null,'t1',null,null,null,null,'duvig001','6213yd54','Nancy','Strasbourg','Nancy');
insert into dossier values(7,str_to_date('10-10-2015','%d-%m-%Y'),str_to_date('20-10-2015','%d-%m-%Y'),null,null,null,'t1','x',null,null,null,'dumon001','1234ya54','Nancy','Nancy','Nancy');
insert into dossier values(8,str_to_date('13-10-2015','%d-%m-%Y'),str_to_date('14-10-2015','%d-%m-%Y'),null,null,null,'t3',null,null,null,null,'delar001','7418yc54','Nancy','Nancy','Nancy');
insert into dossier values(9,str_to_date('13-10-2015','%d-%m-%Y'),str_to_date('14-10-2015','%d-%m-%Y'),null,null,null,'t2',null,null,null,null,'delar001','6213yd54','Nancy','Nancy','Nancy');
insert into dossier values(10,str_to_date('21-10-2015','%d-%m-%Y'),str_to_date('25-10-2015','%d-%m-%Y'),null,null,null,'t1','x',null,null,null,'roule001','1234ya54','Nancy','Nancy','Nancy');

insert into client values('duvig001','duvigne g�rard','16, rue des vignerons','laxou','54100');
insert into client values('dumon001','dumont nathalie','78, avenue du maine','nancy','54000');
insert into client values('delar001','delaroche claude','2, rue des tilleuls','vandoeuvre','54500');
insert into client values('delam001','delamontagne eric','5, rue des acacias','nancy','54000');
insert into client values('roule001','rouletabille claude','29, rue des lilas','Nancy','54000');

insert into categorie values('c1','citadine',4,'a1','t1');
insert into categorie values('c2','compacte',5,'a1','t2');
insert into categorie values('c3','familiale',5,'a1','t3');



-- CONSTRAINT
alter table dossier
  add constraint fk_codecli foreign key (code_cli) references client(code_cli);
alter table dossier
  add(constraint fk_noimm foreign key (no_imm) references vehicule(no_imm));
alter table dossier
    add(constraint fk_agretrait foreign key (ag_retrait) references agence(code_ag));
alter table dossier
    add (constraint fk_agretour foreign key (ag_retour) references agence(code_ag));
alter table dossier
    add (constraint fk_agreserve foreign key (ag_reserve) references agence(code_ag));
alter table vehicule
  add (constraint fk_codecateg foreign key(code_categ) references categorie(code_categ));
alter table vehicule
    add (constraint fk_codeag foreign key(code_ag) references agence(code_ag));
alter table categorie
  add (constraint fk_codetarif foreign key(code_tarif) references tarif(code_tarif));
alter table calendrier
  add(constraint fk_noimm1 foreign key (no_imm) references vehicule(no_imm));
END);