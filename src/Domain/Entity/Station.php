<?php

namespace App\Domain\Entity;

use App\Repository\StationRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;

#[ORM\Entity(repositoryClass: StationRepository::class)]
class Station
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $amenageur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sirenAmenageur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactAmenageur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $operateur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactOperateur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephoneOperateur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $enseigne = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $idStationItenerance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $idStationLocal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomStation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $implantationStation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addressStation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codeInsee = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coordonnees = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nbrPDC = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $idPDC = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $idPDClocal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $puissNominale = null;

    #[ORM\Column(type: "boolean", options: ["default" => false], nullable: true)]
    private ?bool $PriseTypeEF = null;

    #[ORM\Column(type: "boolean", options: ["default" => false], nullable: true)]
    private ?bool $PriseType2 = null;

    #[ORM\Column(type: "boolean", options: ["default" => false], nullable: true)]
    private ?bool $PriseTypeComboCcs = null;

    #[ORM\Column(type: "boolean", options: ["default" => false], nullable: true)]
    private ?bool $PriseTypeChademo = null;

    #[ORM\Column(type: "boolean", options: ["default" => false], nullable: true)]
    private ?bool $PriseTypeAutre = null;

    #[ORM\Column(type: "boolean", options: ["default" => false], nullable: true)]
    private ?bool $gratuit = null;

    #[ORM\Column(type: "boolean", options: ["default" => false], nullable: true)]
    private ?bool $paimentActe = null;

    #[ORM\Column(type: "boolean", options: ["default" => false], nullable: true)]
    private ?bool $paimentCB = null;

    #[ORM\Column(type: "boolean", options: ["default" => false], nullable: true)]
    private ?bool $paimentAautre = null;

    #[ORM\Column(type: "boolean", options: ["default" => false], nullable: true)]
    private ?bool $tarification = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $conditionAccees = null;

    #[ORM\Column(type: "boolean", options: ["default" => false], nullable: true)]
    private ?bool $reservation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $horaire = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $AccessibilitePMR = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $restrictionGabarit = null;

    #[ORM\Column(type: "boolean", options: ["default" => false], nullable: true)]
    private ?bool $station2Roue = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $raccordement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numPDI = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dateMiseEnService = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $observations = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dateMAJ = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cableT2Attach = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastModified = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $datagouvDatasetID = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dataResourceID = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $datagouvOrganizationOrOwner = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $consolidatedLongitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $consolidatedLatitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $consolidatedCodePostale = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $consolidatedCodeCommune = null;

    #[ORM\Column(type: "boolean", options: ["default" => false], nullable: true)]
    private ?bool $consolidatedIsLonLatCorrect = null;


    #[ORM\Column(type: "boolean", options: ["default" => false], nullable: true)]
    private ?bool $consolidatedIsCodeInseeVerified = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): ?int
    {
        return $this->id = $id;
    }

    public function getAmenageur(): ?string
    {
        return $this->amenageur;
    }

    public function setAmenageur(string $amenageur): self
    {
        $this->amenageur = $amenageur;

        return $this;
    }

    public function getOperateur(): ?string
    {
        return $this->operateur;
    }

    public function setOperateur(?string $operateur): self
    {
        $this->operateur = $operateur;

        return $this;
    }

    public function getEnseigne(): ?string
    {
        return $this->enseigne;
    }

    public function setEnseigne(?string $enseigne): self
    {
        $this->enseigne = $enseigne;

        return $this;
    }

    // public function getStation(): ?string
    // {
    //     return $this->station;
    // }

    // public function setStation(?string $station): self
    // {
    //     $this->station = $station;

    //     return $this;
    // }

    // public function getIdStation(): ?string
    // {
    //     return $this->idStation;
    // }

    // public function setIdStation(?string $idStation): self
    // {
    //     $this->idStation = $idStation;

    //     return $this;
    // }

    // public function getAdStation(): ?string
    // {
    //     return $this->adStation;
    // }

    // public function setAdStation(?string $adStation): self
    // {
    //     $this->adStation = $adStation;

    //     return $this;
    // }

    public function getCodeInsee(): ?string
    {
        return $this->codeInsee;
    }

    public function setCodeInsee(?string $codeInsee): self
    {
        $this->codeInsee = $codeInsee;

        return $this;
    }

    // public function getXLongitude(): ?string
    // {
    //     return $this->x_longitude;
    // }

    // public function setXLongitude(?string $x_longitude): self
    // {
    //     $this->x_longitude = $x_longitude;

    //     return $this;
    // }

    // public function getYlatitude(): ?string
    // {
    //     return $this->Ylatitude;
    // }

    // public function setYlatitude(?string $Ylatitude): self
    // {
    //     $this->Ylatitude = $Ylatitude;

    //     return $this;
    // }

    public function getNbrPDC(): ?string
    {
        return $this->nbrPDC;
    }

    public function setNbrPDC(?string $nbrPDC): self
    {
        $this->nbrPDC = $nbrPDC;

        return $this;
    }

    public function getIdPDC(): ?string
    {
        return $this->idPDC;
    }

    public function setIdPDC(?string $idPDC): self
    {
        $this->idPDC = $idPDC;

        return $this;
    }

    // public function getPuissMax(): ?string
    // {
    //     return $this->puissMax;
    // }

    // public function setPuissMax(?string $puissMax): self
    // {
    //     $this->puissMax = $puissMax;

    //     return $this;
    // }

    // public function getTypePrise(): ?string
    // {
    //     return $this->TypePrise;
    // }

    // public function setTypePrise(?string $TypePrise): self
    // {
    //     $this->TypePrise = $TypePrise;

    //     return $this;
    // }

    // public function getAccesRecharge(): ?string
    // {
    //     return $this->AccesRecharge;
    // }

    // public function setAccesRecharge(?string $AccesRecharge): self
    // {
    //     $this->AccesRecharge = $AccesRecharge;

    //     return $this;
    // }

    // public function getAccessibilite(): ?string
    // {
    //     return $this->Accessibilite;
    // }

    // public function setAccessibilite(?string $Accessibilite): self
    // {
    //     $this->Accessibilite = $Accessibilite;

    //     return $this;
    // }

    public function getObservations(): ?string
    {
        return $this->observations;
    }

    public function setObservations(?string $observations): self
    {
        $this->observations = $observations;

        return $this;
    }

    public function getDateMaj(): ?string
    {
        return $this->dateMAJ;
    }

    public function setDateMaj(?string $dateMAJ): self
    {
        $this->dateMAJ = $dateMAJ;

        return $this;
    }

    // public function getSource(): ?string
    // {
    //     return $this->source;
    // }

    // public function setSource(?string $source): self
    // {
    //     $this->source = $source;

    //     return $this;
    // }

    // public function getOther(): ?string
    // {
    //     return $this->other;
    // }

    // public function setOther(?string $other): self
    // {
    //     $this->other = $other;

    //     return $this;
    // }

    /**
     * Get the value of sirenAmenageur
     */
    public function getSirenAmenageur()
    {
        return $this->sirenAmenageur;
    }

    /**
     * Set the value of sirenAmenageur
     *
     * @return  self
     */
    public function setSirenAmenageur($sirenAmenageur)
    {
        $this->sirenAmenageur = $sirenAmenageur;

        return $this;
    }

    /**
     * Get the value of contactAmenageur
     */
    public function getContactAmenageur()
    {
        return $this->contactAmenageur;
    }

    /**
     * Set the value of contactAmenageur
     *
     * @return  self
     */
    public function setContactAmenageur($contactAmenageur)
    {
        $this->contactAmenageur = $contactAmenageur;

        return $this;
    }

    // /**
    //  * Get the value of nomOperateur
    //  */
    // public function getNomOperateur()
    // {
    //     return $this->nomOperateur;
    // }

    // /**
    //  * Set the value of nomOperateur
    //  *
    //  * @return  self
    //  */
    // public function setNomOperateur($nomOperateur)
    // {
    //     $this->nomOperateur = $nomOperateur;

    //     return $this;
    // }

    /**
     * Get the value of telephoneOperateur
     */
    public function getTelephoneOperateur()
    {
        return $this->telephoneOperateur;
    }

    /**
     * Set the value of telephoneOperateur
     *
     * @return  self
     */
    public function setTelephoneOperateur($telephoneOperateur)
    {
        $this->telephoneOperateur = $telephoneOperateur;

        return $this;
    }

    /**
     * Get the value of contactOperateur
     */
    public function getContactOperateur()
    {
        return $this->contactOperateur;
    }

    /**
     * Set the value of contactOperateur
     *
     * @return  self
     */
    public function setContactOperateur($contactOperateur)
    {
        $this->contactOperateur = $contactOperateur;

        return $this;
    }

    /**
     * Get the value of idStationItenerance
     */
    public function getIdStationItenerance()
    {
        return $this->idStationItenerance;
    }

    /**
     * Set the value of idStationItenerance
     *
     * @return  self
     */
    public function setIdStationItenerance($idStationItenerance)
    {
        $this->idStationItenerance = $idStationItenerance;

        return $this;
    }

    /**
     * Get the value of idStationLocal
     */
    public function getIdStationLocal()
    {
        return $this->idStationLocal;
    }

    /**
     * Set the value of idStationLocal
     *
     * @return  self
     */
    public function setIdStationLocal($idStationLocal)
    {
        $this->idStationLocal = $idStationLocal;

        return $this;
    }

    /**
     * Get the value of nomStation
     */
    public function getNomStation()
    {
        return $this->nomStation;
    }

    /**
     * Set the value of nomStation
     *
     * @return  self
     */
    public function setNomStation($nomStation)
    {
        $this->nomStation = $nomStation;

        return $this;
    }

    // /**
    //  * Get the value of implementationStation
    //  */
    // public function getImplementationStation()
    // {
    //     return $this->implementationStation;
    // }

    // /**
    //  * Set the value of implementationStation
    //  *
    //  * @return  self
    //  */
    // public function setImplementationStation($implementationStation)
    // {
    //     $this->implementationStation = $implementationStation;

    //     return $this;
    // }

    /**
     * Get the value of implantationStation
     */
    public function getImplantationStation()
    {
        return $this->implantationStation;
    }

    /**
     * Set the value of implantationStation
     *
     * @return  self
     */
    public function setImplantationStation($implantationStation)
    {
        $this->implantationStation = $implantationStation;

        return $this;
    }

    /**
     * Get the value of addressStation
     */
    public function getAddressStation()
    {
        return $this->addressStation;
    }

    /**
     * Set the value of addressStation
     *
     * @return  self
     */
    public function setAddressStation($addressStation)
    {
        $this->addressStation = $addressStation;

        return $this;
    }

    /**
     * Get the value of coordonnees
     */
    public function getCoordonnees()
    {
        return $this->coordonnees;
    }

    /**
     * Set the value of coordonnees
     *
     * @return  self
     */
    public function setCoordonnees($coordonnees)
    {
        $this->coordonnees = $coordonnees;

        return $this;
    }

    /**
     * Get the value of idPDClocal
     */
    public function getIdPDClocal()
    {
        return $this->idPDClocal;
    }

    /**
     * Set the value of idPDClocal
     *
     * @return  self
     */
    public function setIdPDClocal($idPDClocal)
    {
        $this->idPDClocal = $idPDClocal;

        return $this;
    }

    /**
     * Get the value of puissNominale
     */
    public function getPuissNominale()
    {
        return $this->puissNominale;
    }

    /**
     * Set the value of puissNominale
     *
     * @return  self
     */
    public function setPuissNominale($puissNominale)
    {
        $this->puissNominale = $puissNominale;

        return $this;
    }

    /**
     * Get the value of PriseTypeEF
     */
    public function getPriseTypeEF()
    {
        return $this->PriseTypeEF;
    }

    /**
     * Set the value of PriseTypeEF
     *
     * @return  self
     */
    public function setPriseTypeEF($PriseTypeEF)
    {
        $value = $PriseTypeEF;
        if ($PriseTypeEF == "false") {
            $value = false;
        }
        if ($PriseTypeEF == "true") {
            $value = true;
        }
        $this->PriseTypeEF = $value;

        return $this;
    }

    /**
     * Get the value of PriseType2
     */
    public function getPriseType2()
    {
        return $this->PriseType2;
    }

    /**
     * Set the value of PriseType2
     *
     * @return  self
     */
    public function setPriseType2($PriseType2)
    {
        $value = $PriseType2;
        if ($PriseType2 == "false") {
            $value = false;
        }
        if ($PriseType2 == "true") {
            $value = true;
        }
        $this->PriseType2 = $value;

        return $this;
    }

    /**
     * Get the value of PriseTypeComboCcs
     */
    public function getPriseTypeComboCcs()
    {
        return $this->PriseTypeComboCcs;
    }

    /**
     * Set the value of PriseTypeComboCcs
     *
     * @return  self
     */
    public function setPriseTypeComboCcs($PriseTypeComboCcs)
    {

        $value = $PriseTypeComboCcs;
        if ($PriseTypeComboCcs == "false") {
            $value = false;
        }
        if ($PriseTypeComboCcs == "true") {
            $value = true;
        }
        $this->PriseTypeComboCcs = $value;

        return $this;
    }

    /**
     * Get the value of PriseTypeChademo
     */
    public function getPriseTypeChademo()
    {
        return $this->PriseTypeChademo;
    }

    /**
     * Set the value of PriseTypeChademo
     *
     * @return  self
     */
    public function setPriseTypeChademo($PriseTypeChademo)
    {
        $value = $PriseTypeChademo;
        if ($PriseTypeChademo == "false") {
            $value = false;
        }
        if ($PriseTypeChademo == "true") {
            $value = true;
        }
        $this->PriseTypeChademo = $value;

        return $this;
    }

    /**
     * Get the value of PriseTypeAutre
     */
    public function getPriseTypeAutre()
    {
        return $this->PriseTypeAutre;
    }

    /**
     * Set the value of PriseTypeAutre
     *
     * @return  self
     */
    public function setPriseTypeAutre($PriseTypeAutre)
    {

        $value = $PriseTypeAutre;
        if ($PriseTypeAutre == "false") {
            $value = false;
        }
        if ($PriseTypeAutre == "true") {
            $value = true;
        }
        $this->PriseTypeAutre = $value;

        return $this;
    }

    /**
     * Get the value of tarification
     */
    public function getTarification()
    {
        return $this->tarification;
    }

    /**
     * Set the value of tarification
     *
     * @return  self
     */
    public function setTarification($tarification)
    {

        $value = $tarification;
        if ($tarification == "false") {
            $value = false;
        }
        if ($tarification == "true") {
            $value = true;
        }
        $this->tarification = $value;

        return $this;
    }

    /**
     * Get the value of paimentAautre
     */
    public function getPaimentAautre()
    {
        return $this->paimentAautre;
    }

    /**
     * Set the value of paimentAautre
     *
     * @return  self
     */
    public function setPaimentAautre($paimentAautre)
    {

        $value = $paimentAautre;
        if ($paimentAautre == "false") {
            $value = false;
        }
        if ($paimentAautre == "true") {
            $value = true;
        }
        $this->paimentAautre = $value;

        return $this;
    }

    /**
     * Get the value of paimentCB
     */
    public function getPaimentCB()
    {
        return $this->paimentCB;
    }

    /**
     * Set the value of paimentCB
     *
     * @return  self
     */
    public function setPaimentCB($paimentCB)
    {
        $value = $paimentCB;
        if ($paimentCB == "false") {
            $value = false;
        }
        if ($paimentCB == "true") {
            $value = true;
        }
        $this->paimentCB = $value;

        return $this;
    }

    /**
     * Get the value of paimentActe
     */
    public function getPaimentActe()
    {
        return $this->paimentActe;
    }

    /**
     * Set the value of paimentActe
     *
     * @return  self
     */
    public function setPaimentActe($paimentActe)
    {

        $value = $paimentActe;
        if ($paimentActe == "false") {
            $value = false;
        }
        if ($paimentActe == "true") {
            $value = true;
        }
        $this->paimentActe = $value;

        return $this;
    }

    /**
     * Get the value of gratuit
     */
    public function getGratuit()
    {
        return $this->gratuit;
    }

    /**
     * Set the value of gratuit
     *
     * @return  self
     */
    public function setGratuit($gratuit)
    {
        $value = $gratuit;
        if ($gratuit == "false") {
            $value = false;
        }
        if ($gratuit == "true") {
            $value = true;
        }
        $this->gratuit = $value;
        return $this;
    }

    /**
     * Get the value of conditionAccees
     */
    public function getConditionAccees()
    {
        return $this->conditionAccees;
    }

    /**
     * Set the value of conditionAccees
     *
     * @return  self
     */
    public function setConditionAccees($conditionAccees)
    {
        $this->conditionAccees = $conditionAccees;

        return $this;
    }

    /**
     * Get the value of reservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Set the value of reservation
     *
     * @return  self
     */
    public function setReservation($reservation)
    {

        $value = $reservation;
        if ($reservation == "false") {
            $value = false;
        }
        if ($reservation == "true") {
            $value = true;
        }

        $this->reservation = $value;

        return $this;
    }

    /**
     * Get the value of horaire
     */
    public function getHoraire()
    {
        return $this->horaire;
    }

    /**
     * Set the value of horaire
     *
     * @return  self
     */
    public function setHoraire($horaire)
    {
        $this->horaire = $horaire;

        return $this;
    }

    /**
     * Get the value of AccessibilitePMR
     */
    public function getAccessibilitePMR()
    {
        return $this->AccessibilitePMR;
    }

    /**
     * Set the value of AccessibilitePMR
     *
     * @return  self
     */
    public function setAccessibilitePMR($AccessibilitePMR)
    {
        $this->AccessibilitePMR = $AccessibilitePMR;

        return $this;
    }

    /**
     * Get the value of restrictionGabarit
     */
    public function getRestrictionGabarit()
    {
        return $this->restrictionGabarit;
    }

    /**
     * Set the value of restrictionGabarit
     *
     * @return  self
     */
    public function setRestrictionGabarit($restrictionGabarit)
    {
        $this->restrictionGabarit = $restrictionGabarit;

        return $this;
    }

    /**
     * Get the value of station2Roue
     */
    public function getStation2Roue()
    {
        return $this->station2Roue;
    }

    /**
     * Set the value of station2Roue
     *
     * @return  self
     */
    public function setStation2Roue($station2Roue)
    {

        $value = $station2Roue;
        if ($station2Roue == "false") {
            $value = false;
        }
        if ($station2Roue == "true") {
            $value = true;
        }

        $this->station2Roue = $value;

        return $this;
    }

    /**
     * Get the value of raccordement
     */
    public function getRaccordement()
    {
        return $this->raccordement;
    }

    /**
     * Set the value of raccordement
     *
     * @return  self
     */
    public function setRaccordement($raccordement)
    {
        $this->raccordement = $raccordement;

        return $this;
    }

    /**
     * Get the value of numPDI
     */
    public function getNumPDI()
    {
        return $this->numPDI;
    }

    /**
     * Set the value of numPDI
     *
     * @return  self
     */
    public function setNumPDI($numPDI)
    {
        $this->numPDI = $numPDI;

        return $this;
    }

    /**
     * Get the value of dateMiseEnService
     */
    public function getDateMiseEnService()
    {
        return $this->dateMiseEnService;
    }

    /**
     * Set the value of dateMiseEnService
     *
     * @return  self
     */
    public function setDateMiseEnService($dateMiseEnService)
    {
        $this->dateMiseEnService = $dateMiseEnService;

        return $this;
    }


    /**
     * Get the value of cableT2Attach
     */
    public function getCableT2Attach()
    {
        return $this->cableT2Attach;
    }

    /**
     * Set the value of cableT2Attach
     *
     * @return  self
     */
    public function setCableT2Attach($cableT2Attach)
    {
        $this->cableT2Attach = $cableT2Attach;

        return $this;
    }

    /**
     * Get the value of lastModified
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * Set the value of lastModified
     *
     * @return  self
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * Get the value of datagouvDatasetID
     */
    public function getDatagouvDatasetID()
    {
        return $this->datagouvDatasetID;
    }

    /**
     * Set the value of datagouvDatasetID
     *
     * @return  self
     */
    public function setDatagouvDatasetID($datagouvDatasetID)
    {
        $this->datagouvDatasetID = $datagouvDatasetID;

        return $this;
    }

    /**
     * Get the value of dataResourceID
     */
    public function getDataResourceID()
    {
        return $this->dataResourceID;
    }

    /**
     * Set the value of dataResourceID
     *
     * @return  self
     */
    public function setDataResourceID($dataResourceID)
    {
        $this->dataResourceID = $dataResourceID;

        return $this;
    }

    /**
     * Get the value of datagouvOrganizationOrOwner
     */
    public function getDatagouvOrganizationOrOwner()
    {
        return $this->datagouvOrganizationOrOwner;
    }

    /**
     * Set the value of datagouvOrganizationOrOwner
     *
     * @return  self
     */
    public function setDatagouvOrganizationOrOwner($datagouvOrganizationOrOwner)
    {
        $this->datagouvOrganizationOrOwner = $datagouvOrganizationOrOwner;

        return $this;
    }

    /**
     * Get the value of consolidatedLongitude
     */
    public function getConsolidatedLongitude()
    {
        return $this->consolidatedLongitude;
    }

    /**
     * Set the value of consolidatedLongitude
     *
     * @return  self
     */
    public function setConsolidatedLongitude($consolidatedLongitude)
    {
        $this->consolidatedLongitude = $consolidatedLongitude;

        return $this;
    }

    /**
     * Get the value of consolidatedLatitude
     */
    public function getConsolidatedLatitude()
    {
        return $this->consolidatedLatitude;
    }

    /**
     * Set the value of consolidatedLatitude
     *
     * @return  self
     */
    public function setConsolidatedLatitude($consolidatedLatitude)
    {
        $this->consolidatedLatitude = $consolidatedLatitude;

        return $this;
    }

    /**
     * Get the value of consolidatedCodePostale
     */
    public function getConsolidatedCodePostale()
    {
        return $this->consolidatedCodePostale;
    }

    /**
     * Set the value of consolidatedCodePostale
     *
     * @return  self
     */
    public function setConsolidatedCodePostale($consolidatedCodePostale)
    {
        $this->consolidatedCodePostale = $consolidatedCodePostale;

        return $this;
    }

    /**
     * Get the value of consolidatedCodeCommune
     */
    public function getConsolidatedCodeCommune()
    {
        return $this->consolidatedCodeCommune;
    }

    /**
     * Set the value of consolidatedCodeCommune
     *
     * @return  self
     */
    public function setConsolidatedCodeCommune($consolidatedCodeCommune)
    {
        $this->consolidatedCodeCommune = $consolidatedCodeCommune;

        return $this;
    }

    /**
     * Get the value of consolidatedIsLonLatCorrect
     */
    public function getConsolidatedIsLonLatCorrect()
    {
        return $this->consolidatedIsLonLatCorrect;
    }

    /**
     * Set the value of consolidatedIsLonLatCorrect
     *
     * @return  self
     */
    public function setConsolidatedIsLonLatCorrect($consolidatedIsLonLatCorrect)
    {

        $value = $consolidatedIsLonLatCorrect;
        if ($consolidatedIsLonLatCorrect == "false") {
            $value = false;
        }
        if ($consolidatedIsLonLatCorrect == "true") {
            $value = true;
        }
        $this->consolidatedIsLonLatCorrect = $value;

        return $this;
    }

    /**
     * Get the value of consolidatedIsCodeInseeVerified
     */
    public function getConsolidatedIsCodeInseeVerified()
    {
        return $this->consolidatedIsCodeInseeVerified;
    }

    /**
     * Set the value of consolidatedIsCodeInseeVerified
     *
     * @return  self
     */
    public function setConsolidatedIsCodeInseeVerified($consolidatedIsCodeInseeVerified)
    {
        $value = $consolidatedIsCodeInseeVerified;
        if ($consolidatedIsCodeInseeVerified == "false") {
            $value = false;
        }
        if ($consolidatedIsCodeInseeVerified == "true") {
            $value = true;
        }
        $this->consolidatedIsCodeInseeVerified = $value;

        return $this;
    }


}
