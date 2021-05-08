<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210508104854 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child ADD holder_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE child ADD CONSTRAINT FK_22B35429DEEE62D0 FOREIGN KEY (holder_id) REFERENCES artisan (id)');
        $this->addSql('CREATE INDEX IDX_22B35429DEEE62D0 ON child (holder_id)');
        $this->addSql('ALTER TABLE main ADD holder_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE main ADD CONSTRAINT FK_BF28CD64DEEE62D0 FOREIGN KEY (holder_id) REFERENCES artisan (id)');
        $this->addSql('CREATE INDEX IDX_BF28CD64DEEE62D0 ON main (holder_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child DROP FOREIGN KEY FK_22B35429DEEE62D0');
        $this->addSql('DROP INDEX IDX_22B35429DEEE62D0 ON child');
        $this->addSql('ALTER TABLE child DROP holder_id');
        $this->addSql('ALTER TABLE main DROP FOREIGN KEY FK_BF28CD64DEEE62D0');
        $this->addSql('DROP INDEX IDX_BF28CD64DEEE62D0 ON main');
        $this->addSql('ALTER TABLE main DROP holder_id');
    }
}
