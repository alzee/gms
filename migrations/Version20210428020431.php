<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428020431 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gca ADD team_id INT NOT NULL, ADD artisan_id INT NOT NULL, ADD goldclass_id INT NOT NULL, ADD position_id INT NOT NULL, ADD note VARCHAR(255) DEFAULT NULL, ADD weight DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE gca ADD CONSTRAINT FK_C6BC6D1D296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE gca ADD CONSTRAINT FK_C6BC6D1D5ED3C7B7 FOREIGN KEY (artisan_id) REFERENCES artisan (id)');
        $this->addSql('ALTER TABLE gca ADD CONSTRAINT FK_C6BC6D1DA145C139 FOREIGN KEY (goldclass_id) REFERENCES goldclass (id)');
        $this->addSql('ALTER TABLE gca ADD CONSTRAINT FK_C6BC6D1DDD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('CREATE INDEX IDX_C6BC6D1D296CD8AE ON gca (team_id)');
        $this->addSql('CREATE INDEX IDX_C6BC6D1D5ED3C7B7 ON gca (artisan_id)');
        $this->addSql('CREATE INDEX IDX_C6BC6D1DA145C139 ON gca (goldclass_id)');
        $this->addSql('CREATE INDEX IDX_C6BC6D1DDD842E46 ON gca (position_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gca DROP FOREIGN KEY FK_C6BC6D1D296CD8AE');
        $this->addSql('ALTER TABLE gca DROP FOREIGN KEY FK_C6BC6D1D5ED3C7B7');
        $this->addSql('ALTER TABLE gca DROP FOREIGN KEY FK_C6BC6D1DA145C139');
        $this->addSql('ALTER TABLE gca DROP FOREIGN KEY FK_C6BC6D1DDD842E46');
        $this->addSql('DROP INDEX IDX_C6BC6D1D296CD8AE ON gca');
        $this->addSql('DROP INDEX IDX_C6BC6D1D5ED3C7B7 ON gca');
        $this->addSql('DROP INDEX IDX_C6BC6D1DA145C139 ON gca');
        $this->addSql('DROP INDEX IDX_C6BC6D1DDD842E46 ON gca');
        $this->addSql('ALTER TABLE gca DROP team_id, DROP artisan_id, DROP goldclass_id, DROP position_id, DROP note, DROP weight');
    }
}
