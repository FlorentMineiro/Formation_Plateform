<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251130171618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(200) NOT NULL, description VARCHAR(255) NOT NULL, duree_heures DOUBLE PRECISION NOT NULL, niveau_difficulte VARCHAR(20) NOT NULL, prix DOUBLE PRECISION NOT NULL, date_creation DATE NOT NULL, est_publiee TINYINT(1) NOT NULL, capacite_max INT NOT NULL, no VARCHAR(0) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, date_inscription DATETIME NOT NULL, statut VARCHAR(20) NOT NULL, progression_pourcentage INT NOT NULL, date_fin DATE DEFAULT NULL, note NUMERIC(10, 20) DEFAULT NULL, apprenant_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_5E90F6D6C5697D6D (apprenant_id), INDEX IDX_5E90F6D65200282E (formation_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(150) NOT NULL, description LONGTEXT NOT NULL, ordre INT NOT NULL, duree_estimee INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_C2426285200282E (formation_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, nom_affichage VARCHAR(100) NOT NULL, roles JSON NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, date_inscription DATETIME NOT NULL, est_actif TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE inscriptionU ADD CONSTRAINT FK_5E90F6D6C5697D6D FOREIGN KEY (apprenant_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE inscriptionF ADD CONSTRAINT FK_5E90F6D65200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426285200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscriptionU DROP FOREIGN KEY FK_5E90F6D6C5697D6D');
        $this->addSql('ALTER TABLE inscriptionF DROP FOREIGN KEY FK_5E90F6D65200282E');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426285200282E');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
