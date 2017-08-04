<?php

/**
 *
 * @package phpBB Extension - mChat in Forums and Topics
 * @copyright (c) 2017 kasimi - https://kasimi.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace kasimi\mchatinforumsandtopics\migrations;

use phpbb\db\migration\migration;

class v1_1_2 extends migration
{
	static public function depends_on()
	{
		return array(
			'\kasimi\mchatinforumsandtopics\migrations\v1_0_1',
			'\kasimi\mchatinforumsandtopics\migrations\v1_1_0',
		);
	}

	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'fix_migration_depends_on'))),
		);
	}

	public function fix_migration_depends_on()
	{
		$incorrect_migration_name = '\kasimi\mchatinforumsandtopics\migrations\v1_0_1';

		$sql = 'SELECT migration_depends_on
			FROM ' . MIGRATIONS_TABLE . "
			WHERE migration_name = '" . $this->db->sql_escape($incorrect_migration_name) . "'";
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		$migration_depends_on = unserialize($row['migration_depends_on']);

		if ($migration_depends_on[0] === 'kasimi\mchatinforumsandtopics\migrations\v1_0_0')
		{
			$migration_depends_on[0] = '\kasimi\mchatinforumsandtopics\migrations\v1_0_0';

			$sql = 'UPDATE ' . MIGRATIONS_TABLE . "
				SET migration_depends_on = '" . $this->db->sql_escape(serialize($migration_depends_on)) . "'
				WHERE migration_name = '" . $this->db->sql_escape($incorrect_migration_name) . "'";
			$this->db->sql_query($sql);
		}
	}
}
