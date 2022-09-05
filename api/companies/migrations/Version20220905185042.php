<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220905185042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create "event_log" table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE event_log (id VARCHAR(255) NOT NULL, event VARCHAR(255) NOT NULL, data JSON NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))'
        );
        $this->addSql('COMMENT ON COLUMN event_log.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE event_log');
    }
}
