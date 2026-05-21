<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260518142215 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE shooting ADD drive_folder_id VARCHAR(255) DEFAULT NULL
        SQL);

        $this->addSql(<<<'SQL'
            ALTER TABLE shooting ADD drive_folder_name VARCHAR(255) DEFAULT NULL
        SQL);

        $this->addSql(<<<'SQL'
            ALTER TABLE shooting ADD cover_photo_url VARCHAR(255) DEFAULT NULL
        SQL);

        $this->addSql(<<<'SQL'
            ALTER TABLE shooting ADD is_published BOOLEAN DEFAULT FALSE NOT NULL
        SQL);

        $this->addSql(<<<'SQL'
            ALTER TABLE shooting DROP drive_link
        SQL);

        $this->addSql(<<<'SQL'
            UPDATE shooting SET updated_at = NOW() WHERE updated_at IS NULL
        SQL);

        $this->addSql(<<<'SQL'
            ALTER TABLE shooting ALTER updated_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE
        SQL);

        $this->addSql(<<<'SQL'
            ALTER TABLE shooting ALTER updated_at SET NOT NULL
        SQL);

        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN shooting.updated_at IS '(DC2Type:datetime_immutable)'
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shooting ADD drive_link VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shooting DROP drive_folder_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shooting DROP drive_folder_name
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shooting DROP cover_photo_url
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shooting DROP is_published
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shooting ALTER updated_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shooting ALTER updated_at DROP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN shooting.updated_at IS NULL
        SQL);
    }
}
