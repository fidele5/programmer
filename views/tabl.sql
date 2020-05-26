-- Create a new table called 'categories_cours' in schema 'SchemaName'
-- Drop the table if it already exists
IF OBJECT_ID('programmator.categories_cours', 'U') IS NOT NULL
DROP TABLE programmator.categories_cours
GO
-- Create the table in the specified schema
CREATE TABLE programmator.categories_cours
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, -- primary key column
    desigINSERT INTO `programator`.`admins` (id, login, mdp)
    VALUES
      (
        id:int,
        'login:varchar',
        'mdp:varchar'
      );antion VARCHAR(255) NOT NULL
);
