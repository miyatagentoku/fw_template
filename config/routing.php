<?php

return array(
	// ページファイル拡張子
	'mime_type' => 'php',
	// ルーティング　アクセスURLの許可設定
	'routing' => array(
		// TOP ページ
		'/' => 'home/',
		// 下層ページ
		'/page' => 'page/',
		// 下層ページ　配下
		'/page/sample' => 'page/'
	),
	// エラーページ　デフォルト404
	ERROR => '404'
);