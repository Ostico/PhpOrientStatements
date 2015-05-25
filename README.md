# PhpOrientStatements

An attempt to create Prepared Statements to be used with the PhpOrient library

## Installation

To install the most recent version of the library just type

    git clone git@github.com:Ostico/PhpOrientStatements.git

then enter the directory `PhpOrientStatements` and run

    php composer.phar install

to install the dependencies of the project

## Usage

### Client initialization

To initialize the client we first need to instantiate a `PhpOrient` client and pass it as a dependency

```php
$client = new PhpOrient( 'localhost', 2424 );
$client->username = 'root';
$client->password = 'root_pass';

//The prepare method will be put inside PhpOrient so, for now we make it a simple Factory
//TODO: remove and place inside PhpOrient Client itself
//Ex: 
//$preparedStatement = $client->prepare( 'select from :name' );
//
$preparedClient = new StatementFactory($client);  
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

Alternatively, you can bind a variable to the parameter. It will be passed by reference and evaluated only when the statement is executed

```php
$preparedStatement->bindParam('name', $name);

$name = 'John';
```

To execute the prepared statement ( returns boolean )
and fetch the results:

```php
if ( $preparedStatement->execute() ) {
    /**
     * @var $resultSet \PhpOrient\Protocols\Binary\Data\Record[]|[]
     */
    $resultSet = $preparedStatement->fetchAll();
}
```
