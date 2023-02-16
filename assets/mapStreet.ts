
export class MapStreet {
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
        let L = (window as any).L
        var map = L.map('map').setView([this.lat, this.lon], this.zoom);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 15,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        let mapStation: MapStation = { theMap: map, l: L }
        // let arrayMark = [];
        let markerGroup = L.layerGroup().addTo(map);
        this.group = markerGroup;
        // this.group.clearLayers();
        // console.log(stations.length)
        stations.forEach((station): void => {
            try {
                let marker = L.marker([station.consolidatedLatitude, station.consolidatedLongitude]);
                marker.addTo(markerGroup);
            } catch (error) {
                console.log("ERRORRRRRR" + error);
            }
        })
        // L.featureGroup(arrayMark).addTo(map)
        return mapStation;
    }
}