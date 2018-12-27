<?php
/**
 * Custom styles from the customizer
 *
 * @package Hype
 */

header('Content-type: text/css; charset: UTF-8');

$gradient_1   = get_theme_mod( 'gradient_1', '#56c7d9' );
$gradient_2   = get_theme_mod( 'gradient_2', '#80d2ad' );
$button_color = get_theme_mod( 'button_color', '#56c7d9' );
?>

/**
 * Theme
 */

h5 {
  color: <?php echo $gradient_1; ?>;
}

label,
.date,
.marker {
  color: <?php echo $gradient_1; ?>;
}

.secondary-button:hover .right-arrow-icon {
  fill: <?php echo $gradient_1; ?>;
}

.gradient {
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $gradient_1; ?>', endColorstr='<?php echo $gradient_2; ?>', GradientType=0);
  background: -webkit-linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
  background: linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
}

/**
 * Header
 */

.site-header-full-menu {
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $gradient_1; ?>', endColorstr='<?php echo $gradient_2; ?>', GradientType=0);
  background: -webkit-linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
  background: linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
}

.page-template-page-cover .alternate-nav ul li ul,
.blog .site-header-inner-top .alternate-nav ul li ul {
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $gradient_1; ?>', endColorstr='<?php echo $gradient_2; ?>', GradientType=0);
  background-color: -webkit-linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
  background-color: linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
}

.site-header-inner-logo a {
  color: <?php echo $gradient_1; ?>;
}

/**
 * Hero
 */

.hero .secondary-button:hover {
  color: <?php echo $gradient_2; ?>;
}

.hero-overlay {
  background: -webkit-linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
  background: linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $gradient_1; ?>', endColorstr='<?php echo $gradient_2; ?>', GradientType=0);
}

/**
 * Footer
 */

.site-footer-top {
  background-color: <?php echo $gradient_1; ?>;
}

.site-footer-contact-email {
  color: <?php echo $gradient_1; ?>;
}

.site-footer-top-button:hover {
  color: <?php echo $gradient_1; ?>;
}

/**
 * Home
 */

.portfolio-project-desc {
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $gradient_1; ?>', endColorstr='<?php echo $gradient_2; ?>', GradientType=0);
  background: -webkit-linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
  background: linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
}

.portfolio-button:hover {
  color: <?php echo $gradient_2; ?>;
}

.portfolio-button:hover .right-arrow-icon {
  fill: <?php echo $gradient_2; ?>;
}

.type-portfolio:nth-child(2n+2) .portfolio-button {
  color: <?php echo $gradient_1; ?>;
  border-color: <?php echo $gradient_1; ?>;
}

.type-portfolio:nth-child(2n+2) .portfolio-button:hover {
  background-color: <?php echo $gradient_1; ?>;
}

.type-portfolio:nth-child(2n+2) .portfolio-button .right-arrow-icon {
  fill: <?php echo $gradient_1; ?>
}

.type-portfolio:nth-child(2n+2) .portfolio-project-category {
  color: <?php echo $gradient_1; ?>;
}

.menu-open .site-header-inner-top {
  background-color: <?php echo $gradient_1; ?> !important;
}

.fixed .site-header-inner-logo .site-logo-link.fixed {
  color: <?php echo $gradient_1; ?>;
}

.site-header-inner-logo .site-logo-link:hover {
  color: <?php echo $gradient_2; ?>;
}
/**
 * Portfolio
 **/
.post-pagination-section {
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $gradient_1; ?>', endColorstr='<?php echo $gradient_2; ?>', GradientType=0);
  background: -webkit-linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
  background: linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
}

.post-pagination-prev:hover .post-pagination-text,
.post-pagination-next:hover .post-pagination-text {
  color: <?php echo $gradient_2; ?>;
}

.post-pagination-prev:hover .post-pagination-icon,
.post-pagination-next:hover .post-pagination-icon {
  fill: <?php echo $gradient_2; ?>;
}
.project-all-projects-block-overlay {
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $gradient_1; ?>', endColorstr='<?php echo $gradient_2; ?>', GradientType=0);
  background: -webkit-linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
  background: linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
}

.project-all-projects-button:hover {
  color: <?php echo $gradient_2; ?>;
}

.portfolio-gallery .slick-prev,
.portfolio-gallery .slick-next {
  background-color: <?php echo hype_hex_to_rgba( $gradient_1, 0.7 ); ?>;
}

.portfolio-gallery .slick-prev:hover .slick-prev-icon,
.portfolio-gallery .slick-next:hover .slick-next-icon {
  fill: <?php echo $gradient_1; ?>;
}

.portfolio-audio .mejs-time-current {
  background: <?php echo $gradient_1; ?> !important;
}

/**
* Post
**/
.post-small-tag-icon {
  fill: <?php echo $gradient_1; ?>;
}

blockquote cite {
 color: <?php echo $gradient_1; ?>;
}

/**
* About
**/

.page-template-about .hero {
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $gradient_1; ?>', endColorstr='<?php echo $gradient_2; ?>', GradientType=0);
  background: -webkit-linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
  background: linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
}

.back {
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $gradient_1; ?>', endColorstr='<?php echo $gradient_2; ?>', GradientType=0);
  background: -webkit-linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
  background: linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
}

/**
* Contact
*/

.thanks p {
  color: <?php echo $gradient_1; ?>;
}

/**
* Comments
*/

.comment-author {
  color: <?php echo $gradient_1; ?>;
}

.hype-loader {
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $gradient_1; ?>', endColorstr='<?php echo $gradient_2; ?>', GradientType=0);
  background: -webkit-linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
  background: linear-gradient(<?php echo $gradient_1; ?>, <?php echo $gradient_2; ?>);
}

/**
* Archive
*/

.open.archive-category-container,
.archive-categories li a:hover {
  background-color: <?php echo $gradient_1; ?>;
}

.load-more.ball-pulse > div {
  background-color: <?php echo $gradient_1; ?>;
}

/**
 * Button
 */
.primary-button {
  background-color: <?php echo $button_color; ?>;
}
