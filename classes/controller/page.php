<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Page extends Controller_Template {

	public $auto_render = FALSE;
	public $navigation = FALSE;
	public $page = NULL;
	
	public function get_uri()
	{
		if ( empty( $this->uri ) )
		{
			$uri = $this->request->controller() . '/' . $this->request->action();
			$dir = $this->request->directory();

			if ( !empty( $dir ) )
				$uri = $dir . '/' . $uri;

			$this->uri = $uri;
			unset( $uri, $dir );
		}

		return $this->uri;
	}

	public function before()
	{
		$this->navigation = Navigation::instance( 'sitemap' );

		// Ищем текущую страницу в карте сайта по текущему URL
		$this->page = $this->navigation
			->pages()
			->findOneByUri( Request::current()->uri() );

		// Если найдена, то рендерим шаблон для нее
		if ( $this->page !== NULL )
		{
			$this->auto_render = TRUE;

			// Указываем, нужна ли авторизация и для каких ролей доступен
			// контроллер
			$this->auth_required = $this->page->getRoles();
		}

		parent::before();


		if ( $this->page !== NULL )
		{
			if ( !$this->page->title )
			{
				$this->page->title = $this->page->label;
			}
		}

		if ( $this->auto_render === TRUE )
		{
			$this->template->content = View::factory( $this->get_uri() );
		}
	}

	public function after()
	{
		if ( $this->auto_render === TRUE )
		{
			// Выводим навигацию в шаблон
			$this->template->navigation = View::factory( 'global/navigation', array(
				'navigation' => $this->navigation->menu()
			) );

			// Выводим хлебные крошки в шаблон
			$breadcrumbs = new Navigation_Helper_Breadcrumbs;
			$breadcrumbs->setSeparator( '/ ' );
			$breadcrumbs->setContainer( $this->navigation->pages() );
			$this->template->breadcrumbs = $breadcrumbs->render();
		}

		parent::after();
	}

}