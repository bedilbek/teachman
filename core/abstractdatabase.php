<?php
/**
 * Created by PhpStorm.
 * User: bedilbek
 * Date: 2/4/17
 * Time: 2:35 AM
 */

/**
 * Class AbstractDataBase
 */
    abstract class AbstractDataBase{
        private $mysqli;
        private $sq;
        private $prefix;

        /**
         * AbstractDataBase constructor.
         * Creating Abstract Database object with constructor initial values
         * @param $db_host      // as an example "localhost"
         * @param $db_user      // as an example "root"
         * @param $db_password  // as an example ""
         * @param $db_name      // as an example "school" Database
         * @param $sq           // as an example "?"
         * @param $prefix       // as an example "schl_"
         */
        protected function __construct($db_host, $db_user, $db_password, $db_name, $sq, $prefix)
        {
            $this->mysqli = @new mysqli($db_host,$db_user,$db_password, $db_name);
                if ($this->mysqli->connect_errno) exit("Error while connecting to DataBase");
                $this->sq = $sq;
                $this->prefix = $prefix;
                $this->mysqli->query("SET lc_time_names = `en_EN`");
                $this->mysqli->set_charset("utf-8");
        }
        /**
         * This function return $sq as it is private data member
         * @return mixed
         */
        public function getSQ(){
            return $this->sq;
        }


        /**
         * This function is to check for sql injection and protect the database from hacking
         * @param $query
         * This is sql statement with ? (symbols)
         * @param $params
         * This is array of parameters which should be replaced with ? (symbols)
         * @return mixed
         * Returns ready sql statement which can be executed
         */
        public function getQuery($query,$params){
            if ($params){
                //print_r($params);
                $offset = 0;
                $len_sq = strlen($this->sq);
                for ($i=0; $i<count($params); $i++){
                    $pos = strpos($query,$this->sq, $offset);
                    if (is_null($params[$i])) $arg = "NULL";
                    else $arg = "'".$this->mysqli->real_escape_string($params[$i])."'";
                    $query = substr_replace($query,$arg,$pos,$len_sq);
                    $offset = $pos+strlen($arg);
                }
            }
            return $query;
        }

        /**
         * This function is to get array of rows after finishing executing of sql statement
         * @param AbstractSelect $select
         * @return array|bool
         * On success returns array of rows
         * On failure return false
         */

        public function select(AbstractSelect  $select){
            $result_set = $this->getResultSet($select, true, true);
            if (!$result_set) return false;
            $array = array();
            while (($row = $result_set->fetch_assoc()) != false)
                $array[] = $row;
            return $array;
        }

        /**
         * This function is to return just one row of executed sql statement
         * @param AbstractSelect $select
         * @return array
         * returns just one row which also consist of multiple elements so that it will be regarded as array
         */
        public function selectRow(AbstractSelect $select){

            $result_set = $this->getResultSet($select, false, true);
            if (!$result_set) return false;
            return $result_set->fetch_assoc();
        }

        /**
         *This function is to return one column of data after executing of sql statement
         * @param AbstractSelect $select
         * @return array|bool
         * On success it returns corresponding to paramater one column of data entries
         * On failure it returns false
         */
        public function selectCol(AbstractSelect $select){
            $result_set = $this->getResultSet($select, true, true);
            if (!$result_set) return false;
            $array = array();
            while (($row = $result_set->fetch_assoc()) != false) {
                foreach ($row as $value) {
                    $array[] = $value;
                    break;
                }
            }
            return $array;
        }

        /**
         * This function is to select just one cell from the row after sql statement execution
         * @param AbstractSelect $select
         * @return bool/element
         * On success returns one element that corresponds to parameter that is given from the row
         * On failure returns false
         */
        public function selectCell(AbstractSelect $select){
            $result_set = $this->getResultSet($select, false, true);
            if (!$result_set) return false;
            $arr = array_values($result_set->fetch_assoc());
            return $arr[0];
        }

        /**
         * This function is to insert into corresponding table one row of data entries
         * @param $table_name
         * @param $row
         * associative array of data entries
         * @return bool
         * On success return true
         * On failure return false
         */
        public function insert($table_name, $row){
            if (count($row) == 0) return false;
            $table_name = $this->getTableName($table_name);
            $fields = "(";
            $values = "VALUES (";
            $params = array();
            foreach ($row as $key => $value) {
                $fields .= "`$key`,";
                $values .= $this->sq.",";
                $params[] = $value;
            }
            $fields = substr($fields, 0, -1);
            $values = substr($values, 0, -1);
            $fields .= ")";
            $values .= ")";
            $query = "INSERT INTO `$table_name` $fields $values";
            return $this->query($query, $params);
        }

        /**
         * This function is to update existing row data entries to corresponding
         * table in database with given row of data entries with optional parameters
         * @param $table_name
         * @param $row
         * associative array of data entries
         * @param bool $where
         * @param array $params
         * @return bool
         * On success return true
         * On failure return false
         */
        public function update($table_name, $row, $where=false, $params = array()){
            if (count($row) == 0) return false;
            $table_name = $this->getTableName($table_name);
            $query = "UPDATE `$table_name` SET ";
            $params_add = array();
            foreach ($row as $key => $value) {
                $query .= "`$key` = ".$this->sq.",";
                $params_add[] = $value;
            }
            $query = substr($query, 0, -1);
            if ($where) {
                $params = array_merge($params_add, $params);
                $query .= " WHERE $where";
            }
            return $this->query($query, $params);
        }

        /**
         * This function is to delete existing row data entries from corresponding
         * table in database with optional parameters
         * @param $table_name
         * @param bool $where
         * @param array $params
         * @return mixed
         */
        public function delete($table_name, $where = false, $params= array())
        {
            $table_name = $this->getTableName($table_name);
            $query = "DELETE FROM `$table_name`";
            if ($where) $query .= " WHERE $where";
            return $this->query($query, $params);

        }
        /**
         * This function is to return table name with its given prefix
         * @param $table_name
         * @return string
         */
        public function getTableName($table_name){
            return $this->prefix.$table_name;
        }

        /**
         * This private function executes the statement after getting passed sql
         * statement and parameters to getQuery function and
         * @param $query
         * @param bool $params
         * @return bool|mixed
         * On Success of UPDATE or INSERT returns true
         * On Sucess of INSERT returns id of that data entry row
         * On failure returns error
         */
        private function query($query, $params=false){
            $success = $this->mysqli->query($this->getQuery($query, $params));
            if (!$success) return false;
            if ($this->mysqli->insert_id === 0) return true;
            return $this->mysqli->insert_id;
        }

        /**
         * Execute SELECT STATEMENT and returns array of $result_set
         * @param AbstractSelect $select
         * @param $zero
         * @param $one
         * @return bool|mysqli_result
         * On Success returns array of $result_set
         * On Failure returns false
         */
        private function getResultSet(AbstractSelect $select, $zero, $one){
            $result_set = $this->mysqli->query($select);
            if (!$result_set) return false;
            if ((!$zero) && ($result_set->num_rows == 0)) return false;
            if ((!$one) && ($result_set->num_rows == 1)) return false;
            return $result_set;
        }

        /**
         * When object is deleted mysql DataBase connection will be closed
         */
        public function __destruct()
        {
            if (($this->mysqli) && (!$this->mysqli->connect_errno)) $this->mysqli->close();
        }
    }
?>

