<?php

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
    protected $table = 'pages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'url', 'description', 'status', 'menu_position'];

    public function get_all_pages()
    {
        return $this->where('status', 'active')->findAll();
    }

    public function get_page_by_id($id)
    {
        return $this->find($id);
    }

    public function up()
    {
        $this->forge->addColumn('pages', [
            'menu_position' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'default' => 'none',
                'null' => false,
            ],
        ]);
    }
}
