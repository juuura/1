<?

/*-----------------------------------------------------------------------------------*/ 
//	Меню
/*-----------------------------------------------------------------------------------*/

	function moby () { register_nav_menu ('menu', __ ( 'Основное меню')); }
	add_action ( 'after_setup_theme', 'moby' );


/*-----------------------------------------------------------------------------------*/
//	Javascsript и CSS
/*-----------------------------------------------------------------------------------*/

function add_scripts($styles) {
	wp_enqueue_script('customscript', get_stylesheet_directory_uri() . '/js/customscript.js'.'?ver='.filemtime( get_stylesheet_directory()));
	if(!is_single() && !is_search() && !is_home())
		wp_enqueue_script('add-post', get_stylesheet_directory_uri() . '/js/add_post.js'.'?ver='.filemtime( get_stylesheet_directory()));
/*	if(is_user_logged_in('Administrator'))
		wp_enqueue_style('my_theme_style', get_template_directory_uri() . '/style-beta.css'.'?ver='.filemtime( get_stylesheet_directory()));
	else */ 
	if(wp_is_mobile())
		wp_enqueue_style('my_theme_style', get_template_directory_uri() . '/style-mobile.css'.'?ver='.filemtime( get_stylesheet_directory()));
	else
		wp_enqueue_style('my_theme_style', get_template_directory_uri() . '/style.css'.'?ver='.filemtime( get_stylesheet_directory()));
	if(is_singular())
		wp_enqueue_script('comment-reply'.'?ver='.filemtime( get_stylesheet_directory()));
}
add_action('wp_enqueue_scripts','add_scripts');


/*-----------------------------------------------------------------------------------*/
//  Миниатюра записей
/*-----------------------------------------------------------------------------------*/

	add_theme_support( 'post-thumbnails', array( 'post','i' ) );
	add_filter('jpeg_quality', function($arg){ return 100; } );


/*-----------------------------------------------------------------------------------*/
//	Регистрация сайд-бара
/*-----------------------------------------------------------------------------------*/

	register_sidebar(array(
	'name'=>'Домашняя',
	'id' => 'sidebar_1',
	'before_widget' => '<li class="widget" id="%1$s">',
	'after_widget' => '</li>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
	));

	register_sidebar(array(
	'name'=>'Рубрики',
	'id' => 'sidebar_2',
	'before_widget' => '<li class="widget" id="%1$s">',
	'after_widget' => '</li>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
	));


/*-----------------------------------------------------------------------------------*/ 
//	Навигация
/*-----------------------------------------------------------------------------------*/

function my_request( $request ) {
    $dummy_query = new WP_Query();
    $dummy_query->parse_query( $request );
    if ( $dummy_query->is_archive() ) {
        $request['post_type'] = 'any';
    }
    return $request;
}
add_filter( 'request', 'my_request' );

function pagination($pages = '', $range = 3) { 
	$showitems = ($range * 3)+1;
	global $paged;
	if(empty($paged)) $paged = 1;
	if($pages == '') :
	global $wp_query;
	$pages = $wp_query->max_num_pages; 
	if(!$pages) $pages = 1; 
	endif;
	if(1 != $pages):
	echo "<div class='pagination'><ul>";
	if($paged > 1 && $showitems < $pages) 
	echo "<li><a title='Первая' href='".get_pagenum_link(1)."'>Сюда</a></li>";
	for ($i=1; $i <= $pages; $i++) { 
	if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )):
	echo ($paged == $i)? "<li class='current'><span class='currenttext'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
	endif;
	} 
	if ($paged < $pages && $showitems < $pages) 
	echo "<li><a title='Последняя' href='".get_pagenum_link($pages)."'>Туда</a></li>";
	echo "</ul></div>"; 
	endif;
}


/*-----------------------------------------------------------------------------------*/ 
//	Категория Депо
/*-----------------------------------------------------------------------------------*/

function add_new_taxonomies() {	

register_taxonomy('z',
		array('post'),
		array(
			'labels' => array(
				'name'              => 'Завод:',
				'singular_name'     => 'Завод',
				'search_items'      => 'Искать Завод',
				'all_items'         => 'Все Заводы',
				'parent_item'       => 'Выбрать Завод',
				'parent_item_colon' => 'Главный Завод:',
				'edit_item'         => 'Редактировать Завод',
				'update_item'       => 'Обновить Завод',
				'add_new_item'      => 'Добавить новый Завод',
				'new_item_name'     => 'Название нового Завода',
				'menu_name'         => 'Заводы',
			),
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite' => array(
				'slug' => 'z', // ярлык
			),
		)
	);
	
