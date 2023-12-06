package repo

import (
	"gorm.io/driver/postgres"
	"gorm.io/gorm"
)

type Repo struct {
	db *gorm.DB
}

func NewRepo() (*Repo, error) {
	dsn := "host=localhost user=symfony password=ChangeMe dbname=app port=5432 sslmode=disable TimeZone=Europe/Paris"
	d, err := gorm.Open(postgres.Open(dsn), &gorm.Config{})
	if err != nil {
		return nil, err
	}
	repo := Repo{}
	repo.db = d
	return &repo, nil
}

func (rp Repo) GetStations() ([]Station, error) {
	var station []Station
	rp.db.Raw("SELECT * FROM station").Scan(&station)
	return station, nil
}
