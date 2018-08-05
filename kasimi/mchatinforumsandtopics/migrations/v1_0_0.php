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

class v1_0_0 extends migration
{
	public function update_data()
	{
		return [
			['permission.add', ['u_mchat_in_viewforum', true]],
			['permission.add', ['u_mchat_in_viewtopic', true]],
		];
	}

	public function update_schema()
	{
		return [
			'add_columns' => [
				$this->table_prefix . 'users' => [
					'user_mchat_in_viewforum'	=> ['BOOL', 1],
					'user_mchat_in_viewtopic'	=> ['BOOL', 1],
				],
			],
		];
	}

	public function revert_schema()
	{
		return [
			'drop_columns' => [
				$this->table_prefix . 'users' => [
					'user_mchat_in_viewforum',
					'user_mchat_in_viewtopic',
				],
			],
		];
	}
}
