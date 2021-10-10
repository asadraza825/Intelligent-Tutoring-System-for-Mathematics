<?php

require('config.php');


// this function make CSV windows freindly
function getcsvline($list,  $seperator, $enclosure, $newline = "" ){
    $fp = fopen('php://temp', 'r+'); 

    fputcsv($fp, $list, $seperator, $enclosure );
    rewind($fp);

    $line = fgets($fp);
    if( $newline and $newline != "\n" ) {
      if( $line[strlen($line)-2] != "\r" and $line[strlen($line)-1] == "\n") {
        $line = substr_replace($line,"",-1) . $newline;
      } else {
       //die( 'original csv line is already \r\n style' );
      }
    }

        return $line;
}
//===========================================================Add mail library====================================================
// require 'phpmailer/PHPMailerAutoload.php';
//====================================================================VAG Report=================================================================

$date_time=date('m/d/Y');
$result = mysql_query("UPDATE table1 SET
export_time='$date_time' WHERE vag_status='1' AND exported=0 ") or die('error1'.mysql_error());


	
$sql = "SELECT case_number,prefix_p1,first_name, 
middle_name_p1,last_name_p1,maiden_p1,address,address2_p1,city,state,
zip,email_p1,d_o_birth,d_o_death,phone,mobile_no,
sex,ss,matrial_status,c_relationship,prefix_p2,
c_fname,c_mname,c_lname,c_suffix,
c_address,address2_p2,c_email,c_phone,
c_mobile,city_p2,state_p2,zip_p2,
s_fname,s_mname,s_lname,s_suffix,
s_hphone,s_mphone,s_email,
ch1Name,ch1_dob,ch1_vagbirth,
ch2Name,ch2_dob,ch2_vagbirth,ch3Name,ch3_dob, 
ch3_vagbirth,ch4Name,ch4_dob,ch4_vagbirth,e_name,e_address,
e_city,e_state,e_zip,e_relationship,e_hphone,e_mphone,
lupus,pelvic_pain,diabetes,fibroids,immune_disorder,
adhesive_disease,endometriosis,reason_implant,reason_implant_pelvic,
reason_implant_others,date_fst_surg,name_of_surgeon,name_of_hospital,
hospital_address,revision_surgery,revision_surgery_when_performed,surgeon_of_corrective_surgery,
performed_hospital_name,medical_notes,mesh_erosion,mesh_erosion_treated,
mesh_erosion_complication_date,abdominal_pain,abdominal_pain_treated,
abdominal_pain_complication_date,infection,infection_treated,
infection_complication_date,painful_intercourse,
painful_intercourse_treated,painful_intercourse_complication_date,vaginal_bleeding, 
vaginal_bleeding_treated,vaginal_bleeding_complication_date,vaginal_scarring,vaginal_scarring_treated,vaginal_scarring_complication_date,bladder,
bladder_treated,bladder_complication_date,recurrence_pelvic_organ,recurrence_pelvic_organ_treated,recurrence_pelvic_organ_complication_date,recurrence_stress,
recurrence_stress_treated,recurrence_stress_complication_date,migration_of_implant,migration_of_implant_treated,migration_of_implant_complication_date,
neuromuscular,neuromuscular_treated,neuromuscular_complication_date,fistulae,
fistulae_treated,fistulae_complication_date,other_problem,other_problem_treated,
other_problem_complication_date,others_p1,number_of_pregnancies,number_of_liveBirth,hysterectomy,
hysterectomy_date,care_physician_name,obgyn_physician_name,uro_physician_name,
psy_physician_name,add_surgery_date,add1_surgery_date,
add2_surgery_date,name_surg_hosp,currently_seek_med_treat,
providing_treat_phys_name,prob_transvag_product,
list_injuries,misWord_injury_result,
how_muchWork_mis,injury_occupation,marriage_affected, 
date_of_death,autopsy,death_city,death_date,bankruptcy,when_bankruptcy,
own_computer,member_socialMedia,which_one,attorny,reffered_to,import_time,export_time,case_type_p1
FROM table1 where vag_status='1' AND exported='0'";



$qur = mysql_query($sql) or die(mysql_error());
$row_count=mysql_num_rows($qur );
if($row_count>0){

 $strPath='csv';

 $datetime=date('Y-m-d_Hi');
$filename1 = "VAG_intakes_".$datetime.".csv";
$full_path1=$strPath."/".$filename1;
$display = fopen($full_path1, 'w');
$flag = true;

$data = array("case_number",
"prefix_p1","first_name","middle_name_p1","last_name_p1","maiden_last_name_p1","address","address2_p1","city","state","zip","email_p1","d_o_birth","d_o_death","phone","mobile_no","sex","ss","matrial_status","c_relationship","prefix_p2","c_fname","c_mname","c_lname","c_suffix","c_address","address2_p2","c_email","c_phone","c_mobile","city_p2","state_p2","zip_p2","s_fname","s_mname","s_lname","s_suffix","s_hphone","s_mphone","s_email","ch1Name",
"ch1_dob","ch1_vagbirth","ch2Name","ch2_dob",
"ch2_vagbirth",
"ch3Name","ch3_dob","ch3_vagbirth","ch4Name","ch4_dob","ch4_vagbirth","e_name","e_address","e_city","e_state","e_zip","e_relationship","e_hphone","e_mphone","lupus","pelvic_pain","diabetes","fibroids","immune_disorder","adhesive_disease","endometriosis","reason_implant","reason_implant_pelvic","reason_implant_others","date_fst_surg","name_of_surgeon","name_of_hospital","hospital_address","revision_surgery","revision_surgery_when_performed","surgeon_of_corrective_surgery","performed_hospital_name","medical_notes","mesh_erosion","mesh_erosion_treated","mesh_erosion_complication_date","abdominal_pain","abdominal_pain_treated",
"abdominal_pain_complication_date","infection","infection_treated","infection_complication_date",
"painful_intercourse",
"painful_intercourse_treated","painful_intercourse_complication_date","vaginal_bleeding","vaginal_bleeding_treated","vaginal_bleeding_complication_date","vaginal_scarring","vaginal_scarring_treated","vaginal_scarring_complication_date","bowel","bowel_treated","bowel_complication_date","bladder","bladder_treated","bladder_complication_date","pelvic_organ_rolapse","pelvic_organ_rolapse_treated","pelvic_organ_rolapse_complication_date","recurrence_of_implant","recurrence_implant_treated","recurrence_complication_date","migration","migration_treated","migration_complication_date","neuromuscula","neuromuscula_treated","neuromuscula_complication_date","fistulae _problem","fistulae _treated","fistulae _date","others_p1","number_of_pregnancies","number_of_liveBirth","hysterectomy","hysterectomy_date","care_physician_name","obgyn_physician_name","uro_physician_name","psy_physician_name","add_surgery_date","add1_surgery_date",
"add2_surgery_date","name_surg_hosp","currently_seek_med_treat","providing_treat_phys_name",
"prob_transvag_product",
"list_injuries","misWord_injury_result","how_muchWork_mis","injury_occupation","marriage_affected","date_of_death","autopsy","death_city","death_date","bankruptcy","when_bankruptcy","own_computer","member_socialMedia","which_one","attorny","reffered_to","import_date","export_date","case_type");
while($row = mysql_fetch_assoc($qur)) {
//$row = array_map('mysql_real_escape_string',$row);
$row = preg_replace('/\s+/', ' ', $row);
/*
$newlines = array("\r\n", "\n", "\r");
$row = str_replace($newlines,' ',strip_tags( stripslashes($input) ));
*/
if( $flag ){
//fputcsv($display, $data, ",",'"');
/* to call the function with the array $row and save to file with filehandle $fp */
$line = getcsvline( $data, ",", '"', "\r\n" );
fwrite( $display, $line);
$flag = false;
}

/* to call the function with the array $row and save to file with filehandle $fp */
$line1 = getcsvline( $row, ",", '"', "\r\n" );
fwrite( $display, $line1);
//fputcsv($display, array_values($row), ",");


}
fclose($display);

// send email to


}

// update exported field

$result11 = mysql_query("UPDATE table1 SET
exported=1 where vag_status='1' AND exported='0'") or die('error3'.mysql_error());


                               // TCP port to connect to



?>