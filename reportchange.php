<?php
require('db.php');

if(isset($_REQUEST['selected_from_date'])){
    $selected_from_date = ""; $selected_to_date = ""; $where = "";
    $selected_from_date = $_REQUEST['selected_from_date'];
    $selected_to_date = $_REQUEST['selected_to_date'];

    
    
    if(!empty($selected_from_date)) {
        if(!empty($where)) {
            $where .= " AND book_date >= '$selected_from_date'";
        } else {
            $where .= " book_date >= '$selected_from_date'";
        }
    }
    if(!empty($selected_to_date)) {
        if(!empty($selected_to_date)) {
            $where .= " AND book_date <= '$selected_to_date'";
        } else {
            $where .= " book_date <= '$selected_to_date'";
        }
    }        

    if(!empty($where)) {
           $report_query = "SELECT * FROM tablebooking  WHERE $where";
    } //else {
    //         $report_query = "SELECT * FROM tablebooking";
    // }
    if(!empty($where)){
        $report_list = $conn->query($report_query);
}
?>

    
<?php }

if(!empty($report_list)) {
    foreach($report_list as $data) { ?>
        <tr>
            <td><?php if(!empty($data['id'])) { echo $data['id']; } ?></td>
            <td><?php if(!empty($data['book_date'])) { echo $data['book_date']; } ?></td>
            <td><?php if(!empty($data['cus_name'])) { echo $data['cus_name']; } ?></td>
            <td><?php if(!empty($data['mobile_number'])) { echo $data['mobile_number']; } ?></td>
            <td><?php if(!empty($data['cus_address'])) { echo $data['cus_address']; } ?></td>
            <td><?php if(!empty($data['cus_status'])) { echo $data['cus_status']; } ?></td>
        </tr>
<?php  }
}
?>