<?php
require('db.php');
$print_id = ""; $print_user_details = "";  $cus_id=""; $name=""; $mobile = "";
$address =""; $adult =""; $child =""; $total_person = ""; $b_date=""; $b_no=""; $cus_remark = "";
$cus_status = "";
if(isset($_REQUEST['print_id'])){
    $print_id = $_REQUEST['print_id'];  
    
    if(!empty($print_id)){
        $sql = "SELECT * FROM tablebooking  WHERE id='$print_id'";

        if(!empty($sql)){
            $print_user_details = $conn->query($sql);
        }

        if(!empty($print_user_details)) {
            foreach($print_user_details as $data) {
            $cus_id = $data['id'];
            $name = $data['cus_name'];
            $mobile = $data['mobile_number'];
            $address = $data['cus_address'];
            $adult = $data['no_adult'];
            $child = $data['no_child'];
            $total_person = $data['toatl_ppl'];
            $b_date = $data['book_date'];
            $b_no = $data['book_no'];
            $cus_status = $data['cus_status'];
            $cus_remark = $data['cus_remarks'];
            }
        }
        
        $sql = "SELECT * FROM contact";
        if(!empty($sql)){
            $print_user_details = $conn->query($sql);
        }
        if(!empty($print_user_details)) {
            foreach($print_user_details as $data) {
                $res_name = $data['res_name'];
                $res_address = $data['res_address'];
                $res_mobile = $data['res_mobile'];
            }
        }
    }
}

