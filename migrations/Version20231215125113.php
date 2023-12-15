<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215125113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserve ADD created_by_id INT NOT NULL');
        $this->addSql('ALTER TABLE reserve ADD CONSTRAINT FK_1FE0EA22B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1FE0EA22B03A8386 ON reserve (created_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserve DROP FOREIGN KEY FK_1FE0EA22B03A8386');
        $this->addSql('DROP INDEX IDX_1FE0EA22B03A8386 ON reserve');
        $this->addSql('ALTER TABLE reserve DROP created_by_id');
    }
}