register_taxonomy('t',
		array('post'),
		array(
			'labels' => array(
				'name'              => 'Эксплуатация:',
				'singular_name'     => 'Эксплуатация',
				'search_items'      => 'Искать эксплуатацию',
				'all_items'         => 'Все эксплуатации',
				'parent_item'       => 'Выбрать эксплуатацию',
				'parent_item_colon' => 'Главная Эксплуатация:',
				'edit_item'         => 'Редактировать эксплуатацию',
				'update_item'       => 'Обновить эксплуатацию',
				'add_new_item'      => 'Добавить новую эксплуатацию',
				'new_item_name'     => 'Название новой эксплуатации',
				'menu_name'         => 'Эксплуатация',
			),
			'hierarchical'          => false,
			'rewrite' => array(
				'slug' => 't',
			),
		)
	);
}
add_action( 'init', 'add_new_taxonomies', 0 );


/*-----------------------------------------------------------------------------------*/
//  Инфраструктура
/*-----------------------------------------------------------------------------------*/

add_action('init', 'register_post_types');
function register_post_types(){
	register_post_type('i', array(
		'labels' => array(
			'name'               => 'Инфраструктура',
			'singular_name'      => 'Описание',
			'add_new'            => 'Добавить',
			'add_new_item'       => 'Добавление',
			'edit_item'          => 'Редактирование',
			'new_item'           => 'Новая',
			'view_item'          => 'Смотреть',
			'search_items'       => 'Искать',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено',
			'menu_name'          => 'Инфраструктура',
		),
		'public'              => true,
		'show_in_menu'        => true,
		'menu_position'       => 6,
		'supports'            => array('title','editor','thumbnail','comments','infr' /* ,'excerpt','custom-fields' */),
		'taxonomies'          => array('category'),
	) );
}


/*-----------------------------------------------------------------------------------*/ 
//	Убирает сверх-огромный размер картинки
/*-----------------------------------------------------------------------------------*/

add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ) {
    return array_diff( $sizes, array('medium_large') );
}


/*-----------------------------------------------------------------------------------*/ 
//	В метках описание с визуальным редактором
/*-----------------------------------------------------------------------------------*/

function mayak_category_description($container = ''){
	$content = is_object($container) && isset($container->description) ? html_entity_decode($container->description) : '';
	$editor_id = 'tag_description';
	$settings = 'description';		
	?>
    <tr class="form-field">
	<th scope="row" valign="top"><label for="description">Описание</label></th>
	<td><? wp_editor($content, $editor_id, array(
				'textarea_name' => $settings,
				'editor_css' => '<style>.html-active .wp-editor-area { border: 0 } </style>',
	)); ?>
	</td>
    </tr>
    <?	
}
add_filter('edit_category_form_fields', 'mayak_category_description');
add_filter('edit_tag_form_fields', 'mayak_category_description');


/*-----------------------------------------------------------------------------------*/ 
//	Чистка лишних пунктов админки
/*-----------------------------------------------------------------------------------*/ 

show_admin_bar(false);

add_action('admin_print_footer_scripts', 'hide_tax_metabox_tabs_admin_styles', 99);
function hide_tax_metabox_tabs_admin_styles() { ?>
	<style>
	    #footer-upgrade, #footer-thankyou, .term-description-wrap, textarea#description { display: none }
		
		<? if((current_user_can('contributor')) || (current_user_can('edit'))): ?>
		.delete
		{ display: none!important }
		<? endif;										   
		if(!wp_is_mobile()) echo '.postbox div.tabs-panel { max-height: 500px; border: 0 }' ?>
	</style>
	<?
}


/*-----------------------------------------------------------------------------------*/ 
// Вставка шорт-кода со списком ж/д
/*-----------------------------------------------------------------------------------*/

function post_tags_within_content() {
    global $post;
	if(wp_is_mobile())
	$ttt = get_the_term_list( $post->ID, 't', '<p><strong>Эксплуатация:</strong></p><ul><li>', '</li><li>', '</li></ul>');
	else
	$ttt = get_the_term_list( $post->ID, 't', '<p><strong>Эксплуатация:</strong></p><p>', ', ', '</p>');
    return $ttt;
}
add_shortcode( 'Эксплуатация', 'post_tags_within_content' );

add_filter('widget_text','do_shortcode');


/*-----------------------------------------------------------------------------------*/ 
//	Вывод колонок для пользователей
/*-----------------------------------------------------------------------------------*/

function remove_post_columns($posts_columns) {
	$posts_columns = array(
		"cb" => "",
		"title" => "Заголовок",
		"author" => "Автор",
		"categories" => "Рубрики",
		"tags" => "Метки",
		"date" => "Дата",
	);
	return $posts_columns;
}
add_filter('manage_posts_columns', 'remove_post_columns');


/*-----------------------------------------------------------------------------------*/ 
//	Ajax-подгрузка записей
/*-----------------------------------------------------------------------------------*/

