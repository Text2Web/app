<?php
use Migrations\AbstractMigration;

class SearchIndex extends AbstractMigration
{

    public function change()
    {
        $searchIndexTable = $this->table('search_index');
        $searchIndexTable
            ->addColumn('page_name', 'string', ['limit' => 999])
            ->addColumn('url', 'text')
            ->addColumn('page_content', 'text')
            ->addColumn('uuid', 'uuid')
            ->addColumn('last_modified', 'timestamp')
            ->addColumn('created', 'datetime')
            ->create();
    }
}
