=== Espied ===

Contributors: automattic
Donate link:
Tags: blue, black, white, one-column, fixed-layout, fluid-layout, responsive-layout, custom-colors, custom-header, custom-menu, editor-style, featured-images, flexible-header, infinite-scroll, post-formats, sticky-post, theme-options, translation-ready

Requires at least: 3.4
Tested up to: 3.9
Stable tag:
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A portfolio theme for designers and photographers. Great for showing off your image oriented projects to the world.

== Description ==

Espied is a portfolio theme for designers, photographers, and artists. It’s great for showing off your image-oriented projects to the world. The theme’s minimalist design puts the focus on your projects.

* Responsive layout.
* Portfolio Page Template.
* Full-width Page Template.
* Custom Header.
* Jetpack.me compatibility for Infinite Scroll, Portfolio Custom Post Type.
* The GPL v2.0 or later license. :) Use it to make something cool.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==

= I don't see the Portfolio menu in my admin, where can I find it? =

To make the Portfolio menu appear in your admin, you need to install the [Jetpack plugin](http://jetpack.me) because it has the required code needed to make [custom post types](http://codex.wordpress.org/Post_Types#Custom_Post_Types) work for the Espied theme.

Once Jetpack is active, the Portfolio menu will appear in your admin, in addition to standard blog posts. No special Jetpack module is needed and a WordPress.com connection is not required for the Portfolio feature to function. Portfolio will work on a localhost installation of WordPress if you add this line to `wp-config.php`:

`define( 'JETPACK_DEV_DEBUG', TRUE );`

The Portfolio admin: https://cloudup.com/cOznO6emIyD

= How to setup the front page like the demo site? =

The demo site URL: http://espieddemo.wordpress.com/?demo

When you first activate Espied, you’ll see your posts in a traditional blog format. If you’d like to use the portfolio page template as the front page of your site, as the demo site does, it’s simple to configure:

1. Create or edit a page, and assign it to the Portfolio Page Template from the Page Attributes module. https://cloudup.com/ceH0xfFP2tR
2. Go to Settings > Reading and set “Front page displays” to “A static page”.
3. Select the page you just assigned the Portfolio Page Template to as “Front page” and set another page as the “Posts page” to display your blog posts.

By default, page title and content will appear. You can hide them if you prefer by going to Appearance → Customize → Theme Options and check “Hide title and content on Portfolio Page Template” option.

= Where is the page that lists all projects? =

Along with the Portfolio Page Template, your projects will be displayed on portfolio archive pages.

Let's say you have a WordPress.com site at: http://mygroovydomain.com

The URL of the portfolio archive page will be: http://mygroovydomain.com/portfolio/

If your blog’s URL is http://mygroovydomain.com/, you’ll find your portfolio archive page at http://mygroovydomain.com/portfolio/.

You'll need pretty permalinks (any structure) for this URL to work though. If you're stuck with default permalinks - your links have a query string at the end, like ?p=123 - then your portfolio archive can be accessed by adding this immediately after your URL:

`/?post_type=jetpack-portfolio`

The portfolio archive page: https://espieddemo.wordpress.com/portfolio

= How to add large images in projects? =

People love full-size images of your work, so make sure the images you include are at least 1272px wide. Espied displays these images at full width on larger screens.

= How to use Portfolio Shortcodes? =

Once you create a project, you can use the portfolio shortcode to display it anywhere on your site. Adding the [portfolio] shortcode to any post or page will insert your project. More info on the shortcode.

= How to add the social links in the sidebar? =

Espied allows you display links to your social media profiles, like Twitter and Facebook, with icons.

1. Create a new Custom Menu, and assign it to the Social Links Menu location.
2. Add links to each of your social services using the Links panel.
3. Icons for your social links will automatically appear if it’s available.

Available icons:

* Codepen
* Digg
* Dribbble
* Dropbox
* Facebook
* Flickr
* GitHub
* Google+
* Instagram
* LinkedIn
* Email (mailto: links)
* Pinterest
* Pocket
* PollDaddy
* Reddit
* RSS Feed (urls with /feed/)
* StumbleUpon
* Tumblr
* Twitter
* Vimeo
* WordPress
* YouTube

== Quick Espied Specs (all measurements in pixels) ==

1. The main column width is 552.
2. The sidebar width is 552.
3. Featured Images for blog posts are 840 wide by unlimited height
4. Featured Images for portfolio projects are 480 wide by 360 (landscape), 640 (portrait), and 480(square) height
5. Custom header image should be at least 1600 in width.

== Changelog ==

= 1.1.3 - Aug 22, 2014 =
* Apply hover effect for portfolio items that are added by Infinite Scroll.

= 1.1.2 - Aug 5, 2014 =
* Enqueue a JS check.

= 1.1.1 - Aug 5, 2014 =
* Make Portfolio Page Template always available but add a check if Jetpack Portfolio is availble before the query in the Portfolio page template runs.

= 1.1 - Aug 5, 2014 =
* Remove Portfolio page template if Jetpack Portfolio is not available.

= 1.0 - Aug 4, 2014 =
* Initial release.