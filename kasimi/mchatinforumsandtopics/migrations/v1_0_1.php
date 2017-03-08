<?php

/**
 *
 * @package phpBB Extension - mChat in Forums and Topics
 * @copyright (c) 2016 kasimi - https://kasimi.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace kasimi\mchatinforumsandtopics\migrations;

use phpbb\db\migration\migration;

class v1_0_1 extends migration
{
	public function update_data()
	{
		return array(
			array('config.add', array('mchat_in_viewforum', 0)),
			array('config.add', array('mchat_in_viewtopic', 0)),
		);
	}
}
