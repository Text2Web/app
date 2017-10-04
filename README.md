# Text Convert to Web UI. :) 



**Install Migration Plugin**

```
composer require cakephp/migrations
```


**How to add migration?**

```
 bin/cake migrations create SearchIndex
```


**Run migration**

```
bin/cake migrations migrate
```

**Create Seeds**

```
bin/cake bake seed SeederName
```


**Generate Entity and Table**

```
bin/cake bake model Articles
```

**Run Seeds**

```
bin/cake migrations seed
```




**References**
1. Migration: https://book.cakephp.org/3.0/en/migrations.html
2. Phinx Data Type: http://docs.phinx.org/en/latest/migrations.html#the-save-method
