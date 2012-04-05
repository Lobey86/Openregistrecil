openMairie Exemple
==================



_____________________________________________________________________________
Pre requis :
============
Vous devez avoir installer:
- un serveur apache et php
- une base de donnees : mysql ou postgresql
-----------------------------------------------------------------------------
Prerequisite :
============
You must have the following services installed :
- Apache server with php extension
- database server : mysql or postgresql
_____________________________________________________________________________
En fait, reportez vous aux installations de :
- sous windows : wamp (http://www.wampserver.com/)
                 ou easyphp(http://easyphp.fr/)
- sous linux : lamp

Si vous utilisez postgre sql, voir install sur le site :
http://www.postgresqlfr.org/

Si vous debutez, il est plus simple de garder mysql qui est packagee avec
easyphp ou wamp.
-----------------------------------------------------------------------------
you should report to the installations of :
- for windows : wamp (http://www.wampserver.com/)
                or easyphp(http://easyphp.fr/)
- for Linux : lamp

In case you use postgresql, you also have to install postgresql
(http://www.postgresqlfr.org/)

If you're new to all that, it'd be easier to keep mysql that comes
included in the easyphp or wamp package.
_____________________________________________________________________________
* Installation de openmairie_xxx  -> voir INSTALL.TXT
   copier le repertoire openmairie_xxx sur votre serveur
        wamp/www/openmairie_xxx
        sous linux (debian) : var/www/openmairie_xxx
-----------------------------------------------------------------------------
Install openmairie_xxx ->  see INSTALL.TXT
   copy the openmairie_xxx folder on your server
        wamp/www/openmairie_xxx
       for Linux (Debian) : var/www/openmairie_xxx
___________________________________________________________________________
* Initialisation de la base en MySQL ou Postgresql 
    creer la base openxxx sur mysql 
    Ensuite, il faut creer les tables de la base de donnees
    puis executer les scripts SQL suivants :
    - en mysql :
      data/mysql/init.sql
    - en pgsql
      data/pgsql/init.sql
----------------------------------------------------------------------------
 Initialize the MySQL or postgresql database
    create the openxxx database on mysql or pgsql
    Then, you have to create the database tables
    then execute the following SQL scripts :
    - for mysql :
    openmairie_recensement/data/mysql/init.sql
    - for pgsql
    openmairie_recensement/data/pgsql/init.sql
____________________________________________________________________________
* parametrer la connexion dans /dyn/database.inc.php

parametrage par defaut :
conn[1] est un tableau php qui contient les parametres de connexion suivants
    'titre => 'openxxx (mysql ou pgsql)',[parametrage openmairie]
    'phptype'  => 'mysql', ou 'pgsql' [ne pas changer parametrage dbpear]
    'dbsyntax' => '',[ne pas changer parametrage dbpear]
    'username' => 'root', [par defaut sur wamp easyphp ou lamp /
                           a voir avec le fournisseur d acces le cas echeant]
    'password' => '' [par defaut sur wamp easyphp ou lamp /
                        a voir avec le fournisseur d acces le cas echeant]
    'protocol' => '',
    'hostspec' => 'localhost', [nom de serveur par defaut wamp ou easyphp]
    'port'     => '',  [ne pas changer parametrage dbpear]
    'socket'   => '',  [ne pas changer parametrage dbpear]
    nom de la base => 'openxxx', [parametrage openmairie]
    format date par defaut =>'AAAA-MM-JJ' [[parametrage openmairie ne pas changer]
    shema => '' ou 'public' pour postgre
    prefixe => ''     
----------------------------------------------------------------------------------
setting up the connection in /dyn/database.inc.php

default settings :
conn[1] is a php array containing the following connection settings
    'titre => 'openxxx ',[openmairie setting]
    'phptype'  => 'mysql', or 'pgsql' [do not change dbpear setting]
    'dbsyntax' => '',[do not change dbpear setting]
    'username' => 'root', [default setting on wamp easyphp or lamp /
                           see with provider if needed]
    'password' => '' [default setting on wamp easyphp or lamp /
                           see with provider if needed]
    'protocol' => '',
    'hostspec' => 'localhost', [default server name for wamp or easyphp]
    'port'     => '',  [do not change dbpear setting]
    'socket'   => '',  [do not change dbpear setting]
    'dbname' => 'openxxx', [openmairie setting]
    'default date format' =>'AAAA-MM-JJ' [do not change openmairie setting]
    'shema' => '' ou 'public' for postgre
    'prefixe' => ''     
_________________________________________________________________________________
ATTENTION :
Ne pas oublier de faire une sauvegarde du repertoire /trs ou sont stockees toutes
les donnees numerisees (photos, arretes, autorisation ...)

Sous linux mettre les droits d ecriture 
Mise en place du logo 
----------------------------------------------------------------------------------
BE CAREFUL :
Do not forget to backup the folder /trs where are stored all the digital datas
(photos, pdf...)

On Linux, you have to set the "write" permissions (see 2.5)
Setting up the logo 
__________________________________________________________________________________
*  LOGIN PASSWORD [table om_utilisateur]
demo/demo
admin/admin
______________________________________________________________________________
* Parametage [setting] : /dyn
 dyn/var.inc
 dyn/config.inc.php
    activer descastiver  le mode demo
    [activate /desactivate]
    path des librairies utilisees [path libraries]
    theme jquery
________________________________________________________________________
* Libraries : javascript (js), php, sql, translation

 - js
 externals : lib/  (jquery,tinymce,openlayer ...)
 internals : js/
 
 - php
 externals: php/ (openMairie, pear, fpdf)
 internals: scr/ (screen / ecrans)
            spg/ (sous progr generique : combo, upload, localization, rvb ...)
            trt/ (treatment)
            gen/ (generator)
            obj/ objet métier

 - sql      data/ ... initialization
            sql/ ...       

 translation : /locales
 
[documentation] =======================
toute la documentation sur :
[All the documentation] on:
http://www.openmairie.org
=======================================


[authors] ================================
Francois Raynaud <contact@openmairie.org>
Jean-Louis Bastide <jlb@ville-arles.fr>
==========================================
