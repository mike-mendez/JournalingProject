<?php $title = "Map View"; ?>
<?php $style = "map"; ?>

<?php // $script = "map"; ?>

<?php
// $map_entries = array_map(function($entry){$entries[$entry]["text_content"] = "stuff";}, $entries);
for ($i = 0; $i < count($entries); $i++) {
	$breaks = array("<br />", "<br>", "<br/>");
	$entries[$i]["text_content"] = str_ireplace($breaks, "\n", $entries[$i]["text_content"]);
	// TODO: add br to strip_tags function
	$entries[$i]["text_content"] = nl2br(strip_tags($entries[$i]["text_content"]));
}
// echoPre($entries);
$data = json_encode($entries);
$script = "googleMaps";
?>

<?php ob_start(); ?>
<?= "<script> let data = $data </script>" ?>
<?php include "sidebarView.php"; ?>

<!--The div element for the map -->
<div id="map-view-container">
    <h1 class="title">Map View</h1>
    <div id="map-view-map"></div>
</div>

<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
<script defer src="https://maps.googleapis.com/maps/api/js?key=<?= $_SERVER[
	"GMAP_API_KEY"
] ?>&callback=initMap&v=weekly"></script>
<!-- <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?= $_SERVER[
	"KMAP_API_KEY"
] ?>&libraries=services,clusterer,drawing"></script> -->

<?php $content = ob_get_clean(); ?>
<?php require "template.php"; ?>
