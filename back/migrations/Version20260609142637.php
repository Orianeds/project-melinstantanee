<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260609142637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo DROP CONSTRAINT FK_14B784186A498DE6');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784186A498DE6 FOREIGN KEY (shooting_id) REFERENCES shooting (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE photo DROP CONSTRAINT fk_14b784186a498de6');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT fk_14b784186a498de6 FOREIGN KEY (shooting_id) REFERENCES shooting (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
