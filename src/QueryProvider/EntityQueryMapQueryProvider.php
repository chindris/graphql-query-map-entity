<?php

namespace Drupal\graphql_query_map_entity\QueryProvider;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\graphql\GraphQL\QueryProvider\QueryProviderInterface;
use GraphQL\Server\OperationParams;

class EntityQueryMapQueryProvider implements QueryProviderInterface {
  /**
   * The entity type manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs an EntityQueryMapQueryProvider object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entity type manager service.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public function getQuery($id, OperationParams $operation) {
    $version = $operation->getOriginalInput('version');
    if (empty($version) || empty($id)) {
      return NULL;
    }

    $storage = $this->entityTypeManager->getStorage('graphql_query_map');
    /** @var \Drupal\graphql\Entity\QueryMapInterface $map */
    if ($map = $storage->load($version)) {
      return $map->getQuery($id);
    }

    return NULL;
  }
}
