<?php

if (!isset($_SESSION["uid"])) {
    throw new Exception("401 - Unauthorized");
} ?>
<?php $title = "Create New Entry"; ?>
<?php $style = "createEntry"; ?>
<?php $script = "createEntry"; ?>

<?php ob_start(); ?>

<?php include "sidebarView.php"; ?>

<div id="create-entry-container">
    <form id="create-entry-form" action="<?= BASE . "/index.php?action=addNewEntry" ?>" method="post" enctype="multipart/form-data">
        <h2 id="create-entry-header-text">CREATE A NEW ENTRY</h2>

        <!-- TITLE -->
        <div id="create-entry-title">
            <input id="create-entry-title-input" type="text" name="title" placeholder="Entry Title" />
        </div>

        <!-- TAG -->
        <div id="create-entry-tag">
            <div id="create-tag-btn">
                <i class="fa-solid fa-plus"></i>
            </div>
            <input type="text" id="create-tag-input" placeholder="Add a Tag">
            <!-- <i class='bx bx-calendar'></i> -->
            <!--  Default date to today  -->
            <!-- <input id="create-entry-date-input" type="date" name="date" value=" -->
            <!-- <?php echo date("Y-m-d"); ?> -->
            <!-- "/> -->
        </div>
        <div id="tag-cont">
            <input type="text" name="tagNames" class="submitted-tags-input" hidden>
        </div>

        <!-- LOCATION -->
        <div id="create-entry-location">
            <i class='bx bx-current-location'></i>
            <input id="create-entry-location-input" type="text" name="location" placeholder="Location" />
        </div>

        <!-- WEATHER -->
        <div id="create-entry-weather">
            <select id="weather-select" name="weather">
                <option value="">Select Weather</option>
                <option value="0">Sunny</option>
                <option value="1">Rainy</option>
                <option value="2">Cloudy</option>
                <option value="3">Snowy</option>
            </select>
        </div>

        <!-- TEXT -->
        <div id="create-entry-text-content">
            <textarea type="text" id="text-content-textarea" name="textContent" placeholder="Start Writing..."></textarea>
        </div>

        <div id="entry-upload-photo">
        </div>

        <!-- IMAGE UPLOAD -->
        <div id="create-entry-bottom">
            <input type="file" name="imgUpload" id="imgUpload" accept="image/png, image/jpeg, image/jpg" style="display:none;" />
            <div class="entry-photo" onclick="document.getElementById('imgUpload').click();">
                <label>
                    <i id='upload-icon' class='bx bx-cloud-upload bx-md'></i>
                    Add photo
                </label>
            </div>
            <div id="create-entry-submit">
                <input type="submit" />
            </div>
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require "template.php"; ?>