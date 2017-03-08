<?php

/**
 *
 * @package phpBB Extension - mChat in Forums and Topics
 * @copyright (c) 2017 kasimi - https://kasimi.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace kasimi\mchatinforumsandtopics\migrations;

use phpbb\db\migration\container_aware_migration;

class v1_1_0 extends container_aware_migration
{
	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'fix_migration_name'))),
		);
	}

	public function fix_migration_name()
	{
		$incorrect_migration_name = 'kasimi\mchatinforumsandtopics\migrations\v1_0_0';

		if ($this->exists_migration_name($incorrect_migration_name))
		{
			if ($this->exists_migration_name('\\' . $incorrect_migration_name))
			{
				$sql = 'DELETE FROM ' . MIGRATIONS_TABLE . "	
					WHERE migration_name = '" . $this->db->sql_escape($incorrect_migration_name) . "'";
				$this->db->sql_query($sql);
			}
			else
			{
				$sql = 'UPDATE ' . MIGRATIONS_TABLE . "	
					SET migration_name = '" . $this->db->sql_escape('\\' . $incorrect_migration_name) . "'
					WHERE migration_name = '" . $this->db->sql_escape($incorrect_migration_name) . "'";
				$this->db->sql_query($sql);
			}

			$user = $this->container->get('user');
			$user->add_lang_ext('kasimi/mchatinforumsandtopics', 'mchatinforumsandtopics_ucp');
			trigger_error('MCHAT_IN_FORUMS_AND_TOPICS_FIXED_MIGRATION_NAME');
		}
	}

	/**
	 * @param string $migration_name
	 * @return bool
	 */
	protected function exists_migration_name($migration_name)
	{
		$sql = 'SELECT migration_name 
			FROM ' . MIGRATIONS_TABLE . "	
			WHERE migration_name = '" . $this->db->sql_escape($migration_name) . "'";
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);
		return isset($row['migration_name']);
	}
}
