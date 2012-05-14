<?php defined( 'SYSPATH' ) or die( 'No direct access allowed.' );

$map = array(
	'label' => 'Главная',
	'pages' => array(
		array(
			'label' => 'Главная',
		),
		array(
			'label' => 'Ошибка',
			'route' => 'error',
			'visible' => FALSE,
		),
		array(
			'label' => 'Поиск по сайту',
			'controller' => 'search',
			'visible' => FALSE,
		),
		array(
			'label' => 'События',
			'controller' => 'events',
			'pages' => array(
				array(
					'label' => 'Выставки',
					'controller' => 'exposures'
				),
				array(
					'label' => 'На карте',
					'controller' => 'events',
					'action' => 'map',
				),
				array(
					'label' => 'Событие',
					'controller' => 'events',
					'action' => 'view',
					'visible' => FALSE,
				),
			),
		),
		array(
			'label' => 'Блоги',
			'controller' => 'blogs',
			'pages' => array(
				array(
					'label' => 'Новые',
					'controller' => 'blogs',
					'action' => 'new',
				),
				array(
					'label' => 'Категория',
					'controller' => 'blogs',
					'action' => 'category',
					'visible' => FALSE,
				),
				array(
					'label' => 'Категория постов',
					'controller' => 'topics',
					'action' => 'category',
					'visible' => FALSE,
				),
				array(
					'label' => 'Посты компании',
					'controller' => 'topics',
					'action' => 'company',
					'visible' => FALSE,
				),
				array(
					'label' => 'Тип',
					'controller' => 'blogs',
					'action' => 'type',
					'visible' => FALSE,
				),
				array(
					'label' => 'Блог',
					'route' => 'blog',
					'blog_name' => Request::current()->param( 'blog_name' ),
					'visible' => FALSE,
				),
				array(
					'label' => 'Блог',
					'route' => 'topic_read',
					'blog_name' => Request::current()->param( 'blog_name' ),
					'topic_id' => Request::current()->param( 'topic_id' ),
					'visible' => FALSE,
				),
			),
		),
		array(
			'label' => 'Теги',
			'controller' => 'tags',
			'pages' => array(
				array(
					'label' => 'Топики',
					'route' => 'tag',
					'tag_name' => Request::current()->param( 'tag_name' ),
					'visible' => FALSE,
				),
			),
		),
		array(
			'label' => 'Компании',
			'controller' => 'companies',
			'pages' => array(
				array(
					'label' => 'Компания',
					'controller' => 'companies',
					'action' => 'view',
					'visible' => FALSE,
				),
				array(
					'label' => 'Компании на',
					'controller' => 'companies',
					'action' => 'char',
					'visible' => FALSE,
				),
			),
		),

		array(
			'label' => 'Пользователи',
			'controller' => 'users',
			'pages' => array(
				array(
					'label' => 'Пользователь',
					'route' => 'open_profile',
					'username' => Request::current()->param( 'username' ),
					'visible' => FALSE,
				)
			)
		),
		array(
			'label' => 'Настройки',
			'controller' => 'settings',
			'roles' => array('admin'),
			'pages' => array(
				array(
					'label' => 'Плагины',
					'route' => 'plugins',
					'icon' => 'icon-leaf',
					'pages' => array(
						array(
							'label' => 'Настройки',
							'route' => 'plugins',
							'action' => 'settings',
							'visible' => FALSE,
						),
					),
					'separator' => TRUE,
				),
				array(
					'label' => 'Задачи',
					'controller' => 'settings',
					'action' => 'work',
					'icon' => 'icon-plane'
				),
				array(
					'label' => 'Источники',
					'controller' => 'settings',
					'action' => 'sources',
					'icon' => 'icon-screenshot'
				)
			),
		),
	)
);

