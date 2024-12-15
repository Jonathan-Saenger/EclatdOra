<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use DateTimeImmutable;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Intl\Languages;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use PhpParser\Node\Expr\Cast\String_;

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
        yield TextField::new('adresse', 'Adresse de l\'évènement');
        yield TextField::new('codePostal', 'Code Postal');
        yield NumberField::new('place', 'Places restantes');
        yield DateTimeField::new('createAt')->hideOnForm();
    }
}
