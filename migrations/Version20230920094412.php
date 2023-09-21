<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230920094412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471B6121583');
        $this->addSql('DROP INDEX IDX_6AB5B471B6121583 ON candidat');
        $this->addSql('ALTER TABLE candidat DROP candidature_id');
        $this->addSql('ALTER TABLE candidature ADD candidat_id INT NOT NULL, ADD job_id INT NOT NULL');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B88D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('CREATE INDEX IDX_E33BD3B88D0EB82 ON candidature (candidat_id)');
        $this->addSql('CREATE INDEX IDX_E33BD3B8BE04EA9 ON candidature (job_id)');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8B6121583');
        $this->addSql('DROP INDEX IDX_FBD8E0F8B6121583 ON job');
        $this->addSql('ALTER TABLE job DROP candidature_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat ADD candidature_id INT NOT NULL');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471B6121583 FOREIGN KEY (candidature_id) REFERENCES candidature (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6AB5B471B6121583 ON candidat (candidature_id)');
        $this->addSql('ALTER TABLE job ADD candidature_id INT NOT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8B6121583 FOREIGN KEY (candidature_id) REFERENCES candidature (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8B6121583 ON job (candidature_id)');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B88D0EB82');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8BE04EA9');
        $this->addSql('DROP INDEX IDX_E33BD3B88D0EB82 ON candidature');
        $this->addSql('DROP INDEX IDX_E33BD3B8BE04EA9 ON candidature');
        $this->addSql('ALTER TABLE candidature DROP candidat_id, DROP job_id');
    }
}
