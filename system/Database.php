<?php
class Database
{

    /*    
    *   SET ATTRIBUTES FOR PDO CONNECTION
    */
    private $__attribute = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,
        PDO::ATTR_EMULATE_PREPARES =>  false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    /*
    *   CONNECTION INSTANCE
    */
    private $__conn;

    /*
    *   QUERY MESSAGE
    */
    private $__message = '';

    /*
    *   PREPARED QUERY ARRAY
    */
    private $__prepared;

    /*
    *   WHERE CONDITION ARRAY
    */
    private $__where_condition;

    /*
    *   SET DATA ARRAY
    */
    private $__set_data;

    /*
    *   DATABASE CONSTRUCTOR
    */
    function __construct()
    {
        global $config;
        try {
            $__db_host = empty($config['db']['host']) ? 'localhost' : $config['db']['host'];
            $__db_name = empty($config['db']['database']) ? 'scratch' : $config['db']['database'];
            $__db_user = empty($config['db']['user']) ? 'root' : $config['db']['user'];
            $__db_pass = empty($config['db']['password']) ? '' : $config['db']['password'];

            $__db_dns = empty($config['db']['dns']) ? "mysql:host=$__db_host; dbname=$__db_name;" : $config['db']['dns'];

            $this->__conn =  new PDO($__db_dns, $__db_user, $__db_pass, $this->__attribute);
            return true;
        } catch (PDOException $e) {
            echo 'Error' . $e->getMessage();
        }        
    }

    /*
    *
    *  USED TO RETURN PREPARED QUERY
    *
    */
    private function prepare_query()
    {
        return $this->__conn->prepare($this->__message);
    }

    /*
    *
    *   @param SELECT DATA
    *   @return OBJECT INSTANCE
    *
    */

    public function select($__select__data = "*")
    {
        $this->__message = "SELECT $__select__data ";
        return $this;
    }

    /*
    *
    *   @param TABLE NAME
    *   @return OBJECT INSTANCE
    *
    */
    public function from($__table)
    {
        $this->__message .= " FROM " . $__table;
        return $this;
    }

    /*
    *
    *   @param WHERE ARRAY OR KEY VALUE PAIR
    *   @return OBJECT INSTANCE
    *
    */
    public function where($__where__condition = null, $__value = false)
    {
        $__where__command = "";
        if (is_array($__where__condition)) {
            foreach (array_keys($__where__condition) as $__key)
                $__where__command .= $__where__command != '' ? " AND $__key = :$__key " : " $__key = :$__key ";
            $this->__where_condition = $__where__condition;
        } elseif ($__where__command && $__value) {
            $__where__command = ":$__where__condition = ':$__where__command'";
            $this->__where_condition = $__value;
        } else $__where__command = "1=1";

        $this->__message .= " WHERE $__where__command ";

        return $this;
    }

    /*
    *
    *   EXECUTES QUERY    
    *   @return OBJECT INSTANCE
    *
    */
    public function get()
    {
        $this->__prepared = $this->prepare_query();
        try {
            if ($this->__where_condition)
                $this->__prepared->execute($this->__where_condition);
            else $this->__prepared->execute();
        } catch (PDOException $e) {
            // echo "Error Message: $e";            
            return false;
        }
        return $this;
    }

    /*
    *
    *   TO RETURN RESULT IN ARRAY
    *   @return QUERY ALL RESULTS IN OBJECT ARRAY
    *
    */
    public function first_row()
    {
        return $this->__prepared->fetch(PDO::FETCH_OBJ);
    }

    /*
    *
    *   TO RETURN RESULT IN ARRAY
    *   @return QUERY ALL RESULTS IN OBJECT ARRAY
    *
    */
    public function result()
    {
        return $this->__prepared->fetchAll(PDO::FETCH_OBJ);
    }


    /*
    *
    *   TO RETURN RESULT IN ARRAY
    *   @return QUERY ALL RESULTS IN ASSOC ARRAY
    *
    */
    public function result_array()
    {
        return $this->__prepared->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    *
    *   @param TABLE NAME AND DELETE ARRAY    
    *
    */
    public function delete($__table, $__where__condition)
    {
        $this->__message = "DELETE FROM $__table ";
        $this->where($__where__condition);
        $this->__where_condition = $__where__condition;
        $this->get();
        return true;
    }

    /*
    *
    *   @param SET DATA FOR UPDATE QUERY
    *   @return OBJECT INSTANCE
    *
    */
    public function set($__set)
    {
        $__set_command = '';
        foreach (array_keys($__set) as $__key)
            $__set_command .= ($__set_command == "") ? ("`$__key` = :$__key") : (", `$__key` = :$__key");
        $this->__message = "SET $__set_command";
        $this->__set_data = $__set;
        return $this;
    }

    /*
    *
    *   @param TABLE NAME
    *   @return OBJECT INSTANCE
    *
    */
    public function update($__table)
    {
        $this->__message = "UPDATE $__table $this->__message";

        $this->__prepared = $this->prepare_query();

        if ($this->__set_data)
            foreach ($this->__set_data as $__key => $__value)
                $this->__prepared->bindValue(":$__key", $__value);
        if ($this->__where_condition)
            foreach ($this->__where_condition as $__key => $__value)
                $this->__prepared->bindValue(":$__key", $__value);

        try {
            $this->__prepared->execute();
        } catch (Exception $e) {
            return false;
        }
        return TRUE;
    }

    /*
    *
    *   @param TABLE NAME AND INSERT DATA
    *   @return TRUE FOR QUERY
    *
    */
    public function insert($__table, $__insert__data)
    {
        $this->__message = "INSERT INTO `$__table` (";

        if (is_array($__insert__data)) {
            $this->__message .= implode(",", array_keys($__insert__data));
            $this->__message .= ") VALUES (:";
            $this->__message .= implode(", :",  array_keys($__insert__data));
            $this->__message .= ");";
        }

        $this->__prepared = $this->prepare_query();

        foreach ($__insert__data as $__key => $__value)
            $this->__prepared->bindValue(":$__key", $__value);

        try {
            $this->__prepared->execute();
        } catch (Exception $e) {
            // echo "Error Message: $e";            
            return false;
        }

        return true;
    }

    /*
    *
    *   @param QUERY
    *   @return RESULT FOR THE QUERY
    *
    */
    public function query($__msg)
    {
        return $this->__conn->query($__msg);
    }
}
