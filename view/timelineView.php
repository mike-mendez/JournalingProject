<?php $title = "Timeline";?>
<?php $style = "timeline";?>
<?php $script = "timeline";?>

<?php ob_start();?>
<?php include("sidebarView.php");?>

<?php
    if (isset($_REQUEST['type']) && $_REQUEST['type'] === 'registered') {
        // TODO:this should be turn into a little notification modal thing
        echo "<p>You have been registered. Welcome!</p>";
    }
    // print_r($_SESSION['uid']);
?>

<div id="timeline">

    <div class="title">Timeline</div>
    <div class="switchToggle">
        <?php 
            if ($view === "weekly") {
                ?>
                <div class="group">Weekly</div>
                <a href="index.php?action=toggleView&view=month">
                    <div class="group">Monthly</div>
                </a>
                <?php
            } else if ($view === "monthly") {
                ?>
                <a href="index.php?action=toggleView&view=week">
                    <div class="group">Weekly</div>
                </a>
                <div class="group">Monthly</div>
                <?php
            }
        ?>
    </div>
    <?php
    // TODO: change the code depending on the way we're formatting the weekly & monthly
    if ($view === 'weekly'){
    ?>
         <div class="entryDisplay">
    <?php
    } else if ($view === 'monthly'){
        ?>
         <div class="entryDisplay monthlyView">
    <?php
    }
    ?>
            <?php
            // TODO: if problem uncomment the bottom code
                // echo "<pre>";
                // print_r($entries);
                // echo "<pre>";
            if ($entries === null){
                $entries = array();
            }
            if ($view === "monthly") {
                // number of months from the current month to display
                $numOfMonths = 5;
                $monthsToDisplay = displayMonths($numOfMonths);
                foreach($monthsToDisplay as $month){
                    // check if there are entries from that month
                    if (array_key_exists($month, $entries)){
            ?>
                        <div class="month">
                            <div class="monthName"><?=$month." ".$entries["$month"][0]['year']?></div>
                            <div class="monthContainer">
                                <?php
                                foreach($entries["$month"] as $entry){
                                    include "timeTempView.php";
                                }
                                ?>
                            </div>
                        </div>
            <?php
                    }
                }
            } else if ($view === "weekly") {
                $weeksToDisplay = displayDaysInWeek();
                foreach($weeksToDisplay as $weekDay){
                    // check if there are days in that week
                    if (array_key_exists($weekDay, $entries)){
            ?>
                        <div class="week">
                            <div class="weekName">
                                <?=$weekDay?>
                            </div>
                            <div class="weekContainer">
                                <?php
                                foreach($entries["$weekDay"] as $entry){
                                    include "timeTempView.php";
                                }
                                ?>
                            </div>
                        </div>
            <?php
                    } else {
            ?>
                        <div class="week">
                            <div class="weekName">
                                <!-- <?=$weekDay?> -->
                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>