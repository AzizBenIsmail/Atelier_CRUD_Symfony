<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211026220844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E36278D5A8');
        $this->addSql('DROP INDEX IDX_717E22E36278D5A8 ON etudiant');
        $this->addSql('ALTER TABLE etudiant ADD classroom INT NOT NULL, DROP classroom_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant ADD classroom_id INT DEFAULT NULL, DROP classroom');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E36278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
        $this->addSql('CREATE INDEX IDX_717E22E36278D5A8 ON etudiant (classroom_id)');
    }
}
