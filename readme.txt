=== WP Use parent template ===
Contributors: kanonji
Tags: template, hierarchy, page, category
Requires at least: 3.2
Tested up to: 3.2.1
Stable tag: 0.4

To use parent template for child categories or pages. This plugin patches template hierarchy. This plugin is for who create or customize themes.

== Description ==

= Features =

* use parent template for child category.
* use parent template for child page.

If you have works category with some child categories as followings, you may want to use 'category-works.php' for all three child categories. You need to copy as 'category-design.php' and the rest in default template hierarchy. WP Use parent template patches the template hierarchy to use parent template for these child categories. And also pages too.

* example.com/works/design
* example.com/works/illust
* example.com/works/photo

= Category template hierarchy =

1. category-{slug}.php
2. category-{id}.php
3. category-{parent slug}.php //Add by WP Use parent template
4. category-{parent id}.php //Add by WP Use parent template
5. category.php
6. archive.php
7. index.php

= Page template hierarchy =

1. custom template file
2. page-{slug}.php
3. page-{id}.php
4. page-{parent slug}.php //Add by WP Use parent template
5. page-{parent id}.php //Add by WP Use parent template
6. page.php
7. index.php

See following for Wordpress default template hierarchy.
http://codex.wordpress.org/Template_Hierarchy

= Notes =

* Able to use only one generation age template. 'category-child.php' is able to use as parent template for grandchild in the example of 'example.com/parent/child/grandchild'.
* You may need to change parent template to handle child data.

== Changelog ==

= 0.4 =
* Fix readme.txt

= 0.3 =
* Fix readme.txt

= 0.2 =
* Released.

= 0.1 =
* My local use.
