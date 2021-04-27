<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427232249 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ac ADD maindoc_id INT NOT NULL, ADD artisan_id INT NOT NULL, ADD weight DOUBLE PRECISION NOT NULL, ADD weight_attach DOUBLE PRECISION NOT NULL, ADD weight_gold DOUBLE PRECISION NOT NULL, ADD date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE ac ADD CONSTRAINT FK_E98478FBA0321766 FOREIGN KEY (maindoc_id) REFERENCES center (id)');
        $this->addSql('ALTER TABLE ac ADD CONSTRAINT FK_E98478FB5ED3C7B7 FOREIGN KEY (artisan_id) REFERENCES artisan (id)');
        $this->addSql('CREATE INDEX IDX_E98478FBA0321766 ON ac (maindoc_id)');
        $this->addSql('CREATE INDEX IDX_E98478FB5ED3C7B7 ON ac (artisan_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ac DROP FOREIGN KEY FK_E98478FBA0321766');
        $this->addSql('ALTER TABLE ac DROP FOREIGN KEY FK_E98478FB5ED3C7B7');
        $this->addSql('DROP INDEX IDX_E98478FBA0321766 ON ac');
        $this->addSql('DROP INDEX IDX_E98478FB5ED3C7B7 ON ac');
        $this->addSql('ALTER TABLE ac DROP maindoc_id, DROP artisan_id, DROP weight, DROP weight_attach, DROP weight_gold, DROP date');
    }
}
