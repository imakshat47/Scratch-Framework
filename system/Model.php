<?php

// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// SCRATCH PHP FRAMEWORK
// --------------------------------------------------------------------

class Model
{
    /*** MODEL CONSTRUCTS:
     * DATABASE INSTANCE
     */
    function __construct()
    {
        /** DATABASE INSTANCE */
        $this->db = new Database();
    }

    /**
     *
     * @param TABLE NAME, INSERT DATA
     * @return QUERY RESULT
     *
     */
    protected function insert_row($table_name, $insert_data)
    {
        return $this->db->insert($table_name, $insert_data);
    }

    /**
     *
     * @param TABLE NAME, WHERE CONDITION (OPTIONAL), SELECT DATA (OPTIONAL), GROUP BY (OPTIONAL), ORDER BY (OPTIONAL)
     * @return QUERY RESULT
     *
     */
    protected function fetch_array($table_name, $where_condition = null, $select_data = '*', $group_by = false, $order_by = false)
    {
        $this->db
            ->select($select_data)
            ->from($table_name)
            ->where($where_condition);
        if ($group_by)
            $this->db->group_by($group_by);
        if ($order_by)
            $this->db->order_by($order_by);
        return $this->db->get()->result_array();
    }


    /**
     *
     * @param TABLE NAME, WHERE CONDITION (OPTIONAL), SELECT DATA (OPTIONAL), GROUP BY (OPTIONAL), ORDER BY (OPTIONAL)
     * @return QUERY RESULT 
     *
     */
    protected function fetch_row($table_name, $where_condition = null, $select_data = '*', $group_by = false, $order_by = false)
    {
        $this->db->select($select_data)->from($table_name)->where($where_condition);
        if ($group_by)
            $this->db->group_by($group_by);
        if ($order_by)
            $this->db->order_by($order_by);
        return $this->db->get()->result();
    }

    /**
     *
     * @param TABLE NAME, WHERE CONDITION (OPTIONAL), SELECT DATA (OPTIONAL)
     * @return QUERY RESULT 
     *
     */
    protected function fetch($table_name, $where_condition = null, $select_data = '*')
    {
        return $this->db->select($select_data)->from($table_name)->where($where_condition)->get()->first_row();
    }


    /**
     *
     * @param TABLE NAME, WHERE CONDITION
     * @return QUERY RESULT
     *
     */
    protected function delete_row($table_name, $where_condition)
    {
        return $this->db->delete($table_name, $where_condition);
    }

    /**
     *
     * @param TABLE NAME, SET DATA, WHERE CONDITION
     * @return QUERY RESULT
     *
     */
    protected function update_row($table_name, $set_data, $where_condition)
    {
        if ($this->db->set($set_data)->where($where_condition)->update($table_name))
            return true;
        return false;
    }

    /** is row: REturns number of row count
     * @param TableName String, Required
     * @param WhereCondition Array / String, Default Null
     * @param SelectData String / Array, Default = '*' 
     */
    protected function is_row($table_name, $where_condition = Null, $select_data = '*')
    {
        return $this->db->select($select_data)->from($table_name)->where($where_condition)->get()->count();
    }
}
