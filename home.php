<?php
	require_once( $_SERVER['DOCUMENT_ROOT'].'config/vars.php' );
	require_once( CONFIG.'AppCore.php' );
	require_once( CONTROLLER.'AppController.php' );

	// uriを取得する
	$req_uri = isset($_SERVER['QUERY_STRING']) ?
		str_replace( '?'.$_SERVER['QUERY_STRING'], '', $_SERVER["REQUEST_URI"] ) :
		$_SERVER["REQUEST_URI"];

	$core = new AppCore();
	$inc_path = $core->matchRouting( $req_uri );

	// コントローラを読み込み、またはエラーページを読み込み
    require_once( $inc_path );

    // エラーページでなければコントローラの処理を実行
    if ( $core->page != ERROR ) {
    	$class = str_replace( '/', '', ucfirst ( $core->page ).'Controller' );
    	$controller = new $class;

	    if ( $req_uri != '/' ) {

	    	// uri から表示中のページのスラッグを取得
	    	$func = str_replace( array( $core->page_pre, '/'), '', $req_uri);

	    	if ( $req_uri != '/'.$core->page && $req_uri.'/' != '/'.$core->page ) {

	    		if ( mb_substr_count( $core->page_pre, '/') >= 2 && !$func) {
	    			$f = explode( '/', $core->page_pre);
	    			$func = end($f);
	    		}
	    		
	    		// URLに紐づく関数が PageController に定義されていればそれを実行する
    			// 関数が定義されていなければ error ページとして扱う
	    		if ( method_exists ( $controller, $func ) ) {
	    			$controller->{$func}();
	    		} else {
		    		require_once( $core->error_page );
		    	}

	    	} else {
	    		// PageController
	    		$controller->index();
	    	}

	    } else {
	    	// HomeController
    		$controller->index();
	    }
    }