function true_load_posts() {
 	$args = unserialize( stripslashes( $_POST['query'] ));
	$args['paged'] = $_POST['page'] + 1;
	$args['post_status'] = 'publish';
	query_posts( $args );
	if(have_posts()):
		if(is_category() || is_tax() || is_archive()):
			if($_COOKIE['vidz'] == "Список"):
			$vid_post = 'post-home';
			else:
			$vid_post = 'post-category';
			endif;
			while( have_posts()): the_post();
			get_template_part($vid_post);
			endwhile;
		else:
			while( have_posts()): the_post();
			get_template_part( 'post-home' );
			endwhile;
		endif;
	endif;
	die();
}
  
add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');


/*-----------------------------------------------------------------------------------*/ 
//	Теория
/*-----------------------------------------------------------------------------------*/

add_filter('post_type_labels_post', 'rename_posts_labels');
function rename_posts_labels( $labels ){

	$new = array(
		'name'               => 'Теория',
		'singular_name'      => 'Теория',
		'add_new'            => 'Добавить',
		'add_new_item'       => 'Добавление',
		'edit_item'          => 'Редактирование',
		'new_item'           => 'Новая',
		'view_item'          => 'Смотреть',
		'search_items'       => 'Искать',
		'not_found'          => 'Не найдено',
		'not_found_in_trash' => 'Не найдено в корзине',
		'menu_name'          => 'Теория',
	);

	return (object) array_merge( (array) $labels, $new );
}


/*-----------------------------------------------------------------------------------*/ 
//	Дополнительные поля
/*-----------------------------------------------------------------------------------*/

add_action('add_meta_boxes', 'my_extra_fields', 1);

function my_extra_fields() {
	add_meta_box( 'extra_fields', 'Дополнительные поля', 'teoria_func', 'post', 'normal', 'high'  );
}

function teoria_func($post) {
   ?>
	<input type="hidden" name="extra[num_loco]" value="<? update_post_meta( $post->ID, 'num_loco', '0' ); ?>" />
	<p><label>Год начала производства: <input type="text" name="extra[date_loco]" value="<?= get_post_meta( $post->ID, 'date_loco', 1 ); ?>" style="width: 50px" /></label></p>
	<p><label>Год окончания (0 - в один год): <input type="text" name="extra[spis_loco]" value="<?= get_post_meta($post->ID, 'spis_loco', 1); ?>" style="width: 50px" /></label></p>
	<p><label>Построено (0 - проект): <input type="text" name="extra[kol_loco]" value="<?= get_post_meta($post->ID, 'kol_loco', 1); ?>" style="width: 60px" /></label></p>
   <?
}

add_action('save_post', 'my_extra_fields_update', 0);

function my_extra_fields_update( $post_id ) {
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; 
	if ( !current_user_can('edit_post', $post_id) ) return false;
	if( !isset($_POST['extra']) ) return false; 
	$_POST['extra'] = array_map('trim', $_POST['extra']); 
	foreach( $_POST['extra'] as $key=>$value ){
		if( empty($value) ){
			delete_post_meta($post_id, $key);
			continue;
		}
		update_post_meta($post_id, $key, $value);
	}
	return $post_id;
}

/*-----------------------------------------------------------------------------------*/ 
//	Фильтрация
/*-----------------------------------------------------------------------------------*/

function go_filter() { 
	$args = array( 'paged' => get_query_var( 'paged' ) ); 
	$args['meta_query'] = array('relation' => 'AND');
	global $wp_query;
	if ($_GET['type'] != '') { $args = array( 'category_name' => $_GET['type'] ); }
	query_posts(array_merge($args,$wp_query->query));
}


/*-----------------------------------------------------------------------------------*/ 
//	Отображение карты
/*-----------------------------------------------------------------------------------*/

function get_thumbnail_path($post_ID) {
	$post_image_id = get_post_thumbnail_id($post_ID->ID);
	if ($post_image_id) {
		$thumbnail = wp_get_attachment_image_src( $post_image_id, 'thumbnail', false);
		if ($thumbnail) (string)$thumbnail = $thumbnail[0];
		return $thumbnail;
	}	
}


/*-----------------------------------------------------------------------------------*/ 
//	Убираем лишние пункты меню
/*-----------------------------------------------------------------------------------*/

if(!current_user_can('administrator')):
add_action('admin_menu', 'remove_admin_menu');
function remove_admin_menu() {
  	remove_menu_page('tools.php'); // Инструменты
	remove_menu_page('edit.php?post_type=tinymcetemplates');
}
endif;


/*-----------------------------------------------------------------------------------*/ 
//	Скрытие лого авторизации
/*-----------------------------------------------------------------------------------*/

function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { max-height: 0; max-width: 0 }
    </style>';
}
  
add_action('login_head', 'my_custom_login_logo');


/*-----------------------------------------------------------------------------------*/ 
//	Тесты
/*-----------------------------------------------------------------------------------*/
