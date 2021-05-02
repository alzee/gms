<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210502025642 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE main ADD prodtype_id INT NOT NULL, ADD goldclass_id INT NOT NULL, ADD cotype_id INT NOT NULL, ADD model_id INT NOT NULL, ADD loss_rate_id INT NOT NULL, ADD factory_id INT NOT NULL, ADD per_weight DOUBLE PRECISION NOT NULL, ADD total_weight DOUBLE PRECISION NOT NULL, ADD upstream_doc VARCHAR(20) NOT NULL, ADD length DOUBLE PRECISION DEFAULT NULL, ADD width DOUBLE PRECISION DEFAULT NULL, ADD height DOUBLE PRECISION DEFAULT NULL, ADD note VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE main ADD CONSTRAINT FK_BF28CD64E8420563 FOREIGN KEY (prodtype_id) REFERENCES prodtype (id)');
        $this->addSql('ALTER TABLE main ADD CONSTRAINT FK_BF28CD64A145C139 FOREIGN KEY (goldclass_id) REFERENCES goldclass (id)');
        $this->addSql('ALTER TABLE main ADD CONSTRAINT FK_BF28CD64D20C4835 FOREIGN KEY (cotype_id) REFERENCES cotype (id)');
        $this->addSql('ALTER TABLE main ADD CONSTRAINT FK_BF28CD647975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE main ADD CONSTRAINT FK_BF28CD64EC02E518 FOREIGN KEY (loss_rate_id) REFERENCES lossrate (id)');
        $this->addSql('ALTER TABLE main ADD CONSTRAINT FK_BF28CD64C7AF27D2 FOREIGN KEY (factory_id) REFERENCES factory (id)');
        $this->addSql('CREATE INDEX IDX_BF28CD64E8420563 ON main (prodtype_id)');
        $this->addSql('CREATE INDEX IDX_BF28CD64A145C139 ON main (goldclass_id)');
        $this->addSql('CREATE INDEX IDX_BF28CD64D20C4835 ON main (cotype_id)');
        $this->addSql('CREATE INDEX IDX_BF28CD647975B7E7 ON main (model_id)');
        $this->addSql('CREATE INDEX IDX_BF28CD64EC02E518 ON main (loss_rate_id)');
        $this->addSql('CREATE INDEX IDX_BF28CD64C7AF27D2 ON main (factory_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE main DROP FOREIGN KEY FK_BF28CD64E8420563');
        $this->addSql('ALTER TABLE main DROP FOREIGN KEY FK_BF28CD64A145C139');
        $this->addSql('ALTER TABLE main DROP FOREIGN KEY FK_BF28CD64D20C4835');
        $this->addSql('ALTER TABLE main DROP FOREIGN KEY FK_BF28CD647975B7E7');
        $this->addSql('ALTER TABLE main DROP FOREIGN KEY FK_BF28CD64EC02E518');
        $this->addSql('ALTER TABLE main DROP FOREIGN KEY FK_BF28CD64C7AF27D2');
        $this->addSql('DROP INDEX IDX_BF28CD64E8420563 ON main');
        $this->addSql('DROP INDEX IDX_BF28CD64A145C139 ON main');
        $this->addSql('DROP INDEX IDX_BF28CD64D20C4835 ON main');
        $this->addSql('DROP INDEX IDX_BF28CD647975B7E7 ON main');
        $this->addSql('DROP INDEX IDX_BF28CD64EC02E518 ON main');
        $this->addSql('DROP INDEX IDX_BF28CD64C7AF27D2 ON main');
        $this->addSql('ALTER TABLE main DROP prodtype_id, DROP goldclass_id, DROP cotype_id, DROP model_id, DROP loss_rate_id, DROP factory_id, DROP per_weight, DROP total_weight, DROP upstream_doc, DROP length, DROP width, DROP height, DROP note');
    }
}
