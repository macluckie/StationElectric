import { MapStreet } from './mapStreet';

(async () => {
    if (!navigator.geolocation) {
        console.error(`Your browser doesn't support Geolocation`);
    }
    navigator.geolocation.getCurrentPosition(onSuccess, onError);
    let latitude = localStorage.getItem("latitude");
    let longitude = localStorage.getItem("longitude");


    let url = 'http://localhost:8081/stations';
    if (latitude != null && longitude != null) {
        url = 'http://localhost:8081/stations' + '?latitude=' + latitude + '&longitude=' + longitude;
    }

    let stations = await fetch(url, {
        method: 'GET',
        headers: {
            'X-Station': 'toto'
        },
    });
    let result = await stations.json();
    let stationsArray: Array<Station> = [];
    result.stations.forEach((item) => {
        let station: Station =
        {
            nbrPDC: item.nbrPDC,
            id: item.id,
            amenageur: item.amenageur,
            sirenAmenageur: item.sirenAmenageur,
            contactAmenageur: item.contactAmenageur,
            operateur: item.operateur,
            contactOperateur: item.contactOperateur,
            telephoneOperateur: item.telephoneOperateur,
            enseigne: item.enseigne,
            idStationItenerance: item.idStationItenerance,
            idStationLocal: item.idStationLocal,
            nomStation: item.nomStation,
            implantationStation: item.implantationStation,
            addressStation: item.addressStation,
            codeInsee: item.codeInsee,
            coordonnees: item.coordonnees,
            idPDC: item.idPDC,
            puissanceNominal: item.puissanceNominal,
            priseTypeEF: item.priseTypeEF,
            priseType2: item.priseType2,
            PriseTypeComboCcs: item.PriseTypeComboCcs,
            PriseTypeChademo: item.PriseTypeChademo,
            PriseTypeAutre: item.PriseTypeAutre,
            gratuit: item.gratuit,
            paimentActe: item.paimentActe,
            paimentCB: item.paimentCB,
            paimentAautre: item.paimentAautre,
            tarification: item.tarification,
            conditionAccees: item.conditionAccees,
            reservation: item.reservation,
            horaire: item.horaire,
            AccessibilitePMR: item.AccessibilitePMR,
            restrictionGabarit: item.restrictionGabarit,
            station2Roue: item.station2Roue,
            raccordement: item.raccordement,
            numPDI: item.numPDI,
            dateMAJ: item.dateMAJ,
            observations: item.observations,
            dateMiseEnService: item.dateMiseEnService,
            cableT2Attach: item.cable,
            lastModified: item.lastModified,
            datagouvDatasetID: item.datagouvDatasetID,
            dataResourceID: item.dataResourceID,
            datagouvOrganizationOrOwner: item.datagouvOrganizationOrOwner,
            consolidatedLongitude: item.consolidatedLongitude,
            consolidatedLatitude: item.consolidatedLatitude,
            consolidatedCodePostale: item.consolidatedCodePostale,
            consolidatedCodeCommune: item.consolidatedCodeCommune,
            consolidatedIsCodeInseeVerified: item.consolidatedIsCodeInseeVerified,
            consolidatedIsLonLatCorrect: item.consolidatedIsLonLatCorrect,
        }
        stationsArray.push(station);
    })

    if (latitude == null && longitude == null) {
        latitude = "48.852969";
        longitude = "2.349903";
    }

    let zoom: number = 10;
    let m = new MapStreet(Number(latitude), Number(longitude), zoom);
    let map = m.mapBuilder(stationsArray);

    map.theMap.on('zoom', async (z) => {
        let center = map.theMap.getCenter();
        let position: Position = { lon: center.lng, lat: center.lat }
        let stations = await getStations(position);
        // m.group.clearLayers();

        stations.stations.map((station): void => {
            try {
                let marker = map.l.marker([station.consolidatedLatitude, station.consolidatedLongitude]);
                marker.addTo(m.group);
            } catch (error) {
                console.log("ERRORRRRRR" + error);
            }
        })
    });

    map.theMap.on('moveend', async (z) => {
        let center = map.theMap.getCenter();
        let position: Position = { lon: center.lng, lat: center.lat };
        let stations = await getStations(position);
        // m.group.clearLayers();

        stations.stations.map((station): void => {
            try {
                let marker = map.l.marker([station.consolidatedLatitude, station.consolidatedLongitude]);
                marker.addTo(m.group);
            } catch (error) {
                console.log("ERRORRRRRR" + error);
            }
        })
    });

})();

async function getStations(position: Position) {
    let url = 'http://localhost:8081/stations' + '?latitude=' + position.lat + '&longitude=' + position.lon;
    let stations = await fetch(url, {
        method: 'GET',
        headers: {
            'X-Station': 'toto'
        },
    });
    let result = await stations.json();
    return result
}

function onError() {
    alert('ERROR')
}

function onSuccess(position) {
    const {
        latitude,
        longitude
    } = position.coords;
    localStorage.setItem("longitude", longitude);
    localStorage.setItem("latitude", latitude);
}

