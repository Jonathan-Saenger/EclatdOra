<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Intl\Languages;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

\Locale::setDefault('en');
$language = Languages::getName('fr');
$language = Languages::getAlpha3Name('fra');

class EvenementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Evenement::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
    yield TextField::new('title', 'Titre');
    yield TextareaField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex();
    yield TextEditorField::new('description', 'Description de l\'évènement');
    yield NumberField::new('price', 'Prix');
    yield DateTimeField::new('start', 'Début de l\'évènement');
    yield DateTimeField::new('end', 'Fin de l\'évènement');
    yield DateField::new('createAt', 'Date de création de l\'évènement');
    }
    
}
