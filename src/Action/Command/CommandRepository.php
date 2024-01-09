<?php

namespace App\Action\Command;

use App\Domain\Command\CommandRepositoryInterface;
use App\Domain\Entity\Station;
use Doctrine\ORM\EntityManagerInterface;

class CommandRepository implements CommandRepositoryInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;        
    }

    public function insertCsvInDb(array $CSVData): bool {
        if (count($CSVData) > 0) {
            $i = 0;
            $error = false;
            foreach ($CSVData as $key => $rows) {
                try {
                    $station = $this->createStation($rows);
                    $this->em->persist($station);
                    $this->em->flush();
                    $i++;
                    echo $i;
                  $error = true;
                } catch (\Throwable $th) {
                    echo $th->getMessage();
                    return $error;
                }
            }
            return $error;
        }        
    }

    private function createStation(array $rows): Station
    {
        $station = new Station();
        $station->setAmenageur($rows[0]);
        $station->setSirenAmenageur($rows[1]);
        $station->setContactAmenageur($rows[2]);
        $station->setOperateur($rows[3]);
        $station->setContactOperateur($rows[4]);
        $station->setTelephoneOperateur($rows[5]);
        $station->setEnseigne($rows[6]);
        $station->setIdStationItenerance($rows[7]);
        $station->setIdStationLocal($rows[8]);
        $station->setNomStation($rows[9]);
        $station->setImplantationStation($rows[10]);
        $station->setAddressStation($rows[11]);
        $station->setCodeInsee($rows[12]);
        $station->setCoordonnees($rows[13]);
        $station->setNbrPDC($rows[14]);
        $station->setIdPDC($rows[15]);
        $station->setIdPDClocal($rows[16]);
        $station->setPuissNominale($rows[17]);
        $station->setPriseTypeEF($rows[18]);
        $station->setPriseType2($rows[19]);
        $station->setPriseTypeComboCcs($rows[20]);
        $station->setPriseTypeChademo($rows[21]);
        $station->setPriseTypeAutre($rows[22]);
        $station->setGratuit($rows[23]);
        $station->setPaimentActe($rows[24]);
        $station->setPaimentCB($rows[25]);
        $station->setPaimentAautre($rows[26]);
        $station->setTarification($rows[27]);
        $station->setConditionAccees($rows[28]);
        $station->setReservation($rows[29]);
        $station->setHoraire($rows[30]);
        $station->setAccessibilitePMR($rows[31]);
        $station->setRestrictionGabarit($rows[32]);
        $station->setStation2Roue($rows[33]);
        $station->setRaccordement($rows[34]);
        $station->setNumPDI($rows[35]);
        $station->setDateMiseEnService($rows[36]);
        $station->setObservations($rows[37]);
        $station->setDateMaj($rows[38]);
        $station->setCableT2Attach($rows[39]);
        $station->setLastModified($rows[40]);
        $station->setDatagouvDatasetID($rows[41]);
        $station->setDataResourceID($rows[42]);
        $station->setDatagouvOrganizationOrOwner($rows[43]);
        $station->setConsolidatedLongitude($rows[44]);
        $station->setConsolidatedLatitude($rows[45]);
        $station->setConsolidatedCodePostale($rows[46]);
        $station->setConsolidatedCodeCommune($rows[47]);
        $station->setConsolidatedIsLonLatCorrect($rows[48]);
        $station->setConsolidatedIsCodeInseeVerified($rows[49]);
        return $station;
    }
}