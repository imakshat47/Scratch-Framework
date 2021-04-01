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
     * @param TABLE NAME, SELECT DATA, WHERE CONDITION (OPTIONAL)
     * @return QUERY RESULT
     *
     */
    protected function fetch_all($table_name, $select_data = '*', $where_condition = null, $order_by = null)
    {
        $this->db
            ->select($select_data)
            ->from($table_name)
            ->where($where_condition);
        if ($order_by)
            $this->db->order_by($order_by['by'], $order_by['order']);
        return $this->db->get()->result_array();
    }


    /**
     *
     * @param TABLE NAME, SELECT DATA, WHERE CONDITION (OPTIONAL)
     * @return QUERY RESULT 
     *
     */
    protected function fetch_row($table_name, $select_data = '*', $where_condition = null)
    {
        return $this->db->select($select_data)->from($table_name)->where($where_condition)->get()->result();
    }

    /**
     *
     * @param TABLE NAME, SELECT DATA, WHERE CONDITION (OPTIONAL)
     * @return QUERY RESULT 
     *
     */
    protected function fetch($table_name, $select_data = '*', $where_condition = null)
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
        if (empty($this->fetch_all($table_name, '*', $where_condition)))
            return false;
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
        return $this->db->set($set_data)->where($where_condition)->update($table_name);
    }
}
