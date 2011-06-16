<?php
//$Id$ 
//gen openMairie le 06/04/2011 08:50 
include('../gen/sql/pgsql/om_sig_point.form.inc.php');
$sql_geometry = "select f_table_name,(f_table_name||' '||srid) as lib from geometry_columns ";
$sql_geometry_champ = "select f_geometry_column,(f_table_name||' '||f_geometry_column) as lib from geometry_columns ";
?>