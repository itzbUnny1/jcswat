<?php
$_SESSION['news_delete'] = 0; //will be 1 if news deleted successfully
if($_SESSION['role'] != 'admin'){
  redirect('index.php');
}
if(!isset($_GET['id'])){
  redirect('dashboard.php');
}
if(isset($_GET['id'])){
    $newsId = $_GET['id'];
    $news_query = mysqli_query($conn, "SELECT * FROM event_news WHERE s_no = '$newsId'");
    if(mysqli_num_rows($news_query) == 1){//if selected id has some news in database the store that in an array else redirect to dashbaoard;
    $news_data = mysqli_fetch_array($news_query);
    }else{
      redirect('dashboard.php');
    }
    }
if(isset($_POST['delete_news'])){//by clicking delete button it will delete news form databse and will redirect to news page on dashboard
  $delete_query_news = mysqli_query($conn, "DELETE FROM event_news WHERE s_no ='$newsId'");
  if($delete_query_news){
    $_SESSION['delete_news'] = 1;
    redirect('dashboard.php?page=news');
  }
}
?>
<div class="container-fluid">
    <div>
      <span class="text-center my-3 d-block">
      <a href="dashboard.php?page=news" class="btn btn-pr float-left"><i class="fas fa-arrow-left"></i></a>
        <h3 class="text-center d-inline-block text-danger">delete news</h3>
      </span>
    </div>
    <div>
    <div>
    <form class="needs-validation contactForm col-md-7 mx-auto" action="dashboard.php?page=news_delete&id=<?php echo $newsId; ?>" method="POST" novalidate>
            <div class="form-row">
              <div class="col-md-12 mb-3">
                <label for="news_title">News title</label>
                <input type="text" class="form-control" id="news_title" 
                value="<?php echo $news_data['title']; ?>"
                 placeholder="Title" name="updated_news_title"
                  required>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-md-12 mb-3">
            <div class="form-row">
              <div class="col-md-12 mb-3">
                <label for="news_des">Event News</label>
                <textarea type="text" class="form-control" rows="5" id="news_des" name="updated_news_des" placeholder="News description..."
                required><?php echo $news_data['news_message']; ?></textarea>
                <div class="invalid-feedback">
                  Please write some description.
                </div>
              </div>
            </div>
            <button class="btn btn-block btn-danger" type="submit" name="delete_news" >Confirm delete <i class="far fa-trash-alt"></i></button>
          </form>
    </div>
</div>