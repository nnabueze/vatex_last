<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Model		: Clientmodel
 * Description	: This model is for user related DB transactions, login and registration processes for Client(members)
 * Functions	: isUserExists(), saveData()
 * Author		: Ravi Prakash
 * Dated		: 07/04/16
 */

class Vat_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();	
		
	}
	
	function get_cd_list($tblname) {
			$this->cds=$tblname;
        /* Array of table columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array(
            'ec_id',
			'email',
			'count',
			'amt',
            'sales_date',
			'bankcode'
            );

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "ec_id";

        /* Total data set length */
        $sQuery = "select bankcode,sales_date,ec_id, COUNT(ec_id) as count, sum(vat_amount) from payment_sweep_queue group by sales_date,ec_id";
		
		/*SELECT COUNT('" . $sIndexColumn . "') AS row_count
            FROM $this->cds"; */
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

	function getvatonhold(){
		$requestData= $_REQUEST;


			$columns = array( 
			// datatable column index  => database column name
				0 =>'ec_id', 
				1 => 'ec_id',
				2=> 'count',
				3=> 'amt',
				4=> 'sales_date',
				5=> 'bankcode',
			);



			// getting total number records without any search
		$sql = "select bankcode,sales_date,ec_id, COUNT(ec_id) as count, sum(vat_amount) from payment_sweep_queue group by sales_date,ec_id order by sales_date";
		
		$result = $this->db->query($sql);
		
		//$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
		$totalData = $result->num_rows;
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


		$sql = "select bankcode,sales_date,ec_id, COUNT(ec_id) as count,sum(vat_amount) as amt from payment_sweep_queue WHERE 1=1";
		/*if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
			$sql.=" AND ( employee_name LIKE '".$requestData['search']['value']."%' ";    
			$sql.=" OR employee_salary LIKE '".$requestData['search']['value']."%' ";

			$sql.=" OR employee_age LIKE '".$requestData['search']['value']."%' )";
		} */

		$sql.=" group by sales_date,ec_id "; 
		
		$result = $this->db->query($sql);
		$totalFiltered = $result->num_rows;
		

		//$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
		//$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
//		echo $sql;
		$query = $this->db->query($sql);
		
		$data = array();
		   foreach ($query->result_array() as $row){
			   // preparing an array
			$nestedData=array(); 
			
			$userdata = $this->db->select('username')->where('id',$row["ec_id"])->get('user')->result();
			$bankdata = $this->db->select('bankname')->where('bankcode',$row["bankcode"])->get('bankcode')->result();
			//echo $this->db->last_query();
			$nestedData[] = $row["ec_id"];
			$nestedData[] = $userdata[0]->username;
			$nestedData[] = $row["count"];
			$nestedData[] = $row["amt"];
			$nestedData[] = $row["sales_date"];
			$nestedData[] = $bankdata[0]->bankname;
			$nestedData[] = "Pending Sweep";
			
			$data[] = $nestedData;
		}

		



		$json_data = array(
					"draw"            => intval( $requestData['draw'] ),  
					"recordsTotal"    => intval( $totalData ),  
					"recordsFiltered" => intval( $totalFiltered ), 
					"data"            => $data   
					); 

		echo json_encode($json_data);  // send data as json format


	}


	function get_all_hold_orders($id,$date){
		return $result = $this->db->where(array('ec_id'=>$id,'sales_date'=>$date))->get('payment_sweep_queue')->result();
	}

	function get_user_name($id){
		return $userdata = $this->db->select('username')->where('id',$id)->get('user')->result();
	}
	function get_bank_name($id){
		return $bankdata = $this->db->select('bankname')->where('bankcode',$id)->get('bankcode')->result();
	}
	function get_hold_order_details($orderid,$userid){
		return $result = $this->db->where(array('ec_id'=>$userid,'orderid'=>$orderid))->get('payment_sweep_queue')->result();
	}

	function manual_sweep_start_process($userid,$sdate){
		$sql = "select bankcode,sales_date,ec_id, COUNT(ec_id) as cunt, sum(vat_amount)as amt from payment_sweep_queue where ec_id='". $userid."' and sales_date='".$sdate."' group by sales_date,ec_id order by sales_date";
		$result = $this->db->query($sql);	
		$data = $result->result();
		//print_r($data);
		$savedata = array();
		$savedata['ec_id'] = $data[0]->ec_id;
		$savedata['no_of_transaction'] = $data[0]->cunt;
		$savedata['amount'] = $data[0]->amt;
		$savedata['bankcode'] = $data[0]->bankcode;
		$savedata['sweep_date'] = date('Y-m-d');
		$savedata['status'] = 2;
		$this->db->insert('vat_nibss_transaction',$savedata);
		$nibsid = $this->db->insert_id();

		$orderdata = $this->db->where(array('ec_id'=>$userid,'sales_date'=>$sdate))->get('payment_sweep_queue')->result();
		
		$savedata = array();
		$i=0;
		foreach($orderdata as $ordersinfo){
			$savedata[$i] = array(
								   'nibsid' => $nibsid, 
								   'ec_id' => $ordersinfo->ec_id,
								   'orderid' => $ordersinfo->orderid,
								   'vat_amount' => $ordersinfo->vat_amount,
								   'sales_date' => $ordersinfo->sales_date,
								   'bankcode' => $ordersinfo->bankcode,
								 );
								
			
				$i++;
				if($i==50){
					$this->db->insert_batch('payment_vat_details', $savedata);
					$i=0;
					$savedata = array();
				}	
		}
		if($i!=0){
			$this->db->insert_batch('payment_vat_details', $savedata);
		}

		$this->db->delete('payment_sweep_queue',array('ec_id'=>$userid,'sales_date'=>$sdate));
	}
	
	
	/* Function :- gettransactionhold
	* Description:- Get details of all transaction data
	*/
	function gettransactionhold(){
		$requestData= $_REQUEST;


			$columns = array( 
			// datatable column index  => database column name
				0 =>'ec_id', 
				1 => 'ec_id',
				2=> 'Order_Id',
				3=> 'Transaction_Id',
				4=> 'sales_date',
				5=> 'Payment_Type',
				6=> 'Order_Status',
			);



			// getting total number records without any search
		$sql = "select * from payment_sweep_queue order by sales_date";
		
		$result = $this->db->query($sql);
		
		//$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
		$totalData = $result->num_rows;
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


		$sql = "select * from payment_sweep_queue WHERE 1=1";
		/*if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
			$sql.=" AND ( employee_name LIKE '".$requestData['search']['value']."%' ";    
			$sql.=" OR employee_salary LIKE '".$requestData['search']['value']."%' ";

			$sql.=" OR employee_age LIKE '".$requestData['search']['value']."%' )";
		} */


		
		$result = $this->db->query($sql);
		$totalFiltered = $result->num_rows;
		

		//$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
		//$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
		//echo $sql;
		$query = $this->db->query($sql);
		
		$data = array();
		   foreach ($query->result_array() as $row){
			   // preparing an array
			$nestedData=array(); 
			
			$userdata = $this->db->select('username')->where('id',$row["ec_id"])->get('user')->result();
			//$bankdata = $this->db->select('bankname')->where('bankcode',$row["bankcode"])->get('bankcode')->result();
			//echo $this->db->last_query();
			
				
			$nestedData[] = $row["ec_id"];
			$nestedData[] = $userdata[0]->username;
			$nestedData[] = $row["Transaction_Id"];
			$nestedData[] = $row["Order_Id"];
			$nestedData[] = $row["sales_date"];
			$nestedData[] = $row["Payment_Type"];
			$nestedData[] = $row["Order_Status"];
			
			$data[] = $nestedData;
		}

		



		$json_data = array(
					"draw"            => intval( $requestData['draw'] ),  
					"recordsTotal"    => intval( $totalData ),  
					"recordsFiltered" => intval( $totalFiltered ), 
					"data"            => $data   
					); 

		echo json_encode($json_data);  // send data as json format


	}

}