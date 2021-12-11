  <?php
  /**
   * config.php
   * @author elapp
   */

    define("DB_USER","root");
    define("DB_PASSWORD","root");
    define("HOST", "localhost");
    define("DB_NAME", "dbBeauteDivine");

    $CRUD = [
      "get"=>["description"=>"↦ Afficher ","prefixe"=>"get"],
      "post"=>["description"=>"↦ Créer ou ajouter ","prefixe"=>"create"],
      "put"=>["description"=>"↦ Mettre à jour ","prefixe"=>"update"],
      "delete"=>["description"=>"↦ Supprimer ", "prefixe"=>"delete"]
    ];

    $_ROUTES = [
      "products"=>["one"=>"un produit","all"=>"tous les produits"],
      "categories"=>["one"=>"une categorie","all"=>"toutes les catégories"],
      "orders"=>["one"=>"une commande","all"=>"toutes les commandes"],
      "users"=>["one"=>"un client","all"=>"tous les clients"]
    ];

?>