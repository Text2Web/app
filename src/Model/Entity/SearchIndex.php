<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;


class SearchIndex extends Entity
{

    protected $_accessible = [
        'page_name' => true,
        'url' => true,
        'page_content' => true,
        'uuid' => true,
        'last_modified' => true,
        'created' => true
    ];
}
