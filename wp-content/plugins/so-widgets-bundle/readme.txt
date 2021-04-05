=== SiteOrigin Widgets Bundle ===
Tags: bundle, widget, button, slider, image, carousel, price table, google maps, tinymce, social links
Requires at least: 4.2
Tested up to: 5.7
Requires PHP: 5.6.20
Stable tag: 1.17.11
Build time: 2020-12-09T15:39:14+02:00
License: GPLv3 or later
Contributors: gpriday, braam-genis, alexgso
Donate link: https://siteorigin.com/downloads/premium/

The SiteOrigin Widgets Bundle gives you a collection of widgets that you can use and customize. All the widgets are built on our powerful framework, giving you advanced forms, unlimited colours and 1500+ icons.

== Description ==

The SiteOrigin Widgets Bundle gives you a collection of widgets that you can use and customize. All the widgets are built on our powerful framework, giving you advanced forms, unlimited colours and 1500+ icons.

Widgets are great. No matter where you’re using them. In a [Page Builder](http://siteorigin.com/page-builder/) page or on your widgetized areas. It's even compatible with other popular page building plugins.

[vimeo https://vimeo.com/102103379]

The collection is growing, but here’s what we have so far.

* Google Maps Widget that's going places.
* Button Widget that you’ll love to click.
* Image Widget that’ll let you add images everywhere.
* Call To Action Widget that’ll get your users performing the actions you want.
* Slider Widget that slides images and HTML5 videos.
* Price Table Widget that’ll help you sell more.
* Post Carousel Widget that displays your posts as a carousel.
* Features Widget that lets you display a set of site or service features.
* Video Widget to get your videos out there.
* Headline Widget to get you noticed.
* Social Media Buttons which link to all your social media profiles.
* Accordion Widget to compress your content.
* Contact Form Widget to let people know you care.
* Editor Widget let's you richly edit text anywhere.
* Hero Widget that'll save your site design.
* Icon Widget for when only icons will do.
* Image Grid Widget that'll let you add images everywhere... in a grid.
* Layout Slider Widget lets you build layouts on slides using SiteOrigin Page Builder.
* Masonry Widget to add images in a masonry layout.
* Tabs Widget that'll let you group content into tabbed sections.
* Taxonomy Widget to display the selected taxonomy for the current post.
* Testimonials Widget to show people what your users/customers think of you.

Once you enable a widget, you'll be able to use it anywhere standard widgets are used. You can manage your widgets by going to Plugins > SiteOrigin Widgets in your WordPress admin.

== Documentation ==

[Documentation](https://siteorigin.com/widgets-bundle/getting-started/) is available on SiteOrigin.

== Support ==

We offer free support on the [SiteOrigin support forums](https://siteorigin.com/thread/).

= Create Custom Widgets =

The SiteOrigin Widgets Bundle is the perfect platform to build widgets for your theme or plugin. Read more on our [developer docs](https://siteorigin.com/docs/widgets-bundle/).

== Screenshots ==

1. Manage which widgets you want enabled or disabled.
2. The button widget shows the clean, standard interface all the widgets use.
3. An example of the button widget.

== Changelog ==

== 1.17.11 - 09 December 2020 ==
* Google Maps: Added Map Style button styling.
* Accordion: Submitted contact forms added to Accordion will now open the panel on load.
* Tabs: Prevented the Scroll To setting from affecting the currently selected tab.
* Image Grid: Use image title as item label if set.
* Developer: jQuery updates for WordPress 5.6.
* Developer: Set Slider background image loading to Eager.
* Developer: Exposed Google Maps instances. Once set up, maps can be accessed via `sowb.SiteOriginGoogleMapInstances`.
* Developer: Add a Google Maps `maps_loaded` event that triggers after all of the Google Maps have finished being set up.

== 1.17.10 - 13 November 2020 ==
* TinyMCE: Resolved issue with the Add Media button.

== 1.17.9 - 12 November 2020 ==
* Block Editor: Resolved widget preview issue.
* Elementor: Minor admin styling improvements.
* Google Maps: Added a new global consent setting `Require consent before loading Maps API` at `Plugins > SiteOrigin Widgets > Google Maps`.
* Posts Carousel: Added a `Link target` setting.
* Video Player: Mute self hosted videos set to autoplay.
* Tabs: Added a new global setting `Scroll top` at `Plugins > SiteOrigin Widgets > Tabs` to disable scrolling when changing tabs.
* Accordion: Added a new global setting `Scroll top` at `Plugins > SiteOrigin Widgets > Accordion` to disable scrolling when changing accordions.
* Posts Carousel: Added a new `Slides to scroll` setting for desktop, tablet, and mobile.
* Safari: Ensured the Hero can save when used at `Appearance > Widgets`.
* Updated the widget title field to allow HTML in all SiteOrigin widgets.
* Changed to `enqueue` Google Fonts rather than `@import`.

== 1.17.8 - 28 September 2020 ==
* Image: Prevent image stretching while using Safari

== 1.17.7 - 10 September 2020 ==
* Hero and Layout Sliders: Disable image preload for images added to frames.
* Resolved a preview issue with widgets that attempt to render sub widgets but don't output them.
* Contact Form: Added a field max-width setting.
* Resolved a jQuery Migrate notice on the global widget settings page at `Plugins > SiteOrigin Widgets`.
* Media field: Enhancements to improve usability.
* Disabled Settings buttons while saving global widget settings at `Plugins > SiteOrigin Widgets`.
* State Emitters: Added an animation to conditional settings.
* Posts Carousel: Prevented blank slides loading after all posts are loaded.
* Posts Carousel: Added a new Design settings section and settings.
* Posts Carousel: Ensured the correct navigation buttons are hidden when multiple carousels are in use.
* IE 11: Prevented images from exceeding the widget container.
* Removed wpColorPickerL10n if WP >= 5.5.

== 1.17.6 - 17 August 2020 ==
* Hero and Layout Sliders: Disabled lazy loading for images added to the slide content area.
* Slider: Disabled lazy loading in the Block Editor.

== 1.17.5 - 12 August 2020 ==
* Slider: Disable WordPress 5.5 Lazy Loading.

== 1.17.4 - 06 August 2020 ==
* Post Carousel: Improved support for multiple carousel widgets on the same page.
* Post Carousel: Improved mobile support.
* Sliders: Added `Autoplay` and `Autoplay Pause on Hover` settings to the Slider, Layout Slider and Hero widgets.
* Features: Allowed shortcodes to be used in the Text field.
* Contact Form: Fix to ensure the correct fields are passed to Akismet.

== 1.17.3 - 23 July 2020 ==
* Reverted: Features: Prevented icon overlapping text in edge cases.
* Social Media Buttons: Added TikTok.
* Button: Removed `:visited` color targeting.
* Button: Set hover background color defaults.
* Carousel: Improved multi-carousel support.
* Carousel: Triggered click on swipe for mobile devices.
* Carousel: Contextualized variables as needed.
* Carousel: Find the `ItemWidth` as needed rather than predefining it.

== 1.17.2 - 21 July 2020 ==
* Resolved button Less CSS bug.

== 1.17.1 - 20 July 2020 ==
* Post Carousel: Prevented all posts from outputting. `10` will be output at a time if `Posts per page` isn't set.
* Post Carousel: Inlined navigation buttons if a title is set.
* Updated the Google Fonts array.
* Editor: Added `wp_filter_content_tags` function.
* Updated [Packery](https://packery.metafizzy.co/) to latest version.
* Simple Masonry: Added a `Layout origin` setting.
* Testimonials: Set testimonial text width to `100%`.
* Updated Font Awesome to latest version.
* Image: Added `siteorigin_widgets_image_args` filter allowing adjust all of the widget arguments and attributes.
* Simple Masonry: Added external image support.
* Code Form Field: Removed HTML sanitization.
* Tabs: Added smooth scroll to tab when linked to.
* Added `font-display: block` to all font icons.
* Widget Block: Added `Additional CSS Classes` output.
* Button: Added Button hover style settings.
* Features: Prevented icon overlapping text in edge cases.
* Post Carousel: Resolved IE 11 JavaScript error.
* Post Carousel: Vertically align navigation icons and title when title present.
* Editor: Added `noreferrer` to any target links preventing Layout block failing validation when `target=_blank` link added.
* Hero: Prevented buttons from loading when buttons shortcode isn't added.
* Post Carousel: Added a `Link target` setting.
* Post Carousel: Disable button navigation if number of visible posts is more than total posts.
* Mobile: Improved admin form field responsive behavior.
* Updated Font Awesome from `5.13.0` to `5.14.0`.

== 1.17.0 - 22 May 2020 ==
* Simple Masonry: Added a preloader and related settings.
* Post Carousel: Migrated to Slick Carousel.
* Post Carousel: Added RTL support.
* Icon: Added Title field.
* Minor admin interface styling fixes.
* Price Table: Added title for the feature hover text.
* Testimonials: Added `Equalize testimonial height` setting.
* Testimonials: Fixed user image alignment.
* Switched to Wikimedia's fork of less.php.
* Added error suppression for external Less library.

== 1.16.1 - 20 April 2020 ==
* Accordion: When hiding panels, only search the current accordion and not nested accordions.
* Slider Widgets: Removed slide navigation numbers from excerpt output.
* Added support for custom icon styles.
* Tabs: Fixed top/bottom tab alignment when tab position is set to right/left.
* Post Carousel: Prevent themes from adjusting the thumbnail top margin.
* Improved the reliability of widget description translations. Updated various widget descriptions.
* Editor: Resolved the notice appearing when post meta wasn't available.
* Simple Masonry: Item labels - If the item title field isn't populated use the image title field.
* Hero: Added a setting to vertically align the slide contents.
* Updated jQuery TouchSwipe.
* Sliders: Fixed pagination spacing when HTML optimization is in use.
* Layout Slider: Set frame labels based on the content inserted.
* Slider: Set frame labels based on the content inserted.
* Contact Form: Added placeholder support to the dropdown select field. Used if the field label position is set to Inside.
* Contact Form: Added Required support for the dropdown select field.
* FontAwesome: Moved Brands to the last position in dropdown list.
* Layout Slider: Added a setting to vertically align the slide contents.

= 1.16.0 - 11 February 2020 =
* Block Editor: Fixed widget select field width and alignment.
* Removed unused template files.
* Contact Form: Improved checking for SiteOrigin development email addresses.
* Minor styling improvements to the Classic and Block Editor admin interfaces.
* Features: Added a new setting to select the H tag to be used for the title field.
* Hero: If a height value is assigned, added prefilling to avoid a page jump.
* Hero: Added `font-display: swap` for Google font imports.
* Layout Slider: If a height value is assigned, added prefilling to avoid a page jump.
* Image Grid: Added a class of `sow-image-grid-image_html` to each image. Can be used to exclude images from Lazy Loading plugins.
* Simple Masonry: Added a class of `sow-masonry-grid-image` to each image. Can be used to exclude images from Lazy Loading plugins.
* Features: Added fallback support for the Icon image field.
* Testimonials: Add fallback support for the Image field.
* Post Carousel: Prevented looping until all posts are loaded.
* Post Carousel: Added a new setting to disable looping.
* Post Carousel: Prevented scrolling past loading items and loop as soon as last item is completely visible.
* Contact Form: Added disabled cursor to submit button when disabled.
* Block Editor: Resolved Features widget default settings.
* Tabs and Accordion: Account for accented characters.
* Social Media Buttons: Allowed for multiple instances of the same network without duplicating colors.
* Social Media Buttons: Ensured all icons are correctly centered.
* Contact Form: Added lightweight validation for phone numbers.
* Block Editor: Display author for third party widgets.
* Block Editor: Added processing for the more quicktag in the Editor widget.
* Tabs and Accordion: Added icon spacing.
* Testimonials: Improved image sizing behavior for square images.

= 1.15.9 - 11 November 2019 =
* Contact Form: Improved default email address handling.
* Contact Form: Improved subject field labeling.
* Post Carousel: Loop the carousel when reaching the end.
* Social Media Buttons: Fixed issue with responsive breakpoint unit of measurement.
* Google Maps: Ensured settings modal window opens when directed to insert API key.
* Google Maps: Fixed map center field when used in the Customizer.
* Fixed compatibility with WordPress 5.3.
* Minor code style and widget label improvements.

= 1.15.8 - 20 August 2019 =
* Run FitText setup on window resize events.
* TinyMCE field: Copy any missing content CSS urls from main editor.
* Post Carousel: Prevent scrolling past the last item.
* Contact Form: Prevent sending to testing/dev emails.
* Widget block: Add `h3` wrapper for widget titles.
* Image widget: Remove `width:inherit;` IE8 fix for bound setting which breaks in IE11.
* Sliders: Added padding to slider navigation arrows.
* Accordion: Check if if anchor is present in URL and scroll to Accordion item.
* Various form description and styling fixes.

= 1.15.7 - 22 May 2019 =
* Widget Block: Ensure changed data is retained after previewing.
* Image widget: Prevent overflow of image container when wrapped in link.
* Image Grid: Dispatch event to notify listeners that layout is complete.
* Image Grid: Fix layout for images wrapped in links.
* Image grid: Use image media title for display if title isn't set in the widget form.
* Layout Slider: Remove header and text style fields.
* Remove Autoptimize cache clearing as it detects changes automatically.
* Update FontAwesome icons.
* Google Maps location field: Ensure value is retained after preview in the block editor.
* Prevent issue in SiteOrigin Layout Block when `sowb` hasn't been defined.

= 1.15.6 - 29 April 2019 =
* Image: Fix images vertical stretching.
* Image: Fix widths for images wrapped in links.
* Google Maps Location Field: Remove some unnecessary use of jQuery to avoid `$ is not a function` errors.
* Google Maps Location Field: Check if matchError exists before accessing.

= 1.15.5 - 25 April 2019 =
* Removed admin notice for new widgets.
* Slider Base Widget: Removed unused background videos height setting.
* Price Table: Recalc equalized heights when window size or orientation changes.
* Google Maps location field: Use value in sanitization if already an array.
* Add compatibility for Autoptimize.
* Simple Masonry: Ensure all available width is used for layout.
* Image: Change alignment to use `display:flex` instead of `text-align`.

= 1.15.4 - 27 March 2019 =
* Slider field: Live updates for display value.
* Widget block: Show error if missing or invalid widget data.
* Google Maps: Add more links to relevant docs for enabling required APIs.
* Google Maps Location field: Catch API key errors and display notice.
* Run FitText resizer on `setup_widgets` too.
* Add font url as property of font info object.
* Image grid: Use opacity for initial hide of images so that size may still be detected.
* Google Maps: Detect draggable or scroll_zoom before running setting migration.
* Accordion and Tabs: Trigger window resize on start of animation.
* Icon: Prevent undefined index notices.

= 1.15.3 - 6 March 2019 =
* Image grid: Fallback support, alt text, use measurement fields.
* Features: Fix responsive layout.
* Google Maps: Update to use gesture handling and separate zoom level for mobile.
* Google Maps: Default height when height field is empty.
* Sliders: Option to always show navigation on mobile devices.
* Accordion: Keyboard navigation.
* Beaver Builder: Fix icons and widgets not saving.
* Video: Allow using YouTube embed URLs.
* Post Carousel: Accessibility improvements.
* Escape namespaced widgets in previews.
* Flag additional metaboxes as incompatible with the block editor.
* Fix state emitters for sub-widget fields.
* Google Maps: Remove API key field from widget form, in favor of global API key field.
* Google Maps: Display notice when API key missing.
* Contact form: Prevent double nonce.
* TinyMCE field: Prevent twemoji from replacing emoji in the textarea.
* Widget block: Show appropriate message when widget is missing or deactivated.
* Accordion: Fix open/close icon layout when set to left position.
* Social Media Buttons: Prevent the phone network from opening in a new window.
* Google Maps: Add map styles filter.
* Image radio field: New field created.
* Posts field: Option to specify allowed post types.
* Contact form: Add description to reCAPTCHA field specifying reCAPTCHA v2.

= 1.15.2 - 18 February 2019 =
* Tabs: Set default tab position to top.

= 1.15.1 - 15 February 2019 =
* Google maps: Use correct locations for static maps.

= 1.15.0 - 14 February 2019 =
* Location field: New specialized admin form field which autocompletes addresses using the Google Maps places library.
* Google maps: Moved global API key override to `modify_instance` to make key available in admin form too.
* Google maps: Auto-migration of locations to new location field format.
* Update LESS PHP library with fixes for PHP 7.3 compatibility.
* Features: Apply text styles to all features content, not just `<p>` tags.
* Social Media: New networks: Bandcamp, Goodreads, Telegram, Strava, Blogger.
* Accordion: Fix issue preventing use of numbers in panel titles.
* Block editor: Preview fixes.
* Beaver Builder compat: Fix widgets failing to update and CSS for FontAwesome icons.

= 1.14.1 - 9 January 2019 =
* Icon field: Set correct value of currently selected icon for non-FA icons.
* Icon field: Avoid requiring that third party icon families include a `filter.php` file.
* Widget block: Use JS array reduce function instead of lodash.
* Allow widgets registered by instance.
* Multi-measurement field: Fix layout.
* Block editor: Send widgetData when fetching widget forms.
* Tinymce field: Prevent JS console errors for hidden fields.
* Order field: Additional sanitization before rendering.

= 1.14.0 - 4 January 2019 =
* Accordion: allow multiple panels with the same title.
* Actions when widgets' CSS files are created/deleted.
* Compat fixes for PHP 7.3
* Indicate when 'setup_widgets' is triggered for previews.
* Accordion: Debounce window.location.hash updates to prevent incorrect states.
* Don't remove FitText window listener to ensure previously set up FitText elements still work.
* Icon field: Show loading indicator while icons are loading.
* Widget documentation links.
* Icons: Update to use latest FontAwesome icon sets.
* Sliders: Resize slides when widgets are set up.
* Elementor compat: Directly enqueue necessary scripts and styles for previews.
* Allow widget headers to be translated.
* Accordion: Keep the clicked panel in the viewport, if it moves out.
* TinyMCE field: Check if tinymce is available before using.

= 1.13.4 - 6 December 2018 =
* Widget block: Fix Layout Slider not being editable.
* Widget block: Correct used of i18n for block editor.
* Widget block: Fix previews.
* Google map: Move global API key override to `modify_instance` to ensure key is available in form.
* Widget block: Prevent multiple API requests.

= 1.13.3 - 15 November 2018 =
* Contact: Fix checkboxes and radio alignment on android.
* FitText: Set minimum font size to ensure readability.
* TinyMCE field: Use correct editor when block editor is present.
* Google maps: Use correct info window text for markers.
* TinyMCE: Remove 'editor-buttons' style enqueue causing conflicts.
* TinyMCE field: Prevent adding multiple copies of media buttons.
* Image widget: if no alt text is supplied add an empty alt attribute.
* Repeaters: Reverted some commits causing multiple issues.
* WP 5: Fixed some styles in the block editor.
* Only setup form fields in the dialog when a PB edit widget dialog is opened.
* Multi-measurement field: Fix autoFill in block editor and attempt to fix in PHP <= 5.3.

= 1.13.2 - 31 October 2018 =
* Builder field: Prevent error in PHP <= 5.4
* Avoid replacing repeater item id placeholders for child repeaters.
* Repeaters: In repeater setup, don't setup child repeaters.

= 1.13.1 - 29 October 2018 =
* Gutenberg: Alert user that changes will be lost when changing the widget type.
* Tabs: Keyboard navigation and more accessibility improvements.
* Google maps: Better geocoding request management.
* TinyMCE field: Use correct selector for checking whether click target is editor switching tab.
* Slider: Option to prevent hiding video on mobile.
* Accordion: Deep-linking for child accordions.
* Use inline CSS fallback if writing to file failed.
* Better FitText compressor description.
* Delete old widget styles when updating widgets.
* Layout Slider: Resoonsive height.
* Accordion: Expand when user is printing.
* Features: Text case adjustments and formatting.
* Beaver Builder: Dark styling.
* Builder field: Allow double-encoding to allow already encoded text in editors.
* Contact form: Prevent adding the anchor again if it's already been added.
* Contact form: Attempt to scroll to contact form after submitting, so result is visible.
* Builder field: Set data correctly from JS.
* Builder field: Don't encode already JSON encoded values.
* Gutenberg: Allow editing page containing deactivated widget.
* Gutenberg: Reset global `$post` after enqueueing widgets' scripts and styles, which might run secondary queries.

= 1.13.0 - 13 September 2018 =
* SiteOrigin Widgets Gutenberg block!
* Google Map: Prevent script from running further if no map canvas elements found.
* Removed style to set `p` margins to zero.
* Check that fallback image for static maps is not an empty string before attempting to use it.
* TinyMCE: Ensure target is one of the editor tabs when switching modes.
* Set values for repeaters which are direct children of section fields.
* Prevent unselected radio input state emitters from affecting form states, when form values are set programmatically.
* Plugin Action Links: Check if edit link is present before removal.
* Social Media Buttons: Added Phone and Angelist. Changed email title text.
* Metabox manager: Set empty post meta string value to array. Ensure metabox widget form values are saved when saving drafts too.

= 1.12.1 - 17 July 2018 =
* Contact: Allow non-string values in required field validation.
* Initialize CTA, Price Table and Video JS widgets correctly when in accordion/tabs widgets.

= 1.12.0 - 11 July 2018 =
* Contact: Add dedicated textarea height.
* Social Media Buttons: Adds WhatsApp social network.
* Features: Allow icon size to use a different unit of measurement.
* Repeater field: Update editor id in media buttons when duplicating item with TinyMCE editor.
* Posts field: taxonomy description.
* Price Table: Disable equalized row heights on mobile.
* Beaver Builder: Force icon fonts.
* Slider widgets: Added autoplay option for background videos.
* Maps: Renamed Google maps script to more sensible `sow.google-map.js`
* Editor: Prevent errors when visual editing is disabled for a user.
* Optimized images.
* Accordion/tabs: Trigger 'setup_widgets' to ensure any widgets in panels are initialized correctly.
* Contact: Use 'From' email address if there is no email field in the form.
* Hero: Filter out the align field in the button sub-widget form.
* Testimonials: Switch mobile and tablet resolution width field descriptions.
* Posts field: Allow clearing dates.
* Font field: Use correct value for 'Helvetica Neue' and added 'Arial' option.
* TA: Additional setting to allow clearing the default background colors.
* Contact: Allow a value of '0' for required fields and subject values.

= 1.11.8 - 12 April 2018 =
* Added action just before rendering widget previews.
* Editor: Removed `unwpautop`.
* Editor: Ensure TinyMCE field knows whether to apply `autop` or not.
* Editor: Only apply `autop` on display when using HTML editor.
* Editor: Prevent `widget_text` filters from running `do_shortcode`.

= 1.11.7 - 23 March 2018 =
* Image: Add title alignment setting.
* Button: Add max-width to ensure buttons are responsive.
* Hero: New filter for frame content 'siteorigin_hero_frame_content'
* Features: Don't set margin for one column left/right feature.
* Updated widget icons.
* Updated google web fonts.

= 1.11.6 - 14 March 2018 =
* Hero: Add responsive height settings.
* Added pikaday jQuery plugin and register pikaday scripts for front end too.
* Features: item float clearing and padding mobile specific.

= 1.11.5 - 13 March 2018 =
* Features: Better feature padding removal on row ends.
* Sliders: WCAG 2.4.4 compliance.
* Tabs: Hide widget title when no title is set.
* TinyMCE field: Added setting for `wpautop` processing which is on by default.
* Contact: When Gradient disabled, set basic background.
* Beaver Builder compat: Only set SOWB widget form values when editing a SOWB widget.
* Contact: Option to log submitter's IP address.
* Add random number and set `more_entropy` to increase chance of unique form ids.
* Contact: Added 'tel' field type which should show numeric keyboard on mobile.
* Media field: Trigger change event when removing selected image.
* Renamed the PHP LESS parser to `SiteOrigin_LessC` to avoid conflicts.
* Date range field: Prevent initializing date range fields multiple times and ensure date format consistent.
* Register pikaday as common script and enqueue as needed in fields.
* Google Map: Show satellite map type.
* Translation: Add context to From strings.
* Add missing semicolons to Ionicons codes.

= 1.11.4 - 7 February 2018 =
* Slider: Add playsinline for Video backgrounds for iOS.
* Repeater field: Trigger change events for repeater when adding, removing or duplicating items.
* TinyMCE field: Removed special handling for TinyMCE fields when retrieving data. Just use field value directly.
* Fixed build overwriting some CSS files.

= 1.11.3 - 10 January 2018 =
* Hero: Add margin-top to so-widget-sow-button for spacing.
* Accordion: Added overflow to prevent Image overlap.
* Google Maps: Always register Google Maps script.
* Social Buttons: Mobile Alignment global widget settings
* Contact Form: Ability to control the width of the submit button.
* Contact Form: Add alignment options for submit button.
* Contact Form: Setting submit button gradient intensity to 0 removes gradient.
* Contact Form: Add success and error hooks.
* Accordion: Don't output widget title if not set.
* Accordion: Icon title collapse fix.
* Contact Form: Add placeholder for field type input.
* Button: Icon placement setting.
* Hero: Adjustable Paragraph text shadow.
* Hero: Add font family setting for paragraphs.
* Hero: Add link color picker.
* Slider field: allow float values and allow specifying step size.
* Contact Form: Add ability to set onclick and id for submit button.
* Features: Add ability to control responsive breakpoint.
* Global Settings: Add support for global settings added by themes.
* Beaver Builder Compat: Don't enqueue assets when all widgets are deactivated.
* Hero: Text font empty check.
* Contact Form: Preserve existing location hash when contact form is submitted.
* Post Selector: Only include current post id in exclusion if singular.
* Copy correct radio values when duplicating repeater items.
* Checkbox field: Parse string value 'false' in checkbox field sanitization.

= 1.11.2 - 27 November 2017 =
* Fix compatibility with Beaver Builder Lite.
* Tabs: Recalculate height on resize.

= 1.11.1 - 24 November 2017 =
* Hero: Allow for shortcodes to work.
* Fix posts field not displaying selected values when multiple selected.
* Widgets Page: Fix missing icon issue on windows.
* Trigger 'hide' and 'show' events in Accordion and Tabs widgets when toggling content.
* Fix Google Maps widget not displaying when map is initially hidden.
* Fix Beaver Builder compatibility.
* Builder field: Pass builder type when setting up builder fields.
* Tabs: Use correct variable for tab anchor.
* Repeater field: Prevent radio inputs values being cleared in repeaters when sorting.
* Accordion: Added title field.
* Fix PHP version compatibility checker errors.

= 1.11.0 - 7 November 2017 =
* New Tabs widget!
* Contact: mention it's possible to send to multiple emails.
* Features: Fixes margin causing extended page.
* Presets field.
* Accordion: Add Repeater Label Title.
* Hero: ability to select an image size.
* TinyMCE field: Remember last selected editor.
* Add rel="noopener noreferrer" for all 3rd party/unknown links.
* Social Media Buttons Widget: comply WCAG 2.4.4

= 1.10.2 - 20 October 2017 =
* Fix for links sometimes not working in slider widgets.
* Fix multi-measurement field labels.

= 1.10.1 - 13 October 2017 =
* Fix subwidget fields initializion when not contained in a section.
* TinyMCE field: fix initialization in repeaters.

= 1.10.0 - 11 October 2017 =
* New Accordion widget!
* Prevent multiple initialization of media field.
* Use correct path for widget banner when defined in a theme.
* Video: Added option to show/hide related YouTube videos at end of video.
* Slider: Handle links inside slider frames first and then allow processing of frame background clicks.
* Give repeated fields in widget fields unique ids for state handling.
* New multi-measurement field.
* Widget Manager Path Comparison fix. (allows for settings to work)
* Button: Use `esc_js` instead of `esc_attr` for onclick.

= 1.9.10 - 14 September 2017 =
* TinyMCE field: fixed issue with filter for TinyMCE plugins.
* Added teaser messages for SiteOrigin Premium addons.

= 1.9.9 - 31 August 2017 =
* Avoid using relative paths in asset URLs.
* Fixed compat with latest Elementor update.

= 1.9.8 - 21 August 2017 =
* Use WordPress functions to exit AJAX actions.
* TinyMCE field: Initialized once.
* TinyMCE field: Simplified switching between TinyMCE and QuickTags.
* TinyMCE field: Check if individual TinyMCE settings are encoded as JSON and decode before re-encoding all settings.
* Some compat fixes for Elementor.
* TinyMCE field: Temporarily disable Jetpack Grunion editor.
* Use correct JS dependencies for Beaver Builder compatibility when `WP_DEBUG` not defined.
* Removed unnecessary enqueues in Beaver Builder compat for dashicons and wp media scripts.
* Post carousel: Only handle horizontal swipes.

= 1.9.7 - 11 August 2017 =
* Contact: Added user configurable field for 'From:' address.
* TinyMCE field: Use editor stylesheets for new TinyMCE editor.
* TinyMCE field: Use UTF-8 encoding for text output.
* Sliders: Check whether `$frames` is empty before using.
* Google Maps: Prevent automatic center for routes.

= 1.9.6 - 4 August 2017 =
* Slider: Background Video: Try embedding the video if oEmbed fails.
* Contact: Added some nonce checks.
* Contact: add reply-to header.
* Remove elementor panel width override.
* Editor: Fix TinyMCE editor button filters in WP >= 4.8.
* Editor: Preserve encoded HTML entities in TinyMCE field.
* TinyMCE field: Added missing `tiny_mce_before_init` filter.

= 1.9.5 - 25 July 2017 =
* Fixed icon field selection.
* TinyMCE field is initialized when quicktags is selected.
* Autocomplete field only initialized once.
* Posts field sanitization handles multiple post types.

= 1.9.4 - 24 July 2017 =
* Using new Editor JS API for TinyMCE field.
* Carousel: apply static position on `.overlay`.
* Layout Slider: Add ability to set Background image to Title and spaced the code.
* Add capabilities check to widget activation action.
* Testimonial: Corrected typo in description and corrected formatting.
* Enabling translation for "From:" in contact mail.

= 1.9.3 - 3 July 2017 =
* Editor: Fix settings form label.
* Don't select the external fallback field as value input.
* Social media buttons: Don't output calls when missing network name.
* Use gettext for widget global settings dialog title.
* Image: Added link attributes to template variables.
* Image grid: Use `get_template_variables`.
* Image grid: Template code structure a bit more readable.
* Simple masonry: Assign link attributes in `get_template_variables`.
* Slider widget: Output link attributes.
* Features: Remove redundant paragraph from template.
* Google Maps: Fix issue when no matches found in maps API error string.
* Google Maps: Mention required Google Maps APIs in field descriptions.
* Google Maps: Localized strings used in JS.
* Elementor 1.5: Ensure widgets' setup scripts are run after editing.

= 1.9.2 - 8 June 2017 =
* Post Carousel: default image for posts without featured images.
* Social Media Buttons: allow empty colors.
* Editor: prevent text processing for cache and post content rendering.
* Post selector field: Fix additional args encoding.
* Post selector field: Fix taxonomy search.

= 1.9.1 - 1 June 2017 =
* Fixed Maps widget JS error.

= 1.9 - 30 May 2017 =
* Compatibility with Visual Composer.
* Taxonomy widget text display.
* Price table widget: option to make feature row heights equal.
* New posts selector field based on other existing fields.
* New autocomplete field. Currently supports showing results from posts and taxonomies.
* New date-range field with option to select specific or relative dates.
* Editor widget: Global widget setting for default 'autop' state.
* Some layout fixes for widget forms in Elementor.
* Google Maps: fallback image when maps API not available or returns error.
* Contact form: Reduced intensity of disabled button styling.
* Google Maps: Fix markers not displaying when queries are rate limited.
* Features: Option to use specified icon size for custom icon images.
* Updated FontAwesome icon set to 4.7.0
* Updated IcoMoon icon set.
* Contact form: Allow duplicate forms on same page.
* Widget temp backup in browser storage.
* Google Maps: Custom marker icon for each marker.
* Option to specify default number of visible rows in icon field.
* Changed PHP LESS compiler to a better maintained version.

= 1.8.6 - 10 May 2017 =
* Editor widget supports Jetpack Markdown.
* Editor widget global setting for enabling/disabling 'autop' by default.
* Allow setting FitText compressor strength in hero and headline widgets.
* Fix variable name in `enqueue_registered_styles`.
* Fix FitText not working previews.

= 1.8.5 - 27 April 2017 =
* Fixed button hover class.

= 1.8.4 - 27 April 2017 =
* Fixed button URLs.
* Removed image `sizes` attribute when Jetpack Photon is enabled.
* Fixed missing widget handling for misnamed widgets.

= 1.8.3 - 26 April 2017 =
* Contact Form: Improved type Validation and added empty name check
* Contact Form: Add Field Design Settings
* Testimonial: Add responsive image sizes settings
* Added checks to prevent PHP warnings
* Improved handling of empty order fields.
* Small code refactoring in price table widget.
* Ensure all SiteOrigin widgets are grouped together in Page Builder.
* Slider: Remove slider sentinel contents to avoid things like duplicated video iframe for embedded videos
* Fix TinyMCE z-index.
* Headline: Fixed typo that tied subheadline new window to headline
* Ensure fittext is done before setting up hero slider.
* Ensure google font fields work in live editors/previews.
* Features: Allow specifying position of features widgets icons.
* Added * next to labels of required fields.
* Make required field indicator optional and display legend when enabled.
* Set default color option in wpColorPicker.
* Small refactor to make more use of `get_template_variables`.
* Button: Added field for `rel` attribute.
* Maps: Added setting for global Google API key.
* Small fix to allow checkboxes to act as 'conditional' state emitters.
* Features: Change text form field to a tinymce field
* Properly work with new Page Builder caching system
* Ensure footer templates only printed when editing with Elementor.
* Small IE8 fix
* Contact: Prevent form fields from having 0px height if no height specified.
* Fixed Google Maps info windows.
* Image: Don't output empty attributes.
* Don't attempt to load maps API if already loaded.

= 1.8.2 - 1 April 2017 =
* Compatibility with upcoming Page Builder 2.5 release.
* Fixed compatibility with Elementor 1.4+.
* Fixed incompatibility with Jetpack.

= 1.8.1 - 3 February 2017 =
* Fixed empty array warning.
* Contact Form: Prevent empty title markup from being echoed.
* Contact Form: Display email after name
* Slider: Account for 0 speed.
* Features: Fix sizing issue when using images instead of icons.
* Use default unit if missing for measurement fields.
* Price Table: Shortcode support for feature text.
* Testimonial: Updated text radius label and fixed resulting functionality.
* Revert change made to post search for link field.
* Link Field: Make sure we have a valid post_types value.

= 1.8 - 31 January 2017 =
* Introduced compatibility system.
* Added compatibility with Elementor and Beaver Builder.
* Ensure radio inputs in repeaters have their checked property set correctly.
* Various Call to Action widget improvements.
* Use `text-align: center;` for features icons.
* Always use HTTPS for Google Webfonts.
* Post Selector: Exclude current post id
* Post Selector: Add filter returned query
* Post Carousel: Prevent empty title output.
* Google Maps: Add ability to set link for Static Map.
* Social Links: Add title field and title attributes for links.
* Features: Add title text field for features
* Button Widget: Add Font setting
* Contact: Add radio field Type
* Taxonomy: New Window Setting
* Added a way of specifying post types for link field.
* Introduced a global widget setup action.

= 1.7.2 - 09 November 2016 =
* Made fixes to pass PHP 7 compatibility checks.
* Image Widget: Get alt and title text from chosen image.
* Replaced markup parser with more actively maintained one.
* Simple Masonry: ensure resize on load
* Image Grid: Allow 0 as valid spacing value.
* Editor Widget: Call `WP_Embed::run_shortcode` on Editor widget content
* Maps: Added missing `typeof` causing maps api not to load properly.
* Icon: Fixed URL output.
* Fixed double slash in URLs.
* Features: Use Measurement fields.
* Apply modify_form to form arrays created in the constructor.
* Contact Form: add email default email subject if no subject defined.

= 1.7.1 - 21 September 2016 =
* Fixed case of Maps widget in sidebar causing an error on pages without that sidebar.
* Fixed icon field CSS.

= 1.7 - 20 September 2016 =
* Added mechanism for creating global widget setting.
* Added mechanism for adding dismissible notices to widget forms.
* Unified Google Maps JS working for maps widget and contact form location field.
* Added icon search for icon field.
* Added remove button to icon field.
* Contact Form: Fixed clash with Firefox field validation.
* Properly display remove button after importing Pixabay image.

= 1.6.5 - 15 August 2016 =
* Fixed dialog z-index.
* Added field required argument.
* Properly trigger change for image search import.
* Sanitize arg can now be a callback.
* Improved multi checkbox field
* Maps: Just call initialization function if maps API already loaded.

= 1.6.4 - 21 July 2016 =
* More settings and customizability for Headline widget.
* Added FitText to Headline and Hero Image widgets.
* Fixed Pixabay image importing.

= 1.6.3 - 19 July 2016 =
* Added image search functionality to media field.
* Moved actions into their own file.
* Allow widgets to provide their own LESS/HTML.
* Added very simple code field.
* Multiple widgets can have the same class. Allowing widget functionality to come from configuration.
* Various tweaks for upcoming Widgets Builder plugin.

= 1.6.2 - 11 July 2016 =
* Fixed Firefox issue in post selector builder.
* Properly escape all uses off add_query_arg.
* Added filter after video

= 1.6.1 - 24 June 2016 =
* Social Links: Fixed auto-filling of network colors.
* Social Links: Added 500px network.
* Social Links: Added title tag to link tags.
* Maps: Prevent JS error in when maps widget script is enqueued but widget isn't displayed.
* Maps: Made API field more prominent as it's now required by the Google Maps API.
* Added more general error checking.

= 1.6 - 21 June 2016 =
* Added builder field.
* Added new multi checkboxes field.
* Added Layout Slider widget.
* Added taxonomy widget.
* Added slider wrapper attributes and filter.
* Fix for measurement field inside a repeater.
* Modified base folder to work independently of Widgets Bundle.
* Added custom icon families callback argument to icon field.
* Properly handle attachments in post selector
* Contact Form: Refactored form fields.
* Hero Image: Added image type to Hero Image widget.
* Button: Handle empty width.
* Image: Added filter for SiteOrigin image attributes.
* Image: Add dimensions to sizes dropdown.
* Maps: Ensure maps widget works with API key.
* Hero Image: Added setting to disable swipe on mobile Hero Image Widget.
* Fixed title syntax in Image widget.
* Video: Correctly get video file mime-types.
* Video Widget: Allow specifying multiple self-hosted video sources to support various formats.

= 1.5.11 - April 11 2016 =
* Fixed features widget container shape setting.

= 1.5.10 - April 5 2016 =
* Added Icon widget.
* Moved widget form arrays into separate functions to improve performance.
* Cache widget style CSS if it can't be saved to filesystem.
* Improved preview checking so preview style CSS isn't stored.
* Contact Form: Improved instance hashing for compatibility with Yoast SEO.
* Contact Form: Added description field and customisation.
* Slider: Ensure correct styles are applied to slider images when a link is defined.
* Features: Allow user to select size for uploaded icon image.
* Price Table: Ensure feature icons always vertically centered, alongside feature text.

= 1.5.9 - February 26 2016 =
* Contact Form: Fixed hash checking for duplicate emails.
* Contact Form: Replace default emails with admin_email.

= 1.5.8 - February 26 2016 =
* Skip empty sidebars when loading widget scripts.
* Changes to cache clearing.
* Typo corrections.
* Fixed conflict with Child Theme Configurator.
* Image Grid widget: Using correct field and image size names to determine image sizes.
* Editor widget: Added shortcode unautop to Editor widget.
* Contact Form widget: Added check to prevent email resends in contact form widget.
* Masonry widget: properly handles full width rows in Page Builder.
* Hero Image widget: Fix backgrounds URL.
* Price Table widget: Skip empty buttons.
* Maps Widget: Allow clicking markers to reopen info windows if closed.

= 1.5.7 - February 4 2016 =
* Restored old class name for Image Grid Widget.

= 1.5.6 - January 23 2016 =
* Fixed widget name migration
* Fixed hero image height issue.
* Fixed admin page layout.

= 1.5.5 - January 21 2016 =
* Changed widget folder names to make them less verbose.
* Properly handle LESS compile errors.
* Fixed regex causing only the first 10 TinyMCE fields to be initialized.
* Fixed sanitization in the contact form.
* Fixed Google webfont function.
* Fixed image output for slider base.
* Image Widget: Added alignment options.
* Contact Form: Use anchor to return to form after submit
* Change default caps to manage options.
* Contact form widget: fixed - form in customizer doesn't resize.
* Price Table: Added image alt tags.
* Editor Widget: Fixed issue where only admins can view unfiltered content.
* Editor Widget: Fixed issue where Editor Widget was removing new lines in code.
* Post Selector Field: Support for date fields.
* Maps Widget: Fixed Lat/Long coordinate handling.
* Masonry widget: fixed layout and sizing.
* Image Widget: Allow display of image title above or below image.
* Added more relative measurement units to base.
* Hero Image Widget: Added height setting.
* Testimonial widget: Prevent outputting related image HTML if no image is set.
* Testimonial Widget: Use testimonial URLs to link location and optionally link names and images.
* Contact Form: Prevent multiple submit button clicks.
* Image Widget: Add support for srcset to Image widget
* Contact Form: Allow user to set field label position.
* Contact Form: Allow user to set field label font styles.
* Contact Form: Allow user setting focussed field outline styles.
* Contact Form: Don't do recaptcha validation in admin preview.

= 1.5.4 - November 18 2015 =
* Fixed compatibility with PHP 5.2

= 1.5.3 - November 17 2015 =
* Fixed defaults for Features widget and Hero Image widget.
* Fixed previewing for Editor widget.
* Change measurement field to work as single string.
* Use new measurement field for existing widgets.
* Carousel widget supports RTL.

= 1.5.2 - November 10 2015 =
* Removed word break style from headline widget.
* Fixed image grid URL field.
* Added more text styling options to features widget.
* Added measurement field to use in various widgets.
* Prefix function name in Google Map widget to prevent conflicts.
* Fixed styling for contact form widget.
* Fix to allow multiple duplicated contact forms on a single page.
* Fixed Hero Image widget button shortcode in text mode.
* TinyMCE fields maintain editor state.
* Added support for WP Canvas Shortcodes in TinyMCE field.
* Don't initialize TinyMCE outside the admin.
* Added more styling to contact form submit button.

= 1.5.1 - October 7 2015 =
* Fixed: Issue with Call To Action widget being missing.

= 1.5 - October 5 2015 =
* Fixed: Conflict between WPML and repeaters.
* Added Simple Masonry Layout widget.
* Added Contact Form widget.
* Added Image Grid widget.
* Added Testimonial widget.
* Changed layout of widgets activation page.
* Added Trianglify to generate placeholder widget icons.
* Added mechanism to use state emitters in repeaters.
* Section expanded/collapsed states now stored across form loads.
* Display once off admin notice when new widgets are available.
* Fixed translation domain.
* Editor Widget: Allow more HTML in Editor widget for trusted users.
* Hero Image Widget: Added top padding setting.
* Hero Image Widget: Can now set background click URL.
* Hero Image Widget: Improved handling of buttons shortcode.
* Slider Widget : Fixed open in new window setting.
* Headline Widget: Added word-break CSS.
* Headline Widget: Added option to set type of heading tags used.

= 1.4.4 - September 6 2015 =
* Fixed issue with slider image widths.

= 1.4.3 - September 5 2015 =
* Added support for WooCommerce Shortcodes plugin to TinyMCE field.
* New streamlined icon selector field.
* Added info window functionality to maps widget.
* Added a button to duplicate repeater items.
* Added more design settings to hero image widget.
* Removed full screen mode from TinyMCE field.
* Option to keep map centered when container is resized.
* Fixed: CSS bug for Google font imports on generated CSS.
* Fixed: Post selector for URL fields properly handles empty titles.
* Added option to skip auto paragraphs in Editor widget.

= 1.4.2 - August 18 2015 =
* Urgent fix in preparation for WordPress 4.3 release

= 1.4.1 - August 17 2015 =
* Updated to latest Font Awesome.
* Added TripAdvisor to social links widget.
* Allow unfiltered HTML in SiteOrigin Editor Widget if user has rights.
* Properly set URL scheme.
* Fixed state emitter issue for Google Maps Widget.

= 1.4 - July 20 2015 =
* Created a base slider widget class.
* Converted current slider widget to use base slider.
* Fixed image sizing in slider widget.
* Added plain background color option to slider widget.
* Added new Hero Image widget.
* Fixed repeaters in sub items.

= 1.3.1 =
* Fix to TinyMCE field when moved in Customizer and Widgets interface.
* Small developer level improvements.
* Fixed autoplay in video widget.
* Fixed behaviour of slides in slider widget.

= 1.3 =
* Added TinyMCE field type.
* All fields now use classes to make them easier to extend.
* Added SiteOrigin Editor widget.
* Made it possible for other plugins to filter default widgets.
* Fixed WordPress CLI compatibility.
* Added unit tests.
* Added networks to social networks widget.
* Changed how repeater HTML is stored.

= 1.2.4 =
* Fixed reference to siteorigin_widgets_is_google_webfont.
* Fixed CSS URL.

= 1.2.3 =
* Fixed Javascript issue with Map widget in customizer.
* Added meta box manager.
* Small style change to flat button style.
* Video widget fixes.

= 1.2.2 =
* Added video widget with support for self/external videos.
* New activate/deactivate widgets interface.
* Headline widget CSS fixes.
* Dev Feature: Error checking for widget field type.
* Dev Feature: Added state emitters.
* Dev Feature: Additional hooks and filters.

= 1.2.1 =
* Removed is_customizer_preview - only available in newer versions of WordPress.

= 1.2 =
* Added headline widget.
* All scripts and styles loaded in header instead of lazy loading.
* Added email to social links widget.
* Made carousel touch friendly.
* Improved input sanitization for HTML input.
* Added nonce request checking in carousel widget.
* Added sticky field to post selector.
* Added function to allow Page Builder to use post selector.
* Added a few developer friendly filters.
* Fixed: Various customizer related issues.
* Fixed: Issue limiting maps widget to 10 markers.
* Fixed: Call to action alignment issues.
* Fixed: Carousel preview.

= 1.1.2 =
* Added social links widget.
* Framework updates.

= 1.1.1 =
* Fixed Google Map preview.

= 1.1 =
* Added powerful Google Maps widget.
* Improved data sanitization.
* Various UI improvements.

= 1.0.6 =
* Fixed issues with adding extra widget folders.
* Added compatibility with WordPress Customizer.
* Added more fields to be used with future widgets.

= 1.0.5 =
* Removed legacy widget deactivation functions.
* Improved how widgets are loaded.

= 1.0.4 =
* Changed how widget list is loaded to fix issue with widgets list not displaying.

= 1.0.3 =
* Features widget icons can now be made clickable.

= 1.0.2 =
* Manage widgets page now does live updates.
* Added widget previews.
* Fixed wire button widget hover issue.
* Old stand alone widget plugins are now deactivated in favor of bundled versions.
* Fixed centering of CTA widget.
* Fixed color settings in CTA widget.
* Fixed button icon color setting.
* Small UI improvements.

= 1.0.1 =
* Clean up of code and bundled widgets.

= 1.0 =
* Initial release.
