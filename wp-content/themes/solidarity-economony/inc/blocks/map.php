<?php

$attributes = array();

if (($html_title = get_field('html_title'))) {
  $attributes['htmlTitle'] = $html_title;
}

if (!get_field('show_datasets_panel')) {
  $attributes['showDatasetsPanel'] = 'false';
}

$initial_bounds = get_field('initial_bounds');

if (isset($initial_bounds['lat_1']) && isset($initial_bounds['lat_2']) && isset($initial_bounds['lng_1']) && isset($initial_bounds['lng_2'])) {
  $attributes['initialBounds'] = array(
    array($initial_bounds['lat_1'], $initial_bounds['lng_1']),
    array($initial_bounds['lat_2'], $initial_bounds['lng_2'])
  );
}

$default_lat_lng = get_field('default_lat_lng');
if ($default_lat_lng['lat'] && $default_lat_lng['lng']) {
  $attributes['defaultLatLng'] = array(
    $default_lat_lng['lat'],
    $default_lat_lng['lng']
  );
}

if (($filterable_fields = get_field('filterable_fields'))) {
  $attributes['filterableFields'] = esc_attr($filterable_fields);
}

if (!get_field('does_directory_have_colours')) {
  $attributes['doesDirectoryHaveColours'] = 'false';
}

if (($disable_clustering_at_zoom = get_field('disable_clustering_at_zoom'))) {
  $attributes['disableClusteringAtZoom'] = $disable_clustering_at_zoom;
}

if (($searched_fields = get_field('searched_fields'))) {
  $attributes['searchedFields'] = esc_attr($searched_fields);
}

if (($max_zoom_on_group = get_field('max_zoom_on_group'))) {
  $attributes['maxZoomOnGroup'] = $max_zoom_on_group;
}

if (($max_zoom_on_one = get_field('max_zoom_on_one'))) {
  $attributes['maxZoomOnOne'] = $max_zoom_on_one;
}

if (($max_zoom_on_search = get_field('max_zoom_on_search'))) {
  $attributes['maxZoomOnSearch'] = $max_zoom_on_search;
}

if (($logo = get_field('logo'))) {
  $attributes['logo'] = $logo;
}

?>

<iframe src="<?= get_field('map_url') . '?' . http_build_query($attributes, '', '&'); ?>" style="width:100%; height: <?= (get_field('height') ?: '500') . 'px'; ?>"></iframe>
<div class="cover"></div>