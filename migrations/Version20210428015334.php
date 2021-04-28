<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428015334 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cc ADD team_id INT NOT NULL, ADD recipient_id INT NOT NULL, ADD goldclass_id INT NOT NULL, ADD position_id INT NOT NULL, ADD weight DOUBLE PRECISION NOT NULL, ADD status SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE cc ADD CONSTRAINT FK_DBB21A79296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE cc ADD CONSTRAINT FK_DBB21A79E92F8F78 FOREIGN KEY (recipient_id) REFERENCES clerk (id)');
        $this->addSql('ALTER TABLE cc ADD CONSTRAINT FK_DBB21A79A145C139 FOREIGN KEY (goldclass_id) REFERENCES goldclass (id)');
        $this->addSql('ALTER TABLE cc ADD CONSTRAINT FK_DBB21A79DD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('CREATE INDEX IDX_DBB21A79296CD8AE ON cc (team_id)');
        $this->addSql('CREATE INDEX IDX_DBB21A79E92F8F78 ON cc (recipient_id)');
        $this->addSql('CREATE INDEX IDX_DBB21A79A145C139 ON cc (goldclass_id)');
        $this->addSql('CREATE INDEX IDX_DBB21A79DD842E46 ON cc (position_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cc DROP FOREIGN KEY FK_DBB21A79296CD8AE');
        $this->addSql('ALTER TABLE cc DROP FOREIGN KEY FK_DBB21A79E92F8F78');
        $this->addSql('ALTER TABLE cc DROP FOREIGN KEY FK_DBB21A79A145C139');
        $this->addSql('ALTER TABLE cc DROP FOREIGN KEY FK_DBB21A79DD842E46');
        $this->addSql('DROP INDEX IDX_DBB21A79296CD8AE ON cc');
        $this->addSql('DROP INDEX IDX_DBB21A79E92F8F78 ON cc');
        $this->addSql('DROP INDEX IDX_DBB21A79A145C139 ON cc');
        $this->addSql('DROP INDEX IDX_DBB21A79DD842E46 ON cc');
        $this->addSql('ALTER TABLE cc DROP team_id, DROP recipient_id, DROP goldclass_id, DROP position_id, DROP weight, DROP status');
    }
}
