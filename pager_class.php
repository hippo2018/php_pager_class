<?php
// あ
// +++++++++++++++++++++++++++++++++++++++++++
class clfu_Pager {
	// 番号リンクの数
	public $clhen_linksNum = 6;
	// 1ページに表示するデータ数
	public $clhen_parOnePage;
	// 「いちばん最初リンク」と「いちばん最後リンク」のところの数。
	public $clhen_topEnd = 5;
	// 「いちばん最初リンク」と「いちばん最後リンク」の区切り文字。
	public $clhen_between = '...';
	// prev, nextの文字列
	public $clhen_prevString = 'PREV';
	public $clhen_nextString = 'NEXT';
	// prev, クエリ文字列
	public $clhen_query = 'get_page';
	// ulタグにつくクラス名
	public $clhen_class = 'pager';
	// +++++++++++++++++++++++++++++++++++++
	function __construct($hen_parOnePage, $hen_options = false) {
		$this->clhen_parOnePage = $hen_parOnePage;
		if (is_array ( $hen_options ) && count ( $hen_options ) > 0) {
			array_walk ( $hen_options, array (
					$this,
					'options'
			) );
		}
	}
	// +++++++++++++++++++++++++++++++++++++
	function fu_doIt($hen_total, $hen_query = array()) {
		if (! $hen_total) {
			return false;
		}
		$hen_current = isset ( $_GET [$this->clhen_query] ) ? $_GET [$this->clhen_query] : 1;
		$hen_pages = ceil ( $hen_total / $this->clhen_parOnePage );
		$hen_prev = $hen_current > 1 ? $hen_current - 1 : false;
		$hen_next = $hen_current < $hen_pages ? $hen_current + 1 : false;
		$hen_left = $hen_current - ceil ( $this->clhen_linksNum / 2 );
		$hen_right = $hen_current + ceil ( $this->clhen_linksNum / 2 );
		if ($hen_left < 1) {
			while ( $hen_right <= $this->clhen_linksNum ) {
				$hen_right ++;
			}
			$hen_left = 1;
		}
		if ($hen_right > $hen_pages) {
			$hen_left = $hen_left - $hen_right + $hen_pages;
			$hen_left = $hen_left < 1 ? 1 : $hen_left;
			$hen_right = $hen_pages;
		}
		for($hen_i = $hen_left; $hen_i <= $hen_right; $hen_i ++) {
			$hen_temp [] = $hen_i;
		}
		if ($hen_temp [0] > 1) {
			for($hen_i = 1; $hen_i < $hen_temp [0] && $hen_i <= $this->clhen_topEnd; $hen_i ++) {
				$hen_top [] = $hen_i;
			}
		}
		$hen_top = isset ( $hen_top ) ? $hen_top : array ();
		if (count ( $hen_top ) > 0 && $hen_top [count ( $hen_top ) - 1] != $hen_temp [0] - 1) {
			array_push ( $hen_top, $this->clhen_between );
		}
		$hen_last = $hen_temp [count ( $hen_temp ) - 1];
		if ($hen_last < $hen_pages - $this->clhen_topEnd) {
			array_push ( $hen_temp, $this->clhen_between );
		}
		for($hen_i = 0; $hen_i < $this->clhen_topEnd; $hen_i ++, $hen_pages --) {
			if ($hen_pages > $hen_last) {
				$hen_bottom [] = $hen_pages;
			}
		}
		$hen_bottom = isset ( $hen_bottom ) ? array_reverse ( $hen_bottom ) : array ();
		$hen_temp = array_merge ( $hen_top, $hen_temp, $hen_bottom );
		if ($hen_prev) {
			$hen_Pager [] = '<li><a href="javascript:java_page_cyenzi(' . $this->fu_pagerQuery ( $hen_prev, $hen_query ) . ')">' . $this->clhen_prevString . '</a></li>';
		} else {
			$hen_Pager [] = '<li><span>' . $this->clhen_prevString . '</span></li>';
		}
		for($hen_i = 0; $hen_i < count ( $hen_temp ); $hen_i ++) {
			if ($hen_temp [$hen_i] == $this->clhen_between) {
				$hen_str = $this->clhen_between;
			} elseif ($hen_current == $hen_temp [$hen_i]) {
				$hen_str = '<span>' . $hen_temp [$hen_i] . '</span>';
			} else {
				$hen_str = '<a href="javascript:java_page_cyenzi(' . $this->fu_pagerQuery ( $hen_temp [$hen_i], $hen_query ) . ')">' . $hen_temp [$hen_i] . '</a>';
			}
			$hen_Pager [] = '<li>' . $hen_str . '</li>';
		}
		if ($hen_next) {
			$hen_Pager [] = '<li><a href="javascript:java_page_cyenzi(' . $this->fu_pagerQuery ( $hen_next, $hen_query ) . ')">' . $this->clhen_nextString . '</a></li>';
		} else {
			$hen_Pager [] = '<li><span>' . $this->clhen_nextString . '</span></li>';
		}
		return '<ul class="' . $this->clhen_class . '">' . implode ( $hen_Pager ) . '</ul>';
	}
	// +++++++++++++++++++++++++++++++++++++
	function fu_options($hen_v, $hen_k) {
		$this->$hen_k = $hen_v;
	}
	// +++++++++++++++++++++++++++++++++++++
	function fu_pagerQuery($hen_page, $hen_query) {
		return $hen_page;
	}
}
#+++++++++++++++++++++++++++++++++++++++++++
