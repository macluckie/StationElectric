package main

import (
	"fmt"
	"sync-stations/github.com/handler"
	"sync-stations/github.com/repo"
)

func main() {
	r, er := repo.NewRepo()
	if er != nil {
		panic(er)
	}
	repoHttp := repo.NewRepoHttp()
	gr := repo.NewGlobalRepo(*repoHttp, *r)
	h := handler.NewHandler(gr)
	err := h.SyncStations()
	if err != nil {
		panic(err)
	}
	fmt.Println("End SyncStations !!!!!")
}
