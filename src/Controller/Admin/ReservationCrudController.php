<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Intl\Languages;

\Locale::setDefault('en');
$language = Languages::getName('fr');
$language = Languages::getAlpha3Name('fra');

class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('prestation', 'Prestation');
        yield DateField::new('date', 'Date');
        yield TimeField::new('debut','Heure de début');
        yield TimeField::new('fin','Heure de fin');
        yield ChoiceField::new('prestation', 'Type de prestation')
            ->setChoices([
                'Hypnose transpersonnelle - Presentielle' => 'Hypnose transpersonnelle - Presentielle',
                'Hypnose transpersonnelle - Visio' => 'Hypnose transpersonnelle - Visio',
                'Méditation guidée' => 'Méditation guidée',
                'Reiki' => 'Reiki',
                'Luminothérapie individuelle 1h' => 'Luminotherapie individuelle 1h',
                'Luminothérapie individuelle 2h' => 'Luminotherapie individuelle 2h',
                'Luminothérapie duo 1h' => 'Luminotherapie duo 1h',
                'Luminothérapie duo 2h' => 'Luminotherapie duo 2h',
                'Soins « Holistique » d’harmonisation' => 'Soins « Holistique » d’harmonisation',
                'Séance médiumnique' => 'Séance médiumnique'
        ]);
    }
}
