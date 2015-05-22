# PhpOrientStatements

An attempt to create Prepared Statements to be used with the phporient library

## Installation

To install the most recent version of the library just type

    git clone git@github.com:Ostico/PhpOrientStatements.git

then enter the directory `PhpOrientStatements` and run

    php composer.phar install

to install the dependecies of the project

## Usage

### Client initialization

To initialize the client we first need to instantiate a `PhpOrient` client and pass it as a dependency

```php
$client = new PhpOrient( 'localhost', 2424 );
$client->username = 'root';
$client->password = 'root_pass';

$preparedClient = new PreparedClient($client);
```

To create a new prepared statement

```php
$statement = 'select expand(field) from Class where name = :name';
$preparedStatement = $preparedClient->prepare($statement);
```

Then, to bind a value to the parameter

```php
$preparedStatement->bindValue('name', 'John');
```

Alternatively, you can bind a variable to the parameter. It will be passed by reference and eveluated only when the statement is executed

```php
$preparedStatement->bindParam('name', $name);

$name = 'John';
```

To execute the prepared statement

```php
$preparedStatement->execute();
```
