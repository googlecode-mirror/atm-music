ATM MUSIC

A lire dans le cas d'une installation.

Créez deux bases de données dans phpmyadmin nommées respectivement lif4 et clem
et changez les informations relatives a la connection à phpmyadmin dans le fichier :
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
		
		

		ATM-Music 2013
		RA
		BT