<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210914001300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE action (id UUID NOT NULL, offers_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_47CC8C925E237E06 ON action (name)');
        $this->addSql('CREATE INDEX IDX_47CC8C92A090B42E ON action (offers_id)');
        $this->addSql('COMMENT ON COLUMN action.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN action.offers_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE category (id UUID NOT NULL, category_name VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, admitad_category_external_id INT DEFAULT NULL, admitad_language VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN category.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE offer (id UUID NOT NULL, last_updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, currency VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, admitad_offer_id INT DEFAULT NULL, admitad_offer_link VARCHAR(255) DEFAULT NULL, admitad_offer_activation_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, admitad_offer_last_modified_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, admitad_offer_rating INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_29D6873EF4842A5E ON offer (admitad_offer_id)');
        $this->addSql('COMMENT ON COLUMN offer.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN offer.last_updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN offer.admitad_offer_activation_time IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN offer.admitad_offer_last_modified_time IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE offers_regions (offer_id UUID NOT NULL, region_id UUID NOT NULL, PRIMARY KEY(offer_id, region_id))');
        $this->addSql('CREATE INDEX IDX_CB97595B53C674EE ON offers_regions (offer_id)');
        $this->addSql('CREATE INDEX IDX_CB97595B98260155 ON offers_regions (region_id)');
        $this->addSql('COMMENT ON COLUMN offers_regions.offer_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN offers_regions.region_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE admitad_category_offers (admitad_category_id UUID NOT NULL, admitad_offer_id UUID NOT NULL, PRIMARY KEY(admitad_category_id, admitad_offer_id))');
        $this->addSql('CREATE INDEX IDX_31D0C2EE6BF23333 ON admitad_category_offers (admitad_category_id)');
        $this->addSql('CREATE INDEX IDX_31D0C2EEF4842A5E ON admitad_category_offers (admitad_offer_id)');
        $this->addSql('COMMENT ON COLUMN admitad_category_offers.admitad_category_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN admitad_category_offers.admitad_offer_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE offer_action (id UUID NOT NULL, offer_id UUID DEFAULT NULL, action_id UUID DEFAULT NULL, action_type VARCHAR(255) NOT NULL, payment_amount INT NOT NULL, external_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9E99FB3353C674EE ON offer_action (offer_id)');
        $this->addSql('CREATE INDEX IDX_9E99FB339D32F035 ON offer_action (action_id)');
        $this->addSql('COMMENT ON COLUMN offer_action.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN offer_action.offer_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN offer_action.action_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE region (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F62F1765E237E06 ON region (name)');
        $this->addSql('COMMENT ON COLUMN region.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C92A090B42E FOREIGN KEY (offers_id) REFERENCES offer_action (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offers_regions ADD CONSTRAINT FK_CB97595B53C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offers_regions ADD CONSTRAINT FK_CB97595B98260155 FOREIGN KEY (region_id) REFERENCES region (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE admitad_category_offers ADD CONSTRAINT FK_31D0C2EE6BF23333 FOREIGN KEY (admitad_category_id) REFERENCES offer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE admitad_category_offers ADD CONSTRAINT FK_31D0C2EEF4842A5E FOREIGN KEY (admitad_offer_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offer_action ADD CONSTRAINT FK_9E99FB3353C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offer_action ADD CONSTRAINT FK_9E99FB339D32F035 FOREIGN KEY (action_id) REFERENCES action (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE offer_action DROP CONSTRAINT FK_9E99FB339D32F035');
        $this->addSql('ALTER TABLE admitad_category_offers DROP CONSTRAINT FK_31D0C2EEF4842A5E');
        $this->addSql('ALTER TABLE offers_regions DROP CONSTRAINT FK_CB97595B53C674EE');
        $this->addSql('ALTER TABLE admitad_category_offers DROP CONSTRAINT FK_31D0C2EE6BF23333');
        $this->addSql('ALTER TABLE offer_action DROP CONSTRAINT FK_9E99FB3353C674EE');
        $this->addSql('ALTER TABLE action DROP CONSTRAINT FK_47CC8C92A090B42E');
        $this->addSql('ALTER TABLE offers_regions DROP CONSTRAINT FK_CB97595B98260155');
        $this->addSql('DROP TABLE action');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE offers_regions');
        $this->addSql('DROP TABLE admitad_category_offers');
        $this->addSql('DROP TABLE offer_action');
        $this->addSql('DROP TABLE region');
    }
}
