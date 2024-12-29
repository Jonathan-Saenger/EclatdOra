<?php

namespace App\Controller\Admin;

use App\Entity\Offre;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\TextType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class OffreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Offre::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('Titre_offre', 'Presentation de l\'offre');
        yield IntegerField::new('duree_offre', 'Durée (en heure)');
        yield NumberField::new('prix_offre', 'Prix (en euro)');
    }
}
