<? get_header() ?>
<div id="page">
	<div id="single">
	    <? if(have_posts()) while (have_posts()): the_post() ?>
				<header>
				<h1 id="title-sinlge"><? the_title() ?></h1>
				<div id="post-info">
					<span title='Категория'><picture><source srcset="/icon/papka.webp" type="image/webp"><img alt="Категория" src="/icon/papka.png" width="10"></picture> <? the_category(', ') ?></span>
					<span title='Автор'><strong>Опубликовал:</strong> <? the_author() ?></span>
					<? if((get_the_modified_date()) != (get_the_date())) echo " <span title='Дата изменения'><strong>Изменено: </strong>", get_the_modified_date(), "</span> | "; echo "<span title='Дата публикации'><strong>Дата: </strong>", get_the_date(), "</span>";
					if(is_user_logged_in()) echo ' | ', edit_post_link('Редактировать'); ?>
					<span title='Просмотры' class="post-right-top"><? the_views() ?></span>
				</div>
				</header>
		    <div class="post">
		<? if(get_post_meta($post->ID, 'kol_loco', true) ): ?>
	    <div class="wp-caption aligncenter center">
	        <? $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
    	    echo '<a href="'.$large_image_url[0].'" >'; the_post_thumbnail('large'); echo '</a>' ?>
    	    <p class="wp-caption-min"><span class="wp-caption-txt"><?= get_the_post_thumbnail_caption($post->ID) ?></span></p>
    	</div>
    	<p>
    	    <?  if ((get_post_meta($post->ID, 'kol_loco', true))):
			    foreach(get_the_tags() as $tag) echo $tag->description; echo '.';
        	    if(get_post_meta($post->ID, 'date_loco', true) != '0000'): ?>
		    	Производство <? if(get_post_meta($post->ID, 'spis_loco', true) != '0000') echo 'с ';
		    	echo '<strong>'. get_post_meta($post->ID, 'date_loco', true). '</strong>';
		    	    if (get_post_meta($post->ID, 'spis_loco', true) && get_post_meta($post->ID, 'spis_loco', true) != '0000')
	    		    echo ' по <strong>'. get_post_meta($post->ID, 'spis_loco', true). '</strong> год на - ';
		    	    else echo ' года на - ';
		    	echo get_the_term_list($post, 'z', '', ', '). '. Всего построено <strong>'.get_post_meta($post->ID, 'kol_loco', true). '</strong> шт.';
				elseif((get_post_meta($post->ID, 'date_loco', true) == '0000') && (get_the_terms( $post->ID, 'z', true))):
    			echo 'Возможное производство на '. get_the_term_list($post, 'z', '', ', ').'.';
				endif;
	        	endif;
            ?>
		</p>
	<? endif;
	the_content();
    endwhile;
		wp_reset_query() ?>
		</div>
		<div id="tags">
			<div id="post-left">
                <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                <script src="//yastatic.net/share2/share.js"></script>
                <div class="ya-share2" data-services="collections,vkontakte,facebook,twitter,lj,viber,whatsapp,telegram"></div>
			</div>
			<div id="post-right">
				<? the_ratings() ?>
			</div>
		</div>
        </div>
	    <div class="center">
	        
		<? if(wp_is_mobile()): ?>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
            style="display:block; text-align:center;"
            data-ad-layout="in-article"
            data-ad-format="fluid"
            data-ad-client="ca-pub-1801017290864895"
            data-ad-slot="4583078544"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
			
		<? else: ?>	
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Горизонтальный ЦЖД -->
            <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-1801017290864895"
            data-ad-slot="8417881116"
            data-ad-format="auto"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
			
		<? endif; ?>
			
		    <div class="altern-single"> 
		        <? $k = rand(1, 7);
		        if($k == 1)
		            query_posts('post_type=any&order=ASC&orderby=meta_value_num&meta_key=views&posts_per_page=4');
		        else
		            query_posts( 'post_type=any&orderby=rand&posts_per_page=4' );
	            while ( have_posts()): the_post();
		        get_template_part( 'post-single' );
		        endwhile;
		        wp_reset_query() ?>
            </div>	
        <br/>
		<? comments_template(); ?>		
	</div>	        
</div>
<? get_footer() ?>
