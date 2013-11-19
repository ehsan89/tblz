Add these lines to application config.yml: 
    - { resource: @ApplicationShoppingBundle/Resources/config/services.yml }
    - { resource: @ApplicationShoppingBundle/Resources/config/parameters.yml }
    - { resource: @ApplicationShoppingBundle/Resources/config/twig.yml }
    
For adding a new product for sale these actions must be made:

1. Add the create function to cartItemRepository with three arguments. for example: 
	public function createProductItem($resource_id, $quantity, $properties = array())
	