<?php

define("SETTLEMENT_MYSQL_HOST", getenv("RDS_SERVER"));
define("SETTLEMENT_MYSQL_USERNAME",getenv("RDS_USER"));
define("SETTLEMENT_MYSQL_PASSWORD",getenv("RDS_PASSWORD"));
include_once 'nacha_engine.class.php';
include_once("encrypt_and_decrypt_data.php");

$con = mysql_connect(SETTLEMENT_MYSQL_HOST,SETTLEMENT_MYSQL_USERNAME,SETTLEMENT_MYSQL_PASSWORD);
if (!$con){ die('Could not connect to database. Please try again later. Error: ' . mysql_error()); }
mysql_select_db("settlement", $con);


function _INPUT($name)
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
        return mysql_real_escape_string(strip_tags(stripslashes($_GET[$name])));
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
        return mysql_real_escape_string(strip_tags(stripslashes($_POST[$name])));
}

$settle = $_POST['settle'];
$mode = $_POST['mode'];

$counter = 1;

$q = "SELECT ach_file_id FROM settlement_log ORDER BY settlement_time DESC LIMIT 1";
$r = mysql_query($q);
$row=mysql_fetch_assoc($r);
$file_id = $row['ach_file_id'] + 1;
if($file_id>999){
    $file_id=1;
}

$eft1464file = new nacha_file('1320571576', '1320571576', 'RIVERPAY', '231372691', 'b231372691', 'SANTANDER BANK');

$curdate = date_create();
$uniqueid = date_format($curdate, "ymdHi");


$achdata = array();


foreach ($settle as $mid => $settledates){
    $q = "SELECT 	m1.ach_format, 	m1.bank_message, m1.parent_merchant_id, m1.parent_merchant_id, CASE WHEN m1.parent_merchant_id = '' THEN m1.merchant_name ELSE m2.merchant_name END AS merchant_name, 	m1.merchant_agent,CASE WHEN m1.parent_merchant_id = '' THEN m1.routing_number1 ELSE m2.routing_number1 END AS routing_number1, CASE WHEN m1.parent_merchant_id = '' THEN m1.account_number1 ELSE m2.account_number1 END AS account_number1, CASE WHEN m1.parent_merchant_id = '' THEN m1.inst_number1 ELSE m2.inst_number1 END AS inst_number1 	 FROM 	merchant_info m1 LEFT JOIN merchant_info m2 ON m1.parent_merchant_id = m2.merchant_id  WHERE 	m1.merchant_id = '$mid' ";
    $r = mysql_query($q);
    $merchantdata = mysql_fetch_assoc($r);
    
    if(!empty($merchantdata['parent_merchant_id'])){
        $currentmid = $merchantdata['parent_merchant_id'];
    }else{
        $currentmid = $mid;
    }

    if(!isset($achdata[$currentmid])){
        $achdata[$currentmid]['bank_message'] = $merchantdata['bank_message'];
        $achdata[$currentmid]['merchant_name'] = $merchantdata['merchant_name'];
        $achdata[$currentmid]['inst_number'] = decrypt_data($merchantdata['inst_number1']);
        $achdata[$currentmid]['routing_number'] = decrypt_data($merchantdata['routing_number1']);
        $achdata[$currentmid]['account_number'] = decrypt_data($merchantdata['account_number1']);
        $achdata[$currentmid]['total'] = array_sum($settledates);
    }else{
        $achdata[$currentmid]['total'] += array_sum($settledates);
    }
}


$counter = 1;
foreach ($achdata as $mid => $data){
    $uniqueid = date_format(date_create(), "ymdHi");
    if(empty($data['bank_message'])) {$data['bank_message'] = 'ACH Pmt';}
    $eft1464file->create_credit_entry($data['total'], $data['merchant_name'],$data['routing_number'],$data['account_number'],$data['bank_message'],$mid);
    $counter++;
}

$eft1464_string = $eft1464file->get_file_string();
    
if($mode=='live-eft1464-usd'){
        $q_log = "INSERT INTO settlement_log (settlement_content, ach_file_id) VALUES ('', '".mysql_real_escape_string($file_id)."')";
        if (mysql_query($q_log)){
            //echo "ACH file created";
        }else{
            echo "ERROR: Failed to write log<br>";
    }
}

header("Content-type: text/plain");
header("Content-Disposition: attachment; filename=RiverpayACHfile.txt");
header("Pragma: no-cache");
header("Expires: 0");

$ach_errors = $eft1464file->errors;

if(!empty($ach_errors)){
        echo "ERRORS: "."\r\n";        
        foreach($ach_errors as $error){
            echo $error."\r\n";
        }
        echo "END OF ERRORS "."\r\n"; 
        echo "\r\n";
        //exit;
}
echo $eft1464_string;


