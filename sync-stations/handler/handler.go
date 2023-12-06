package handler

import (
	"net/http"
	"sync-stations/github.com/repo"
)

type GlobalRepoInterface interface {
	GetStations() ([]repo.Station, error) 
	PostCollectionDocuments(data []repo.Station) (*http.Response, error)
	CreateCollectionStations() (*http.Response, error)
	IsCollectionExist(collectionName string) (*bool, error)	
}

type Handler struct {
	Rp GlobalRepoInterface
}

func NewHandler(rp GlobalRepoInterface) *Handler {
	h := Handler{}
	h.Rp = rp
	return &h
}

func (h Handler) SyncStations() error {
	stations, er := h.Rp.GetStations()
	if er != nil {
		return er
	}
	iscollectionExist, er := h.Rp.IsCollectionExist("stations")
	if er != nil {
		return er
	}

	if !*iscollectionExist {
		_, err := h.Rp.CreateCollectionStations()
		if err != nil {
			return err
		}

	}
	_, err := h.Rp.PostCollectionDocuments(stations)
	if err != nil {
		return err
	}
	return nil
}
