# Base (parent) theme

## Template tags (overridable)

If you'd like to override any of these functions, create a new function in
your functions.php file with the same name. Your function will overwrite 
the original.

### `oneltd_get_img_url($file)`

Return the full url of image `$file` (includes TEMPLATE_DIRECTORY/images/)

### `oneltd_img_url($file)`

echos `oneltd_get_img_url` 

### `oneltd_get_post_thumbnail_src($post_id, $size)`

Return the post thumbnail src for given post id and thumbnail size.

Defaults to current post and 'full'.

### `oneltd_post_thumbnail_src($post_id, $size)`

echos `oneltd_get_post_thumbnail_id`

### `oneltd_register_nav_menus`

Adds nav menus to the site. See also: `oneltd_register_nav_menus` action

### `oneltd_add_theme_support`

Adds post thumbnail support to the theme. Override to remove post thumbnail 
support, or to add more support (post-formats, etc);

## Actions

Because the base theme does some grafting in the background, there are some
actions which it creates which you can hook onto. If possible, you should
use these instead of the standard WP versions (replace `wp_` with `oneltd_`);

### `oneltd_init`

Stuff which should run on wp_init

### `oneltd_admin_enqueue_styles`

Use to enqueue styles in the admin area

### `oneltd_enqueue_styles`

Use to enqueue styles

```
add_action('oneltd_enqueue_styles', 'SITENAME_enqueue_styles');

function SITENAME_enqueue_styles() {
  wp_enqueue_style(...);
}

```

### `oneltd_enqueue_scripts`

Use to enqueue scripts

```
add_action('oneltd_enqueue_scripts', 'SITENAME_enqueue_scripts');

function SITENAME_enqueue_scripts() {
  wp_register_script(...);
  wp_enqueue_script(...);
}

```

### `oneltd_register_nav_menus`

Use to add new nav menus. You can use this instead of overriding the 
`oneltd_register_nav_menus` function. 

```
add_action('oneltd_register_nav_menus', 'SITENAME_register_nav_menus');

function SITENAME_register_nav_menus() {
  register_nav_menus(array(
    // ...
  ));
}
```
