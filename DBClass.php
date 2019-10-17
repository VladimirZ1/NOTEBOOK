<?php

class DBClass
{
	private $server, $user, $pass, $dbname, $db;

	function __construct($server, $user, $pass, $dbname) {
		$this->server = $server;
		$this->user = $user;
		$this->pass = $pass;
		$this->dbname = $dbname;
        $this->openConnection();
	}

	public function openConnection() {  
    	
		if ( $this->db )  {
			return true;
		}  
            	
        $mysqli = new mysqli($this->server, $this->user, $this->pass, $this->dbname);
         
		if ( $mysqli->connect_error )  {  
       		return false;  
        }  
        
        $this->db = $mysqli;
        $this->db->query("SET lc_time_names = 'ru_RU'");
        $this->db->query("SET NAMES 'utf8'");

	    return true; 
    }

    public function select($what, $from, $where = null, $order = null) {
        $fetched = array();         
        $sql = 'SELECT '.$what.' FROM '.$from;  

        if ($where != null) $sql .= ' WHERE '.$where;  
        if ($order != null) $sql .= ' ORDER BY '.$order;  
 
        $query = $this->db->query($sql);  
        if ($query) {  
            $rows = $query->num_rows;  

            for($i = 0; $i < $rows; $i++) {  
                $results = $query->fetch_assoc();  
                $key = array_keys($results);
                $numKeys = count($key);

                for($x = 0; $x < $numKeys; $x++) { 
                    $fetched[$i][$key[$x]] = $results[$key[$x]];                           
                }                                          
            } 
            return $fetched; 
        } else {  
            return false;  
        }    

    }
    public function insert($table,$values,$rows = null)  {  
 
        $insert = 'INSERT INTO '.$table;  
        
        if($rows != null) {  
                $insert .= ' ('.$rows.')';  
        }  
        
        $numValues = count($values);
        for($i = 0; $i < $numValues; $i++)  {  
            if(is_string($values[$i])) {
                $values[$i] = '"'.$values[$i].'"';
            }
        }  
        
        $values = implode(',',$values);  
        $insert .= ' VALUES ('.$values.')';  
        $ins = $this->db->query($insert);
        return ($ins) ? true : false;
 
    }
    public function closeConnection() {
    	if ( $this->db ) { 
    		$this->db->close();
    		$this->db = null;
    	} 
    }

    function __destruct() {
    	if ( $this->db ) { 
     		$this->db->close();
    	} 
    }
}

?>