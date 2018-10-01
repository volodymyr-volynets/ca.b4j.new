<?php

namespace Helper;
class Dispatch {
	/**
	 * This would be called before controller
	 */
	public static function before() {
		\Layout::addCss('/numbers/media_submodules/Numbers_Frontend_HTML_Renderers_Bootstrap_Media_CSS_Base.css', -31600);
		\Layout::addJs('/numbers/media_submodules/Numbers_Frontend_HTML_Renderers_Bootstrap_Media_JS_Base.js', -31500);
	}

	/**
	 * This would be called after controller
	 */
	public static function after() {

	}
}