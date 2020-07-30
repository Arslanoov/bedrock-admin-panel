<?php

namespace Migration;

use Spiral\Migrations\Migration;

class OrmDefault94f12343306d549015155fb02ca323b8 extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('user_users')
            ->addColumn('id', 'primary', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('login', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 32
            ])
            ->addColumn('status', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 16
            ])
            ->setPrimaryKeys(["id"])
            ->create();
    }

    public function down(): void
    {
        $this->table('user_users')->drop();
    }
}
