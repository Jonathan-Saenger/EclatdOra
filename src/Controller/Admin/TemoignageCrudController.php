<?php

namespace App\Controller\Admin;

use App\Entity\Temoignage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use Symfony\Component\Intl\Languages;
use Vich\UploaderBundle\Form\Type\VichImageType;

\Locale::setDefault('en');
$language = Languages::getName('fr');
$language = Languages::getAlpha3Name('fra');

class TemoignageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Temoignage::class;
    }

    public function configureFields(string $pageName): iterable
    {

    yield textField::new('Nom','Nom et prénom');
    yield textField::new('Metier');
    yield TextEditorField::new('Commentaire');
    yield TextareaField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex();
    }
}
