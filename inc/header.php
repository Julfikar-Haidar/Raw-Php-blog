<?php include'config/config.php'; ?>
<?php include'lib/Database.php'; ?>
<?php include'helpers/format.php'; ?>

<?php
$db = new Database();
$fm = new format();
?>


<!DOCTYPE html>
<html>
    <head>
        <?php
        if (isset($_GET['page'])) {
            $titleId = $_GET['page'];

            //data show from table
            $query = "select *from  tbl_page where id='$titleId'";
            $page_title = $db->select($query);
            if ($page_title) {
                while ($result = $page_title->fetch_assoc()) {
                    ?>

                    <title> <?php echo $result['name']; ?>- <?php echo TITLE; ?></title>
                   
                <?php
            }}}//end loop if& while 
          //posts title show
        elseif (isset($_GET['id'])) {
            $postid = $_GET['id'];

            //data show from table
            $query = "select *from  tbl_post where id='$postid'";
            $page_title = $db->select($query);
            if ($page_title) {
                while ($result = $page_title->fetch_assoc()) {
                    ?>

                    <title> <?php echo $result['title']; ?>- <?php echo TITLE; ?></title>
        <?php }}}//category tite show
            elseif (isset($_GET['category'])) {
            $categorytitle = $_GET['category'];

            //data show from table
            $query = "select *from  tbl_category where id='$categorytitle'";
            $page_title = $db->select($query);
            if ($page_title) {
                while ($result = $page_title->fetch_assoc()) {
                    ?>

                    <title> <?php echo $result['name']; ?>- <?php echo TITLE; ?></title>
        <?php }}} else { ?>
            <title> <?php echo $fm->title(); ?>- <?php echo TITLE; ?></title>

<?php } ?>


        <meta name="language" content="English">
        <meta name="description" content="It is a website about education">
        <?php 
        if(isset($_GET['id'])){
            $postidget=$_GET['id'];
            $query="select *from tbl_post where id='$postidget'";
            $postkeywords=$db->select($query);
            if($postkeywords){
                while ($result=$postkeywords->fetch_assoc()){ ?>
                    <meta name="keywords" content="<?php echo $result['tags']; ?> ">
        <?php }}}else{
            
        ?>
                    <meta name="keywords" content="<?php echo KEYWORD;?>" >              

        <?php }?>
        
        <meta name="author" content="Delowar">
        <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
        <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="style.css">
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(window).load(function () {
                $('#slider').nivoSlider({
                    effect: 'random',
                    slices: 10,
                    animSpeed: 500,
                    pauseTime: 5000,
                    startSlide: 0, //Set starting Slide (0 index)
                    directionNav: false,
                    directionNavHide: false, //Only show on hover
                    controlNav: false, //1,2,3...
                    controlNavThumbs: false, //Use thumbnails for Control Nav
                    pauseOnHover: true, //Stop animation while hovering
                    manualAdvance: false, //Force manual transitions
                    captionOpacity: 0.8, //Universal caption opacity
                    beforeChange: function () {},
                    afterChange: function () {},
                    slideshowEnd: function () {} //Triggers after all slides have been shown
                });
            });
        </script>
    </head>

    <body>
        <div class="headersection templete clear">
            <a href="#">
                <div class="logo">
<?php
//data show from table
$query = "select *from  title_slogan where id='1'";
$blog_title = $db->select($query);
if ($blog_title) {
    while ($result = $blog_title->fetch_assoc()) {
        ?>
                            <img src="admin/<?php echo $result['logo']; ?>" alt="Logo"/>
                            <h2><?php echo $result['title']; ?></h2>
                            <p><?php echo $result['slogan'] ?></p>
                        <?php }}//end loop?> 
                </div>
            </a>
            <div class="social clear">
                <div class="icon clear">
<?php
//data show from table
$query = "select *from  tbl_social where id='1'";
$social_item = $db->select($query);
if ($social_item) {
    while ($result = $social_item->fetch_assoc()) {
        ?>
                            <a href="<?php echo $result['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="<?php echo $result['tw']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="<?php echo $result['ln']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                            <a href="<?php echo $result['gp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
    <?php }} ?>
                </div>
                <div class="searchbtn clear">
                    <form action="search.php" method="get">
                        <input type="text" name="search" placeholder="Search keyword..."/>
                        <input type="submit" name="submit" value="Search"/>
                    </form>
                </div>
            </div>
        </div>
        <div class="navsection templete">
            <ul>
        <?php
        $path=$_SERVER['SCRIPT_FILENAME'];
        $currentpage=  basename($path,'.php');
        
        ?>
                <li><a <?php if($currentpage=='index'){echo 'id="active"' ;}?> href="index.php">Home</a></li>
        <?php
        //data show from table
        $query = "select *from  tbl_page";
        $page_item = $db->select($query);
        if ($page_item) {
            while ($result = $page_item->fetch_assoc()) {
                ?>
                                <li><a <?php   if(isset($_GET['page'])&& $_GET['page']==$result['id']){
            echo 'id="active"' ;
        } ?> href="page.php?page=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>	
        <?php }} ?>
                        <li><a <?php if($currentpage=='contact'){echo 'id="active"' ;}?>  href="contact.php">Contact</a></li>

                    </ul>
                </div>
