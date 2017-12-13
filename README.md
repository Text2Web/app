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

**Create Plugin**

```
bin/cake bake plugin PluginName
```

**Create Controller**

```
bin/cake bake controller WebHook
```

bin/cake migrations create migration_name --plugin PluginName
bin/cake bake all --plugin PluginName
bin/cake migrations migrate -p ManagePackage
bin/cake bake seed Bootstrap -p ManagePackage

bin/cake migrations seed -p ManagePackage


**References**
1. Migration: https://book.cakephp.org/3.0/en/migrations.html
2. Phinx Data Type: http://docs.phinx.org/en/latest/migrations.html#the-save-method


**Page Meta Information**
[//]:# (TITLE ::: Java Introduction)
[//]:# (DESCRIPTION ::: Java Introduction)
[//]:# (KEYWORD ::: Java Introduction)


Required Page
---------------------------
About Us, Contact Us, Terms & Conditions, Privacy Policy
