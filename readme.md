# Addic Clinic Directory

A comprehensive WordPress plugin designed to manage and display a directory of clinics. The plugin provides an intuitive interface for administrators to add, edit, and remove clinic entries, and offers users advanced search and filtering options to easily find clinics based on location, specialty, or other criteria. Seamlessly integrates with the WordPress admin panel for straightforward management and configuration.
# Addic Clinic Directory

Addic Clinic Directory is a comprehensive WordPress plugin designed to manage and display a directory of clinics (rehabs). It provides an intuitive interface for administrators to add, edit, and remove clinic entries, and offers users advanced search and filtering options to easily find clinics based on location, specialty, or other criteria. The plugin seamlessly integrates with the WordPress admin panel for straightforward management and configuration.

---

## Features

- **Custom Post Type:** Registers a custom post type for clinics (`Rehabs`).
- **Custom Taxonomies:** Organizes clinics using multiple custom taxonomies, including:
  - Locations
  - Clientele
  - Conditions
  - Insurances
  - Therapies
  - Levels of Care
  - Amenities
  - Luxuries
  - Highlights
  - Languages
  - Type of Membership
- **Shortcodes:** Easily display filters, carousels, lists, and AJAX search forms anywhere on your site.
- **AJAX Filtering & Search:** Users can filter clinics by taxonomy or search by name/location with instant results.
- **Carousels & Sliders:** Display clinics and posts in responsive carousels using Swiper.js.
- **Related Posts:** Show related blog posts on clinic pages.
- **Sitemap Integration:** Adds custom taxonomies to the sitemap for better SEO (compatible with Yoast).
- **Template System:** Uses a flexible template system for easy customization.
- **Multilingual Ready:** All strings are translatable.

---

## Installation

1. Upload the plugin folder to `/wp-content/plugins/addic-clinic-directory/`.
2. Activate the plugin through the WordPress admin panel.
3. Configure your clinics and taxonomies from the WordPress dashboard.

---

## Usage

### Shortcodes

- `[filter_page_loop tax="coltman_locations" title="Locations"]`  
  Display a filterable list of clinics by location.
- `[addic_ajax_filter]`  
  Show an AJAX-powered search and filter form.
- `[addic_filters_tab]`  
  Display filter tabs for main taxonomies.
- `[clinic_list_carousel tax="coltman_locations" type="carousel" term="los-angeles"]`  
  Show a carousel of clinics filtered by taxonomy and term.
- `[location_carousel]`  
  Display a carousel of locations.
- `[condition_list]`  
  Show a list of conditions with a "load more" button.
- `[addic_posts_carousel]`  
  Display a carousel of recent blog posts.
- `[coltman_related_posts]`  
  Show related blog posts.
- `[rehabcta]`  
  Display a call-to-action for clinics.
- `[ads_slide]`  
  Show an ads slider.

You can combine and customize these shortcodes as needed.

---

## Folder Structure

- **addic-clinic-directory.php** – Main plugin file and loader.
- **/includes/** – Core logic, post types, taxonomies, filters, and shortcodes.
- **/template/** – Frontend templates for displaying clinics, filters, and components.
- **/assets/** – CSS, JS, and images for frontend and admin.
- **/languages/** – Translation files.

---

## Customization

- **Templates:**  
  Copy any template from `/template/` to your theme's `addic-clinic-directory/` folder to override it.
- **Styles & Scripts:**  
  Customize or enqueue your own styles/scripts as needed.

---

## Requirements

- WordPress 5.2+
- PHP 8.1+

---

## Development

- All code is namespaced and uses WordPress best practices.
- Custom post types and taxonomies are registered via helper classes.
- AJAX handlers are secured with nonces.
- SEO-friendly URLs and sitemap integration.

## License

GPLv2 or later

---

## Support

For support or feature requests, please contact the developer or open an issue in your repository.
