Here is some **user** feedback to consider before your review.  

1.  On activation, the theme outputs this message: "The main theme CSS stylesheet was regenerated. Please refresh your web browser's and server's cache (if you are using a website server caching solution)." This is obnoxious and unnecessary. If you use a version number on your style sheet, you will not need to tell the admin anything about this, and the site visitors will get the correct version also. Besides, the theme is not supposed to write defaults anywhere, so nothing should have happened on activation.
2.  Add descriptions to the widget areas to indicate when and where they are shown.
3.  Theme or author name/brand should not be output on front end except as allowed in a credit link. Remove the theme logo that is shown by default. No one will want the theme logo.
4.  The menu needs to have a fallback for when no menu is selected. The default value of <tt>fallback_cb</tt> parameter of <tt>wp_nav_menu()</tt> works really well, and it's core functionality.
5.  I do not like the extra text that is in the menu. (category descriptions)
6.  Any restrictions (such as menu depth=4) need to be documented for the user.
7.  The mobile menu X ix partially covered by the admin bar.
8.  Themes may have a single credit link in the footer. Theme URI or Author URI
9.  A post title with markup renders correctly in the blog page, but not in the single post page.
10.  <tt>img[width], img[height] {height: auto;}</tt> This should be on every image, not just the ones with HTML attributes. It goes with <tt>max-width:100%</tt> so that the images do not look distorted.
11.  Links in image captions look like the rest of the text.
12.  The comment input box just looks like a line. I can't tell that it is a place to type. Same for search widget.
13.  Remove the CSS counters for user content ordered lists. It is not taking into account the start attribute or the reversed attribute. Here is the same page twice: on the left how the theme is displaying, but on the right how they are without the counters (I used Firebug to disable them). [![https://s2.postimg.org/gau3xe87t/ordered-list-numbers.jpg](https://s2.postimg.org/gau3xe87t/ordered-list-numbers.jpg "https://s2.postimg.org/gau3xe87t/ordered-list-numbers.jpg")](https://s2.postimg.org/gau3xe87t/ordered-list-numbers.jpg)
14.  You might want to hide the menu, comment form, and widget areas for the print styles. Also, the comment author avatars are showing really large.
15.  Pingbacks and trackbacks should be shown.
16.  Gallery captions are only shown on hover. This obscures the image, and how are touch screen users supposed to see them? Also, a long caption is truncated.
17.  <tt>.gallery img {width: 100%;}</tt> This CSS rule should be removed, as the theme cannot know what the image width should be. It causes the browser to upscale thumbnails, which looks awful, and the user doesn't get the size he chose.
18.  Same for <tt>.entry-media img {width: 100%;}</tt>
19.  The image attachment page shows the image size, but does not display the image at that size.
20.  The image attachment page has no post navigation links. (back to gallery or Previous/Next attachment)
21.  Can you put the sidebar on the 404 page?
22.  Customizer
    1.  Can you make all checkboxes consistent with core options and boolean logic, so that a checked option means "Enabled" or "Show" instead of "Disabled" or "Hide", please?
    2.  Header Media - the Header Image has no default, but the suggested image is shown on archive pages. I don't see a way to remove it.
23.  When I looked at the next theme, I noticed that my Media Settings had been changed by this theme. Themes are not allowed to update any options but theme options. Remove the code to change the image sizes. Themes can add image sizes to suit the design, but cannot change the standard image sizes.