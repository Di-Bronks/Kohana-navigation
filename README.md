Kohana-navigation
=================

Модуль создания навигации и карты сайта

## Описание
Данный модуль сделан на основе Zend Navigation. Он практически полностью переписан и адаптирован под Kohana

Модуль использует роутинг Kohana и на основе него генерирует ссылки и по нему определяет текущую страницу.
По умолчанию используется роут `default`

## Принцип работы
Модуль берет всю информацию из Sitemap, который располагается в конфигах. При инициализации модуля, указывается название конфига.
По умолчанию `sitemap`


	$navigation = Navigation::instance( 'sitemap' );
	$page = $navigation
		->pages()
		->findOneByUri( Request::current()->uri() );
		
## Хлебные крошки

	$breadcrumbs = new Navigation_Helper_Breadcrumbs;
	$breadcrumbs->setSeparator( '/ ' );
	$breadcrumbs->setContainer( $navigation->pages() );
	$breadcrumbs->render();

	

### Bug

В текущей версии модуля есть небольшой баг по определению текущей страницы, у которой динамические параметры в uri.
Эти параметры необходимо так же указывать в `sitemap`

	array(
		'label' => 'Блог',
		'route' => 'topic_read',
		'blog_name' => Request::current()->param( 'blog_name' ),
		'topic_id' => Request::current()->param( 'topic_id' )
	)