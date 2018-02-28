# SlyGen - a rest api generator

Generates a simple application that exposes REST Api and handles basic CRUD operations on top of MySql db.

This is meant as a skeleton generator that would remove repetitive tasks, such as basic routing,
controllers and model creation and migration script.

**IMPORTANT NOTE:** This is a playground kind of project, by no means is this meant for any 
production usage. As such, it isn't even the most effective or simple to use solution for what it does.
Not only that, it is also in some loose kind of draft state, and is only able to generate what is currently in 
the `schema.json` file in tmp dir. Adding more resources of same capabilities will of course work, but 
I didn't implement many of the relation types, and controllers are not very well connected with the models
and their methods.

If you ask "Doesn't Doctrine kinda do all of this already?" the answer is yes. Yes it does.

## Generated code

Generated code is built on top of Symfony Http kernel, uses Symfony packages for configuration and
dependency injection. For database ORM the Laravel's Eloquent is used.

## Schema file

The bread and butter of this project, a definition of what is to be generated.

### General setup section

* Name of application, is also used as the top level namespace
* Driver defines what type of SQL database you're using (Only MySql currently supported). 
* Output folder, where generated code is written
* Credentials, full set of MySql credentials

```json
  "type": "relational",
  "driver": "mysql",
  "name": "test",
  "outputFolder": "/tmp/slygen",
  "credentials": {
    "dbname": "test",
    "username": "root",
    "password": "",
    "host": "127.0.0.1",
    "port": "3306",
    "driver": "mysql",
    "charset": "utf8",
    "collation": "utf8_unicode_ci"
  }
```

### Resources

This area defines two things, the API endpoints, as well as database structure.

Name and plural values are used for naming of endpoints, and model methods.

Options are specific to MySql and are used in migration script.

Indexes and columns are used for migration script, values are specific to EloquentORM method naming (eg datatype `increments`).

Relations are used for generating methods in Models, and as such accessors to related entity collections.

```json
{
      "name": "team",
      "plural": "teams",
      "options": [
        {
          "type": "collation",
          "value": "utf8_unicode_ci"
        },
        {
          "type": "engine",
          "value": "InnoDB"
        }
      ],
      "indexes": [
        {
          "type": "unique",
          "column": "column_3"
        }
      ],
      "columns": [
        {
          "name": "id",
          "dataType": "increments"
        },
        {
          "name": "name",
          "dataType": "string"
        },
        {
          "name": "column_3",
          "dataType": "string"
        }
      ],
      "relations": [
        {
          "type": "12M",
          "reference": "player",
          "through": null
        }
      ]
    }
```


