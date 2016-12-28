<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Model		: Clientmodel
 * Description	: This model is for user related DB transactions, login and registration processes for Client(members)
 * Functions	: isUserExists(), saveData()
 * Author		: Ravi Prakash
 * Dated		: 07/04/16
 */

class Client_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();	
		
	}

	/*
	 * Function isUserExists checks whether Client exists or not. It searches email ID in database.
	 * This query will be someting like this (select email from user_master where email = '$email')
	 * Added By Ravi Prakash
	 */

	/***  Function for Client login ***/
    function login($data)
    {
      $sql    = "select * from Client where email='".$data['email']."' and password='".sha1(md5($data['password']))."' and status='1'";
	  $query  = $this->db->query($sql);
	  $res = $query->result_array();
	  if(sizeof($res)>0){
		  $data = array(
               'last_login' => date('Y-m-d h:i:s') //2016-04-07 11:58:26
            );

		$this->db->where('id', $res[0]['id']);
		$this->db->update('user', $data); 
	  }
	  return $res;
    }	
	/****** EOF *****/

    //inserting ercommerce inot user table
    public function user($item)
    {
        $this->db->insert("user", $item);
    }

	/***  Function for Client Detail ***/
	public function client_detail($id){
		$query = $this->db->where(array('id'=>$id))->get('client')->result();
		return $query;
	}
	/****** EOF *****/

	public function get_client_settings($id=NULL)
	{
		//$query = $this->db->where(array('client_id'=>$id))->get('client_settings')->result();
		if($id == NULL){
		$query = $this->db->select('*')->from('client_settings')->join('client', 'client.id = client_settings.client_id')->get()->result();
		}
		else{
			$query = $this->db->select('*')->from('client_settings')->join('client', 'client.id = client_settings.client_id')->where(array('client_settings.client_id'=>$id))->get()->result();
		}
		
		return $query;
	}

	/***  Function for Client Exists or not ***/
	public function client_exists($contact_email,$client_name){		
		$sql = "select * from client where contact_email = '".$contact_email."' or client_name = '".$client_name."'";
		$query  = $this->db->query($sql);
		return $query->num_rows();
	}
	/****** EOF *****/

	/***  Function for Registration of New Client ***/
	public function client_registration($data){
		$this->db->insert('client', $data);	
		return $this->db->insert_id();
	}
	/****** EOF *****/

	public function add_client_settings($data){
		$this->db->insert('client_settings', $data);	
		return $this->db->insert_id();
	}

	/**** function for Client Listing ****/
	public function client_listing()
	{
		$query = $this->db->get('client')->result();
		return $query;	
	}
	/*** EOF ***/

	/**** function for Client Listing ****/
	public function admin_listing(){
		$query = $this->db->where(array('user_group_id'=>1))->get('user')->result();
		return $query;	
	}
	/*** EOF ***/

	/**** function for Declined Client Listing ****/
	public function declined_client_listing(){
		$query = $this->db->where(array('status'=>2))->get('user')->result();
		return $query;	
	}
	/*** EOF ***/
	
	/**** function for Approved Client Listing ****/
	public function approved_client_listing(){
		$query = $this->db->where(array('status'=>1))->get('user')->result();
		return $query;	
	}
	/*** EOF ***/
	
	/**** function for Approved Client Configuration tables ****/
	public function approved_client_configuration($id){
		$query = $this->db->select('service_bank_ebills,service_cashpoint,service_centralpay_ecommerce')->where(array('id'=>$id))->get('user')->result();
		return $query;	
	}
	/*** EOF ***/
	
	/**** function for Approved Client Configuration table structure detail ****/
	public function client_services_table_structure($servicetbl){		
		$table = $this->db->escape_str($servicetbl);
		$sql = "DESCRIBE `$table`";
		$desc = $this->db->query($sql)->result();		
		return $desc;	
	}
	/*** EOF ***/

	public function client_acronymn($acronymn){
		$query = $this->db->where(array('client_acronymn'=>$acronymn))->get('user')->result();
		return $query;	
	}

	

	function get_cd_list($tblname) {
			$this->cds=$tblname;
        /* Array of table columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array(
            'username',
			'email',
			'mobile',
			'companyname',
            'clientbusiness',
			'amanager',
			'amemail'
            );

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        /* Total data set length */
        $sQuery = "SELECT COUNT('" . $sIndexColumn . "') AS row_count
            FROM $this->cds";
        $rResultTotal = $this->db->query($sQuery);
        $aResultTotal = $rResultTotal->row();
        $iTotal = $aResultTotal->row_count;

        /*
         * Paging
         */
        $sLimit = "";
        $iDisplayStart = $this->input->get_post('start', true);
        $iDisplayLength = $this->input->get_post('length', true);
        if($iDisplayLength==''){$iDisplayLength=10;}
		if (isset($iDisplayStart) && $iDisplayLength != '-1') {
            $sLimit = "LIMIT " . intval($iDisplayStart) . ", " .
                    intval($iDisplayLength);
        }

        $uri_string = $_SERVER['QUERY_STRING'];
        $uri_string = preg_replace("/\%5B/", '[', $uri_string);
        $uri_string = preg_replace("/\%5D/", ']', $uri_string);

        $get_param_array = explode("&", $uri_string);
        $arr = array();
        foreach ($get_param_array as $value) {
            $v = $value;
            $explode = explode("=", $v);
            $arr[$explode[0]] = $explode[1];
        }

        $index_of_columns = strpos($uri_string, "columns", 1);
        $index_of_start = strpos($uri_string, "start");
        $uri_columns = substr($uri_string, 7, ($index_of_start - $index_of_columns - 1));
        $columns_array = explode("&", $uri_columns);
        $arr_columns = array();
        foreach ($columns_array as $value) {
            $v = $value;
            $explode = explode("=", $v);
            if (count($explode) == 2) {
                $arr_columns[$explode[0]] = $explode[1];
            } else {
                $arr_columns[$explode[0]] = '';
            }
        }

        /*
         * Ordering
         */
        
        echo $sOrderIndex = $arr['order[0][column]'];
        $sOrderDir = $arr['order[0][dir]'];
        $bSortable_ = $arr_columns['columns[' . $sOrderIndex . '][orderable]'];
        //if($sOrderIndex==''){ $sOrderIndex=0;}
		if ($bSortable_ == "true") {
            $sOrder = "ORDER BY ";
			$sOrder .= $aColumns[$sOrderIndex] .
                    ($sOrderDir === 'asc' ? ' asc' : ' desc');
        }

        /*
         * Filtering
         */
        $sWhere = "";
		$sSearchVal = $arr['search[value]'];
        if (isset($sSearchVal) && $sSearchVal != '') {
			$sWhere = "WHERE (";
        	
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        } 
		
		if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
		$sWhere .= ' status=1 ';
		//$sWhere .= " (str_to_date(TransDate,'%d-%m-%Y %H:%i')>='".$startdate."' and str_to_date(TransDate,'%d-%m-%Y %H:%i') <='".$enddate."')";
		

        /* Individual column filtering */
        $sSearchReg = $arr['search[regex]'];
        for ($i = 0; $i < count($aColumns); $i++) {
            $bSearchable_ = $arr['columns[' . $i . '][searchable]'];
            if (isset($bSearchable_) && $bSearchable_ == "true" && $sSearchReg != 'false') {
                $search_val = $arr['columns[' . $i . '][search][value]'];
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($search_val) . "%' ";
            }
        }


        /*
         * SQL queries
         * Get data to display
         */
          $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
        FROM $this->cds
        $sWhere
        $sOrder
        $sLimit
        ";
        $rResult = $this->db->query($sQuery);

        /* Data set length after filtering */
        $sQuery = "SELECT FOUND_ROWS() AS length_count";
        $rResultFilterTotal = $this->db->query($sQuery);
        $aResultFilterTotal = $rResultFilterTotal->row();
        $iFilteredTotal = $aResultFilterTotal->length_count;

        /*
         * Output
         */
        $sEcho = $this->input->get_post('draw', true);
        $output = array(
            "draw" => intval($sEcho),
            "recordsTotal" => $iTotal,
            "recordsFiltered" => $iFilteredTotal,
            "data" => array()
        );

        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($aColumns as $col) {
                $row[] = $aRow[$col];
            }
            $output['data'][] = $row;
        }

        return $output;
    }


}