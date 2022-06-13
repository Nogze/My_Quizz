<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504084046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE quizz_results_quizz');
        $this->addSql('ALTER TABLE quizz_results ADD quizz_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quizz_results ADD CONSTRAINT FK_F5493BC085BD94A9 FOREIGN KEY (quizz_id_id) REFERENCES quizz (id)');
        $this->addSql('CREATE INDEX IDX_F5493BC085BD94A9 ON quizz_results (quizz_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quizz_results_quizz (quizz_results_id INT NOT NULL, quizz_id INT NOT NULL, INDEX IDX_64454A0EBA934BCD (quizz_id), INDEX IDX_64454A0EC45C4589 (quizz_results_id), PRIMARY KEY(quizz_results_id, quizz_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE quizz_results_quizz ADD CONSTRAINT FK_64454A0EBA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quizz_results_quizz ADD CONSTRAINT FK_64454A0EC45C4589 FOREIGN KEY (quizz_results_id) REFERENCES quizz_results (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quizz_results DROP FOREIGN KEY FK_F5493BC085BD94A9');
        $this->addSql('DROP INDEX IDX_F5493BC085BD94A9 ON quizz_results');
        $this->addSql('ALTER TABLE quizz_results DROP quizz_id_id');
    }
}
