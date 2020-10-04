# sea-wordpress-theme

## Building

Run the gruntfile in the theme directory (`wp-content/themes/solidarity-economy/`): 

`grunt dev` will watch for changes and generate uncompressed files while

`grunt build`will watch and generate compressed files with no comments.

## Structure

Any blocks code, content parts or theme or page specific code is generally kept in the `solidarity-economy/inc` folder.

CSS, JS and SASS is stored in `solidarity-economy/src`

_**Don't edit the CSS in style.css**_ – make changes to the SASS only and grunt will rebuild style.css on each change.

## Plugins

The theme comes with Advanced Custom Fields Pro - this requires a license to be ugraded but is allowed to be installed according to the license. Details can found on [the ACF website](https://www.advancedcustomfields.com/resources/including-acf-within-a-plugin-or-theme/#:~:text=We%20do%20not%20allow%20ACF,may%20not%20include%20ACF%20PRO). The steps on this page have been followed.

