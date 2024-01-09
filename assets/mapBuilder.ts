import 'leaflet-search';

export class MapBuilder {
    lat: number;
    lon: number;
    zoom: number;
    group: any;

    constructor(lat: number, lon: number, zoom: number) {
        this.lat = lat;
        this.lon = lon;
        this.zoom = zoom;
    }

    mapBuilder(stations: Array<Station>): MapStation {
        let L = (window as any).L;
        var map = L.map('map').setView([this.lat, this.lon], this.zoom);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 15,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
    
        let mapStation: MapStation = { theMap: map, l: L };
        let markerGroup = L.layerGroup().addTo(map);
        this.group = markerGroup;
        
        stations.forEach((station): void => {
            try {
                const marker = L.marker([station.consolidatedLatitude, station.consolidatedLongitude], {operateur: station.operateur});
                marker.addTo(markerGroup);
            } catch (error) {
                console.log("ERRORRRRRR" + error);
            }
        });
        
        const searchControl = new L.Control.Search({
            position: 'topright',
            layer: markerGroup,
            propertyName: 'operateur', 
            textPlaceholder: 'Rechercher par ville...'
        });
        map.addControl(searchControl);        
        searchControl.on('search:locationfound', (e: any) => {
        map.setView(e.latlng, 15)
        // console.log('Résultat de la recherche:', e);
        
        // // Vous pouvez faire d'autres actions ici, comme recentrer la carte
        // // ou afficher des informations supplémentaires sur le résultat.
        // map.setView(e.latlng, 15); // Par exemple, recentrer la carte sur le résultat de la recherche
    });

        return mapStation;
    }
}
    