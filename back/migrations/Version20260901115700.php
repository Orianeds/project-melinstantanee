<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260901115700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo ADD drive_file_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE photo ADD drive_file_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE photo ADD thumbnail_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE photo ADD mime_type VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE photo ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE photo ALTER photo_url DROP NOT NULL');
        $this->addSql('COMMENT ON COLUMN photo.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_14B784184DD437D0 ON photo (drive_file_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_14B784184DD437D0');
        $this->addSql('ALTER TABLE photo DROP drive_file_id');
        $this->addSql('ALTER TABLE photo DROP drive_file_name');
        $this->addSql('ALTER TABLE photo DROP thumbnail_url');
        $this->addSql('ALTER TABLE photo DROP mime_type');
        $this->addSql('ALTER TABLE photo DROP updated_at');
        $this->addSql('ALTER TABLE photo ALTER photo_url SET NOT NULL');
    }
}
