<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428014204 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cgd ADD maindoc_id INT NOT NULL, ADD goldclass_id INT NOT NULL, ADD position_id INT NOT NULL, ADD weight DOUBLE PRECISION NOT NULL, ADD note VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE cgd ADD CONSTRAINT FK_D5B3F44AA0321766 FOREIGN KEY (maindoc_id) REFERENCES center (id)');
        $this->addSql('ALTER TABLE cgd ADD CONSTRAINT FK_D5B3F44AA145C139 FOREIGN KEY (goldclass_id) REFERENCES goldclass (id)');
        $this->addSql('ALTER TABLE cgd ADD CONSTRAINT FK_D5B3F44ADD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('CREATE INDEX IDX_D5B3F44AA0321766 ON cgd (maindoc_id)');
        $this->addSql('CREATE INDEX IDX_D5B3F44AA145C139 ON cgd (goldclass_id)');
        $this->addSql('CREATE INDEX IDX_D5B3F44ADD842E46 ON cgd (position_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cgd DROP FOREIGN KEY FK_D5B3F44AA0321766');
        $this->addSql('ALTER TABLE cgd DROP FOREIGN KEY FK_D5B3F44AA145C139');
        $this->addSql('ALTER TABLE cgd DROP FOREIGN KEY FK_D5B3F44ADD842E46');
        $this->addSql('DROP INDEX IDX_D5B3F44AA0321766 ON cgd');
        $this->addSql('DROP INDEX IDX_D5B3F44AA145C139 ON cgd');
        $this->addSql('DROP INDEX IDX_D5B3F44ADD842E46 ON cgd');
        $this->addSql('ALTER TABLE cgd DROP maindoc_id, DROP goldclass_id, DROP position_id, DROP weight, DROP note');
    }
}
