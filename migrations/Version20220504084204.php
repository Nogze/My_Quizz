<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504084204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizz_results DROP FOREIGN KEY FK_F5493BC085BD94A9');
        $this->addSql('ALTER TABLE quizz_results DROP FOREIGN KEY FK_F5493BC09D86650F');
        $this->addSql('DROP INDEX IDX_F5493BC085BD94A9 ON quizz_results');
        $this->addSql('DROP INDEX IDX_F5493BC09D86650F ON quizz_results');
        $this->addSql('ALTER TABLE quizz_results CHANGE user_id_id user_id INT NOT NULL, CHANGE quizz_id_id quizz_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quizz_results ADD CONSTRAINT FK_F5493BC0A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE quizz_results ADD CONSTRAINT FK_F5493BC0BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id)');
        $this->addSql('CREATE INDEX IDX_F5493BC0A76ED395 ON quizz_results (user_id)');
        $this->addSql('CREATE INDEX IDX_F5493BC0BA934BCD ON quizz_results (quizz_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizz_results DROP FOREIGN KEY FK_F5493BC0A76ED395');
        $this->addSql('ALTER TABLE quizz_results DROP FOREIGN KEY FK_F5493BC0BA934BCD');
        $this->addSql('DROP INDEX IDX_F5493BC0A76ED395 ON quizz_results');
        $this->addSql('DROP INDEX IDX_F5493BC0BA934BCD ON quizz_results');
        $this->addSql('ALTER TABLE quizz_results CHANGE user_id user_id_id INT NOT NULL, CHANGE quizz_id quizz_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quizz_results ADD CONSTRAINT FK_F5493BC085BD94A9 FOREIGN KEY (quizz_id_id) REFERENCES quizz (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE quizz_results ADD CONSTRAINT FK_F5493BC09D86650F FOREIGN KEY (user_id_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F5493BC085BD94A9 ON quizz_results (quizz_id_id)');
        $this->addSql('CREATE INDEX IDX_F5493BC09D86650F ON quizz_results (user_id_id)');
    }
}
