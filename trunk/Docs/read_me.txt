ATM MUSIC

A lire dans le cas d'une installation.

Cr�ez deux bases de donn�es dans phpmyadmin nomm�es respectivement lif4 et clem
et changez les informations relatives a la connection � phpmyadmin dans le fichier :
		atm-music/application/config/database.php
		
		
Voici la portion de code que vous devriez voir et qu'il vous faudra modifier pour votre utilisation
		'mysql' => array(
			'driver'   => 'mysql',
			'host'     => 'localhost',
			'database' => 'lif4',
			'username' => 'root',
			'password' => '',
			'charset'  => 'utf8',
			'prefix'   => '',
		),

		'clem' => array(
			'driver'   => 'mysql',
			'host'     => 'localhost',
			'database' => 'clem',
			'username' => 'root',
			'password' => '',
			'charset'  => 'utf8',
			'prefix'   => '',
			
		),
/!\ ATTENTION /!\
Nous avons utilis� le module de r��criture d'URL d'Apache. Donc, il faut activer le mod rewrite, sans quoi
l'application ne fonctionnera pas!

		ATM-Music 2013
		RA
		BT