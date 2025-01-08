<?php
include("db.php");

//Add new User
if(isset($_POST['save_new'])){
    try{
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $dept = mysqli_real_escape_string($conn,$_POST['dept']);
        $cgpa = mysqli_real_escape_string( $conn,$_POST['cgpa']);
        $query="INSERT INTO students(name,dept,cgpa) VALUES('$name','$dept','$cgpa')";
        if(mysqli_query($conn,$query)){
            $res=[
                'status'=>200,
                'message'=>'User Added Successfully',
            ];
            echo json_encode($res);
        }else{
            throw new Exception('Query Error : '.mysqli_error($conn));
        }
    }
    catch(Exception $e){
        $res=[
            'status'=>500,
            'message'=>'Error Adding User',
        ];
        echo json_encode($res);

    }
}

//delete User
if(isset($_POST['delete_user'])){
    $std_id=mysqli_real_escape_string($conn,$_POST['user_id']);
    $query="DELETE FROM students WHERE id='$std_id'";
    if(mysqli_query($conn,$query)){
        $res=[
            'status'=>200,
            'message'=>'User Deleted Successfully',
        ];
        echo json_encode($res);
        return;
    }
    else{
        $res=[
            'status'=>500,
            'message'=>'Error Deleting User',
        ];
        echo json_encode($res);
    }
}

//get data for User edit
if(isset($_POST['edit_user'])){
    $std_id=mysqli_real_escape_string($conn,$_POST['user_id']);
    $query= "SELECT * FROM students WHERE id='$std_id'";
    $result=mysqli_query($conn,$query);
    $user_data=mysqli_fetch_assoc($result);
    if($result){
        $res=[
            'status'=>200,
            'message'=>"Fetched Successfully",
            'data'=>$user_data
        ];
        echo json_encode($res);
        return;
    }
    else{
        $res=[
            'status'=>500,
            'message'=>'Error Fetching User',
        ];
        echo json_encode($res);
        return;
    }
}

//User edit
if(isset($_POST['upd_new'])){
    $std_id=mysqli_real_escape_string($conn,$_POST['id']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $dept = mysqli_real_escape_string($conn,$_POST['dept']);
    $cgpa = mysqli_real_escape_string( $conn,$_POST['cgpa']);
    $query="UPDATE students SET name='$name',dept='$dept',cgpa='$cgpa'WHERE id=$std_id ";
    $run=mysqli_query($conn,$query);
    if($run){
        $res=[
            'status'=>200,
            'message'=>'User Updated Successfully',
        ];
        echo json_encode($res);
        return;
    }
    else{
        $res=[
            'status'=>500,
            'message'=>'Error Updating User',
        ];
        echo json_encode($res);
        return;
    }
}


?>
