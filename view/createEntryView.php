<?php

if (!isset($_SESSION['uid'])){
    throw new Exception("401 - Unauthorized");
}
?>
<?php $title = "Create New Entry";?>
<?php $style = "createEntry";?>

<?php ob_start();?>

<?php include("sidebarView.php");?>

    <div id="create-entry-container">
        <form id="create-entry-form" action="<?=BASE . "/index.php?action=addNewEntry"?>" method="post" enctype="multipart/form-data">
            <h2 id="create-entry-header-text">CREATE A NEW ENTRY</h2>
            <div id="create-entry-title">
                <input id="create-entry-title-input" type="text" name="title" placeholder="Entry Title"/>
            </div>

            <div id="create-entry-date">
                <i class='bx bx-calendar'></i>
                <!--  Default date to today  -->
                <!-- <input id="create-entry-date-input" type="date" name="date" value=" -->
                <!-- <?php echo date('Y-m-d'); ?> -->
                <!-- "/> -->
            </div>

            <div id="create-entry-location">
                <i class='bx bx-current-location'></i>
                <input id="create-entry-location-input" type="text" placeholder="Location"/>
            </div>

            <div id="create-entry-weather">
                <select id="weather-select">
                    <option value="Sunny">Sunny</option>
                    <option value="Rainy">Rainy</option>
                    <option value="Cloudy">Cloudy</option>
                    <option value="Snowy">Snowy</option>
                </select>
            </div>

            <div id="create-entry-text-content">
                <textarea type="text" id="text-content-textarea" name="textContent" placeholder="Start Writing..."></textarea>
            </div>

            <div id="entry-upload-photo">
            </div>

            <div id="create-entry-bottom">
                <?php require('uploadImageView.php'); ?>
                <div id="create-entry-submit">
                    <input type="submit"/>
                </div>
            </div>
        </form>
    </div>



<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>