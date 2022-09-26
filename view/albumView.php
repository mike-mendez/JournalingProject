<!-- <link rel="stylesheet" href="album.css"/> -->

<?php $title = "Album";?>
<?php $style = "album";?>
<?php $script = "album";?>

<?php ob_start();?>
<?php include("sidebarView.php");?>

<div class="overlay display-none" onclick="closeModal()"></div>
<div class="modal-container display-none">
<div class="modal display-none">

</div>
</div>
<div id="container"> 
<h1>Album</h1> 
<section id="album-container"> 

<?php
$month_arr = [];

        for($i = 0; $i < count($res); $i++){
            $path_raw = $res[$i]["paths"];
            $path = explode(",",$path_raw);
            $date_created = $res[$i]["date_created"];
            $newDate = date("F j Y", strtotime($date_created));  
            $month_created = date("F Y", strtotime($date_created));  
            $title = $res[$i]["title"];
            
            // if($month_created){
                
                // if the month_created is NOT in the array, add it and display it
                // if it IS in the array, do nothing
                ?>
            <div id="album-container-bottom">
                <?php 
                if(!in_array($month_created, $month_arr)){
                    array_push($month_arr, $month_created);

                    echo "<p>{$month_created}</p>";
                } 
                
            ?>
            <!-- *BUG* . being added to path when uploading images on entry -->
                    <div class="album" onclick="openModal()" style='background-image: url("<?=BASE . $path[0]?>")';>
                        <p id="album-title"> <?=$title?> </p>
                        <div class="album-bottom">
                            <p>tag</p>
                            <p><?=$newDate?></p>
                    </div>
                </div> 
            </div>

            <?php
        }
    
        ?>

</section>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>
