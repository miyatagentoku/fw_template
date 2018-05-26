<?php
	class AppCore {

		private $routing;
		public $page;
		public $page_pre;
		public $error_page;

		public function __construct() {
			$this->routing = $this->init();
			$this->error_page = ROOT.$this->routing[ERROR].'.'.$this->routing['mime_type'];
		}

		private function init() {
			return require_once( CONFIG.'routing.php');
		}

		public function matchRouting( $uri ) {

    		// 拡張子、コントローラのパスを取得するため
    		$uri_arr = explode( '/', $uri );
    		$uri_mime = end( $uri_arr );

	    	// 拡張子付きのURLを指定している場合404
    		if ( strpos($uri_mime, '.') != false ) {
    			$this->page = ERROR;
    			return $this->error_page;
    		}

    		// ルーティング設定されているURLのみコントローラーを読み込む
			foreach ( array_reverse( $this->routing['routing'] ) as $requested_uri => $inc_path) {
				if ( preg_match("{^$requested_uri}", $uri) ) {
					$this->page = $inc_path;
					$this->page_pre = $requested_uri;
					return CONTROLLER.$inc_path.'controller.php';
				}
			}

			// ルーティングされていないページはエラーページ扱い
			$this->page = ERROR;
			return $this->error_page;
		}
	}