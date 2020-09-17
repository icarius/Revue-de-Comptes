<?php
/**
 * Description of ad2 Model: CodeIgniter 
 *
 * @author TechArise Team
 *
 * @givenname  info@techarise.com
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ad2_model extends CI_Model {
    private $_employeeID;
    private $_samaccountname;
    private $_givenname;
    private $_sn;
    private $_employeeNumber;
    private $_limit;
    private $_pageNumber;
    private $_offset; 
    
    public function setemployeeID($employeeID) {
        $this->_employeeID = $employeeID;
    }
    
    public function setsamaccountname($samaccountname) {
        $this->_samaccountname = $samaccountname;
    }
    
    public function setgivenname($givenname) {
        $this->_givenname = $givenname;
    }
    
    public function setsn($sn) {
        $this->_sn = $sn;
    }
    
    public function setemployeeNumber($employeeNumber) {
        $this->_employeeNumber = $employeeNumber;
    }

    public function settitle($title) {
        $this->_title = $title;
    }

    public function setLimit($limit) {
        $this->_limit = $limit;
    }

    public function setPageNumber($pageNumber) {
        $this->_pageNumber = $pageNumber;
    }

    public function setOffset($offset) {
        $this->_offset = $offset;
    }    

    // count ad2
    public function countad2() {
        //$this->db->where('employeeNumber', $this->_employeeNumber);
        $this->db->from('exportad'); 
        return $this->db->count_all_results();
    }

    // get ad2 List
    public function getad2List() {
        $tableName = 'exportad';
        $this->db->select(array('c.employeeID', 'c.samaccountname', 'c.givenname', 'c.sn', 'c.employeeNumber', 'c.title'));
        $this->db->from('exportad as c');        
        //$this->db->where('c.employeeNumber', $this->_employeeNumber);
        if(!empty($this->_pageNumber)) {
            $this->db->limit($this->_pageNumber, $this->_offset);
        }
        $query = $this->db->get();
        return $query->result_array();
    } 
    
    // create ad2
    public function createad2() {
        $tableName = 'exportad';
        $this->db->truncate($tableName);
            $data = array(
                'employeeID' => $this->_employeeid,
                'samaccountname' => $this->_samaccountname,
                'givenname' => $this->_givenname,
                'sn' => $this->_sn,
                'employeeNumber' => $this->_employeenumber,
                'title' => $this->_title,
            );
            $this->db->insert($tableName, $data);
            return $this->db->insert_id();

        
    }    
}
?>