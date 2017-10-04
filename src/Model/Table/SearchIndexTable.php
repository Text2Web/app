<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class SearchIndexTable extends Table
{


    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->setTable('search_index');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
    }


    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('page_name')
            ->allowEmpty('page_name');

        $validator
            ->scalar('url')
            ->allowEmpty('url');

        $validator
            ->scalar('page_content')
            ->allowEmpty('page_content');

        $validator
            ->scalar('uuid')
            ->allowEmpty('uuid');

        $validator
            ->dateTime('last_modified')
            ->allowEmpty('last_modified');

        return $validator;
    }
}
