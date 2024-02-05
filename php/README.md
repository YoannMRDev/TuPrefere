# Projet de démonstration

Ce projet est une coquille vide destinée aux élève du CFPT informatique. Son but est de montrer comment créer une structure de projet PHP professionnelle, utilisant composer.

Il se compose des éléments suivants:

- ``` public ```: ce dossier est celui servi par Apache. Il contient un fichier index.php qui sert de point d'entrée à l'application, toutes les urls sont redirigées sur ce fichier. C'est dans ce dossier que viendront s'ajouter les images, fichiers css et js;
- ``` routes ```: ce dossier contient un fichier ``` web.php ``` qui définit les routes de l'application;
- ``` src ```: ce dossier contiendra toutes les sources de votre application. Pour la démonstration il ne contient qu'un dossier ``` Controllers ```;
- fichier ``` .gitignore ```: ce fichier sert à indiquer à git les éléments qu'il doit ignorer (ici le dossier vendor et le fichier coposer.lock);
- ``` composer.json ```: le fichier de configuration de composer pour ce projet. Il contient des informations sur le projet et ses dépendances;
- ``` README.md ```: le présent fichier

## Installation

Cloner le projet, vous rendre dans le dossier racine, puis lancer la commande suivante:

```
composer install
```

Les dépendances du projet sont installées et vous verrez apparaitre un dossier ``` vendor ``` ainsi qu'un fichier ``` composer.lock ``` à la racine du projet.

Vous pouvez maintenant naviguer sur les 2 urls du projet:
- ``` / ```: la page d'accueil
- ``` /test/show ```: une page de test, il est possible d'ajouter un paramètre à cette url, essayez par exemple ``` /test/show/{votre nom} ```

## Dépendance

Ce projet utilise une unique dépendance, un router PHP nommé [simple-php-router](https://github.com/skipperbent/simple-php-router) qui s'occupe de gérer le routing.

Le projet original n'ayant plus l'air maintenu, ce squelette se base sur le fork réalisé par [DeveloperMarius](https://github.com/DeveloperMarius/simple-php-router), qui est compatible avec PHP 8.1.

## Lancer le serveur

Le projet peut être testé de 2 manières : avec le serveur web integré à PHP, ou avec Apache2

### Serveur web integré

Pour lancer le serveur web integré à PHP, placez-vous à la racine du projet puis :

```
cd public # Se déplacer dans le dossier public du projet
php -S localhost:8080 # Démarrez le serveur, le site est accessible depuis http://localhost:8080
```

### Apache2

Pour tester le projet depuis Apache2, il faut d'abord activer le module mod_rewrite d'Apache :

```
sudo a2enmod rewrite
sudo service apache2 restart
```

Il faut ensuite créer un nouveau vhost dans Apache2 :

```
sudo touch /etc/apache2/sites-available/demophp.cfpt.conf
```

Copiez ensuite le contenu ci-dessous dans le fichier nouvellement créé :

```
<VirtualHost *:80>
	ServerName demophp.cfpt.loc

	ServerAdmin webmaster@localhost
	DocumentRoot /var/www/html/demophp/public

	<Directory /var/www/html/demophp/public>
	    Options -Indexes +FollowSymLinks
	    AllowOverride All
	</Directory>

	ErrorLog ${APACHE_LOG_DIR}/demophp.cfpt.loc-error.log
	CustomLog ${APACHE_LOG_DIR}/demophp.cfpt.loc-access.log combined
</VirtualHost>
```

Veillez à adapter le nom du fichier (ici demophp.cfpt.conf) de l'url du site (ici demophp.cfpt.loc) et du chemin vers le projet (ici /var/www/html/demophp/public) à vos besoins !

Vérifiez que vous n'avez pas d'erreur de syntaxe :

```
sudo apache2ctl -t
```

Avant d'activer le vhost :

```
sudo a2ensite demophp.cfpt.conf
sudo service apache2 restart
```

Le vhost est maintenant activé, il reste à rendre disponible l'url depuis Windows :

1. ouvrez le bloc notes **en mode administrateur** ;
2. ouvrez le fichier ```C:\Windows\System32\drivers\etc\hosts``` (le fichier n'a pas d'extension) ;
3. copiez les 2 lignes suivantes, en prenant soin de faire correspondre l'url avec celle de votre vhost :
```
127.0.0.1       demophp.cfpt.loc
::1             demophp.cfpt.loc
```
Votre site est maintenant accessible.