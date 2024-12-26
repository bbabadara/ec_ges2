<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241224184309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cours_semestre (cours_id INT NOT NULL, semestre_id INT NOT NULL, INDEX IDX_B6FC21617ECF78B0 (cours_id), INDEX IDX_B6FC21615577AFDB (semestre_id), PRIMARY KEY(cours_id, semestre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours_semestre ADD CONSTRAINT FK_B6FC21617ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours_semestre ADD CONSTRAINT FK_B6FC21615577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE absence ADD etudiant_id INT NOT NULL, ADD seance_id INT NOT NULL, ADD date_absence DATETIME NOT NULL');
        $this->addSql('ALTER TABLE absence ADD CONSTRAINT FK_765AE0C9DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE absence ADD CONSTRAINT FK_765AE0C9E3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id)');
        $this->addSql('CREATE INDEX IDX_765AE0C9DDEAB1A3 ON absence (etudiant_id)');
        $this->addSql('CREATE INDEX IDX_765AE0C9E3797A94 ON absence (seance_id)');
        $this->addSql('ALTER TABLE cours ADD classe_id INT DEFAULT NULL, ADD professeur_id INT DEFAULT NULL, ADD date_cours DATETIME NOT NULL, ADD nombre_heure INT NOT NULL, ADD create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD update_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9C8F5EA509 ON cours (classe_id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9CBAB22EE9 ON cours (professeur_id)');
        $this->addSql('ALTER TABLE niveau ADD semestre_id INT DEFAULT NULL, ADD create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD update_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE niveau ADD CONSTRAINT FK_4BDFF36B5577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4BDFF36B5577AFDB ON niveau (semestre_id)');
        $this->addSql('ALTER TABLE professeur ADD nom VARCHAR(50) NOT NULL, ADD prenom VARCHAR(50) NOT NULL, ADD grade VARCHAR(50) DEFAULT NULL, ADD specialite VARCHAR(50) DEFAULT NULL, ADD create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD update_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE seance ADD cours_id INT NOT NULL, ADD date_seance DATETIME NOT NULL, ADD heure_debut TIME DEFAULT NULL, ADD heure_fin TIME DEFAULT NULL, ADD create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD update_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0E7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_DF7DFD0E7ECF78B0 ON seance (cours_id)');
        $this->addSql('ALTER TABLE semestre ADD nom VARCHAR(25) NOT NULL, ADD etat TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours_semestre DROP FOREIGN KEY FK_B6FC21617ECF78B0');
        $this->addSql('ALTER TABLE cours_semestre DROP FOREIGN KEY FK_B6FC21615577AFDB');
        $this->addSql('DROP TABLE cours_semestre');
        $this->addSql('ALTER TABLE absence DROP FOREIGN KEY FK_765AE0C9DDEAB1A3');
        $this->addSql('ALTER TABLE absence DROP FOREIGN KEY FK_765AE0C9E3797A94');
        $this->addSql('DROP INDEX IDX_765AE0C9DDEAB1A3 ON absence');
        $this->addSql('DROP INDEX IDX_765AE0C9E3797A94 ON absence');
        $this->addSql('ALTER TABLE absence DROP etudiant_id, DROP seance_id, DROP date_absence');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C8F5EA509');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CBAB22EE9');
        $this->addSql('DROP INDEX IDX_FDCA8C9C8F5EA509 ON cours');
        $this->addSql('DROP INDEX IDX_FDCA8C9CBAB22EE9 ON cours');
        $this->addSql('ALTER TABLE cours DROP classe_id, DROP professeur_id, DROP date_cours, DROP nombre_heure, DROP create_at, DROP update_at');
        $this->addSql('ALTER TABLE niveau DROP FOREIGN KEY FK_4BDFF36B5577AFDB');
        $this->addSql('DROP INDEX UNIQ_4BDFF36B5577AFDB ON niveau');
        $this->addSql('ALTER TABLE niveau DROP semestre_id, DROP create_at, DROP update_at');
        $this->addSql('ALTER TABLE professeur DROP nom, DROP prenom, DROP grade, DROP specialite, DROP create_at, DROP update_at');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0E7ECF78B0');
        $this->addSql('DROP INDEX IDX_DF7DFD0E7ECF78B0 ON seance');
        $this->addSql('ALTER TABLE seance DROP cours_id, DROP date_seance, DROP heure_debut, DROP heure_fin, DROP create_at, DROP update_at');
        $this->addSql('ALTER TABLE semestre DROP nom, DROP etat');
    }
}
