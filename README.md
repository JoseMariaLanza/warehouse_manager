# Panel Autogestión Comercial
## _Self-Management Panel_

SMP (Self-Management Panel) es la versión comercial del Panel Autogestión. La característica principal de éste es que se divide en módulos que pueden ser adquiridos de forma independiente unos de otros según el plan contratado, éstos son:

- [Account (Módulo de cuentas de usuario)](https://gitlab.com/sitenso-comercial/smp-backend/-/tree/main/resources/docs/account)
- [Shifts (Módulo de Turnos)](https://gitlab.com/sitenso-comercial/smp-backend/-/tree/main/resources/docs/shifts)
- Warehouse (Módulo que contiene a Smart Warehouse expuesto como un servicio)
- Documents (Módulo de Gestión Documental)
- Claims (Módulo de Reclamos)
- Orders (Módulo de Gestión de Pedidos)

Los diagramas de la aplicación se pueden consultar [Aquí](https://gitlab.com/jmlanza/smp-backend-own/-/blob/main/resources/docs/diagrams/html-docs/index.html)

## Levantando el proyecto

Para levantar el proyecto sólo se deben seguir los siguientes pasos:

### PASO 1 - Ejecutar _**`composer install`**_
Este comando instalará todas las dependencias necesarias para el funcionamiento del proyecto.
> Paquetes requeridos: `firebase/php-jwt` y `spatie/laravel-permission`.

**Estos paquetes se instalarán automáticamente al ejecutar `composer install`.**

### PASO 2 - Correr migraciones con el comando personalizado _**`php artisan migrate:actions`**_.
### IMPORTANTE:
Para mantener la separación de los distintos módulos se separó en carpetas tanto migraciones como seeders
_**`php artisan migrate:actions`**_ funciona de acuerdo a las conexiones de la base de datos de la siguiente manera:
#### database.php
En el archivo de configuración de bases de datos se modificó `'default' => env('DB_CONNECTION', 'mysql'),` por `'default' => env('DB_CONNECTION', 'core'),` por ende en el *.env* puede obviarse el valor DB_CONNECTION=mysql
##### Conexión 'core'
La razón de setear esta conexión por defecto es la de tener la posibilidad de crear una DB por módulo si se necesita además de tener un orden tanto en las migraciones como en los seeders. Esto no quita la posibilidad de separar en carpetas pero aún así usar la misma conexión "core" para tener todas las tablas en una sola DB.
##### Conexión 'customers'
Se definió una nueva conexión llamada "customers" con los registros de los clientes que adquirieron un plan.

#### Separación de migraciones por carpeta
Se pueden crear las migraciones de cada módulo para mantener un cierto orden en éstas con el fin de poder realizar un versionado de base de datos más fácil de mantener. Si no se define una nueva conexión en database.php y se crea una carpeta el comando tendrá esto en cuenta. Por defecto la conexión es 'core' como se mencionó anteriormente por lo que al correr la migración, las tablas se crearán teniendo en cuenta esta conexión.
##### Código de ejemplo
Se creó un directorio "warehouse", el cual contiene una tabla 'stocks', para correr esta migración usa la conexión "core" aunque esta se encuentre fuera de la carpeta 'core' esto es porque se define en dicha migración la conexión a usar. dicho esto, aunque no es necesario indicar la conexión ya que por defecto es 'core', es buena idea hacerlo para mantener las cosas claras.
```sh
public function up()
{
    Schema::connection('core')->create('stocks', function (Blueprint $table) {
        $table->id();
        $table->integer('quantity')->default(0);
        $table->timestamps();
    });
}
```
Como se indicó anteriormente, no es necesario indicar la conexión (aunque es recomendable), por lo que el código puede quedar de la siguiente manera:
```sh
public function up()
{
    Schema::create('stocks', function (Blueprint $table) {
        $table->id();
        $table->timestamps();
    });
}
```
> CREACIÓN DE TABLA PARA UNA CONEXIÓN CONFIGURADA: Si se quiere crear una tabla en otra DB que no es la de la app (conexión 'core') SI SE DEBE ESPECIFICAR LA CONEXIÓN como se muestra en el siguiente ejemplo:

```sh
public function up()
{
    Schema::connection('customers')->create('customers', function (Blueprint $table) {
        $table->id();
        ...
        $table->timestamps();
    });
}
```
> Esto es así porque existe una conexión llamada "customers" en _**database.php**_

#### Creando migraciones en directorio
Si se quiere crear una migración en un directorio se debe ejecutar el comando de artisan _`php artisan make:migration --path=database/migrations/<nombre_directorio> <nombre_migracion>`_
Ej.: _**`php artisan make:migration --path=database/migrations/core create_new_table`**_
Luego se debe especificar el nombre de la conexión en ésta, como se mostró anteriormente.

#### Creando seeders en directorio
Funciona exactamente igual que las migraciones y al momento de ejecutar un factory se debe especificar la conexión
Para crear un seeder en un determinado directorio se debe ejecutar el comando `php artisan make:seeder <carpeta>\\<NombreClaseTableSeeder>`, por ejemplo:
```sh
php artisan make:seeder core\\StockTableSeeder
```
Ej.:
```sh
public function run()
{
    Stock::factory()->connection('core')->count(1)->create();
}
```
> En este caso son importantes las barras invertidas ya que la clase que se crea tiene un namespace, dicho esto, es obligatorio modificar el namespace agregando el nombre da la carpeta al final
Ej.:
```sh
En seeder namespace Database\Seeders\warehouse;
En Factory namespace Database\Factories\warehouse;
```

##### Pasos para crear un Seeder con Factory
###### PASO 1 - Ejecutar comando `php artisan make:factory warehouse\\StockFactory`
###### PASO 2 - Modificar el namespace `namespace Database\Factories;` por `namespace Database\Factories\warehouse;`
###### PASO 3 - Ejecutar comando `php artisan make:seeder warehouse\\StockTableSeeder`
###### PASO 4 - Modificar el namespace `namespace Database\Seeders;` por `namespace Database\Seeders\warehouse;`
###### PASO 5 - Crear clase `DatabaseSeeder.php` esta clase debe estar junto a los seeders correspondientes, en este caso en la carpeta _warehouse_
###### PASO 6 - Modificar el namespace `namespace Database\Seeders;` por `namespace Database\Seeders\warehouse;`

#### Usar sistema de migraciones y seeders por defecto
Para usar el sistema por defecto basta con modificar la conexión por defecto en `database.php` y descomentar la conexión de la base de datos en el **.env** . Luego ejecutar los comandos de siempre (`php artisan make:migration <nombre_migracion>, php artisan make:seeder <NombreClaseSeeder>, etc.`)
```sh
'default' => env('DB_CONNECTION', 'mysql'),
...
'connections' => [
        ...
        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            ...
```
> No olvidar crear la clase DatabaseSeeder dentre de seeders

##### PASOS PARA ACTIVAR LA MIGRACION POR DEFECTO
###### PASO 1 - Descomentar .env
###### PASO 2 - Setear `'default' => env('DB_CONNECTION', 'mysql')` en `database.php`
###### PASO 3 - Descomentar conexión *mysql* en `database.php`
###### PASO EXTRA - Setear conexion en modelos de 'core' a 'mysql'

### JWT (`firebase/php-jwt`)
El sistema puede recibir un JWT o no dependiendo de lo que se especifique en las variables de entorno dentro del archivo **.env** ACCEPT_JWT y RETURN_JWT, además toma en cuenta si la aplicación está en modo debug o producción.
Para aceptar o retornar JWT se tiene que cambiar a false los valores de dichas variables de entorno.

### customers_db
Se creó una DB externa la cual cuenta con su coneccion, modelos, migraciones y seeders correspondientes. En esta base de datos se registran los clientes que adquirieron un plan.

# > FINALMENTE SE DEBE AGREGAR LA SIGUIENTE LINE A LOS MODELOS CORRESPONDIENTES PARA QUE FUNCIONEN LAS CONSULTAS A LA DB
> o bien agregar connection('core') en cada consulta, pero esto no es recomendable
# > protected $connection= 'core';

## Arquitectura del proyecto

La arquitectura usada es una en capas, La arquitectura hexagonal específicamente.

- smp_backend/
    - app/
        - Http/
            - Controllers/
                - Api/
                    - v1/
                        - Account/
                        - Shifts/
        - Middleware/
        - Models/
            - Shifts/
            - User
    - Core/
        - Account/
            - Infrastructure/
            - Application/
            - Domain/
        - Shifts/
            - Infrastructure/
            - Application/
            - Domain/

La App está dividida en el framework y la aplicación. Como se puede observar, el la carpeta app está al mismo nivel que la aplicación (Core), la cual contiene los módulos separados unos de otros e implementan las en cada uno de ellos las capas correspondientes de la arquitectura definida.

### Capas de un módulo

- **Account:** Este módulo contiene la lógica de la cuenta de los usuarios de la aplicación. Contiene además el servicio para la decodificación de JWT.
- **Shifts:** Este módulo contendrá la lógica del módulo de turnos.

### Flujo de datos del proyecto | Comunicación entre capas de un módulo

| Capas | Descripción | Comunicación |
| ------ | ------ | ------ |
| Infrastructure | En esta están definidas interfaces y fachadas. | Application (Bidireccional) |
| | No debe contener lógica del negocio. | |
| | Se realizan validaciones de los requests. | |
| | | |
| Application | Se definen los casos de uso para el **módulo** y el **modelo** en concreto | Domain (Bidireccional) | 
| | | |
| Domain | Se define la lógica del negocio | Application (Unidireccional) |
| | Se definen las validaciones específicas del módulo, relacionadas a la lógica del negocio | |
| | Realiza operaciones para la persistencia de los datos | |
| | | |

### Creación de una nueva app y modulos dentro del proyecto

#### Comandos personalizados
Se crearon comandos personalizados para facilitar la creación de una app y/o módulo nuevos mediante los siguientes comandos

##### Creación de una aplicación con un módulo inicial
- `php artisan make:module`: este comando está ubicado en **_app/Console/Commands/MakeModuleCommand_** recibe dos parámetros para la creación de la aplicación o creación de un módulo dentro de una aplicación que puede o no estar creada, éstos son `<appname>` y `<modulename>`. El comando en cuestión quedaría de la siguiente manera en la consola de comandos:
```sh
    php artisan make:module core auth 
```
Siendo `core` el nombre de la aplicación y `auth` el nombre del módulo a crear.

**IMPORTANTE:**
_**Los nombres pueden ser escriton con la primera letra en mayúscula o minúscula, esto es indistinto cuando se trata de nombres de una sola palabra, para los casos en que el nombre consista en más de una palabra, la primera puede o no escribirse con minúsculas, pero las siguientes deben ser escritas en notación `camel case`.**_

Una vez ejecutado el comando, artisan habrá creado una aplicación nueva dentro del framework de Laravel con la arquitectura definida.

**Aclaraciones acerca de la arquitectura**
**Capa de infraestructura:**
Esta capa comprende rutas, middlewares, controladores, comandos, etc. los cuales forman parte del framework, se puede observar que cada módulo tiene su capa de infraestructura la cual se comunica con la capa de aplicación, la cual contiene los distintos casos de uso para el módulo.

**Capa de aplicación**
Se comunica con la capa de infraestructura y dominio.

**Capa de dominio**
Contiene la lógica de negocio, se comunica con la capa de aplicación y con realiza las peticiones a la base de datos accediendo a los modelos u obteniendo datos externos. Se hacen también validaciones de reglas del negocio.

###### Comandos que usa _`php artisan make:module`_
**`php artisan make:interface:`** Crea una interfaz según el contenido del archivo _**stubs/interface.stub**_.

| Ubicación | Parámetros | Capa |
| ------ | ------ | ------ |
| **_app/Console/Commands/MakeInterfaceCommand_** | app, module, layer, name | Infrastructure |

**`php artisan make:facade:`** Crea una clase que hereda de Facade e implementa la interfaz correspondiente según _**stubs/facade.stub**_.
| Ubicación | Parámetros | Capa |
| ------ | ------ | ------ |
| **_app/Console/Commands/MakeFacadeCommand_** | app, module, layer, name | Infrastructure |

**`php artisan make:validation:`** Crea una clase según _**stubs/validation.stub**_.
| Ubicación | Parámetros | Capa |
| ------ | ------ | ------ |
| **_app/Console/Commands/MakeValidationCommand_** | app, module, layer, name | Infrastructure |

**`php artisan make:usecase:`** Crea una clase según _**stubs/usecase.stub**_.
| Ubicación | Parámetros | Capa |
| ------ | ------ | ------ |
| **_app/Console/Commands/MakeUseCaseCommand_** | app, module, layer, name | Application |

**`php artisan make:service:`** Crea una clase según _**stubs/service.stub**_. En ésta va la lógica del negocio.
| Ubicación | Parámetros | Capa |
| ------ | ------ | ------ |
| **_app/Console/Commands/MakeServiceCommand_** | app, module, layer, name | Domain |

**`php artisan make:repository:`**  Crea una clase según _**stubs/repository.stub**_. Aquí se define el origen de los datos (Modelos, DB externas, ERP - SAP).
| Ubicación | Parámetros | Capa |
| ------ | ------ | ------ |
| **_app/Console/Commands/MakeRepositoryCommand_** | app, module, layer, name | Domain |

#### Estos comandos pueden ser ejecutados de manera independiente pero respetando siempre el orden de los parámetros.
