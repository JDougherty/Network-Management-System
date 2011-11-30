<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Idb_model extends CI_Model
{
 	function __construct()
    {
        parent::__construct();
    }
	
	// http://stackoverflow.com/questions/1252868/mysql-programmatically-remove-all-foreign-keys/3003121#3003121
	function drop_fks()
	{
		$db = return_db();
		$db = $db['default'];
		
		$link = mysql_connect($db['hostname'], $db['username'], $db['password']) or die('Could not connect: ' . mysql_error());
		
		$test = $db['database'];
		mysql_select_db($db['database'], $link) or die('Could select database: ' . mysql_error());
	
		$result = mysql_query("SELECT DISTINCT table_name, constraint_name FROM information_schema.key_column_usage"
			. " WHERE constraint_schema = '$db[database]' AND referenced_table_name IS NOT NULL");
		
		while($row = mysql_fetch_assoc($result))
		{
			mysql_query("ALTER TABLE `$row[table_name]` DROP FOREIGN KEY `$row[constraint_name]`", $link) or die('Could not drop fks: ' . mysql_error());
		}
		
		mysql_free_result($result);
		mysql_close($link);
	}
    
	// Can drop tables in any order since we drop FKs first
	function drop_tables()
	{
		$this->drop_fks();
	
		$sql = "DROP TABLE IF EXISTS
				`devices`";
				
		$result = $this->db->query($sql);
		return $result;
	}
	
	function create_devices()
	{
		$sql = 	"CREATE TABLE IF NOT EXISTS `devices` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `label` varchar(128) NOT NULL,
				  `host` varchar(128) NOT NULL,
				  `community` varchar(128) NOT NULL,
				  PRIMARY KEY (`id`)
				 ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
	
		$result = $this->db->query($sql);
		return $result;
	}
}
/* End of file idb_model.php */
/* Location: ./app/models/idb_model.php */