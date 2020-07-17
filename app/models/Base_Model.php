<?php
class Base_Model
{
    function __construct()
    {
        /* DATABASE INSTANCE */
        $this->db = new DB();
    }

    /*
    *
    *   @param TABLE NAME, INSERT DATA
    *   @return QUERY RESULT
    *
    */
    private function insert_row($table_name, $insert_data)
    {
        return $this->db->insert($table_name, $insert_data);
    }

    /*
    *
    *   @param TABLE NAME, SELECT DATA, WHERE CONDITION (OPTIONAL)
    *   @return QUERY RESULT
    *
    */
    private function fetch_all($table_name, $select_data, $where_condition = null)
    {
        return $this->db->select($select_data)->from($table_name)->where($where_condition)->get()->result_array();
    }

    /*
    *
    *   @param TABLE NAME, WHERE CONDITION
    *   @return QUERY RESULT
    *
    */
    private function delete_row($table_name, $where_condition)
    {
        $this->db->delete($table_name, $where_condition);
    }

    /*
    *
    *   @param TABLE NAME, SET DATA, WHERE CONDITION
    *   @return QUERY RESULT
    *
    */
    private function update_row($table_name, $set_data, $where_condition)
    {
        $this->db->set($set_data)->where($where_condition)->update($table_name);
    }

    function add_user()
    {
        // print_r($this->insert_row('a', 'a'));
    }
}
