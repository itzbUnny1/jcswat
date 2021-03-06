<?php
if(!isset($_GET['id'])){//will redirect to dashboard if member is not selected
    redirect('dashboard.php');
  }
if(isset($_GET['id'])){
$memberId = $_GET['id'];
$member_query = mysqli_query($conn, "SELECT * FROM users WHERE s_no = '$memberId'"); //select member form database by its id
if(mysqli_num_rows($member_query) == 1){//will store member data in array if member is present in database else will redirect to members page
$member_data = mysqli_fetch_array($member_query);
if($member_data['role'] == 'admin'){//if selected member is an admin it will not delete member and will redirect to members page
    redirect('dashboard.php?page=members');
  }
}else{
    redirect('dashboard.php?page=members');
}
}
?>
<div class="container-fluid">
    <h3 class="text-danger text-center my-4">Delete Member</h3>
    <div class=" text-center mx-auto beforeDeleteInfo">
        <p>
            Name : <?php echo $member_data['first_name'].' '.$member_data['first_name']; ?>
        </p>
        <p>
            Email : <?php echo $member_data['email']; ?>
        </p>
        <p>
            Role : <?php echo $member_data['role']; ?>
        </p>
        <p>
            Status : <?php if($member_data['is_active']) echo 'Active'; else echo 'Disabled'; ?>
        </p>
        <h6 class="text-danger my-3">Are You sure to delete member?</h6>
        <a href="dashboard.php?page=members" class="btn btn-pr"><i class="fas fa-arrow-left"></i> back</a>
        <a href="dashboard.php?page=confirm_delete&id=<?php echo $_GET['id'];?>" class="btn btn-danger text-uppercase" >Yes delete <i class="fas fa-user-minus"></i></a>
    </div>
</div>