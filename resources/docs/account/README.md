# Módulo de Cuentas de Usuario
## _Account_

El módulo de cuentas de usuario incorpora los paquetes `firebase/php-jwt` y `spatie/laravel-permission` para el sistema de autenticación y autorizaciones además de sanctum el cual ya viene incorporado en la versión 8 de laravel.

### Funcionamiento del sistema de autenticación (`laravel/sanctum`)
En este proyecto se usa sanctum sólo para las autorizaciones, no así su funcionalidad para los permisos ya que ésta última no cumple con las necesidades del negocio.

### Funcionamiento de JWT (`firebase/php-jwt`)
Se implementó `firebase/php-jwt`para la protección de las solicitudes.
El sistema puede recibir un JWT o no dependiendo de lo que se especifique en las variables de entorno dentro del archivo **.env** ACCEPT_JWT y RETURN_JWT, además toma en cuenta si la aplicación está en modo debug o producción.

* **El servicio para la encriptación y decriptación del JWT recibido y/o retornado se encuentra en este módulo (*Account*).**
* **Para la encriptación de los datos se creó un middleware que recibe la petición a la ruta con el JWT y lo decodifica, una vez decodificado los datos siguen el flujo normal (`controller --> capa de infraestructura ... `).**

> Ejemplo: rutas de autenticación (archivo account.php)

  ```sh
    Route::middleware(['jwt.decoder'])->group(function () {
        Route::post('v1/register', [AccountControllerV1::class, 'register']);
        Route::post('v1/login', [AccountControllerV1::class, 'login']);
    });
    
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('v1/user-profile', [AccountControllerV1::class, 'userProfile']);
        Route::get('v1/logout', [AccountControllerV1::class, 'logout']);
    });
  ```

* **Para retornar datos encriptados o desenciptados, se hace el llamado del método parse() del servicio antes de retornar la respuesta al controlador.**

La razón de tener la posibilidad elegir el tipo de respuesta se debe a que facilita la tarea de desarrollo.

### Funcionamiento del sistema de autorización (`spatie/laravel-permission`)
Este paquete tiene la ventaja que se pueden definir por un lado grupos de permisos asignados a un rol determinado y por otro permisos individuales asignados a una entidad, dicha entidad en este caso es la de usuario (User), pero puede ser asignada a otro tipo de entidades. Tiene ya definidas funciones para la fácil asignación de roles y permisos.

* **Middleware `plan.modules:<Nombre_modulo>`: Este middleware define qué cliente tiene acceso los módulos según el plan contratado**
  > Ejemplo: Si el cliente tiene contratado el plan básico y a su vez este plan solo incluye el módulo de Turnos, éste solo podrá acceder dicho módulo.
  ```sh
    'plan.modules:Shifts'
  ```
* **Middleware `Auth<Nombre>Middleware`: Este middleware define qué cliente tiene acceso a la ruta según el rol que tiene asignado**
  > Ejemplo: Suponiendo que el cliente tiene acceso al módulo de Turnos, se requiere ahora determinar que el usuario autenticado tiene el rol correcto para acceder a la ruta solicitada.
  ```sh
    AuthShiftRolesMiddleware::class
  ```
  > El middleware consultará si el rol del usuario tiene los permisos necesarios para acceder a esa ruta.

> En el archivo de rutas shifts.php la declaración quedaría de la siguiente manera teniendo en cuenta los middleware anteriores que deben llamarse:
```sh
    Route::middleware(['auth:sanctum', 'jwt.decoder', 'plan.modules:Shifts', AuthShiftRolesMiddleware::class])->group(function () {
        Route::get('v1/', [ShiftController::class, 'index'])->middleware('jwt.decoder');
    });
```

* **

## Flujo de la información
1. La _**request**_ viaja a la API.
2. Middleware sanctum
3. Middleware jwt.decoder
4. Middleware plan.modules:<Nombre_modulo>
5. Middleware Auth<Nombre>Middleware
6. Controller
7. "Nombre de la aplicación " (en este caso Core)
8. "Nombre del módulo" (Account/Shifts/etc.)
9. Infrastructure
10. Application
11. Domain
12. ERP/DB

> **¡IMPORTANTE!: Los módulos se comunican entre sí con el módulo contigüo**
1. Infrastructure: Está comprendida por algunas partes del framework (rutas, controladores, middlewares, etc.) además de la capa correspondiente en cada módulo, la cual contiene interfaces, fachadas y Request validators
2. Application: Se compone de los distintos casos de uso con respecto al módulo en cuestión. Se separa en grupos de casos de uso para cada entidad (modelo) que participa en el módulo.
3. Domain: Contiene la lógica del negocio y se comunica con la capa de persistencia de datos (modelos).

## Rutas
1. _**{url}/account/v1/login**_ (Sign In)
2. _**{url}/account/v1/register**_ (Register new user)
3. _**{url}/account/v1/user-profile**_ (Get user profile)
4. _**{url}/account/v1/logout**_ (Sign Out)

_**Importar y consultar Json de Postman y su documentación para más detalles**_
