<?php
/**
 * The template part for displaying veranstaltungen articles on homepage.
 *
 * @package Hype
 *
 */
$blog_link = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url();
?>
<div class="section home-veranstaltungen">
  <div class="inner-width">
	  <h2><?php echo _e( 'Unsere nächsten Termine', 'hype' ); ?></h2>
	 
				<?php if (class_exists('EM_Events')) {
					echo EM_Events::output(array('format'=>
					'<div class="flip-container" ontouchstart="this.classList.toggle("hover");"><div class="flipper">
						<div class="front">#_EVENTIMAGE
						
						<h3><a href="#_EVENTURL">#_EVENTNAME</a></h3>
						
					 <div class="flip-date">
					 <svg class="icon-folder"><use xlink:href="#icon-calendar"></use>
                </svg>#d.#m.  -   <svg class="icon-folder"><use xlink:href="#icon-calendar"></use></svg> #_24HSTARTTIME</div><br/>
					 <br/>
					 </div>
					 <div class="back">
					 <a href="#_EVENTURL" border=0><h5>#_EVENTNAME</h5></a>
					    <div class="marker team-member-subtitle"> #d.#m. #_24HSTARTTIME</div>
          <p>#_EVENTEXCERPT{10}</p>
		  <br/><br/>
<br><a class="button secondary-button portfolio-button" href="#_EVENTURL">Termin ansehen<svg class="right-arrow-icon"><use xlink:href="#icon-down-arrow"></use>
                </svg></a></div></div></div>',
					'limit'=>3, 'pagination'=>0, 'orderby'=>'date'));
					} ?>
		
</div>
		<div class="inner-width">
			<div class="home-news-button-container">
			<a href="veranstaltungen" class="button primary-button"><?php _e( 'Alle Termine ansehen', 'hype' ); ?></a>
			</div>
		</div>
</div><!-- .home-news -->