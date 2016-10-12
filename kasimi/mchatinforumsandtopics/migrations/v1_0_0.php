<?php

/**
 *
 * @package phpBB Extension - mChat in Forums and Topics
 * @copyright (c) 2016 kasimi
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace kasimi\mchatinforumsandtopics\migrations;

use phpbb\db\migration\container_aware_migration;

class v1_0_0 extends container_aware_migration
{
	static public function depends_on()
	{
		return array('\dmzx\mchat\migrations\mchat_2_0_0_rc7');
	}

	public function update_data()
	{
		return array(
			array('permission.add', array('u_mchat_in_viewforum', true)),
			array('permission.add', array('u_mchat_in_viewtopic', true)),
		);
	}

	public function update_schema()
	{
		return array(
			'add_columns' => array(
				$this->table_prefix . 'users' => array(
					'user_mchat_in_viewforum'	=> array('BOOL', 1),
					'user_mchat_in_viewtopic'	=> array('BOOL', 1),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns' => array(
				$this->table_prefix . 'users' => array(
					'user_mchat_in_viewforum',
					'user_mchat_in_viewtopic',
				),
			),
		);
	}
}
