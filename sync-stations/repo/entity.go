package repo

import (
	"gorm.io/gorm"
)

type Station struct {
	gorm.Model
	Amenageur                       string
	SirenAmenageur                  string
	ContactAmenageur                string
	Operateur                       string
	ContactOperateur                string
	TelephoneOperateur              string
	Enseigne                        string
	IdStationItenerance             string
	IdStationLocal                  string
	NomStation                      string
	ImplantationStation             string
	AddressStation                  string
	CodeInsee                       string
	Coordonnees                     string
	NbrPDC                          string
	IdPDC                           string
	IdPDClocal                      string
	PuissNominale                   string
	PriseTypeEF                     bool
	PriseType2                      bool
	PriseTypeComboCcs               bool
	PriseTypeChademo                bool
	PriseTypeAutre                  bool
	Gratuit                         bool
	PaimentActe                     bool
	PaimentCB                       bool
	PaimentAautre                   bool
	Tarification                    bool
	ConditionAccees                 string
	Reservation                     bool
	Horaire                         string
	AccessibilitePMR                string
	RestrictionGabarit              string
	Station2Roue                    bool
	Raccordement                    string
	NumPDI                          string
	DateMiseEnService               string
	Observations                    string
	DateMAJ                         string
	CableT2Attach                   string
	LastModified                    string
	DatagouvDatasetID               string
	DataResourceID                  string
	DatagouvOrganizationOrOwner     string
	ConsolidatedLongitude           string
	ConsolidatedLatitude            string
	ConsolidatedCodePostale         string
	ConsolidatedCodeCommune         string
	ConsolidatedIsLonLatCorrect     bool
	ConsolidatedIsCodeInseeVerified bool
	Coordo                          []float64
}
