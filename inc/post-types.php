<?php

function oleoscope_register_cpts() {
	// News
	$labels0 = array(
		'name' => 'Новости',
		'singular_name' => 'Новость', // Добавить->Запись (Именительный падеж)
		'add_new' => 'Добавить новость', // в меню и на кнопке
		'add_new_item' => 'Добавить новость', // заголовок
		'edit_item' => 'Редактировать новость',
		'new_item' => 'Новая новость',
		'all_items' => 'Все новости', // подменю в админке
		'view_item' => 'Просмотреть новость',
		'search_items' => 'Поиск новостей',
		'not_found' =>  'Новостей не найдено.',
		'not_found_in_trash' => 'Новостей в корзине не найдено.',
		'menu_name' => 'Новости' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels0,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true,
		'menu_icon' => 'dashicons-text-page',
		'menu_position' => 20, // порядок в меню
		'taxonomies' => array('category', 'post_tag'),
		'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'post-formats')
	);
	register_post_type('news', $args);

	// Interview
	$labels1 = array(
		'name' => 'Интервью', // множественное число
		'singular_name' => 'Интервью', // админ панель Добавить->Интервью
		'add_new' => 'Добавить интервью', // в сайдбаре админки
		'add_new_item' => 'Добавить новое интервью', // заголовок тега <title>
		'edit_item' => 'Редактировать интервью',
		'new_item' => 'Новое интервью',
		'all_items' => 'Все интервью',
		'view_item' => 'Просмотреть интервью',
		'search_items' => 'Поиск интервью',
		'not_found' =>  'Интервью не найдено.',
		'not_found_in_trash' => 'Интервью в корзине не найдено.',
		'menu_name' => 'Интервью' // ссылка в меню в админке
	);
	$args['labels'] = $labels1;
	$args['menu_icon'] = 'dashicons-format-status';
	$args['menu_position'] += 1;
	$args['taxonomies'] = array();
	register_post_type('interview', $args);

	// Analytics
	$labels2 = array(
		'name' => 'Аналитика', // H1
		'singular_name' => 'Запись аналитики', // Добавить->Запись (Именительный падеж)
		'add_new' => 'Добавить запись',
		'add_new_item' => 'Добавить новую', // в меню
		'edit_item' => 'Редактировать запись',
		'new_item' => 'Новая запись',
		'all_items' => 'Вся аналитика',
		'view_item' => 'Просмотреть запись аналитики',
		'search_items' => 'Поиск записей аналитики',
		'not_found' =>  'Записей не найдено.',
		'not_found_in_trash' => 'Записей аналитики в корзине не найдено.',
		'menu_name' => 'Аналитика' // ссылка в меню в админке
	);
	$args['labels'] = $labels2;
	$args['menu_icon'] = 'dashicons-analytics';
	$args['menu_position'] += 1;
	$args['taxonomies'] = array('category', 'post_tag');
	register_post_type('analytics', $args);

	// Partners' news
	$labels3 = array(
		'name' => 'Новости партнёров',
		'singular_name' => 'Новость партнёра', // Добавить->Запись (Именительный падеж)
		'add_new' => 'Добавить новость', // в меню и на кнопке
		'add_new_item' => 'Добавить новость партнёра', // заголовок
		'edit_item' => 'Редактировать новость',
		'new_item' => 'Новая новость',
		'all_items' => 'Все новости партнёров', // подменю в админке
		'view_item' => 'Просмотреть новость партнёров',
		'search_items' => 'Поиск новостей',
		'not_found' =>  'Новостей партнёров не найдено.',
		'not_found_in_trash' => 'Новостей партнёров в корзине не найдено.',
		'menu_name' => 'Партнёры' // ссылка в меню в админке
	);
	$args['labels'] = $labels3;
	$args['menu_icon'] = 'dashicons-groups';
	$args['menu_position'] += 1;
	register_post_type('partners', $args);

	// Companies
	$labels4 = array(
		'name' => 'Компании',
		'singular_name' => 'Компания', // Добавить->Запись (Именительный падеж)
		'add_new' => 'Добавить компанию', // в меню и на кнопке
		'add_new_item' => 'Добавить новую', // заголовок
		'edit_item' => 'Редактировать компанию',
		'new_item' => 'Новая компания',
		'all_items' => 'Все компании', // подменю в админке
		'view_item' => 'Просмотреть компанию',
		'search_items' => 'Поиск компаний',
		'not_found' =>  'Компаний не найдено.',
		'not_found_in_trash' => 'Компаний в корзине не найдено.',
		'menu_name' => 'Компании' // ссылка в меню в админке
	);
	$args['labels'] = $labels4;
	$args['menu_icon'] = 'dashicons-building';
	$args['menu_position'] += 1;
	register_post_type('companies', $args);

	// Events' news
	$labels5 = array(
		'name' => 'Мероприятия',
		'singular_name' => 'Мероприятие', // Добавить->Запись (Именительный падеж)
		'add_new' => 'Добавить мероприятие', // в меню и на кнопке
		'add_new_item' => 'Добавить мероприятие', // заголовок
		'edit_item' => 'Редактировать мероприятие',
		'new_item' => 'Новое мероприятие',
		'all_items' => 'Все мероприятия', // подменю в админке
		'view_item' => 'Просмотреть мероприятие',
		'search_items' => 'Поиск мероприятий',
		'not_found' =>  'Мероприятий не найдено.',
		'not_found_in_trash' => 'Мероприятий в корзине не найдено.',
		'menu_name' => 'Мероприятия' // ссылка в меню в админке
	);
	$args['labels'] = $labels5;
	$args['menu_icon'] = 'dashicons-text-page';
	$args['menu_position'] += 1;
	register_post_type('events', $args);
}
add_action( 'init', 'oleoscope_register_cpts' );


function create_interview_taxonomies() {
	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Categories' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category Name' ),
		'menu_name'         => __( 'Categories' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'categories' ),
	);

	register_taxonomy( 'interview_categories', array( 'interview' ), $args );

	$labels2 = array(
		'name'                       => _x( 'Tags', 'taxonomy general name' ),
		'singular_name'              => _x( 'Tag', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Tags' ),
		'all_items'                  => __( 'All Tags' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Tag' ),
		'update_item'                => __( 'Update Tag' ),
		'add_new_item'               => __( 'Add New Tag' ),
		'new_item_name'              => __( 'New Tag Name' ),
		'menu_name'                  => __( 'Tags' ),
	);

	$args2 = array(
		'hierarchical'      => false,
		'labels'            => $labels2,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'tags' ),
	);
	register_taxonomy( 'interview_tags', array( 'interview' ), $args2 );
	flush_rewrite_rules();
}
add_action( 'init', 'create_interview_taxonomies', 0 );