<?php

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Motscles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('contenu')
            ->add('date_creation')
            ->add('date_modif')
            ->add('categorie',EntityType::class, [
                'class' => Categorie::class,
                'choice_label'=>'categorie  ',
                'expanded'=>false,
                'multiple'=>false
                
            ])
            ->add('motscles',EntityType::class, [
                'class' => Motscles::class,
                'choice_label'=>'Motcle  ',
                'expanded'=>false,
                'multiple'=>true
                
            ])

            
        ;
        
       
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
