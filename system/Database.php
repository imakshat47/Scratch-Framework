<?php

// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// SCRATCH PHP FRAMEWORK
// --------------------------------------------------------------------

class Database
{

    /*** SET ATTRIBUTES FOR PDO CONNECTION
     * ERROR MODE
     * ATTRIBUTE CASE
     * EMPTY / NULL STRINGS
     * RESULT FETCH MODE
     */
    private $__attribute = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,
        PDO::ATTR_EMULATE_PREPARES =>  false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    /**
     * CONNECTION INSTANCE
     */
    private $__conn;

    /**
     * QUERY MESSAGE
     */
    private $__message = '';

    /**
     * PREPARED QUERY ARRAY
     */
    private $__prepared;

    /**
     * WHERE CONDITION ARRAY
     */
    private $__where_condition;

    /**
     * SET DATA ARRAY
     */
    private $__set_data;

    /*** DATABASE CONSTRUCTOR
     * COONECTS WITH DATABASE FROM CONFIG FILE
     * OR RETURNS EXCEPTION
     */
    function __construct()
    {
        try {
            global $config;

            $__db_host = empty($config['DB']['db_host']) ? 'localhost' : $config['DB']['db_host'];
            $__db_name = empty($config['DB']['db_name']) ? '' : $config['DB']['db_name'];

            $__db_user = empty($config['DB']['db_user']) ? 'root' : $config['DB']['db_user'];
            $__db_pass = empty($config['DB']['db_pass']) ? '' : $config['DB']['db_pass'];

            $__db_dns = empty($config['DB']['db_dns']) ? "mysql:host=$__db_host; dbname=$__db_name;" : $config['DB']['db_dns'];

            $this->__conn =  new PDO($__db_dns, $__db_user, $__db_pass, $this->__attribute);
            return true;
        } catch (PDOException $__err) {
            __error($__err->getMessage(), $__err);
        }
    }

    function __destruct()
    {
        $this->__message = '';
        $__prepared = Null;
        $__where__condition = Null;
        $this->__set_data = Null;
    }

    /**
     *
     *  USED TO RETURN PREPARED QUERY
     *
     */
    private function prepare_query()
    {
        return $this->__conn->prepare($this->__message);
    }

    /**
     *
     * @param SELECT DATA
     * @return OBJECT INSTANCE
     *
     */
    public function select($__select__data = "*")
    {
        if (is_array($__select__data))
            $__select__data = implode(' , ', $__select__data);
        $this->__message = "SELECT $__select__data ";
        return $this;
    }

    /**
     *
     * @param TABLE NAME
     * @return OBJECT INSTANCE
     *
     */
    public function from($__table)
    {
        $this->__message .= " FROM $__table ";
        return $this;
    }

    /**
     *
     * @param WHERE ARRAY OR KEY VALUE PAIR
     * @return OBJECT INSTANCE
     *
     */
    public function where($__where__condition = null, $__value = false)
    {
        if ($__where__condition == null)
            return $this;
        $__where__command = "";
        if (is_array($__where__condition)) {
            foreach (array_keys($__where__condition) as $__key) {
                $__where__command .= $__where__command != '' ? " AND `$__key` = :$__key " : " `$__key` = :$__key ";
            }
            $this->__where_condition = $__where__condition;
        } elseif ($__where__command && $__value) {
            $__where__command = ":$__where__condition = ':$__where__command'";
            $this->__where_condition = $__value;
        } else $__where__command = "1=1";
        $this->__message .= " WHERE $__where__command ";
        return $this;
    }

    /**
     *
     * @param LIMIT $__limit
     * @param OFFSET $__offset
     * @return OBJECT INSTANCE
     *
     */
    public function limit($__limit, $__offset)
    {
        $this->__message .= " LIMIT $__limit OFFSET $__offset";
        return $this;
    }


    /**
     *
     * @param Array $__group_by     
     * @param String $__group
     * @return OBJECT INSTANCE
     *
     */
    public function group_by($__group_by)
    {
        if (is_array($__group_by))
            $__group_by = implode(',', $__group_by);
        $this->__message .= " GROUP BY $__group_by ";
        return $this;
    }