require('fpdf/fpdf.php');
if($print_user_details){
    $pdf = new FPDF("P", 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',14);

    $sales_start_y = $pdf->getY(); 
    $pdf->Cell(0,10,''.$res_name, 0, 1, 'C', 0);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(0, 5,''.$res_address, 0, 1, 'C', 0);
    $pdf->Cell(0, 5,'Tamil Nadu', 0, 1, 'C', 0);
    $pdf->Cell(0, 5,'Mobile No : '.$res_mobile, 0, 1, 'C', 0);
    $sales_end_y = $pdf->getY();
    $pdf->setY($sales_start_y);
    $pdf->cell(0, ($sales_end_y - $sales_start_y), '', 1, 1, 'C', 0);

    $pdf->SetFont('Arial', 'B', 11); 
    $pdf->Cell(65, 7,'Booking No:  ' .$b_no, 0, 1, 'L', 0);
    $pdf->Cell(65, 7,'', 0, 1, 'L', 0);
    $date_end_y = $pdf->getY();
    $bill_end_y = $pdf->getY();
    $pdf->SetY($sales_end_y);
    $pdf->setX(110);  
    $pdf->Cell(65, 7,'Booking Date:   '.$b_date, 0, 1, 'L', 0);
    $max_y = max(array($bill_end_y, $date_end_y));
    $pdf->SetY( $sales_end_y);
    $pdf->Cell(95, ($max_y - $sales_end_y),'', 1, 0, 'C', 0);
    $pdf->Cell(0, ($max_y - $sales_end_y),'', 1, 0, 'C', 0);
    
   
    $pdf->setY($date_end_y);
    $pdf->SetFont('Arial', 'BU', 11); 
    $pdf->Cell(0, 10,'BOOKING DETAILS ', 0, 1, 'C', 0);
    $pdf->SetFont('Arial', '', 11); 
    $pdf->setX(50);
    $pdf->cell(70, 8, 'Name', 0, 0, 'L', 0);
    $pdf->setX(30);
    $pdf->cell(70, 8, ':', 0, 0, 'R', 0);
    $pdf->setX(100);
    $pdf->cell(70, 8, ''.$name, 0, 1, 'L', 0);
    $pdf->setX(50);
    $pdf->cell(70, 8, 'Mobile Number', 0, 0, 'L', 0);
    $pdf->setX(30);
    $pdf->cell(70, 8, ':', 0, 0, 'R', 0);
    $pdf->setX(100);
    $pdf->cell(70, 8, ''.$mobile, 0, 1, 'L', 0);
    $pdf->setX(50);
    $pdf->cell(70, 8, 'Address', 0, 0, 'L', 0);
    $pdf->setX(30);
    $pdf->cell(70, 8, ':', 0, 0, 'R', 0);
    $pdf->setX(100);
    $pdf->cell(70, 8, ''.$address, 0, 1, 'L', 0);
    $pdf->setX(50);
    $pdf->cell(70, 8, 'Adult', 0, 0, 'L', 0);
    $pdf->setX(30);
    $pdf->cell(70, 8, ':', 0, 0, 'R', 0);
    $pdf->setX(100);
    $pdf->cell(70, 8, ''.$adult, 0, 1, 'L', 0);
    $pdf->setX(50);
    $pdf->cell(70, 8, 'Child', 0, 0, 'L', 0);
    $pdf->setX(30);
    $pdf->cell(70, 8, ':', 0, 0, 'R', 0);
    $pdf->setX(100);
    $pdf->cell(70, 8, ''.$child, 0, 1, 'L', 0);
    $pdf->setX(50);
    $pdf->cell(70, 8, 'Total Persons', 0, 0, 'L', 0);
    $pdf->setX(30);
    $pdf->cell(70, 8, ':', 0, 0, 'R', 0);
    $pdf->setX(100);
    $pdf->cell(70, 8, ''.$total_person, 0, 1, 'L', 0);
    $pdf->setX(50);
    $pdf->cell(70, 8, 'Booking Table Status', 0, 0, 'L', 0);
    $pdf->setX(30);
    $pdf->cell(70, 8, ':', 0, 0, 'R', 0);
    $pdf->setX(100);
    $pdf->cell(70, 8, ''.$cus_status, 0, 1, 'L', 0);
    $pdf->setX(50);
    $pdf->cell(70, 8, 'Remarks', 0, 0, 'L', 0);
    $pdf->setX(30);
    $pdf->cell(70, 8, ':', 0, 0, 'R', 0);
    $pdf->setX(100);
    $pdf->cell(70, 8, ''.$cus_remark, 0, 1, 'L', 0);
    // $pdf->setX(50);
    // $pdf->cell(70, 8, 'Booking Number', 0, 0, 'L', 0);
    // $pdf->setX(30);
    // $pdf->cell(70, 8, ':', 0, 0, 'R', 0);
    // $pdf->setX(100);
    // $pdf->cell(70, 8, ''.$b_no, 0, 1, 'L', 0);
    $details_end = $pdf->getY();
    $pdf->SetY($sales_end_y);
    $pdf->cell(0, 190, '', 1, 1, 'C', 0);
    $row_end = $pdf->getY();
    // $pdf->Cell(65, 7,'Booking Date:   '.$b_date, 0, 1, 'L', 0);

    // // $pdf->Cell(75, 5,'  ', 0, 1, 'L', 0);
    // // $pdf->SetFont('Arial', '', 11); 
    // $pdf->Cell(75, 5,'  ', 0, 1, 'L', 0);
    // $pdf->Cell(75, 5,'  ', 0, 1, 'L', 0);   
    // // $pdf->Cell(75, 5,'  ', 0, 1, 'L', 0);
    // $bill_end_y = $pdf->getY();
    // $pdf->SetY($sales_end_y);
    // $pdf->setX(110);
    // $pdf->Cell(65, 7,'Booking Date:   '.$b_date, 0, 1, 'L', 0);
    // $pdf->setX(110);
    // // $pdf->Cell(65, 7,'Sales Date:   '.$party_date, 0, 1, 'L', 0);
    // $date_end_y = $pdf->getY();
    // $max_y = max(array($bill_end_y, $date_end_y));
    // $pdf->SetY( $sales_end_y);
    // $pdf->Cell(95, ($max_y - $sales_end_y),'', 1, 0, 'C', 0);
    // $pdf->Cell(0, ($max_y - $sales_end_y),'', 1, 0, 'C', 0);

    // $pdf->SetFont('Arial', 'B', 11); 
    // $pdf->SetY($bill_end_y);

    // $pdf->cell(15, 8, 'SI No', 1, 0, 'C', 0);
    // $pdf->cell(70, 8, 'Customer Name', 1, 0, 'C', 0);
    // $pdf->cell(35, 8, 'Adult', 1, 0, 'C', 0);
    // $pdf->cell(35, 8, 'Child', 1, 0, 'C', 0);
    // $pdf->cell(35, 8, 'Total People', 1, 1, 'C', 0);
    // $row_start_y = $pdf->getY();
    // $pdf->SetFont('Arial', '', 11); 

    

    // $pdf->cell(15, 8, ''.$cus_id, 1, 0, 'C', 0);
    // $pdf->cell(70, 8, ''.$name, 1, 0, 'C', 0);
    // $pdf->cell(35, 8, ''.$adult, 1, 0, 'C', 0);
    // $pdf->cell(35, 8, ''.$child, 1, 0, 'C', 0);
    // $pdf->cell(35, 8, ''.$total_person, 1, 1, 'C', 0);

    
    // $pdf->setY($row_start_y);
    // $pdf->cell(15, 160, '', 1, 0, 'C', 0);
    // $pdf->cell(70, 160, '', 1, 0, 'C', 0);
    // $pdf->cell(35, 160, '', 1, 0, 'C', 0);
    // $pdf->cell(35, 160, '', 1, 0, 'C', 0);
    // $pdf->cell(35, 160, '', 1, 1, 'C', 0);
    // $row_end = $pdf->getY();

    // $pdf->SetFont('Arial', 'B', 10); 
    // $pdf->SetY($row_end);
    // $pdf->cell(155, 5, 'Total Person', 1, 0, 'R', 0);
    // $pdf->cell(0, 5, ''.$total_person, 1, 1, 'R', 0);
    // $total_end = $pdf->getY();

    $rupe_start = $pdf->getY();
    $pdf->SetY($row_end);
    $pdf->SetFont('Arial', '', 9); 
    $pdf->cell(0, 5, 'Amount Chargeable (in words)', 0, 0, 'L', 0);
    $pdf->cell(0, 5, 'E. &O.E', 0, 1, 'R', 0);
    $pdf->SetFont('Arial', 'B', 9); 
    $pdf->cell(0, 5, '', 0, 1, 'L', 0);
    $rupe_end = $pdf->getY();
    $pdf->SetY($row_end);
    $pdf->cell(0,($rupe_end - $rupe_start),'', 1, 1, '', 0);

    $declare_start = $pdf->getY();
    $pdf->SetFont('Arial', 'BU', 9); 
    $pdf->cell(0, 5, 'Declaration', 0, 0, 'L', 0);
    $pdf->SetFont('Arial', 'B', 9); 
    $pdf->cell(0, 5, 'For Family Restaurant', 0, 1, 'R', 0);
    $pdf->SetFont('Arial', '', 8); 
    $pdf->cell(0, 5, '* We declare that this bill shows the actual price of the goods described and that all particular are true and correct', 0, 1, 'L', 0);
    $pdf->cell(0, 5, 'correct', 0, 1, 'L', 0);
    $pdf->cell(0, 5, '* Subject to SIVAKASI jurisidiction only.', 0, 0, 'L', 0);
    $pdf->SetFont('Arial', 'B', 9); 
    $pdf->cell(0, 5, 'Authorised Signature', 0, 1, 'R', 0);
    $declare_end = $pdf->getY();
    $pdf->SetY($rupe_end);
    $pdf->cell(0, ($declare_end - $declare_start), '', 1, 1, 'C', 0);
    $pdf->cell(0, 7, '***This is Computer Generated bill. Hence Digital Signature is not required***', 0, 0, 'C', 0);
     $pdf->Output();
}
?>