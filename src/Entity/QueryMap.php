<?php

namespace Drupal\graphql_query_map_entity\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * @ConfigEntityType(
 *   id = "graphql_query_map",
 *   label = @Translation("Query map"),
 *   handlers = {
 *     "list_builder" = "Drupal\graphql_query_map_entity\Controller\QueryMapListBuilder",
 *     "form" = {
 *       "import" = "Drupal\graphql_query_map_entity\Form\QueryMapImportForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *       "inspect" = "Drupal\graphql_query_map_entity\Form\QueryMapForm",
 *     }
 *   },
 *   config_prefix = "graphql_query_map",
 *   admin_permission = "administer graphql queries",
 *   entity_keys = {
 *     "id" = "version"
 *   },
 *   config_export = {
 *     "version",
 *     "queryMap",
 *   },
 *   links = {
 *     "inspect-form" = "/admin/config/graphql-query-maps/{graphql_query_map}",
 *     "import-form" = "/admin/config/graphql-query-maps/import",
 *     "delete-form" = "/admin/config/graphql-query-maps/{graphql_query_map}/delete",
 *     "collection" = "/admin/config/graphql-query-maps",
 *   }
 * )
 */
class QueryMap extends ConfigEntityBase implements QueryMapInterface {

  /**
   * The GraphQL query map version ID.
   *
   * @var string
   */
  public $version;

  /**
   * The GraphQL query map.
   *
   * @var array
   */
  public $queryMap = [];

  /**
   * {@inheritdoc}
   */
  public function id() {
    return $this->version;
  }

  /**
   * {@inheritdoc}
   */
  public function getQuery($queryId) {
    if (isset($this->queryMap[$queryId])) {
      return $this->queryMap[$queryId];
    }

    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  public static function exists($id) {
    return (bool) static::load($id);
  }

}