    /**
     *
     * @param Array $__order_by     
     * @param String $__order
     * @return OBJECT INSTANCE
     *
     */
    public function order_by($__order_by, $__order = "desc")
    {
        if (is_array($__order_by))
            foreach ($__order_by as  $__key => $__val)
                $this->__message .= " ORDER BY $__key $__val";
        else
            $this->__message .= " ORDER BY $__order_by $__order";
        return $this;
    }

    /**
     *
     * EXECUTES QUERY    
     * @return OBJECT INSTANCE
     *
     */
    public function get()
    {
        try {
            $this->__prepared = $this->prepare_query();
            if ($this->__where_condition)
                $this->__prepared->execute($this->__where_condition);
            else $this->__prepared->execute();
        } catch (PDOException $__err) {
            return __error($__err->getMessage(), $__err);
        }
        return $this;
    }

    /**
     *
     * TO RETURN RESULT IN ARRAY
     * @return QUERY FIRST ROW RESULT IN OBJECT ARRAY
     *
     */
    public function first_row()
    {
        return $this->__prepared->fetch(PDO::FETCH_OBJ);
    }

    /**
     *
     * TO RETURN RESULT IN ARRAY
     * @return QUERY ALL RESULTS IN OBJECT ARRAY
     *
     */
    public function result()
    {
        return $this->__prepared->fetchAll(PDO::FETCH_OBJ);
    }


    /**
     *
     * TO RETURN RESULT IN ARRAY
     * @return QUERY ALL RESULTS IN ASSOC ARRAY
     *
     */
    public function result_array()
    {
        return $this->__prepared->fetchAll(PDO::FETCH_ASSOC);
    }


    /** Set: Set Variables for Update Query    
     * @param Array / String $__set
     * @param String $__value
     * @return OBJECT $this
     */
    public function set($__set, $__value = null)
    {
        if ($__value == null) {
            $__set_command = " ";
            foreach (array_keys($__set) as $__key)
                $__set_command .= ($__set_command != " ") ? ", `$__key` = :$__key " : " `$__key` = :$__key ";
            $this->__set_data = $__set;
            $this->__message = "SET $__set_command";
        } else {
            $this->__set_data = $__value;
            $this->__message = "SET `$__set` = :$__value";
        }
        return $this;
    }

    public function count()
    {
        return $this->__prepared->rowCount();
    }

    /**
     *
     * @param TABLE NAME AND DELETE ARRAY    
     *
     */
    public function delete($__table, $__where__condition)
    {
        $this->__message = "DELETE FROM $__table ";
        $this->where($__where__condition);
        $this->__where_condition = $__where__condition;
        if ($this->get())
            return $this->count();
        return false;
    }

    /**
     *
     * @param TABLE NAME
     * @return OBJECT INSTANCE
     *
     */
    public function update($__table)
    {
        $this->__message = "UPDATE $__table $this->__message;";
        try {
            $this->__prepared = $this->prepare_query();
            if ($this->__set_data)
                foreach ($this->__set_data as $__key => $__value)
                    $this->__prepared->bindValue(":$__key", $__value);
            if ($this->__where_condition)
                foreach ($this->__where_condition as $__key => $__value)
                    $this->__prepared->bindValue(":$__key", $__value);
            $this->__prepared->execute();
        } catch (Exception $__err) {
            return __error($__err->getMessage(), $__err);
        }
        return $this->__prepared->rowCount();
    }

    /**
     *
     * @param TABLE NAME AND INSERT DATA
     * @return TRUE FOR QUERY
     *
     */
    public function insert($__table, $__insert__data)
    {
        $this->__message = "INSERT INTO `$__table` (";

        try {

            if (is_array($__insert__data)) {
                $this->__message .= implode(",", array_keys($__insert__data));
                $this->__message .= ") VALUES (:";
                $this->__message .= implode(", :",  array_keys($__insert__data));
                $this->__message .= ");";
            }

            $this->__prepared = $this->prepare_query();

            foreach ($__insert__data as $__key => $__value)
                $this->__prepared->bindValue(":$__key", $__value);

            $this->__prepared->execute();
        } catch (Exception $__err) {
            return __error($__err->getMessage(), $__err);
        }
        return true;
    }

    /**
     *
     * @param QUERY
     * @return RESULT FOR THE USER DEFINED-QUERY
     *
     */
    public function query($__msg)
    {
        if ($this->__conn->query($__msg))
            return true;
        return false;
    }
}
