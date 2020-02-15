<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Instructions on running Up & Down migrations listed above each method (see below).
 */
final class Version20200211144805 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'test migration';
    }

    /**
     * To run this migration you would run in your terminal:
     *  > ./vendor/bin/doctrine-migrations migrations:execute --up 20200211144805
     */
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('CREATE TABLE example_table (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');

    }

    /**
     * To run this migration you would run in your terminal:
     *  > ./vendor/bin/doctrine-migrations migrations:execute --down 20200211144805
     */
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        
        $this->addSql('DROP TABLE example_table');

    }
}
