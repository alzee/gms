<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428011835 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ca ADD maindoc_id INT NOT NULL, ADD artisan_id INT NOT NULL, ADD craft_id INT NOT NULL, ADD weight DOUBLE PRECISION NOT NULL, ADD weight_attach DOUBLE PRECISION NOT NULL, ADD weight_gold DOUBLE PRECISION NOT NULL, ADD date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE ca ADD CONSTRAINT FK_35BC7B55A0321766 FOREIGN KEY (maindoc_id) REFERENCES center (id)');
        $this->addSql('ALTER TABLE ca ADD CONSTRAINT FK_35BC7B555ED3C7B7 FOREIGN KEY (artisan_id) REFERENCES artisan (id)');
        $this->addSql('ALTER TABLE ca ADD CONSTRAINT FK_35BC7B55E836CCC8 FOREIGN KEY (craft_id) REFERENCES craft (id)');
        $this->addSql('CREATE INDEX IDX_35BC7B55A0321766 ON ca (maindoc_id)');
        $this->addSql('CREATE INDEX IDX_35BC7B555ED3C7B7 ON ca (artisan_id)');
        $this->addSql('CREATE INDEX IDX_35BC7B55E836CCC8 ON ca (craft_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ca DROP FOREIGN KEY FK_35BC7B55A0321766');
        $this->addSql('ALTER TABLE ca DROP FOREIGN KEY FK_35BC7B555ED3C7B7');
        $this->addSql('ALTER TABLE ca DROP FOREIGN KEY FK_35BC7B55E836CCC8');
        $this->addSql('DROP INDEX IDX_35BC7B55A0321766 ON ca');
        $this->addSql('DROP INDEX IDX_35BC7B555ED3C7B7 ON ca');
        $this->addSql('DROP INDEX IDX_35BC7B55E836CCC8 ON ca');
        $this->addSql('ALTER TABLE ca DROP maindoc_id, DROP artisan_id, DROP craft_id, DROP weight, DROP weight_attach, DROP weight_gold, DROP date');
    }
}
