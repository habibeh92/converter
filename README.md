
# Converter  
Simple data converter to convert different data types like JSON and XML into specified entities.  
  
## Installation  
You can install it in your application via composer using command below:  
```  
composer require habibeh92/converter  
```  
### Requirements  
- `"php": ">=8.0"`  
  
## How to use  
Once it installed, you can convert any type of data easily (currently JSON and XML is supported) into predefined objects. In that case, you need to call `handle` method of the `Converter`, which needs an instance of `Decoder`, to simply convert your data.  The `handle` method receives an instance of entity and the data, which is needed to be converted, and returns an initialized instance.  
```php  
$entity = new DataEntity();  
$converter = new Converter(new JsonDecoder());  
$entity = $converter->handle($entity, $json_data);  
```  
### Defining Entities  
The entities, which are going to be filled with the data, should have some predefined properties with specified `DataType` attribute. The `DataType` needs two parameters, `field` and `type`, which `field` is required, and it shows the field name in the incoming data. The `type` parameter should be filled for the array properties, and it shows the entity of each object.  
```php  
<?php    
 namespace Converter\Tests\Feature\Entities;    
 
 use Converter\Attributes\DataType;    
 
 class Post {    
 
  #[DataType(field: 'title')]    
  public string $title;    
    
  #[DataType(field: 'name')]    
  public string $slug;  
   #[DataType(field: 'content-labels', type: Label::class)]    
  public array $labels;  
  
}  
```  
### Custom Decoders  
You can create your own custom decvoder (like HTML converter). All the decoders needs to implement `Converter\Decoders\Decoder` interface. You should implement the `handle` method in your decoder which accepts the `$data` parameter and it is needed to decode the data to an array and returns it
```php  
<?php    
 namespace Converter\Decoders;   
  
 use Converter\Decoders\Decoder;    
 
 class HtmlDecoder implements Decoder {    
 
	 /**    
	 * @inheritDoc    
	 */    
	public function handle($data): array    
	  {    
	     $array = $this->decodeToArray($data); // convert the data to an array  
	     return $array;  
	 } 
}  
```  
## Contribution  
Thank you for considering contributing. Please feel free to create pull requests.  
  
Hope you enjoy it.
