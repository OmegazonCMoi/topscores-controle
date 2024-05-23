<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Evaluations;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType; // Add this line
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class EvaluationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
            $builder
                ->add('comment', TextareaType::class, [
                    'label' => 'Commentaire',
                ])
                ->add('note', NumberType::class, [
                    'label' => 'Note sur 20',
                    'scale' => 2,
                ]);
        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evaluations::class,
        ]);
    }
}
