<?php

namespace App\Controller\Admin;

use App\Entity\News;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NewsCrudController extends AbstractCrudController
{
    public const NEWS_UPLOAD_DIR = 'public/uploads/images/news';
    public const NEWS_BASE_PATH = 'uploads/images/news';
    public static function getEntityFqcn(): string
    {
        return News::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'titre'),
            TextField::new('slug'),
            TextEditorField::new('description'),
            BooleanField::new('isActive'),
            ImageField::new('image')
            ->setBasePath(self::NEWS_BASE_PATH)
            ->setUploadDir(self::NEWS_UPLOAD_DIR)
            ->setSortable(false),
            DateTimeField::new('updatedAt')->hideOnForm(),
            DateTimeField::new('createdAt')->hideOnForm(),

            
        ];
    }
    
}
