<?php

namespace Controller;
class Index extends \Object\Controller {

	public $title = 'Home';

	public function actionIndex() {
		\Layout::addMessage('Break for Jesus 2021 is changing again!', SUCCESS);
		\Layout::addMessage('Camp B4J will now run APRIL 12-16, daily 11 am-12:15 pm.', SUCCESS);
		\Layout::addMessage("The online camp for Ukrainian Catholic children in gr. 3-8 from
our eparchy will run on ZOOM, and will include prayers, teachings, music, arts and crafts, games and various fun activities – all together and in smaller groups. There is a limit of 80 screens.
*REGISTRATION HAS BEEN EXTENDED TO MARCH 14.", SUCCESS);
	}
}