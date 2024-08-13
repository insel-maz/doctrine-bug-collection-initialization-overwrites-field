# doctrine-bug-collection-initialization-overwrites-field

When Doctrine fetches the entities for a PersistentCollection it overwrites a nulled association field with the persisted association.

This happens by the if statement in https://github.com/doctrine/orm/blob/205b2f5f200c63f8cb22a26bfc0174071ed97d2c/src/Internal/Hydration/ObjectHydrator.php#L434.

## Installation
```sh
composer install
php bin/doctrine orm:schema-tool:update --dump-sql --force
php create-entities.php
```

## Run test
```sh
php test-entities.php
```

## Actual result
```
Disposing invoice audit: 1
Actual invoice ➡ invoice audit: NULL
Actual invoice ➡ invoice audit: object
```

## Expected result
```
Disposing invoice audit: 1
Actual invoice ➡ invoice audit: NULL
Actual invoice ➡ invoice audit: NULL
```
