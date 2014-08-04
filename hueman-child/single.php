<?php get_header(); ?>
<?php get_sidebar(); ?>

<section class="content">
   
   <?php get_template_part('inc/page-title'); ?>
   
   <div class="pad group">
      
      <?php while ( have_posts() ): the_post(); ?>
         <article <?php post_class(); ?>> 
            <div class="post-inner group">
               
               <h1 class="post-title"><?php the_title(); ?></h1>
               <p class="post-byline"><?php _e('by','hueman'); ?> <?php the_author_posts_link(); ?> &middot; <?php the_time(get_option('date_format')); ?></p>
               
               <?php if( get_post_format() ) { get_template_part('inc/post-formats'); } ?>
               
               <div class="clear"></div>
               
               <div class="entry <?php if ( ot_get_option('sharrre') != 'off' ) { echo 'share'; }; ?>">  
                  <div class="entry-inner">
                     <?php //check for video, if none, show feat. image
                     $meta = get_post_meta($post->ID,'_my_meta',true);
                     $video_id = $meta['videoid'];
                     if($video_id != ''){ ?>
                     <script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js">
                     </script>
                     <object id="myExperience" class="BrightcoveExperience">
                        <param name="bgcolor" value="#FFFFFF" />
                        <param name="width" value="100%" />
                        <param name="height" value="360" />
                        <param name="playerID" value="970265183001" />
                        <param name="playerKey" value="AQ~~,AAAAocwtmPk~,RTQzrMOt-UDibiFyq2BFUUaXsdcirLOC" />
                        <param name="videoID" value="<?php echo $video_id ?>" />
                        <param name="isVid" value="true" />
                        <param name="isUI" value="true" />
                        <param name="dynamicStreaming" value="true" />
                        <param name="htmlFallback" value="true" />
                     </object>          
                     <script type="text/javascript">brightcove.createExperiences();</script>
                     <?php } ?>
                     <!-- the text of the post -->

                     <?php the_content(); ?>
                     <?php wp_link_pages(array('before'=>'<div class="post-pages">'.__('Pages:','hueman'),'after'=>'</div>')); ?>
                  </div>
                  <?php if ( ot_get_option('sharrre') != 'off' ) { get_template_part('inc/sharrre'); } ?>
                  <div class="clear"></div>           
               </div><!--/.entry-->
               
            </div><!--/.post-inner-->  
         </article><!--/.post-->          
      <?php endwhile; ?>
      
      <div class="clear"></div>
      
      <?php // The tags for a post are now removed, not wanted. 
            // Couldn't find the option in the theme options, 
            // that's why it is commented out here.
            // the_tags('<p class="post-tags"><span>'.__('Tags:','hueman').'</span> ','','</p>'); ?>
      
      <?php if ( ( ot_get_option( 'author-bio' ) != 'off' ) && get_the_author_meta( 'description' ) ): ?>
         <div class="author-bio">
            <div class="bio-avatar"><?php echo get_avatar(get_the_author_meta('user_email'),'128'); ?></div>
            <p class="bio-name"><?php the_author_meta('display_name'); ?></p>
            <p class="bio-desc"><?php the_author_meta('description'); ?></p>
            <div class="clear"></div>
         </div>
      <?php endif; ?>
      
      <?php if ( ot_get_option( 'post-nav' ) == 'content') { get_template_part('inc/post-nav'); } ?>
      
      <?php if ( ot_get_option( 'related-posts' ) != '1' ) { get_template_part('inc/related-posts'); } ?>
      
      <?php comments_template('/comments.php',true); ?>
      
   </div><!--/.pad-->
   
</section><!--/.content-->


<?php get_footer(); ?>