drop table if exists adminPlaylist;
drop table if exists songPlaylist;
drop table if exists songKind;
drop table if exists songAlbum;
drop table if exists com;
drop table if exists album;
drop table if exists band;
drop table if exists playlist;
drop table if exists song;
drop table if exists kind;
drop table if exists user_lif;



create table `user_lif`
(
  `id_user_lif` int(10) unsigned not null unique auto_increment,
    `username_user_lif` varchar(10) not null unique,
    `password_user_lif` varchar(60) not null,
  `last_name_user_lif` varchar(40) not null,
  `first_name_user_lif` varchar(40) not null,
  `date_creation` timestamp default current_timestamp,
  `appliLog` varchar(10) not null,
  primary key (`id_user_lif`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table `kind` 
(
  `name_kind` varchar(50) not null unique,
  primary key (`name_kind`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table `song` 
(
  `id_song` int(10) unsigned not null unique auto_increment,
  `id_user_lif` int(10) unsigned not null,
  `title_song` varchar(100) not null,
  `date_song` int(4),
  `length_song` varchar(4),
  `path_song` varchar(80),
  `track_song` int(2),
  primary key (`id_song`),
  foreign key(`id_user_lif`) REFERENCES user_lif(`id_user_lif`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table `com` 
(
  `id_com` int(10) unsigned not null unique auto_increment,
  `id_user_lif` int(10) unsigned not null,
  `id_song` int(10) unsigned not null,
  `vote_com` int(1),
  `content_com` varchar(255),
  primary key (`id_com`),
  foreign key(`id_user_lif`) REFERENCES user_lif(`id_user_lif`),
  foreign key(`id_song`) REFERENCES song(`id_song`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table `playlist` 
(
  `id_playlist` int(10) unsigned not null unique auto_increment,
  `name_playlist` varchar(80) not null,
  `date_creation_playlist` timestamp default current_timestamp,
  primary key (`id_playlist`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table `songPlaylist` 
(
  `id_playlist` int(10) unsigned not null ,
  `id_song` int(10) unsigned not null,
  `id_user_lif` int(10) unsigned not null,
  `date_added` timestamp default current_timestamp,
  primary key (`id_playlist`,id_song),
  foreign key(`id_playlist`) REFERENCES playlist(`id_playlist`),
  foreign key(`id_song`) REFERENCES song(`id_song`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table `band` 
(
  `id_band` int(10) unsigned not null unique auto_increment ,
  `id_user_lif` int(10) unsigned not null,
  `name_band` varchar(80) not null,
  `date_form_band` int(4),
  `date_disband_band` int(4),  
  primary key (`id_band`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table `album` 
(
  `id_album` int(10) unsigned not null unique auto_increment,
  `id_user_lif` int(10) unsigned not null,
  `id_band` int(10) unsigned not null,
  `name_album` varchar(80) not null,
  `date_prod_album` int(4),
  primary key (`id_album`),
  foreign key(`id_user_lif`) REFERENCES user_lif(`id_user_lif`),
  foreign key(`id_band`) REFERENCES band(`id_band`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table `songAlbum` 
(
  `id_song` int(10) unsigned not null ,
  `id_album` int(10) unsigned not null,
  primary key (`id_song`,`id_album`),
  foreign key(`id_song`) REFERENCES song(`id_song`),
  foreign key(`id_album`) REFERENCES album(`id_album`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




create table `adminPlaylist` 
(
  `id_user_lif` int(10) unsigned not null,
  `id_playlist` int(10) unsigned not null,
  `code_admin` char not null, 
  primary key (`id_user_lif`,`id_playlist`),
  foreign key (`id_user_lif`) REFERENCES user_lif(`id_user_lif`),
  foreign key (`id_playlist`) REFERENCES playlist(`id_playlist`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table `songKind` 
(
  `id_song` int(10) unsigned not null,
  `name_kind` varchar(50) not null,
  primary key (`id_song`,`name_kind`),
  foreign key (`id_song`) REFERENCES song(`id_song`),
  foreign key (`name_kind`) REFERENCES kind(`name_kind`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;





insert into user_lif values (0,'babs','$1$we1.3d5.$ZBETx580BnzoZ6TncMnSd0 ','Thouverez','Bastien','','');
insert into user_lif values (1,'tiago','$1$Ao..JN4.$LNOReeYIbI7PVsAxvaKax0','Adriano','Rémi','','');
insert into user_lif values (2,'user','$1$w23.3v..$kv8dljt4og2CFZWw3gBmn0','Marley','Bob','','');
insert into user_lif values (3,'admin','$1$8D0.vY5.$Hj4oR.DzKaKX1.INjdHSw/','Juste','Dieu','','');


insert into band values(1,1,'Koja','2007','2012');
insert into band values(2,1,'KoRn','2012','2012');
insert into band values(3,3,'Bob Marley','1945','1981');
insert into band values(4,1,'Sinsémiia','1996','2010');
insert into band values(5,1,'Trivium','2001','');
insert into band values(6,2,'Dub Inc','1998','');
insert into band values(7,2,'Damian Marley','1996','');


insert into kind values ('Reggae');
insert into kind values ('Rock\'n\'Roll');
insert into kind values ('K-pop');
insert into kind values ('Grunge');
insert into kind values ('Ska');
insert into kind values ('RnB');
insert into kind values ('Rap');
insert into kind values ('Metal');


insert into album values (1, 1, 2, 'Untouchables', '2002');
insert into album values (2, 1, 2, 'Life is peachy', '1996');
insert into album values (3, 1, 5, 'Ascendancy', '2005');
insert into album values (4, 3, 3, 'Kaya', '1978');
insert into album values (5, 1, 4, 'Première récolte', '1996');
insert into album values (6, 1, 4, 'Résistances', '1998');
insert into album values (7, 2, 6, 'Dans le décor', '2000');
insert into album values (8, 2, 7, 'Welcome to Jamrock', '2002');


insert into song values (1, 1, 'Hollow life', '2002', '1\'45', 'Hollow life.mp3', 1);
insert into song values (2, 1, 'Shoot and ladders', '2002', '2\'52', 'Shoot and ladders.mp3', 2);
insert into song values (3, 1, 'Did my time', '2002', '1\'12', 'Did my time.mp3', 6);
insert into song values (4, 1, 'Alone I Break', '2002', '3\'54', 'Alone I Break.mp3', 5);
insert into song values (5, 1, 'Whats wrong', '1996', '2\'41', 'What\'s wrong.mp3', 8);
insert into song values (6, 1, 'The deceived', '2005', '1\'36', 'The deceived.mp3', 1);
insert into song values (7, 1, 'Rain', '2005', '3\'51', 'Rain.mp3', 5);
insert into song values (8, 2, 'Rude Boy', '2000', '8\'45', 'Rude Boy.mp3', 1);
insert into song values (9, 2, 'My Freestyle', '2000', '6\'41', 'My Freestyle.mp3', 5);
insert into song values (10, 2, 'Road to Zion', '2002', '2\'38', 'Road to Zion.mp3', 7);
insert into song values (11, 2, 'Give dem some ways', '2002', '2\'59', 'Give dem some ways.mp3', 12);
insert into song values (12, 2, 'Beautiful', '2002', '3\'00', 'Beautiful.mp3', 5);
insert into song values (13, 3, 'Redemption song', '1978', '1\'28', 'Redemption song.mp3', 9);
insert into song values (14, 3, 'Is this love', '1978', '2\'54', 'Is this love.mp3', 8);


insert into playlist values (1, 'playlist du babs', '2012');
insert into playlist values (2, 'playlist de tiago', '2011');
insert into playlist values (3, 'playlist de dieu', '2010');




insert into songkind values (1, 'Metal');
insert into songkind values (2, 'Metal');
insert into songkind values (3, 'Metal');
insert into songkind values (4, 'Metal');
insert into songkind values (5, 'Reggae');
insert into songkind values (6, 'Metal');
insert into songkind values (7, 'Metal');
insert into songkind values (8, 'Reggae');
insert into songkind values (9, 'Reggae');
insert into songkind values (10, 'Reggae');
insert into songkind values (11, 'Reggae');
insert into songkind values (12, 'Reggae');
insert into songkind values (13, 'Reggae');
insert into songkind values (14, 'Reggae');


insert into songalbum values (1, 1);
insert into songalbum values (2, 1);
insert into songalbum values (3, 1);
insert into songalbum values (4, 1);
insert into songalbum values (5, 5);
insert into songalbum values (6, 3);
insert into songalbum values (7, 3);
insert into songalbum values (8, 7);
insert into songalbum values (9, 7);
insert into songalbum values (10, 8);
insert into songalbum values (11, 8);
insert into songalbum values (12, 8);
insert into songalbum values (13, 4);
insert into songalbum values (14, 4);

