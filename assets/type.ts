interface MapStation {
    theMap: any;
    l: any;
}

interface Position {
    lon: number;
    lat: number;
}


interface Station {
    id: string;
    amenageur: string;
    sirenAmenageur: string;
    contactAmenageur: string;    
    operateur: string;
    contactOperateur: string;
    telephoneOperateur: string;
    enseigne: string;
    idStationItenerance: string;
    idStationLocal: string;
    nomStation: string;
    implantationStation: string;
    addressStation: string;
    codeInsee: string;
    coordonnees: string;
    nbrPDC: string;
    idPDC: string;
    puissanceNominal: string;
    priseTypeEF: boolean;
    priseType2: boolean;
    PriseTypeComboCcs: boolean;
    PriseTypeChademo: boolean;
    PriseTypeAutre: boolean;
    gratuit: boolean;
    paimentActe: boolean;
    paimentCB: boolean;
    paimentAautre: boolean;
    tarification: boolean;
    conditionAccees: string;
    reservation: boolean;
    horaire: string;
    AccessibilitePMR: string;
    restrictionGabarit: string;
    station2Roue: boolean;
    raccordement: string;
    numPDI: string;
    dateMiseEnService: string;
    observations: string;
    dateMAJ: string;
    cableT2Attach: string;
    lastModified: string;
    datagouvDatasetID: string;
    dataResourceID: string;
    datagouvOrganizationOrOwner: string;
    consolidatedLongitude: string;
    consolidatedLatitude: string;
    consolidatedCodePostale: string;
    consolidatedCodeCommune: string;
    consolidatedIsLonLatCorrect: boolean;
    consolidatedIsCodeInseeVerified: boolean;
}