if ( Auth::instance()->logged_in() )
{
	$user = Auth::instance()->get_user();
	$map['pages'][] = array(
		'label' => $user->username,
		'route' => 'open_profile',
		'username' => $user->username,
		'class' => 'login',
		'pages' => array(
			array(
				'label' => 'Новая компания',
				'route' => 'system',
				'controller' => 'company',
				'action' => 'add',
				'roles' => array('admin'),
				'icon' => 'icon-home',
				'pages' => array(
					array(
						'label' => 'Редактирование компании',
						'route' => 'system',
						'controller' => 'company',
						'action' => 'edit',
						'roles' => array('admin'),
						'visible' => FALSE,
					),
				)
			),
			array(
				'label' => 'Новый блог',
				'route' => 'system',
				'controller' => 'blog',
				'action' => 'add',
				'roles' => array('admin'),
				'icon' => 'icon-folder-close',
				'pages' => array(
					array(
						'label' => 'Редактирование блога',
						'route' => 'system',
						'controller' => 'blog',
						'action' => 'edit',
						'roles' => array('admin'),
						'visible' => FALSE,
					),
				)
			),
			array(
				'label' => 'Новая категория',
				'route' => 'system',
				'controller' => 'category',
				'action' => 'add',
				'icon' => 'icon-list-alt',
				'roles' => array('admin'),
				'pages' => array(
					array(
						'label' => 'Редактирование категории',
						'route' => 'system',
						'controller' => 'category',
						'action' => 'edit',
						'roles' => array('admin'),
						'visible' => FALSE,
					),
				)
			),
			array(
				'label' => 'Новый топик',
				'route' => 'system',
				'controller' => 'topic',
				'action' => 'add',
				'icon' => 'icon-file',
				'roles' => array('login'),
				'separator' => TRUE,
				'pages' => array(
					array(
						'label' => 'Редактирование топика',
						'route' => 'system',
						'controller' => 'topic',
						'action' => 'edit',
						'roles' => array('admin'),
						'visible' => FALSE,
					),
				)
			),
			array(
				'label' => 'Новое событие',
				'route' => 'system',
				'controller' => 'event',
				'action' => 'add',
				'icon' => 'icon-calendar',
				'roles' => array('admin'),
				'pages' => array(
					array(
						'label' => 'Редактирование события',
						'route' => 'system',
						'controller' => 'event',
						'action' => 'edit',
						'roles' => array('admin'),
						'visible' => FALSE,
					),
				)
			),
			array(
				'label' => 'Новая выставка',
				'route' => 'system',
				'controller' => 'exposure',
				'action' => 'add',
				'icon' => 'icon-map-marker',
				'roles' => array('admin'),
				'separator' => TRUE,
				'pages' => array(
					array(
						'label' => 'Редактирование выставки',
						'route' => 'system',
						'controller' => 'exposure',
						'action' => 'edit',
						'roles' => array('admin'),
						'visible' => FALSE,
					),
				)
			),
			array(
				'label' => 'Новый пользователь',
				'route' => 'system',
				'controller' => 'user',
				'action' => 'add',
				'icon' => 'icon-user',
				'roles' => array('admin'),
				'separator' => TRUE,
				'pages' => array(
					array(
						'label' => 'Редактирование пользователя',
						'route' => 'system',
						'controller' => 'user',
						'action' => 'edit',
						'roles' => array('admin'),
						'visible' => FALSE,
					),
				)
			),
			array(
				'label' => 'Избранное',
				'route' => 'favorites',
				'roles' => array('login'),
				'icon' => 'icon-bookmark'
			),
			array(
				'label' => 'Резюме',
				'route' => 'resume',
				'icon' => 'icon-lock',
				'roles' => array('login')
			),
			array(
				'label' => 'Настройки',
				'route' => 'profile',
				'roles' => array('login'),
				'icon' => 'icon-cog',
				'separator' => TRUE
			),
			array(
				'label' => 'Выход',
				'route' => 'user',
				'action' => 'logout',
			),
		),
	);
}
else
{
	$map['pages'][] = array(
		'label' => 'Регистрация',
		'route' => 'user',
		'action' => 'register',
		'class' => 'login'
	);

	$map['pages'][] = array(
		'label' => 'Вход',
		'route' => 'user',
		'action' => 'login',
		'class' => 'login'
	);
}

return array($map);