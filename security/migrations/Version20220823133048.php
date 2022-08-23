<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220823133048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, account_holder_id INT NOT NULL, account_manager_id INT NOT NULL, balance DOUBLE PRECISION NOT NULL, INDEX IDX_7D3656A4FC94BA8B (account_holder_id), UNIQUE INDEX UNIQ_7D3656A484A5C6C7 (account_manager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A4FC94BA8B FOREIGN KEY (account_holder_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A484A5C6C7 FOREIGN KEY (account_manager_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A4FC94BA8B');
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A484A5C6C7');
        $this->addSql('DROP TABLE account');
    }
}
