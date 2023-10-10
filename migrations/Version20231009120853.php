<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231009120853 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat ADD passport_id INT DEFAULT NULL, ADD cv_id INT DEFAULT NULL, ADD avatar_id INT DEFAULT NULL, DROP passport, DROP cv, DROP avatar');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471ABF410D0 FOREIGN KEY (passport_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471CFE419E2 FOREIGN KEY (cv_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B47186383B10 FOREIGN KEY (avatar_id) REFERENCES media (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6AB5B471ABF410D0 ON candidat (passport_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6AB5B471CFE419E2 ON candidat (cv_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6AB5B47186383B10 ON candidat (avatar_id)');
        $this->addSql('ALTER TABLE media ADD original_name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471ABF410D0');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471CFE419E2');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B47186383B10');
        $this->addSql('DROP INDEX UNIQ_6AB5B471ABF410D0 ON candidat');
        $this->addSql('DROP INDEX UNIQ_6AB5B471CFE419E2 ON candidat');
        $this->addSql('DROP INDEX UNIQ_6AB5B47186383B10 ON candidat');
        $this->addSql('ALTER TABLE candidat ADD passport INT DEFAULT NULL, ADD cv INT DEFAULT NULL, ADD avatar INT DEFAULT NULL, DROP passport_id, DROP cv_id, DROP avatar_id');
        $this->addSql('ALTER TABLE media DROP original_name');
    }
}
