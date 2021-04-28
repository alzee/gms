<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428022921 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gb ADD addtype_id INT NOT NULL, ADD addreason_id INT NOT NULL, ADD weight_booked DOUBLE PRECISION NOT NULL, ADD weight DOUBLE PRECISION NOT NULL, ADD short DOUBLE PRECISION NOT NULL, ADD note VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE gb ADD CONSTRAINT FK_C8D9EFEBD0A12A3C FOREIGN KEY (addtype_id) REFERENCES addtype (id)');
        $this->addSql('ALTER TABLE gb ADD CONSTRAINT FK_C8D9EFEB4F91A684 FOREIGN KEY (addreason_id) REFERENCES addreason (id)');
        $this->addSql('CREATE INDEX IDX_C8D9EFEBD0A12A3C ON gb (addtype_id)');
        $this->addSql('CREATE INDEX IDX_C8D9EFEB4F91A684 ON gb (addreason_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gb DROP FOREIGN KEY FK_C8D9EFEBD0A12A3C');
        $this->addSql('ALTER TABLE gb DROP FOREIGN KEY FK_C8D9EFEB4F91A684');
        $this->addSql('DROP INDEX IDX_C8D9EFEBD0A12A3C ON gb');
        $this->addSql('DROP INDEX IDX_C8D9EFEB4F91A684 ON gb');
        $this->addSql('ALTER TABLE gb DROP addtype_id, DROP addreason_id, DROP weight_booked, DROP weight, DROP short, DROP note');
    }
}
