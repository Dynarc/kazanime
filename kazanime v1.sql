drop database kazanime;
create database kazanime CHARACTER SET utf8 COLLATE utf8_general_ci;
use kazanime;

create table tag(
	id_tag int auto_increment primary key not null,
    nom varchar(50)
);

create table genre(
	id_genre int auto_increment primary key not null,
    nom varchar(50)
);

create table studio(
	id_studio int auto_increment primary key not null,
    nom varchar(50)
);

create table detenir(
	id_anime int,
    id_tag int,
    primary key(id_anime, id_tag)
);

create table avoir(
	id_anime int,
    id_genre int,
    primary key(id_anime, id_genre)
);

create table disposer(
	id_anime int,
    id_studio int,
    primary key(id_anime, id_studio)
);

create table anime(
	id_anime int auto_increment primary key not null,
    nom varchar(100),
    nom_alt text,
    image varchar(150),
    image_miniature varchar(150),
    date_debut date,
    date_fin date,
    synopsis text,
    nombre_episode int,
    duree_episode int
);

create table episode(
	id_episode int auto_increment primary key not null,
    nom varchar(100),
    numero float,
    id_anime int
);

create table diffuseur(
	id_diffuseur int auto_increment primary key not null,
    nom varchar(50),
    lien varchar(100)
);

create table diffuser(
	id_anime int,
    id_diffuseur int,
    lien varchar(150),
    primary key(id_anime, id_diffuseur)
);

create table retransmettre(
	id_episode int,
    id_diffuseur int,
    lien_episode varchar(150),
    primary key(id_episode, id_diffuseur)
);

create table commentaire(
	id_commentaire int auto_increment primary key not null,
    contenu text,
    date datetime default current_timestamp,
    id_user int,
    id_anime int
);

create table user(
	id_user int auto_increment primary key not null,
    pseudo varchar(50),
	mail varchar(150),
    mdp varchar(100),
    mdp_temp varchar(100) default null,
    date_inscription datetime default current_timestamp,
    id_role int
);

create table voir(
	id_anime int,
    id_user int,
    note int,
    memo text,
    nombre_episode_vu int,
    date_ajout datetime default current_timestamp,
    primary key(id_anime, id_user)
);

create table liste(
	id_liste int auto_increment primary key not null,
    nom varchar(50),
    description varchar(150),
    date_creation varchar(50),
    id_user int
);

create table lister(
	id_anime int,
    id_liste int,
	primary key(id_anime, id_liste)
);

create table partager(
	id_user int,
    id_liste int,
    primary key(id_user, id_liste)
);

create table proposition(
	id_proposition int auto_increment primary key not null,
    nom varchar(100),
    date datetime default current_timestamp,
    nom_alt text,
    nombre_episode int,
    duree_episode int,
    synopsis text,
    studio varchar(50),
    date_debut date,
    date_fin date,
    diffuseur varchar(150),
    genre varchar(200),
    tag varchar(200),
    id_user int,
    id_statut int
);

create table statut_proposition(
	id_statut int auto_increment primary key not null,
    nom varchar(50)
);

create table role(
	id_role int auto_increment primary key not null,
    nom varchar(50)
);

create table sanction(
	id_sanction int auto_increment primary key not null,
    raison varchar(50),
    date datetime default current_timestamp,
    duree int,
    commentaire text,
    id_type_sanction int,
    id_user int
);

create table type_sanction(
	id_type_sanction int auto_increment primary key not null,
    nom varchar(50)
);

alter table detenir
add constraint fk_detenir_anime
foreign key (id_anime)
references anime(id_anime); 

alter table detenir
add constraint fk_detenir_tag
foreign key (id_tag)
references tag(id_tag);

alter table avoir
add constraint fk_avoir_anime
foreign key (id_anime)
references anime(id_anime);

alter table avoir
add constraint fk_avoir_genre
foreign key (id_genre)
references genre(id_genre);

alter table disposer
add constraint fk_disposer_anime
foreign key (id_anime)
references anime(id_anime);

alter table disposer
add constraint fk_disposer_studio
foreign key (id_studio)
references studio(id_studio);

alter table episode
add constraint fk_episode_anime
foreign key (id_anime)
references anime(id_anime);

alter table retransmettre
add constraint fk_retransmettre_episode
foreign key (id_episode)
references episode(id_episode);

alter table retransmettre
add constraint fk_retransmettre_diffuseur
foreign key (id_diffuseur)
references diffuseur(id_diffuseur);

alter table diffuser
add constraint fk_diffuser_anime
foreign key (id_anime)
references anime(id_anime);

alter table diffuser
add constraint fk_diffuser_diffuseur
foreign key (id_diffuseur)
references diffuseur(id_diffuseur);

alter table commentaire
add constraint fk_commentaire_user
foreign key (id_user)
references user(id_user);

alter table commentaire
add constraint fk_commentaire_anime
foreign key (id_anime)
references anime(id_anime);

alter table voir
add constraint fk_voir_anime
foreign key (id_anime)
references anime(id_anime);

alter table voir
add constraint fk_voir_user
foreign key (id_user)
references user(id_user);

alter table user
add constraint fk_user_role
foreign key (id_role)
references role(id_role);

alter table lister
add constraint fk_lister_anime
foreign key (id_anime)
references anime(id_anime);

alter table lister
add constraint fk_lister_liste
foreign key (id_liste)
references liste(id_liste);

alter table liste
add constraint fk_liste_user
foreign key (id_user)
references user(id_user);

alter table partager
add constraint fk_partager_user
foreign key (id_user)
references user(id_user);

alter table partager
add constraint fk_partager_liste
foreign key (id_liste)
references liste(id_liste);

alter table proposition
add constraint fk_proposition_user
foreign key (id_user)
references user(id_user);

alter table proposition
add constraint fk_proposition_statut
foreign key (id_statut)
references statut(id_statut);

alter table sanction
add constraint fk_sanction_type_sanction
foreign key (id_type_sanction)
references type_sanction(type_sanction);

alter table sanction
add constraint fk_sanction_user
foreign key (id_user)
references user(id_user);