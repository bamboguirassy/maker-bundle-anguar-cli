<?= "<?php\n" ?>

namespace <?= $namespace ?>;

use <?= $entity_full_class_name ?>;
use <?= $form_full_class_name ?>;
<?php if (isset($repository_full_class_name)): ?>
use <?= $repository_full_class_name ?>;
<?php endif ?>
use Symfony\Bundle\FrameworkBundle\Controller\<?= $parent_class_name ?>;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Utils\Utils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/api<?= $route_path ?>")
 */
class <?= $class_name ?> extends <?= $parent_class_name; ?><?= "\n" ?>
{
    /**
     * @Rest\Get(path="/", name="<?= $route_name ?>_index")
     * @Rest\View(StatusCode = 200)
     * @IsGranted("ROLE_<?= strtoupper($entity_class_name) ?>_LISTE")
     */
<?php if (isset($repository_full_class_name)): ?>
    public function index(<?= $repository_class_name ?> $<?= $repository_var ?>): array
    {
        return $<?= $repository_var ?>->findAll();
    }
<?php else: ?>
    public function index(): array
    {
        $<?= $entity_var_plural ?> = $this->getDoctrine()
            ->getRepository(<?= $entity_class_name ?>::class)
            ->findAll();

        return count($<?= $entity_var_plural ?>)?$<?= $entity_var_plural ?>:[];
    }
<?php endif ?>

    /**
     * @Rest\Post(Path="/create", name="<?= $route_name ?>_new")
     * @Rest\View(StatusCode=200)
     * @IsGranted("ROLE_<?= strtoupper($entity_class_name) ?>_NOUVEAU")
     */
    public function create(Request $request): <?= $entity_class_name ?>
    {
        $<?= $entity_var_singular ?> = new <?= $entity_class_name ?>();
        $form = $this->createForm(<?= $form_class_name ?>::class, $<?= $entity_var_singular ?>);
        $form->submit(Utils::serializeRequestContent($request));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($<?= $entity_var_singular ?>);
        $entityManager->flush();

        return $<?= $entity_var_singular ?>;
    }

    /**
     * @Rest\Get(path="/{<?= $entity_identifier ?>}", name="<?= $route_name ?>_show",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     * @IsGranted("ROLE_<?= strtoupper($entity_class_name) ?>_AFFICHAGE")
     */
    public function show(<?= $entity_class_name ?> $<?= $entity_var_singular ?>): <?= $entity_class_name ?>
    {
        return $<?= $entity_var_singular ?>;
    }

    
    /**
     * @Rest\Put(path="/{<?= $entity_identifier ?>}/edit", name="<?= $route_name ?>_edit",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     * @IsGranted("ROLE_<?= strtoupper($entity_class_name) ?>_EDITION")
     */
    public function edit(Request $request, <?= $entity_class_name ?> $<?= $entity_var_singular ?>): <?= $entity_class_name ?>
    {
        $form = $this->createForm(<?= $form_class_name ?>::class, $<?= $entity_var_singular ?>);
        $form->submit(Utils::serializeRequestContent($request));

        $this->getDoctrine()->getManager()->flush();

        return $<?= $entity_var_singular ?>;
    }
    
    /**
     * @Rest\Put(path="/{id}/clone", name="<?= $route_name ?>_clone",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     * @IsGranted("ROLE_<?= strtoupper($entity_class_name) ?>_CLONE")
     */
    public function cloner(Request $request, <?= $entity_class_name ?> $<?= $entity_var_singular ?>):  <?= $entity_class_name ?> {
        $em=$this->getDoctrine()->getManager();
        $<?= $entity_var_singular ?>New=new <?= $entity_class_name ?>();
        $form = $this->createForm(<?= $entity_class_name ?>Type::class, $<?= $entity_var_singular ?>New);
        $form->submit(Utils::serializeRequestContent($request));
        $em->persist($<?= $entity_var_singular ?>New);

        $em->flush();

        return $<?= $entity_var_singular ?>New;
    }

    /**
     * @Rest\Delete("/{<?= $entity_identifier ?>}", name="<?= $route_name ?>_delete",requirements = {"id"="\d+"})
     * @Rest\View(StatusCode=200)
     * @IsGranted("ROLE_<?= strtoupper($entity_class_name) ?>_DELETE")
     */
    public function delete(<?= $entity_class_name ?> $<?= $entity_var_singular ?>): <?= $entity_class_name ?>
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($<?= $entity_var_singular ?>);
        $entityManager->flush();

        return $<?= $entity_var_singular ?>;
    }
    
    /**
     * @Rest\Post("/delete-selection/", name="<?= $route_name ?>_selection_delete")
     * @Rest\View(StatusCode=200)
     * @IsGranted("ROLE_<?= strtoupper($entity_class_name) ?>_DELETE")
     */
    public function deleteMultiple(Request $request): array {
        $entityManager = $this->getDoctrine()->getManager();
        $<?= $entity_var_plural ?> = Utils::getObjectFromRequest($request);
        if (!count($<?= $entity_var_plural ?>)) {
            throw $this->createNotFoundException("Selectionner au minimum un élément à supprimer.");
        }
        foreach ($<?= $entity_var_plural ?> as $<?= $entity_var_singular ?>) {
            $<?= $entity_var_singular ?> = $entityManager->getRepository(<?= $entity_class_name ?>::class)->find($<?= $entity_var_singular ?>->id);
            $entityManager->remove($<?= $entity_var_singular ?>);
        }
        $entityManager->flush();

        return $<?= $entity_var_plural ?>;
    }
}
