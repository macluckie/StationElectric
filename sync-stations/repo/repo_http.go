package repo

import (
	"bytes"
	"encoding/json"
	"fmt"
	"net/http"
	"os"
	"strconv"
	"strings"
)

type RepoHttp struct {
}

func NewRepoHttp() *RepoHttp {
	rHttp := RepoHttp{}
	return &rHttp
}

func (repo *RepoHttp) CreateCollectionStations() (*http.Response, error) {
	requestBody := []byte(`{"name": "stations", "fields": [
	{"name": "ID", "type": "auto"},
    {"name": "CreatedAt", "type": "auto"},
    {"name": "UpdatedAt", "type": "auto"},
    {"name": "DeletedAt", "type": "auto"},
    {"name": "Amenageur", "type": "auto"},
    {"name": "SirenAmenageur", "type": "auto"},
    {"name": "ContactAmenageur", "type": "auto"},
    {"name": "Operateur", "type": "auto"},
    {"name": "ContactOperateur", "type": "auto"},
    {"name": "TelephoneOperateur", "type": "auto"},
    {"name": "Enseigne", "type": "auto"},
    {"name": "IdStationItenerance", "type": "auto"},
    {"name": "IdStationLocal", "type": "auto"},
    {"name": "NomStation", "type": "auto"},
    {"name": "ImplantationStation", "type": "auto"},
    {"name": "AddressStation", "type": "auto"},
    {"name": "CodeInsee", "type": "auto"},
    {"name": "Coordonnees", "type": "auto"},
    {"name": "NbrPDC", "type": "auto"},
    {"name": "IdPDC", "type": "auto"},
    {"name": "IdPDClocal", "type": "auto"},
    {"name": "PuissNominale", "type": "auto"},
    {"name": "PriseTypeEF", "type": "auto"},
    {"name": "PriseType2", "type": "auto"},
    {"name": "PriseTypeComboCcs", "type": "auto"},
    {"name": "PriseTypeChademo", "type": "auto"},
    {"name": "PriseTypeAutre", "type": "auto"},
    {"name": "Gratuit", "type": "auto"},
    {"name": "PaimentActe", "type": "auto"},
    {"name": "PaimentCB", "type": "auto"},
    {"name": "PaimentAautre", "type": "auto"},
    {"name": "Tarification", "type": "auto"},
    {"name": "ConditionAccees", "type": "auto"},
    {"name": "Reservation", "type": "auto"},
    {"name": "Horaire", "type": "auto"},
    {"name": "AccessibilitePMR", "type": "auto"},
    {"name": "RestrictionGabarit", "type": "auto"},
    {"name": "Station2Roue", "type": "auto"},
    {"name": "Raccordement", "type": "auto"},
    {"name": "NumPDI", "type": "auto"},
    {"name": "DateMiseEnService", "type": "auto"},
	{"name": "Observations", "type": "auto"},
	{"name": "DateMAJ", "type": "auto"},
	{"name": "cableT2Attach", "type": "auto"},
	{"name": "LastModified", "type": "auto"},
	{"name": "DatagouvDatasetID", "type": "auto"},
	{"name": "DataResourceID", "type": "auto"},
	{"name": "DatagouvOrganizationOrOwner", "type": "auto"},
	{"name": "ConsolidatedLongitude", "type": "float"},
	{"name": "ConsolidatedLatitude", "type": "float"},
	{"name": "ConsolidatedCodePostale", "type": "auto"},
	{"name": "ConsolidatedCodeCommune", "type": "auto"},
	{"name": "ConsolidatedIsLonLatCorrect", "type": "auto"},
	{"name": "ConsolidatedIsCodeInseeVerified", "type": "auto"},
	{"name": "Coordo", "type": "geopoint"}		
		]
				}`)
	url := "http://localhost:8108/collections"
	client := &http.Client{}
	req, er := http.NewRequest("POST", url, bytes.NewBuffer(requestBody))
	if er != nil {
		return nil, er
	}
	req.Header.Set("x-typesense-api-key", "a00c45f7-808e-4e66-8e1f-cf73a334c452")
	req.Header.Set("Content-type", "application/json")
	res, _ := client.Do(req)
	return res, nil

}

