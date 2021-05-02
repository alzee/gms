<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210502101033 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cgd DROP FOREIGN KEY FK_D5B3F44AA0321766');
        $this->addSql('DROP INDEX IDX_D5B3F44AA0321766 ON cgd');
        $this->addSql('ALTER TABLE cgd CHANGE maindoc_id main_id INT NOT NULL');
        $this->addSql('ALTER TABLE cgd ADD CONSTRAINT FK_D5B3F44A627EA78A FOREIGN KEY (main_id) REFERENCES main (id)');
        $this->addSql('CREATE INDEX IDX_D5B3F44A627EA78A ON cgd (main_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cgd DROP FOREIGN KEY FK_D5B3F44A627EA78A');
        $this->addSql('DROP INDEX IDX_D5B3F44A627EA78A ON cgd');
        $this->addSql('ALTER TABLE cgd CHANGE main_id maindoc_id INT NOT NULL');
        $this->addSql('ALTER TABLE cgd ADD CONSTRAINT FK_D5B3F44AA0321766 FOREIGN KEY (maindoc_id) REFERENCES center (id)');
        $this->addSql('CREATE INDEX IDX_D5B3F44AA0321766 ON cgd (maindoc_id)');
    }
}
