 <?php
class Huis {

    private int $aantalVerdiepingen;
    private int $aantalKamers;
    private float $breedte;
    private float $hoogte;
    private float $diepte;
    private float $prijsPerM3 = 800;


    public function __construct(int $aantalVerdiepingen, int $aantalKamers, float $breedte, float $hoogte, float $diepte) {
        $this->aantalVerdiepingen = $aantalVerdiepingen;
        $this->aantalKamers = $aantalKamers;
        $this->breedte = $breedte;
        $this->hoogte = $hoogte;
        $this->diepte = $diepte;
    }
protected function validater($getal)

    {
        if ($getal < 0) {
            $getal = 0;
        }
        return $getal;
    }


    public function berekenPrijs(): float {
        return $this->berekenVolume() * $this->prijsPerM3;
    }


    public function toonDetails(): void {
        echo "🏠Huis🏠<br>";
        echo "- Verdiepingen: {$this->aantalVerdiepingen}<br>";
        echo "- Kamers: {$this->aantalKamers}<br>";
        echo "- Afmetingen: {$this->breedte}m × {$this->hoogte}m × {$this->diepte}m<br>";
        echo "- Volume: " . $this->berekenVolume() . " m³<br>";
        echo "- Prijs: €" . number_format($this->berekenPrijs(), 2, ',', '.') . "<br><br>";
    }
}


$huis1 = new Huis(2, 5, 8.0, 6.7, 8.0);
$huis1->toonDetails();

$huis2 = new Huis(5, 10, 100.0, 90.0, 12.0);
$huis2->toonDetails();

$huis3 = new Huis(1, 2, 6.5, 3.0, 10.0);
$huis3->toonDetails();

?>