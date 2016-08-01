<?php	 	 
function check_my_table_exists() {	 	 
   // Benötigt zum Verwenden der WordPress Datenbank Funktionen	 	 
   require_once(ABSPATH . '/wp-admin/includes/upgrade.php');	 	 
 
   // das globale WordPress Datenbank Objekt	 	 
   global $wpdb;	 	 
 	 	 
   // der neue Tabellenname inklusive WordPress Tabellen Präfix	 	 
   $my_table_name = $wpdb->prefix . 'my_table_name';	 	 
   
   // überprüfen ob die Tabelle schon existiert	 	 
   if($wpdb->get_var("SHOW TABLES LIKE '$my_table_name'") != $my_table_name) {	 	 
 	 	 
      // Charset festlegen, wenn noch nicht vorhanden	 	 
      if(!empty($wpdb->charset)) {	 	 
         $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";	 	 
      }
	 	 
      // Collate festlegen, wenn noch nicht vorhanden	 	 
      if(!empty($wpdb->collate)) {	 	 
         $charset_collate .= " COLLATE $wpdb->collate";	 	 
      }	 	 
 
      // SQL Query erzeugen	 	 
      $sql = "CREATE TABLE " . $my_table_name . " (	 	 
         'id' bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,	 	 
         'wunsch' longtext NOT NULL,	 	 
         'erhalten' boolean DEFAULT 0,	 	 
         PRIMARY KEY ('id') 	 	 
      ) $charset_collate;";	 	 
 
      // SQL Query via WordPress dbDelta ausführen	 	 
      dbDelta($sql);	 	 
   }	 	 
}	 	 

// beim Aktivieren des Plugins ausführen (WordPress-Hook)	 	 
register_activation_hook(__FILE__, 'check_my_table_exists');	 	 
?>