func (repo *RepoHttp) IsCollectionExist(collectionName string) (*bool, error) {
	exist := false
	url := "http://localhost:8108/collections/" + collectionName
	client := &http.Client{}
	req, er := http.NewRequest("GET", url, nil)
	if er != nil {
		return nil, er
	}
	req.Header.Set("x-typesense-api-key", "a00c45f7-808e-4e66-8e1f-cf73a334c452")
	res, _ := client.Do(req)
	if res.StatusCode == http.StatusNotFound {
		return &exist, nil
	} else {
		exist = true
		return &exist, nil
	}

}

func (repo *RepoHttp) PostCollectionDocuments(data []Station) (*http.Response, error) {
	er := convertMapStringToJson(data)
	if er != nil {
		return nil, er
	}
	file, erOpenFile := os.Open("stations.jsonl")
	if erOpenFile != nil {
		return nil, erOpenFile
	}

	url := "http://localhost:8108/collections/stations/documents/import?action=create"
	client := &http.Client{}
	req, er := http.NewRequest("POST", url, file)
	if er != nil {
		return nil, er
	}
	req.Header.Set("x-typesense-api-key", "a00c45f7-808e-4e66-8e1f-cf73a334c452")
	req.Header.Set("Content-Type", "application/json; charset=UTF-8")
	res, er := client.Do(req)
	if er != nil {
		return nil, er
	}
	fmt.Println("COUCOUCOUlskdlksdklkslklskd")
	fmt.Println(res.Status)
	defer res.Body.Close()
	return res, nil
}

func convertMapStringToJson(data []Station) error {
	file, er := createJSONFile()
	if er != nil {
		return er
	}

	e := writeInJSONFile(file, data)
	if e != nil {
		return e
	}
	file.Close()
	return nil
}

func createJSONFile() (*os.File, error) {
	if _, err := os.Stat("stations.jsonl"); os.IsNotExist(err) {
		file, er := createStationsFile()
		if er != nil {
			return nil, er
		}
		return file, nil
	} else {
		err := os.Remove("stations.jsonl")
		if err != nil {
			fmt.Println("Erreur lors de la suppression du fichier :", err)
		}
		file, er := createStationsFile()
		if er != nil {
			return nil, er
		}
		return file, nil
	}
}

func createStationsFile() (*os.File, error) {
	file, err := os.Create("stations.jsonl")
	if err != nil {
		return nil, err
	}
	return file, nil
}

func writeInJSONFile(file *os.File, data []Station) error {
	for _, s := range data {
		sh, er := handleLocation(s)
		if er != nil {
			return er
		}
		jsonData, err := json.Marshal(sh)
		if err != nil {
			return err
		}
		_, e := file.WriteString(string(jsonData) + "\n")
		if e != nil {
			return fmt.Errorf("error pendant ecriture dans le fichier: %s", e)
		}
	}
	return nil
}

func handleLocation(station Station) (Station, error) {
	location := station.Coordonnees
	locationSplit := strings.Split(location, ",")
	// result := []string{}
	var lon float64
	var lat float64
	// separate := ","
	for i, val := range locationSplit {
		if i == 1 {
			latArray := strings.Split(val, "]")
			var er error
			lat, er = strconv.ParseFloat(strings.TrimSpace(latArray[0]), 64)
			if er != nil {
				return Station{}, er
			}
		}
		if i == 0 {
			lonArray := strings.Split(val, "[")
			var err error
			lon, err = strconv.ParseFloat(strings.TrimSpace(lonArray[1]), 64)
			if err != nil {
				return Station{}, err
			}
		}
	}
	station.Coordo = []float64{lat, lon}

	return station, nil

}
