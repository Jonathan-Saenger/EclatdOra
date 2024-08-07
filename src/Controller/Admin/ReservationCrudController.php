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
                'Hypnose transpersonnelle en presentielle' => 'Hypnose transpersonnelle en presentielle',
                'Hypnose transpersonnelle en visio' => 'Hypnose transpersonnelle en visio',
                'Méditation guidée' => 'Méditation guidée',
                'Séance individuelle Reiki' => 'Séance individuelle Reiki',
                'Formation 1er degré Reiki' => 'Formation 1er degré Reiki',
                'Formation 2ème degré Reiki' => 'Formation 2ème degré Reiki',
                'Formation 3ème degré Reiki' => 'Formation 3ème degré Reiki',
                'Formation 4ème degré Reiki' => 'Formation 4ème degré Reiki',
                'Luminothérapie individuelle 1h' => 'Luminotherapie individuelle 1h',
                'Luminothérapie individuelle 2h' => 'Luminotherapie individuelle 2h',
                'Luminothérapie duo 1h' => 'Luminotherapie duo 1h',
                'Luminothérapie duo 2h' => 'Luminotherapie duo 2h',
                'Soins holistique' => 'Soins holistique',
                'Séance médiumnique' => 'Séance médiumnique'
        ]);
    }
}
