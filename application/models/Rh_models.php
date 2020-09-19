<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rh_models extends CI_Model{
    
    function __construct() {
        // Set table name
        $this->tableAD = 'exportad';
        $this->tableRH = 'exportrem';
        $this->tablePCPASS = 'exportpcpass';
    }
    
    /*
     * Fetch members data from the database
     * @param array filter data based on the passed parameters
     */
    public function getRowsAD($params = array()){
        $this->db->select('*');
        $this->db->from($this->tableAD);
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("employeeID", $params)){
                $this->db->where('employeeID', $params['employeeID']);
                $query = $this->db->get();
                $result = $query->row_array();
            }
			else{
                $this->db->order_by('employeeID', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }

    public function search_samaccountname($str){
        return $this->db->get_where($this->tableAD,$str)->row_array();
    }

    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insertAD($data) {
        if(!empty($data)){
            $this->db->truncate($this->tableAD);
            // Insert member data
            $insert = $this->db->insert_batch($this->tableAD, $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $condition array filter data
     */
    public function updateAD($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            //if(!array_key_exists("modified", $data)){
                //$data['modified'] = date("Y-m-d H:i:s");
            //}
            
            // Update member data
            $update = $this->db->update($this->tableAD, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }












        /*
     * Fetch members data from the database
     * @param array filter data based on the passed parameters
     */
    public function getRowsRH($params = array()){
        $this->db->select('*');
        $this->db->from($this->tableRH);
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("Matricule", $params)){
                $this->db->where('Matricule', $params['Matricule']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('Matricule', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }

    public function search_rhinfo($str){
        return $this->db->get_where($this->tableRH,$str)->row_array();
    }
	
	public function count_cdf($str){
		$query = $this->db->get_where($this->tableRH, array('UO_Analytique' => $str));
        return $query->num_rows();
		
    }
	
    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insertRH($data) {
        if(!empty($data)){
            $this->db->truncate($this->tableRH);
            // Insert member data
            $insert = $this->db->insert_batch($this->tableRH, $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $condition array filter data
     */
    public function updateRH($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            //if(!array_key_exists("modified", $data)){
                //$data['modified'] = date("Y-m-d H:i:s");
            //}
            
            // Update member data
            $update = $this->db->updateRH($this->tableRH, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }












    /*
     * Fetch members data from the database
     * @param array filter data based on the passed parameters
     */
    public function getRowsPCPASS($params = array()){
        $this->db->select('*');
        $this->db->from($this->tablePCPASS);
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("matricule", $params)){
                $this->db->where('matricule', $params['matricule']);
                $query = $this->db->get();
                $result = $query->row_array();
            }
			else{
                $this->db->order_by('nom', 'asc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }

    public function search_pcpass($str){
        return $this->db->get_where($this->tablePCPASS,$str)->row_array();
    }

    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insertPCPASS($data) {
        if(!empty($data)){
            $this->db->truncate($this->tablePCPASS);
            // Insert member data
            $insert = $this->db->insert_batch($this->tablePCPASS, $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $condition array filter data
     */
    public function updatePCPASS($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            //if(!array_key_exists("modified", $data)){
                //$data['modified'] = date("Y-m-d H:i:s");
            //}
            
            // Update member data
            $update = $this->db->update($this->tablePCPASS, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }

}    