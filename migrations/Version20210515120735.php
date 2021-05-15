<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210515120735 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gd DROP FOREIGN KEY FK_21BA4ADEA0321766;');
        $this->addSql('DROP TABLE center');
        $this->addSql('DROP INDEX IDX_21BA4ADEA0321766 ON gd');
        $this->addSql('ALTER TABLE gd DROP maindoc_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE center (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE gd ADD maindoc_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_21BA4ADEA0321766 ON gd (maindoc_id)');
    }
}
