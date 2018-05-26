<?php

class PageController extends AppController {

	// /page 直下のページ
	public function index () {
		echo "This is page's index";
	}

	// /page 配下 /page/sample
	public function sample () {
		echo "This is page's lowerpage sample";
	}

	// /page 配下 /page/sample/sampleChild
	public function sampleChild () {
		echo "This is page's lowepage sample's child";
	}

	// /page 配下 /page/others
	public function others () {
		echo "This is page's lowerpage others";
	}
 }