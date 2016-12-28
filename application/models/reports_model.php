<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reports_model extends CI_Model {
	private $cds = 'cds';	
    public function __construct()
    {
        parent::__construct();
    }
	
	
	function get_cd_list($result_fields, $tblname,$startdate,$enddate) {
			$this->cds=$tblname;
        /* Array of table columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = $result_fields;

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
        $sOrder = "ORDER BY ";
        $sOrderIndex = $arr['order[0][column]'];
        $sOrderDir = $arr['order[0][dir]'];
        $bSortable_ = $arr_columns['columns[' . $sOrderIndex . '][orderable]'];
        if ($bSortable_ == "true") {
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
		$sWhere .= " (str_to_date(TransDate,'%d-%m-%Y %H:%i')>='".$startdate."' and str_to_date(TransDate,'%d-%m-%Y %H:%i') <='".$enddate."')";
		

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
	
	
	public function generate_analysis_data($tblnm,$startdate,$enddate){
		
				$date1 = new DateTime($startdate);
				$date2 = new DateTime($enddate);
				$diff = $date2->diff($date1)->format("%a");
				//echo "<pre>";
				$x=0;
				$resultarr = array();
				if($diff<=30){
					while($x <= $diff){
					$y = $x+1;
					$stdate = date('Y-m-d', strtotime($startdate .' +'.$x.' day')); 
					$endate = date('Y-m-d', strtotime($startdate .' +'.$y.' day'));
						$data = $this->db->query("select PaidAmount, UNIX_TIMESTAMP( STR_TO_DATE( TransDate,  '%d-%m-%Y %H:%i' ) ) as timestampdate, str_to_date(TransDate,'%d-%m-%Y %H:%i') as datetimestamp FROM $tblnm where str_to_date(TransDate,'%d-%m-%Y %H:%i')>='".$stdate."' and str_to_date(TransDate,'%d-%m-%Y %H:%i') <='".$endate."'")->result();
						
						$amount=0;
						if(sizeof($data)>0){
							foreach($data as $curdata){
								$PaidAmount = str_replace(",",'',$curdata->PaidAmount);
								$amount += $PaidAmount;
							}
						}
						$stdate = date('M-d', strtotime($stdate));
						$resultarr[$x] = array($stdate,$amount);	
						$x++;
					}
				}elseif($diff>30){
				//	echo "sdf";
				//&& $diff<=34
					$x=0;
					//echo "<pre>";
					//$diff = ceil($diff/7);
					while($x <= $diff){
					$y = $x+30;
					$stdate = date('Y-m-d', strtotime($startdate .' +'.$x.' day')); 
					//echo $x;
					//echo "<br>";
					if(($x+30)>=	 $diff){
						$endate = $enddate;
					} else {
						$endate = date('Y-m-d', strtotime($startdate .' +'.$y.' day'));
					}
						$data = $this->db->query("select PaidAmount, UNIX_TIMESTAMP( STR_TO_DATE( TransDate,  '%d-%m-%Y %H:%i' ) ) as timestampdate, str_to_date(TransDate,'%d-%m-%Y %H:%i') as datetimestamp FROM $tblnm where str_to_date(TransDate,'%d-%m-%Y %H:%i')>='".$stdate."' and str_to_date(TransDate,'%d-%m-%Y %H:%i') <='".$endate."'")->result();
						
						$amount=0;
						if(sizeof($data)>0){
							foreach($data as $curdata){
								$PaidAmount = str_replace(",",'',$curdata->PaidAmount);
								$amount += $PaidAmount;
							}
						}
						$resultarr[$x] = array($stdate,$amount);	
						//echo $this->db->last_query();
						//print_r($data);
						$x = $x+30;
					}
				}
				//print_r($resultarr);
				return $resultarr;
		
		//$data = $this->db->query("select *, UNIX_TIMESTAMP( STR_TO_DATE( TransDate,  '%d-%m-%Y %H:%i' ) ) as timestampdate, str_to_date(TransDate,'%d-%m-%Y %H:%i') as datetimestamp FROM $tblnm where str_to_date(TransDate,'%d-%m-%Y %H:%i')>='".$startdate."' and str_to_date(TransDate,'%d-%m-%Y %H:%i') <='".$enddate."'")->result();
		//echo $this->db->last_query(); 	
		//return $data;
	}
	
	public function report(){
		// DB table to use
		$table = 'biller';
		 
		// Table's primary key
		$primaryKey = 'id';
		 
		// Array of database columns which should be read and sent back to DataTables.
		// The `db` parameter represents the column name in the database, while the `dt`
		// parameter represents the DataTables column identifier. In this case simple
		// indexes
		$columns = array(
			array( 'db' => 'name', 'dt' => 0 ),
			array( 'db' => 'last_name',  'dt' => 1 ),
			array( 'db' => 'position',   'dt' => 2 ),
			array( 'db' => 'office',     'dt' => 3 ),
			array(
				'db'        => 'start_date',
				'dt'        => 4,
				'formatter' => function( $d, $row ) {
					return date( 'jS M y', strtotime($d));
				}
			),
			array(
				'db'        => 'salary',
				'dt'        => 5,
				'formatter' => function( $d, $row ) {
					return '$'.number_format($d);
				}
			)
		);
		 
		// SQL server connection information
		$sql_details = array(
			'user' => '',
			'pass' => '',
			'db'   => '',
			'host' => ''
		);
		 
		 
		/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		 * If you just want to use the basic configuration for DataTables with PHP
		 * server-side, there is no need to edit below this line.
		 */
		 
		require( 'ssp.class.php' );
		 
		echo json_encode(
			SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
		);
	}
	
	public function tbl_structure($tbl){	
		$fields = $this->db->list_fields($tbl);
		return $fields;		
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//getting computed report
	public function computed_report($date=null)
	{
		$result = $this->db->get('computed_vat')->result();

		return $result;
	}

	//getting deducted VAT
	public function deducted_report($date=null)
	{
		$result = $this->db->where('status','1')->get('computed_vat')->result();

		return $result;
	}

	//getting remitance report
	public function remittance_report()
	{
		$result = $this->db->get('remittance_report')->result();

		return $result;
	}

	//getting computed report for a specific ecommerce
	public function ecommerce_computed_report($data)
	{
		$result = $this->db->where('ecommerce_id',$data)
				->get('computed_vat')->result();

		return $result;
	}

	//getting deducted report for a specific ecommerce
	public function ecommerce_deducted_report($data)
	{
		$result = $this->db->where('status','1')
				->where('ecommerce_id',$data)
				->get('computed_vat')->result();

		return $result;
	}

	//getting list of vendors within ecommerce 
	public function client_listing($item)
	{
		$result = $this->db->where('Ecommerce_Id',$item)
				->get('vendor')->result_array();

		return $result;
	}


	
	
}
?>