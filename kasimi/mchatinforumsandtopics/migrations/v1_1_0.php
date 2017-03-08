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

		$sql = 'UPDATE ' . MIGRATIONS_TABLE . "	
			SET migration_name = '" . $this->db->sql_escape('\\' . $incorrect_migration_name) . "'
			WHERE migration_name = '" . $this->db->sql_escape($incorrect_migration_name) . "'";
		$this->db->sql_query($sql);

		if ($this->db->sql_affectedrows())
		{
			$user = $this->container->get('user');
			$user->add_lang_ext('kasimi/mchatinforumsandtopics', 'mchatinforumsandtopics_ucp');
			trigger_error('MCHAT_IN_FORUMS_AND_TOPICS_FIXED_MIGRATION_NAME');
		}
	}
}
