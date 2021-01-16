<?php

namespace Controller;
class Index extends \Object\Controller {

	public $title = 'Home';

	public function actionIndex() {
		\Layout::addMessage('Break for Jesus is back!', SUCCESS);
		\Layout::addMessage("The organizing committee is pleased to announce that B4J 2021 will take place virtually, during March
Break, every day from 11am-12:15pm. The online camp for Ukrainian Catholic children in gr. 3-8 from
our eparchy will run on ZOOM, and will include prayers, teachings, music, arts and crafts, games and
various fun activities – all together and in smaller groups. There is a limit of 80 screens, and you must
register in advance on this site, starting February 1.", SUCCESS);
	}
}