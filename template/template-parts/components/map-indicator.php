<?php
$map_location = get_query_var('map_location');
$title = $map_location['title'];
$top_locations = $map_location['top_locations'];
$google_map_iframe = $map_location['google_map_iframe'];

?>
<section class="map-section section-container" >
    <div class="clinic-container map-container">
        <div class="map-location-left">
            <?php
            echo $google_map_iframe;
            ?>
        </div>
        <div class="map-location-right">
            <h2 class="map-location-title">
                <?php echo $title; ?>
            </h2>
            <div class="map-location-list" id="map-location-list"  itemscope itemtype="https://schema.org/ItemList">
                <?php
                $count = 1;
                foreach ($top_locations as $key => $location) {
                    echo '<a class="map-location-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"   href="' . $location['link'] . '"><span itemprop="item" itemprop="name" >' . $location['name'] . '</span> <meta itemprop="position" content="'.$count.'" /></a>';
                    $count++;
                }
                ?>
        </div>
    </div>
</section>