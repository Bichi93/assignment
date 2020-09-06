<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersTable extends Migration
{
	public function up()
	{

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'last_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'phone' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),	
		);

		$this->forge->addField($fields);
		$this->forge->addKey('id', TRUE);

		$this->forge->createTable('users');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
